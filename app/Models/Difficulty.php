<?php

namespace App\Models;

use App\Enums\DifficultyStatus;
use Database\Factories\DifficultyFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['learning_id', 'subject', 'description', 'level', 'status'])]
class Difficulty extends Model
{
    /** @use HasFactory<DifficultyFactory> */
    use HasFactory;

    protected $attributes = [
        'level' => 3,
        'status' => 'unresolved',
    ];

    protected static function booted(): void
    {
        static::saving(function (Difficulty $difficulty) {
            if ($difficulty->isDirty('status')) {
                $difficulty->resolved_at = $difficulty->status === DifficultyStatus::Resolved ? now() : null;
            }
        });
    }

    protected function casts(): array
    {
        return [
            'level' => 'integer',
            'status' => DifficultyStatus::class,
            'resolved_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function learning(): BelongsTo
    {
        return $this->belongsTo(Learning::class);
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->user_id === $user->id;
    }
}
