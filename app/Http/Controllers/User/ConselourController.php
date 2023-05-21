<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Counselor\CounselorCreateRequest;
use App\Http\Requests\User\Counselor\CounselorUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ConselourController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware("role:Admin", ["except" => ["update"]]);
    }

    public function index()
    {
        return view("user.conselour.index");
    }

    public function table(Request $request)
    {
        $data["search"] = "";

        $users = $this->user->query();

        if ($request->search) {
            $data["search"] = $request->search;
            $users->where("name", "like", "%$request->search%");
        }

        $users = $users->role("Konselor")->with(["counselor"])->paginate($request->per_page);

        $data["users"] = json_encode($users);

        return view('user.conselour.table', $data);
    }

    public function create()
    {
        abort(404);
    }

    public function store(CounselorCreateRequest $request)
    {
        DB::beginTransaction();

        $request->merge([
            "uuid" => Str::uuid(),
            "password" => Hash::make($request->password)
        ]);

        $role = Role::findById(User::KONSELOR);

        try {
            $user = $this->user->create($request->all());
            $user->counselor()->create($request->all());
            $user->assignRole($role);

            DB::commit();
            return redirect(route("web.conselour.index"))->with("successMessage", '<script>swal("Selamat!", "pengguna berhasil ditambahkan!", "success")</script>');
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

        return view('user.conselour.edit', $data);
    }

    public function update(CounselorUpdateRequest $request, string $id)
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
            $user->counselor()->update([
                "age" => $request->age,
                "study" => $request->study,
                "major" => $request->major,
            ]);

            DB::commit();
            if ($user->role('Konselor')) {
                return back()->with("successMessage", '<script>swal("Selamat!", "pengguna berhasil diperbaharui!", "success")</script>');
            }
            return redirect(route("web.conselour.index"))->with("successMessage", '<script>swal("Selamat!", "pengguna berhasil diperbaharui!", "success")</script>');
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
            if ($user->counselor) {
                $user->counselor()->delete();
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
