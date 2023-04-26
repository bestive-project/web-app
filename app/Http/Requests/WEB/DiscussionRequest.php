<?php

namespace App\Http\Requests\WEB;

use Illuminate\Foundation\Http\FormRequest;

class DiscussionRequest extends FormRequest
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
            "study_group_id" => "exists:study_groups,uuid|required",
            "wa_link" => "required",
            "discord_link" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "study_group_id" => "kelompok belajar",
            "wa_link" => "wa link",
            "discord_link" => "discord link",
        ];
    }
}
