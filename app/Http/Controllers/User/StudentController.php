<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Student\StudentRequest;
use App\Models\StudyGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    protected $user, $studyGroup;

    public function __construct(User $user, StudyGroup $studyGroup)
    {
        $this->user = $user;
        $this->studyGroup = $studyGroup;
    }

    public function index()
    {
        $students = $this->user->role("Siswa")->whereHas("student", function ($query) {
            $query->where("study_group_id", 0);
        })->get();

        $data = [
            "students" => $students,
            "studyGroups" => $this->studyGroup->all()
        ];

        return view('user.student.index', $data);
    }

    public function table(Request $request)
    {
        $data["search"] = "";

        $users = $this->user->query();

        if ($request->search) {
            $data["search"] = $request->search;
            $users->where("name", "like", "%$request->search%");
        }

        $users = $users->role("Siswa")->with("student")->paginate($request->per_page);

        $data["users"] = json_encode($users);

        return view('user.student.table', $data);
    }

    public function show(string $id)
    {
        $user = $this->user->where("uuid", $id)->first();
        if (!$user) {
            abort(404);
        }

        $data = [
            "student" => $user
        ];

        return view('user.student.show', $data);
    }

    public function assignGroup(Request $request, string $id)
    {
        DB::beginTransaction();

        $user = $this->user->where("uuid", $id)->first();
        if (!$user) {
            abort(404);
        }

        $studyGroup = $this->studyGroup->where("uuid", $request->study_group_id)->first();
        if (!$studyGroup) {
            abort(404);
        }

        try {
            $user->student()->update([
                "study_group_id" => $studyGroup->id
            ]);

            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function update(StudentRequest $request, string $id)
    {
        DB::beginTransaction();

        $user = $this->user->where("uuid", $id)->first();
        if (!$user) {
            abort(404);
        }

        try {
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
            ]);
            $user->student()->update([
                "birth_place" => $request->birth_place,
                "date_birth" => $request->date_birth,
                "class" => $request->class,
                "school" => $request->school,
                "phone" => $request->phone,
            ]);

            DB::commit();
            return redirect(route("web.student.show", $id))->with("successMessage", '<script>swal("Selamat!", "pengguna berhasil diperbaharui!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
