<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
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

        $users = $users->role("Guru")->paginate($request->per_page);

        $data["users"] = json_encode($users);

        return view('user.teacher.table', $data);
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(string $id)
    {
        abort(404);
    }

    public function update(Request $request, string $id)
    {
        abort(404);
    }

    public function destroy(string $id)
    {
        abort(404);
    }
}
