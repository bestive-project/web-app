<?php

namespace App\Http\Controllers;

use App\Models\LiveClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    protected $liveClass, $user;

    public function __construct(LiveClass $liveClass, User $user)
    {
        $this->liveClass = $liveClass;
        $this->user = $user;
    }

    public function liveClass()
    {
        $data = [
            "user" => $this->user->findOrFail(Auth::user()->id)
        ];

        return view('schedule.liveClass', $data);
    }
}
