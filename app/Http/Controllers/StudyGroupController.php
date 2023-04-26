<?php

namespace App\Http\Controllers;

use App\Http\Requests\WEB\StudyGroupRequest;
use App\Models\Student;
use App\Models\StudyGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudyGroupController extends Controller
{
    protected $studyGroup;
    protected $student;

    public function __construct(StudyGroup $studyGroup, Student $student)
    {
        $this->studyGroup = $studyGroup;
        $this->student = $student;
    }

    public function index()
    {
        return view("studyGroup.index");
    }

    public function table(Request $request)
    {
        $data["search"] = "";

        $studyGroups = $this->studyGroup->query();

        if ($request->search) {
            $data["search"] = $request->search;
            $studyGroups->where("name", "like", "%$request->search%");
        }

        $studyGroups = $studyGroups->with("students")->paginate($request->per_page);

        $data["studentWithoutGroup"] =  $this->student->studyGroupNull()->get();
        $data["studyGroups"] = json_encode($studyGroups);

        return view('studyGroup.table', $data);
    }

    public function create()
    {
        //
    }

    public function store(StudyGroupRequest $request)
    {
        DB::beginTransaction();

        try {
            $this->studyGroup->create($request->all());

            DB::commit();
            return redirect(route("web.study-group.index"))->with("successMessage", '<script>swal("Selamat!", "nama kelompok berhasil ditambahkan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(StudyGroup $studyGroup)
    {
        //
    }

    public function edit(string $id)
    {
        $studyGroup = $this->studyGroup->where("uuid", $id)->first();

        if (!$studyGroup) {
            abort(404);
        }

        return $studyGroup;
    }

    public function update(StudyGroupRequest $request, string $id)
    {
        DB::beginTransaction();

        $studyGroup = $this->studyGroup->where("uuid", $id)->first();

        if (!$studyGroup) {
            abort(404);
        }

        try {
            $studyGroup->update($request->all());

            DB::commit();
            return redirect(route("web.study-group.index"))->with("successMessage", '<script>swal("Selamat!", "nama kelompok berhasil diperbaharui!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        $studyGroup = $this->studyGroup->where("uuid", $id)->first();

        if (!$studyGroup) {
            abort(404);
        }

        try {
            foreach ($studyGroup->students as $student) {
                $student->update([
                    "study_group_id" => 0
                ]);
            }

            $studyGroup->discussion()->delete();

            $studyGroup->delete();

            DB::commit();
            return $studyGroup;
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
