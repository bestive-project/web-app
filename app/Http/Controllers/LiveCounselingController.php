<?php

namespace App\Http\Controllers;

use App\Http\Requests\WEB\LiveCounseling\LiveCounselingRequest;
use App\Models\LiveCounseling;
use App\Models\StudyGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiveCounselingController extends Controller
{
    protected $liveCounseling, $studyGroup;

    public function __construct(LiveCounseling $liveCounseling, StudyGroup $studyGroup)
    {
        $this->liveCounseling = $liveCounseling;
        $this->studyGroup = $studyGroup;
    }

    public function index()
    {
        $data = [
            "liveCounselings" => $this->liveCounseling->all(),
            "studyGroups" => $this->studyGroup->all()
        ];

        return view("liveCounseling.index", $data);
    }

    public function create()
    {
        //
    }

    public function store(LiveCounselingRequest $request)
    {
        DB::beginTransaction();

        $studyGroup = $this->studyGroup->where('uuid', $request->study_group_id)->first();
        if (!$studyGroup) {
            abort(404);
        }

        try {
            $request->merge([
                "study_group_id" => $studyGroup->id
            ]);

            $this->liveCounseling->create($request->all());

            DB::commit();
            return redirect(route("web.live-counseling.index"))->with("successMessage", '<script>swal("Selamat!", "jadwal berhasil ditambahkan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(string $liveCounseling)
    {
        $liveCounseling = $this->liveCounseling->where('uuid', $liveCounseling)->first();
        if (!$liveCounseling) {
            abort(404);
        }

        $data = [
            "liveCounseling" => $liveCounseling,
        ];

        return view('liveCounseling.show', $data);
    }

    public function edit(string $liveCounseling)
    {
        $liveCounseling = $this->liveCounseling->where('uuid', $liveCounseling)->first();
        if (!$liveCounseling) {
            abort(404);
        }

        $data = [
            "liveCounseling" => $liveCounseling,
            "studyGroups" => $this->studyGroup->all()
        ];

        return view('liveCounseling.edit', $data);
    }

    public function update(LiveCounselingRequest $request, string $liveCounseling)
    {
        $liveCounseling = $this->liveCounseling->where('uuid', $liveCounseling)->first();
        if (!$liveCounseling) {
            abort(404);
        }

        $studyGroup = $this->studyGroup->where('uuid', $request->study_group_id)->first();
        if (!$studyGroup) {
            abort(404);
        }

        try {
            $request->merge([
                "study_group_id" => $studyGroup->id
            ]);

            $liveCounseling->update($request->all());

            DB::commit();
            return redirect(route("web.live-counseling.index"))->with("successMessage", '<script>swal("Selamat!", "jadwal berhasil diperbaharui!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function destroy(string $liveCounseling)
    {
        $liveCounseling = $this->liveCounseling->where('uuid', $liveCounseling)->first();
        if (!$liveCounseling) {
            abort(404);
        }

        try {
            $liveCounseling->delete();

            DB::commit();
            return redirect(route('web.live-counseling.index'))->with("successMessage", '<script>swal("Selamat!", "jadwal berhasil dihapus!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
