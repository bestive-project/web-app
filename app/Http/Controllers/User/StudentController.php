<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('user.student.index');
    }

    public function table(Request $request)
    {
        $users = $this->user->query();

        if ($request->search) {
            $users->where("name", "like", "%$request->search%");
        }

        $users = $users->role("Siswa")->with("student")->paginate($request->per_page);

        $data = [
            "users" => json_encode($users)
        ];

        return view('user.student.table', $data);
    }

    public function show(string $id)
    {
        # code...
    }
}
