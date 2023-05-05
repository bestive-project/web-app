<?php

namespace App\Http\Controllers;

use App\Http\Requests\WEB\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $data = [
            'categories' => $this->category->all()
        ];

        return view('category.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $request->merge([
                "category_slug" => Str::slug($request->category_slug)
            ]);

            $this->category->create($request->all());

            DB::commit();
            return redirect(route('web.category.index'))->with("successMessage", '<script>swal("Selamat!", "mata pelajaran berhasil ditambahkan!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(string $id)
    {
        $category = $this->category->where("uuid", $id)->first();
        if (!$category) {
            abort(404);
        }

        return $category;
    }

    public function update(CategoryRequest $request, string $id)
    {
        DB::beginTransaction();

        $category = $this->category->where("uuid", $id)->first();
        if (!$category) {
            abort(404);
        }

        try {
            $request->merge([
                "category_slug" => Str::slug($request->category_slug)
            ]);

            $category->update($request->all());

            DB::commit();
            return redirect(route('web.category.index'))->with("successMessage", '<script>swal("Selamat!", "mata pelajaran berhasil diperbaharui!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        $category = $this->category->where("uuid", $id)->first();
        if (!$category) {
            abort(404);
        }

        try {
            $category->delete();

            DB::commit();
            return redirect(route('web.category.index'))->with("successMessage", '<script>swal("Selamat!", "mata pelajaran berhasil dihapus!", "success")</script>');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with("message", $th->getMessage())->withInput();
        }
    }
}
