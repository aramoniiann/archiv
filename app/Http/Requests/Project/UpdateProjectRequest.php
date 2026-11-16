<?php

namespace App\Http\Requests\Project;

use App\Enums\ProjectStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:150'],
            'description' => ['sometimes', 'nullable', 'string', 'max:5000'],
            'repository_url' => ['sometimes', 'nullable', 'url', 'max:255'],
            'start_date' => ['sometimes', 'nullable', 'date'],
            'due_date' => ['sometimes', 'nullable', 'date', ...$this->tasksDueDateLimit()],
            'status' => ['sometimes', Rule::enum(ProjectStatus::class)],
        ];
    }

    private function tasksDueDateLimit(): array
    {
        $project = $this->route('project');

        if (! $project->isOwnedBy($this->user())) {
            return [];
        }

        $latestTaskDueDate = $project->tasks()->max('due_date');

        if (! $latestTaskDueDate) {
            return [];
        }

        return ['after_or_equal:'.$latestTaskDueDate];
    }
}
