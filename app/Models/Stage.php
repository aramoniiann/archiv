<?php

namespace App\Models;

use Database\Factories\StageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['name', 'description', 'position', 'is_completed'])]
class Stage extends Model
{
    /** @use HasFactory<StageFactory> */
    use HasFactory;

    protected $attributes = [
        'position' => 1,
        'is_completed' => false,
    ];

    protected function casts(): array
    {
        return [
            'position' => 'integer',
            'is_completed' => 'boolean',
        ];
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->task->isOwnedBy($user);
    }
}
