<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Teacher\TeacherCreaterRequest;
use App\Http\Requests\User\Teacher\TeacherUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class TeacherController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware("role:Admin", ["except" => ["update"]]);
    }

    public function index()
    {
        return view("user.teacher.index");
    }

    public function table(Request $request)
    {
        $data["search"] = "";

        $users = $this->user->query();

        if ($request->search) {
            $data["search"] = $request->search;
            $users->where("name", "like", "%$request->search%");
        }

        $users = $users->role("Guru")->with(["teacher"])->paginate($request->per_page);
        $data["users"] = json_encode($users);

        return view('user.teacher.table', $data);
    }

    public function create()
    {
        abort(404);
    }

    public function store(TeacherCreaterRequest $request)
    {
        DB::beginTransaction();

        $request->merge([
            "password" => Hash::make($request->password)
        ]);

        $role = Role::findById(User::GURU);

        try {
            $user = $this->user->create($request->all());
            $user->teacher()->create($request->all());
            $user->assignRole($role);

            DB::commit();
            return redirect(route("web.teacher.index"))->with("successMessage", '<script>swal("Selamat!", "pengguna berhasil ditambahkan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(string $id)
    {
        $user = $this->user->where("uuid", $id)->first();
        if (!$user) {
            abort(404);
        }

        $data = [
            "user" => $user
        ];

        return view('user.teacher.edit', $data);
    }

    public function update(TeacherUpdateRequest $request, string $id)
    {
        DB::beginTransaction();

        $user = $this->user->where("uuid", $id)->first();
        if (!$user) {
            abort(404);
        }

        try {
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
            ]);
            $user->teacher()->update([
                "age" => $request->age,
                "study" => $request->study,
                "major" => $request->major,
                "interest" => $request->interest,
            ]);

            DB::commit();

            if ($user->role('Guru')) {
                return back()->with("successMessage", '<script>swal("Selamat!", "pengguna berhasil diperbaharui!", "success")</script>');
            }

            return redirect(route("web.teacher.index"))->with("successMessage", '<script>swal("Selamat!", "pengguna berhasil diperbaharui!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        $user = $this->user->where("uuid", $id)->first();
        if (!$user) {
            abort(404);
        }

        try {
            if ($user->teacher) {
                $user->teacher()->delete();
            }

            $user->delete();

            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
