<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function process(LoginRequest $request)
    {
        $user = $this->user->where("email", $request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            return back()->with("message", "email atau password salah!")->withInput();
        }

        $request->session()->regenerate();

        Auth::attempt($request->validated());

        return redirect(route("web.dashboard.index"));
    }
}
