<?php

namespace App\Http\Requests\WEB;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequestStore extends FormRequest
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
            "chapter_id" => "required|exists:chapters,uuid",
            "link_quiz" => "required"
        ];
    }

    public function attributes()
    {
        return [
            "chapter_id" => "bab",
            "link_quiz" => "link kuis",
        ];
    }
}
