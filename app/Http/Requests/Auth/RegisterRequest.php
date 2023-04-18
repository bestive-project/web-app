<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "birth_place" => "required",
            "date_birth" => "required",
            "class" => "required",
            "school" => "required",
            "phone" => "required|numeric",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|max:255"
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
