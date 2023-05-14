<?php

namespace App\Http\Requests\WEB\LiveCounseling;

use Illuminate\Foundation\Http\FormRequest;

class LiveCounselingRequest extends FormRequest
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
            'study_group_id' => 'required|exists:study_groups,uuid',
            // 'date_meet' => 'required',
            'day' => 'required',
            'hour' => 'required',
            'link_meet' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'study_group_id' => 'kelompok belajar',
            // 'date_meet' => 'jadwal',
            'day' => 'hari',
            'hour' => 'jam',
            'link_meet' => 'link',
        ];
    }
}
