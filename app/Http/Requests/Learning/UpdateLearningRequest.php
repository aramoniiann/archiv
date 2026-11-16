<?php

namespace App\Http\Requests\Learning;

use App\Enums\LearningStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLearningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:150'],
            'description' => ['sometimes', 'nullable', 'string', 'max:5000'],
            'studied_at' => ['sometimes', 'nullable', 'date'],
            'status' => ['sometimes', Rule::enum(LearningStatus::class)],
        ];
    }
}
