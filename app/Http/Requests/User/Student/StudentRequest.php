<?php

namespace App\Http\Requests\User\Student;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
        $user = User::where("uuid", request('id'))->first();

        return [
            "name" => "required",
            "birth_place" => "required",
            "date_birth" => "required",
            "class" => "required",
            "school" => "required",
            "phone" => "required|numeric",
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
            "birth_place" => "tempat lahir",
            "date_birth" => "tanggal lahir",
            "class" => "kelas",
            "school" => "asal sekolah",
            "phone" => "no telepon",
        ];
    }
}
