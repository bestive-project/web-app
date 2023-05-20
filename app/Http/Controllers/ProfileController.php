<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $data = [
            "user" => $this->user->findOrFail(Auth::user()->id)
        ];

        return view('user.profile.index', $data);
    }
}
