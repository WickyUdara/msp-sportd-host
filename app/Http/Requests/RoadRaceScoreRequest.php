<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoadRaceScoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'score_id' => 'required|exists:road_race_scores,score_id',
            'place' => 'required|integer|min:1',
        ];
    }
}
