<?php

namespace App\Http\Controllers;

use App\Models\LiveClass;
use App\Models\LogRecording;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogRecordingController extends Controller
{
    protected $liveClass, $logRecording;

    public function __construct(LiveClass $liveClass, LogRecording $logRecording)
    {
        $this->liveClass = $liveClass;
        $this->logRecording = $logRecording;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            "link_recording" => 'required'
        ]);

        $liveClass = $this->liveClass->where('uuid', $request->live_class_id)->first();
        if (!$liveClass) {
            abort(404);
        }

        try {
            $request->merge([
                "live_class_id" => $liveClass->id,
                "link_title" => Carbon::now()->isoFormat("dddd, d MMMM YYYY")
            ]);

            $this->logRecording->create($request->all());

            DB::commit();
            return redirect(route("web.live-class.show", $liveClass->uuid))->with("successMessage", '<script>swal("Selamat!", "recording berhasil ditambahkan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(LogRecording $logRecording)
    {
        //
    }

    public function edit(LogRecording $logRecording)
    {
        //
    }

    public function update(Request $request, LogRecording $logRecording)
    {
        //
    }

    public function destroy(string $logRecording)
    {
        DB::beginTransaction();

        $logRecording = $this->logRecording->where('uuid', $logRecording)->first();
        if (!$logRecording) {
            abort(404);
        }

        $liveClassId = $logRecording->liveClass->uuid;

        try {
            $logRecording->delete();

            DB::commit();
            return redirect(route('web.live-class.show', $liveClassId))->with("successMessage", '<script>swal("Selamat!", "record berhasil dihapus!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
