<?php

namespace App\Http\Controllers;

use App\Http\Requests\WEB\DiscussionRequest;
use App\Models\Discussion;
use App\Models\StudyGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiscussionController extends Controller
{
    protected $discussion, $studyGroup, $user;

    public function __construct(Discussion $discussion, StudyGroup $studyGroup, User $user)
    {
        $this->discussion = $discussion;
        $this->studyGroup = $studyGroup;
        $this->user = $user;
    }

    public function index()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        $data = [
            "discussions" => $this->discussion->all(),
            "studyGroups" => $this->studyGroup->all(),
            "user" => $user
        ];

        return view('discussion.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(DiscussionRequest $request)
    {
        DB::beginTransaction();

        $studyGroup = $this->studyGroup->where("uuid", $request->study_group_id)->first();
        if (!$studyGroup) {
            abort(404);
        }

        try {
            $studyGroup->discussion()->create($request->all());

            DB::commit();
            return redirect(route("web.discussion.index"))->with("successMessage", '<script>swal("Selamat!", "link diskusi berhasil ditambahkan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(Discussion $discussion)
    {
        //
    }

    public function edit(string $id)
    {
        $discussion = $this->discussion->where("uuid", $id)->first();
        if (!$discussion) {
            abort(404);
        }

        $data = [
            "discussion" => $discussion,
            "studyGroups" => $this->studyGroup->all(),
        ];

        return view("discussion.edit", $data);
    }

    public function update(DiscussionRequest $request, string $id)
    {
        DB::beginTransaction();

        $discussion = $this->discussion->where("uuid", $id)->first();

        if (!$discussion) {
            abort(404);
        }

        try {
            $discussion->update($request->all());

            DB::commit();
            return redirect(route("web.discussion.index"))->with("successMessage", '<script>swal("Selamat!", "link diskusi berhasil diperbaharui!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        $discussion = $this->discussion->where("uuid", $id)->first();

        if (!$discussion) {
            abort(404);
        }

        try {
            $discussion->delete();

            DB::commit();
            return $discussion;
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
