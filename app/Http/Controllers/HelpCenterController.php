<?php

namespace App\Http\Controllers;

use App\Http\Requests\WEB\HelpCenterRequest;
use App\Models\Counselor;
use App\Models\HelpCenter;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HelpCenterController extends Controller
{
    protected $helpCenter, $user;

    public function __construct(
        HelpCenter $helpCenter,
        User $user,
    ) {
        $this->helpCenter = $helpCenter;
        $this->user = $user;
    }

    public function index()
    {
        $user = $this->user->role("Siswa")->where("id", Auth::user()->id)->first();

        if ($user) {
            return $this->create();
        }

        return view('helpCenter.index');
    }

    public function table(Request $request)
    {
        $data["search"] = "";

        $helpCenters = $this->helpCenter->query();

        if ($request->search) {
            $data["search"] = $request->search;
            $helpCenters->where(function ($query) use ($request) {
                $query->where("message", "like", "%$request->search%")
                    ->orWhereHas("assignFrom", function ($query)  use ($request) {
                        $query->where("name", "like", "%$request->search%");
                    })->orWhereHas("assignTo", function ($query)  use ($request) {
                        $query->where("name", "like", "%$request->search%");
                    });
            });
        }

        if ($request->tipe) {
            $helpCenters->where("type", "like", "%$request->tipe%");
        }

        $teacher = $this->user->role("Guru")->where("id", Auth::user()->id)->first();
        if ($teacher) {
            $helpCenters->where('assign_to', Auth::user()->id);
        }

        $teacher = $this->user->role("Konselor")->where("id", Auth::user()->id)->first();
        if ($teacher) {
            $helpCenters->where('assign_to', Auth::user()->id);
        }

        $helpCenters = $helpCenters->with(["assignFrom", "assignTo"])->paginate($request->per_page);

        $data["helpCenters"] = json_encode($helpCenters);

        return view('helpCenter.table', $data);
    }

    public function create()
    {
        $data = [
            "teachers" => $this->user->role("Guru")->get(),
            "counselors" => $this->user->role("Konselor")->get(),
        ];

        return view('helpCenter.create', $data);
    }

    public function store(HelpCenterRequest $request)
    {
        DB::beginTransaction();

        if ($request->has('assign_to')) {
            $user = $this->user->where("uuid", $request->assign_to)->first();
            $request->merge([
                "assign_to" => $user->id
            ]);
        }

        $request->merge([
            "assign_from" => Auth::user()->id
        ]);

        try {
            $this->helpCenter->create($request->all());

            DB::commit();
            return redirect(route("web.help-center.index"))->with("successMessage", '<script>swal("Selamat!", "data berhasil ditambahkan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(string $helpCenter)
    {
        $helpCenter = $this->helpCenter->where("uuid", $helpCenter)->first();
        if (!$helpCenter) {
            abort(404);
        }

        return view('helpCenter.show', compact('helpCenter'));
    }

    public function edit(HelpCenter $helpCenter)
    {
        //
    }

    public function update(Request $request, HelpCenter $helpCenter)
    {
        //
    }

    public function destroy(string $helpCenter)
    {
        DB::beginTransaction();

        $helpCenter = $this->helpCenter->where("uuid", $helpCenter)->first();

        try {
            $helpCenter->delete();

            DB::commit();
            return $helpCenter;
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
