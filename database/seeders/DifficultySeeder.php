<?php

namespace Database\Seeders;

use App\Enums\DifficultyStatus;
use App\Models\Difficulty;
use App\Models\User;
use Illuminate\Database\Seeder;

class DifficultySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', UserSeeder::DEMO_EMAIL)->firstOrFail();

        $sanctum = $user->learnings()->where('title', 'Autenticação com Sanctum')->firstOrFail();

        $user->difficulties()->createMany([
            [
                'learning_id' => $sanctum->id,
                'subject' => 'Diferença entre 401 e 403',
                'description' => 'Não sabia qual retornar quando o usuário acessa um registro de outro.',
                'level' => 2,
                'status' => DifficultyStatus::Resolved,
            ],
            [
                'subject' => 'Container não enxerga o banco',
                'description' => 'O app tentava conectar em localhost em vez do nome do serviço.',
                'level' => 4,
                'status' => DifficultyStatus::Studying,
            ],
        ]);

        $other = User::where('email', UserSeeder::OTHER_EMAIL)->firstOrFail();

        Difficulty::factory()->count(2)->for($other)->create();
    }
}
