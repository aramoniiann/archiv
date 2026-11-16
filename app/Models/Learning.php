<?php

namespace App\Models;

use App\Enums\LearningStatus;
use Database\Factories\LearningFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['title', 'description', 'studied_at', 'status'])]
class Learning extends Model
{
    /** @use HasFactory<LearningFactory> */
    use HasFactory;

    protected $attributes = [
        'status' => 'studying',
    ];

    protected function casts(): array
    {
        return [
            'studied_at' => 'date',
            'status' => LearningStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function difficulties(): HasMany
    {
        return $this->hasMany(Difficulty::class);
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->user_id === $user->id;
    }
}
