<?php

namespace App\Http\Controllers;

use App\Http\Requests\WEB\Chapter\ChapterRequestStore;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    protected $chapter, $course;

    public function __construct(Chapter $chapter, Course $course)
    {
        $this->chapter = $chapter;
        $this->course = $course;
    }

    public function index()
    {
    }

    public function table(Request $request, $id)
    {
        $data["search"] = "";

        $chapters = $this->chapter->query();

        if ($request->search) {
            $data["search"] = $request->search;
            $chapters->where("chapter_name", "like", "%$request->search%");
        }

        $chapters->where(function ($query) use ($id) {
            $query->whereHas('course', function ($query) use ($id) {
                $query->where('uuid', $id);
            });
        });

        $chapters = $chapters->with(["user", "document"])->paginate($request->per_page);

        $data["chapters"] = json_encode($chapters);
        $data["courseId"] = $id;

        return view('course.chapter.table', $data);
    }

    public function create(string $id)
    {
        $course = $this->course->where("uuid", $id)->first();
        if (!$course) {
            abort(404);
        }

        $data = [
            'course' => $course
        ];

        return view('course.chapter.create', $data);
    }

    public function store(ChapterRequestStore $request, string $id)
    {
        DB::beginTransaction();

        $course = $this->course->where("uuid", $id)->first();
        if (!$course) {
            abort(404);
        }

        try {
            $request->merge([
                'user_id' => Auth::user()->id,
                'course_id' => $course->id,
                'chapter_slug' => Str::slug($request->chapter_name)
            ]);

            $chapter = $this->chapter->create($request->all());

            if ($request->hasFile('chapter_document')) {
                $attributes["document_path"] = $request->file('chapter_document')->store('chapters');
                $attributes["document_name"] = $request->file('chapter_document')->getClientOriginalName();
                $chapter->document()->create($attributes);
            }

            DB::commit();
            return redirect(route("web.course.show", $id))->with("successMessage", '<script>swal("Selamat!", "bab baru berhasil ditambahkan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(string $id, string $chapter)
    {
        $course = $this->course->where("uuid", $id)->first();
        if (!$course) {
            abort(404);
        }

        $chapter = $this->chapter->where("uuid", $chapter)->first();
        if (!$chapter) {
            abort(404);
        }

        $data = [
            "chapter" => $chapter
        ];

        return view('course.chapter.show', $data);
    }

    public function edit(string $id, string $chapter)
    {
        $course = $this->course->where("uuid", $id)->first();
        if (!$course) {
            abort(404);
        }

        $chapter = $this->chapter->where("uuid", $chapter)->first();
        if (!$chapter) {
            abort(404);
        }

        $data = [
            "chapter" => $chapter
        ];

        return view('course.chapter.edit', $data);
    }

    public function update(ChapterRequestStore $request, string $id, string $chapter)
    {
        DB::beginTransaction();

        $chapter = $this->chapter->where("uuid", $chapter)->first();
        if (!$chapter) {
            abort(404);
        }

        try {
            $request->merge([
                'chapter_slug' => Str::slug($request->chapter_name)
            ]);
            $chapter->update($request->all());

            if ($request->hasFile('chapter_document')) {
                $attributes["document_path"] = $request->file('chapter_document')->store('chapters');
                $attributes["document_name"] = $request->file('chapter_document')->getClientOriginalName();

                if ($chapter->document) {
                    Storage::delete($chapter->document->document_path);
                    $chapter->document()->update($attributes);
                } else {
                    $chapter->document()->create($attributes);
                }
            }

            DB::commit();
            return redirect(route('web.course.show', ['course' => $id]))->with("successMessage", '<script>swal("Selamat!", "bab berhasil diperbaharui!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function destroy($id, $chapter)
    {
        DB::beginTransaction();

        $chapter = $this->chapter->where("uuid", $chapter)->first();
        if (!$chapter) {
            abort(404);
        }

        try {
            $chapter->delete();

            DB::commit();
            return redirect(route('web.course.show', ['course' => $id]))->with("successMessage", '<script>swal("Selamat!", "bab berhasil dihapus!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
