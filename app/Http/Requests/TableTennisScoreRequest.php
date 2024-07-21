<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableTennisScoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'set1_marks' => 'sometimes|numeric|min:-1|max:30',
            'set2_marks' => 'sometimes|numeric|min:-1|max:30',
            'set3_marks' => 'sometimes|numeric|min:-1|max:30',
            'set4_marks' => 'sometimes|numeric|min:-1|max:30',
            'set5_marks' => 'sometimes|numeric|min:-1|max:30',
            'set6_marks' => 'sometimes|numeric|min:-1|max:30',
            'set7_marks' => 'sometimes|numeric|min:-1|max:30',
            'sets_won' => 'sometimes|numeric|min:0|max:3'
        ];
    }
}
