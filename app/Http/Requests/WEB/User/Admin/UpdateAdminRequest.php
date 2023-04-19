<?php

namespace App\Http\Requests\WEB\User\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
        $user = User::where("uuid", request("admin"))->first();

        return [
            "name" => "required",
            "email" => [
                "required",
                "email",
                Rule::unique("users")->ignore($user)
            ],
        ];
    }
}
