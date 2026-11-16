<?php

namespace App\Http\Requests\Difficulty;

use App\Enums\DifficultyStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDifficultyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'learning_id' => ['sometimes', 'nullable', 'integer', Rule::exists('learnings', 'id')->where('user_id', $this->user()->id)],
            'subject' => ['sometimes', 'required', 'string', 'max:150'],
            'description' => ['sometimes', 'nullable', 'string', 'max:5000'],
            'level' => ['sometimes', 'integer', 'between:1,5'],
            'status' => ['sometimes', Rule::enum(DifficultyStatus::class)],
        ];
    }
}
