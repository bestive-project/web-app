<?php

namespace App\Http\Controllers;

use App\Models\LiveClass;
use App\Models\LiveCounseling;
use App\Models\LogRecording;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogRecordingController extends Controller
{
    protected $liveClass, $liveCounseling, $logRecording;

    public function __construct(LiveClass $liveClass, LiveCounseling $liveCounseling, LogRecording $logRecording)
    {
        $this->liveClass = $liveClass;
        $this->liveCounseling = $liveCounseling;
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

        if ($request->isCounseling) {
            $liveCounseling = $this->liveCounseling->where('uuid', $request->live_class_id)->first();
            if (!$liveCounseling) {
                abort(404);
            }

            $request->merge([
                "log_type" => $this->logRecording::TYPE_LIVECOUNSELING
            ]);

            $route = route("web.live-counseling.show", $liveCounseling->uuid);

            $id = $liveCounseling->id;
        } else {
            $liveClass = $this->liveClass->where('uuid', $request->live_class_id)->first();
            if (!$liveClass) {
                abort(404);
            }

            $request->merge([
                "log_type" => $this->logRecording::TYPE_LIVECLASS
            ]);

            $route = route("web.live-class.show", $liveClass->uuid);

            $id = $liveClass->id;
        }

        try {
            $request->merge([
                "live_id" => $id,
                "link_title" => Carbon::now()->isoFormat("dddd, D MMMM YYYY")
            ]);

            $this->logRecording->create($request->all());

            DB::commit();
            return redirect($route)->with("successMessage", '<script>swal("Selamat!", "recording berhasil ditambahkan!", "success")</script>');
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

        if ($logRecording->log_type == LogRecording::TYPE_LIVECOUNSELING) {
            $route = route("web.live-counseling.show", $logRecording->liveCounseling->uuid);
        } else {
            $route = route("web.live-class.show", $logRecording->liveClass->uuid);
        }

        try {
            $logRecording->delete();

            DB::commit();
            return redirect($route)->with("successMessage", '<script>swal("Selamat!", "record berhasil dihapus!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
