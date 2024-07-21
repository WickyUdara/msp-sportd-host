<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VollyBallRequest extends FormRequest
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
        'set2_marks' => 'sometimes|numeric|min:-1|max:30',
        'set3_marks' => 'sometimes|numeric|min:-1|max:30',
        'set1_marks' => 'sometimes|numeric|min:-1|max:30',
        'sets_won' => 'sometimes|numeric|min:0|max:3',
        'current_round' => 'sometimes|numeric|min:0'
        ];
    }
}
