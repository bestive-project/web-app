<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\WEB\User\Admin\CreateAdminRequest;
use App\Http\Requests\WEB\User\Admin\UpdateAdminRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view("user.admin.index");
    }

    public function table(Request $request)
    {
        $data["search"] = "";

        $users = $this->user->query();

        if ($request->search) {
            $data["search"] = $request->search;
            $users->where("name", "like", "%$request->search%");
        }

        $users = $users->role("Admin")->paginate($request->per_page);

        $data["users"] = json_encode($users);

        return view('user.admin.table', $data);
    }

    public function store(CreateAdminRequest $request)
    {
        DB::beginTransaction();

        $role = Role::findOrFail($this->user::ADMIN);

        $request->merge([
            "password" => Hash::make($request->password),
        ]);

        try {
            $user = $this->user->create($request->all());
            $user->syncRoles($role);

            DB::commit();
            return redirect(route("web.admin.index"))->with("successMessage", '<script>swal("Selamat!", "pengguna berhasil ditambahkan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = [
            "user" => $this->user->role("Admin")->where("uuid", $id)->first()
        ];

        return view("user.admin.edit", $data);
    }

    public function update(UpdateAdminRequest $request, string $id)
    {
        DB::beginTransaction();

        $user = $this->user->where("uuid", $id)->first();
        if (!$user) {
            return back()->with("message", "data tidak tersedia");
        }

        try {
            $user->update($request->all());

            DB::commit();
            return redirect(route("web.admin.index"))->with("successMessage", '<script>swal("Selamat!", "pengguna berhasil diperbaharui!", "success")</script>');
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
            return back()->with("message", "data tidak tersedia");
        }

        try {
            $user->delete();

            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
