<?php

namespace App\Http\Controllers;

use App\Http\Requests\WEB\LiveClass\LiveClassRequest;
use App\Models\LiveClass;
use App\Models\StudyGroup;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LiveClassController extends Controller
{
    protected $liveClass, $studyGroup, $user;

    public function __construct(LiveClass $liveClass, StudyGroup $studyGroup, User $user)
    {
        $this->liveClass = $liveClass;
        $this->studyGroup = $studyGroup;
        $this->user = $user;
    }

    public function index()
    {
        $data = [
            "liveClasses" => $this->liveClass->all(),
            "studyGroups" => $this->studyGroup->all(),
            "teachers" => $this->user->role("Guru")->get()
        ];

        if (Auth::user()->hasRole('Guru')) {
            $data["liveClasses"] = $this->liveClass->where("user_id", Auth::user()->id)->get();
        }

        return view('liveClass.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(LiveClassRequest $request)
    {
        DB::beginTransaction();

        $studyGroup = $this->studyGroup->where('uuid', $request->study_group_id)->first();
        if (!$studyGroup) {
            abort(404);
        }

        $user = $this->user->where('uuid', $request->user_id)->first();
        if (!$user) {
            abort(404);
        }

        try {
            $request->merge([
                "study_group_id" => $studyGroup->id,
                "user_id" => $user->id
            ]);

            $this->liveClass->create($request->all());

            DB::commit();
            return redirect(route("web.live-class.index"))->with("successMessage", '<script>swal("Selamat!", "jadwal berhasil ditambahkan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(string $liveClass)
    {
        $liveClass = $this->liveClass->where('uuid', $liveClass)->first();
        if (!$liveClass) {
            abort(404);
        }

        $data = [
            "liveClass" => $liveClass,
        ];

        return view('liveClass.show', $data);
    }

    public function edit(string $liveClass)
    {
        $liveClass = $this->liveClass->where('uuid', $liveClass)->first();
        if (!$liveClass) {
            abort(404);
        }

        $data = [
            "liveClass" => $liveClass,
            "studyGroups" => $this->studyGroup->all(),
            "teachers" => $this->user->role("Guru")->get()
        ];

        return view('liveClass.edit', $data);
    }

    public function update(LiveClassRequest $request, string $liveClass)
    {
        $liveClass = $this->liveClass->where('uuid', $liveClass)->first();
        if (!$liveClass) {
            abort(404);
        }

        $studyGroup = $this->studyGroup->where('uuid', $request->study_group_id)->first();
        if (!$studyGroup) {
            abort(404);
        }

        $user = $this->user->where('uuid', $request->user_id)->first();
        if (!$user) {
            abort(404);
        }

        try {
            $request->merge([
                "study_group_id" => $studyGroup->id,
                "user_id" => $user->id
            ]);

            $liveClass->update($request->all());

            DB::commit();
            return redirect(route("web.live-class.index"))->with("successMessage", '<script>swal("Selamat!", "jadwal berhasil diperbaharui!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function destroy(string $liveClass)
    {
        $liveClass = $this->liveClass->where('uuid', $liveClass)->first();
        if (!$liveClass) {
            abort(404);
        }

        try {
            $liveClass->delete();

            DB::commit();
            return redirect(route('web.live-class.index'))->with("successMessage", '<script>swal("Selamat!", "jadwal berhasil dihapus!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
