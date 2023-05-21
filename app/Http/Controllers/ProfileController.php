<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Profile\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function update(UpdateRequest $request)
    {
        if (Auth::user()->role('Siswa')) {
            return $this->updateStudent($request);
        }
    }

    public function updateAdmin($request)
    {
    }

    public function updateTeacher(Type $var = null)
    {
        # code...
    }

    public function updateCounselor($request)
    {
        DB::beginTransaction();

        $user = $this->user->findOrFail(Auth::user()->id);
        if (!$user) {
            abort(404);
        }

        try {
            if ($request->password != "") {
                $user->update([
                    "password" => Hash::make($request->password)
                ]);
            }

            $user->update([
                "name" => $request->name,
                "email" => $request->email,
            ]);
            $user->counselor()->update([
                "age" => $request->age,
                "study" => $request->study,
                "major" => $request->major,
            ]);

            DB::commit();
            return back()->with("successMessage", '<script>swal("Selamat!", "pengguna berhasil diperbaharui!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function updateStudent($request)
    {
        DB::beginTransaction();

        $user = $this->user->findOrFail(Auth::user()->id);
        if (!$user) {
            abort(404);
        }

        try {
            if ($request->password != "") {
                $user->update([
                    "password" => Hash::make($request->password)
                ]);
            }

            $user->update([
                "name" => $request->name,
                "email" => $request->email,
            ]);

            $user->student()->update([
                "birth_place" => $request->birth_place,
                "date_birth" => $request->date_birth,
                "class" => $request->class,
                "school" => $request->school,
                "phone" => $request->phone,
            ]);

            DB::commit();
            return back()->with("successMessage", '<script>swal("Selamat!", "pengguna berhasil diperbaharui!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
