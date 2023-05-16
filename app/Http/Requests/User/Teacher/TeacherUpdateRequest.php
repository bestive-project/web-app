<?php

namespace App\Http\Requests\User\Teacher;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherUpdateRequest extends FormRequest
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
        $user = User::where("uuid", request('teacher'))->first();

        return [
            "name" => "required",
            "age" => "required",
            "study" => "required",
            "major" => "required",
            "interest" => "required",
            "email" => [
                "required",
                "email",
                Rule::unique('users')->ignore($user)
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
