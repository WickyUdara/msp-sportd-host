<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CricketScoreRequest extends FormRequest
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
            'roles' => 'sometimes|array|min:2|max:2',
            'runs' => 'sometimes|numeric|min:0',
            'n_6s' => 'sometimes|numeric|min:0',
            'n_4s' => 'sometimes|numeric|min:0',
            'balls' => 'sometimes|numeric|min:0',
            'no_balls' => 'sometimes|numeric|min:0',
            'wide_balls' => 'sometimes|numeric|min:0',
            'wickets' => 'sometimes|numeric|min:0',
            'innings' => 'sometimes|numeric|min:0',
        ];
    }
}
