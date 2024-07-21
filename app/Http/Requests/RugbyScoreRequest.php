<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RugbyScoreRequest extends FormRequest
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
            'score_id' => 'sometimes',
            'place' => 'sometimes|numeric|min:0',
            'current_round' => 'sometimes|string'
        ];
    }
}
