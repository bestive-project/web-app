<?php

namespace App\Http\Requests\WEB\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequestStore extends FormRequest
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
            'category_id' => 'required|exists:categories,uuid',
            'course_name' => 'required',
            'course_description' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'mata pelajaran',
            'course_name' => 'judul materi',
            'course_description' => 'deskripsi materi',
        ];
    }
}
