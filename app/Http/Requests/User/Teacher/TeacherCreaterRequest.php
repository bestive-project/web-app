<?php

namespace App\Http\Requests\User\Teacher;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherCreaterRequest extends FormRequest
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
            "name" => "required",
            "age" => "required",
            "study" => "required",
            "major" => "required",
            "interest" => "required",
            "password" => "required|min:8|max:255",
            "email" => [
                "required",
                "email",
                Rule::unique('users')
            ],
        ];
    }

    public function attributes()
    {
        return [
            "name" => "nama lengkap",
            "age" => "usia",
            "study" => "pendidikan",
            "major" => "jurusan",
            "interest" => "minat",
        ];
    }
}
