<?php

namespace App\Http\Requests\WEB;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "category_name" => "required|unique:categories,category_name"
        ];
    }

    public function attributes()
    {
        return [
            "category_name" => "mata pelajaran"
        ];
    }
}
