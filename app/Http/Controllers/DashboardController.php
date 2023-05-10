<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function __invoke(Request $request)
    {
        $data = [];

        if (Auth::user()->hasRole("Siswa")) {
            $data["user"] = $this->user->findOrFail(Auth::user()->id);
        }

        return view("dashboard.index", $data);
    }
}
