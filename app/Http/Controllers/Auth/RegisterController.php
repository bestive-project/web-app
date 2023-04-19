<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view("auth.register");
    }

    public function process(RegisterRequest $request)
    {
        DB::beginTransaction();

        $role = Role::findOrFail($this->user::SISWA);

        $request->merge([
            "password" => Hash::make($request->password),
        ]);

        try {
            $user = $this->user->create($request->all());
            $user->student()->create($request->all());
            $user->syncRoles($role);

            DB::commit();
            return redirect(route("web.login.index"))->with("successMessage", '<script>swal("Selamat!", "Akun anda berhasil terdaftar!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
