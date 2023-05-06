<?php

namespace App\Http\Requests\WEB\Chapter;

use Illuminate\Foundation\Http\FormRequest;

class ChapterRequestStore extends FormRequest
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
        $request = [
            'chapter_name' => 'required',
            'chapter_description' => 'required',
        ];

        if (request()->hasFile('chapter_document')) {
            $request['chapter_document'] = 'file|mimes:pdf';
        }

        return $request;
    }
}
