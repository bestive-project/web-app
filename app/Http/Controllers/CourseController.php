<?php

namespace App\Http\Controllers;

use App\Http\Requests\WEB\Course\CourseRequestStore;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    protected $course, $category;

    public function __construct(Course $course, Category $category)
    {
        $this->course = $course;
        $this->category = $category;
    }

    public function index()
    {
        $data = [
            "courses" => $this->course->all()
        ];

        return view("course.index", $data);
    }

    public function table(Request $request)
    {
        $data["search"] = "";

        $courses = $this->course->query();

        if ($request->search) {
            $data["search"] = $request->search;
            $courses->where("course_name", "like", "%$request->search%");
        }

        if (Auth::user()->roles('Guru')) {
            $courses->where('user_id', Auth::user()->id);
        }

        $courses = $courses->with(["user", "category"])->paginate($request->per_page);

        $data["courses"] = json_encode($courses);

        return view('course.table', $data);
    }

    public function create()
    {

        $data = [
            "categories" => $this->category->all()
        ];

        return view('course.create', $data);
    }

    public function store(CourseRequestStore $request)
    {
        DB::beginTransaction();

        $category = $this->category->where('uuid', $request->category_id)->first();
        if (!$category) {
            abort(404);
        }

        try {
            $request->merge([
                'user_id' => Auth::user()->id,
                'category_id' => $category->id,
                'course_slug' => Str::slug($request->course_name)
            ]);
            $this->course->create($request->all());

            DB::commit();
            return redirect(route("web.course.index"))->with("successMessage", '<script>swal("Selamat!", "materi berhasil ditambahkan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(string $id)
    {
        $course = $this->course->where("uuid", $id)->first();
        if (!$course) {
            abort(404);
        }

        $data = [
            "course" => $course,
            "categories" => $this->category->all()
        ];

        return view('course.show', $data);
    }

    public function showBySlug($slug)
    {
        $course = $this->course->where("course_slug", $slug)->first();
        if (!$course) {
            abort(404);
        }

        return $this->show($course->uuid);
    }

    public function update(CourseRequestStore $request, string $id)
    {
        DB::beginTransaction();

        $course = $this->course->where("uuid", $id)->first();
        if (!$course) {
            abort(404);
        }

        $category = $this->category->where('uuid', $request->category_id)->first();
        if (!$category) {
            abort(404);
        }

        try {
            $request->merge([
                'category_id' => $category->id,
                'course_slug' => Str::slug($request->course_name),
            ]);
            $course->update($request->all());

            DB::commit();
            return back()->with("successMessage", '<script>swal("Selamat!", "materi berhasil diperbaharui!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function updateStatus(string $id)
    {
        DB::beginTransaction();

        $course = $this->course->where("uuid", $id)->first();
        if (!$course) {
            abort(404);
        }

        try {
            $course->update([
                "course_status" => $course->course_status == Course::ACTIVE ? Course::DEACTIVE : Course::ACTIVE
            ]);

            DB::commit();
            return $course;
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        $course = $this->course->where("uuid", $id)->first();
        if (!$course) {
            abort(404);
        }

        try {
            if ($course->chapters) {
                $course->chapters()->delete();
            }
            $course->delete();

            DB::commit();
            return redirect(route('web.course.index'))->with("successMessage", '<script>swal("Selamat!", "bab berhasil dihapus!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
