<?php

namespace Database\Seeders;

use App\Enums\LearningStatus;
use App\Models\Learning;
use App\Models\User;
use Illuminate\Database\Seeder;

class LearningSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', UserSeeder::DEMO_EMAIL)->firstOrFail();

        $user->learnings()->createMany([
            [
                'title' => 'Eloquent: relacionamentos',
                'description' => 'hasMany e belongsTo entre projetos, tarefas e etapas.',
                'studied_at' => '2026-11-05',
                'status' => LearningStatus::Learned,
            ],
            [
                'title' => 'Autenticação com Sanctum',
                'studied_at' => '2026-11-12',
                'status' => LearningStatus::Studying,
            ],
            [
                'title' => 'Docker Compose com volumes',
                'status' => LearningStatus::ToStudy,
            ],
        ]);

        $other = User::where('email', UserSeeder::OTHER_EMAIL)->firstOrFail();

        Learning::factory()->count(3)->for($other)->create();
    }
}
