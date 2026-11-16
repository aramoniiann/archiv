<?php

namespace Database\Seeders;

use App\Enums\ProjectStatus;
use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Stage;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', UserSeeder::DEMO_EMAIL)->firstOrFail();

        $archiv = $user->projects()->create([
            'name' => 'Archiv API',
            'description' => 'API REST para organizar projetos e estudos de desenvolvimento.',
            'repository_url' => 'https://github.com/example/archiv',
            'start_date' => '2026-11-01',
            'due_date' => '2026-12-10',
            'status' => ProjectStatus::InProgress,
        ]);

        $migrations = $archiv->tasks()->create([
            'title' => 'Criar migrations',
            'priority' => TaskPriority::High,
            'status' => TaskStatus::Completed,
        ]);

        $migrations->stages()->createMany([
            ['name' => 'Desenhar as tabelas', 'position' => 1, 'is_completed' => true],
            ['name' => 'Escrever as migrations', 'position' => 2, 'is_completed' => true],
            ['name' => 'Rodar migrate:fresh', 'position' => 3, 'is_completed' => true],
        ]);

        $auth = $archiv->tasks()->create([
            'title' => 'Implementar autenticação com Sanctum',
            'priority' => TaskPriority::High,
            'status' => TaskStatus::InProgress,
            'due_date' => '2026-11-25',
        ]);

        $auth->stages()->createMany([
            ['name' => 'Instalar o Sanctum', 'position' => 1, 'is_completed' => true],
            ['name' => 'Criar rota de login', 'position' => 2],
            ['name' => 'Proteger as rotas com auth:sanctum', 'position' => 3],
        ]);

        $archiv->tasks()->create([
            'title' => 'Escrever arquivos rest.http',
            'priority' => TaskPriority::Low,
            'due_date' => '2026-12-05',
        ]);

        $portfolio = $user->projects()->create([
            'name' => 'Portfólio pessoal',
            'description' => 'Site com meus projetos e contato.',
            'start_date' => '2026-10-15',
        ]);

        $layout = $portfolio->tasks()->create([
            'title' => 'Montar layout da página inicial',
        ]);

        $layout->stages()->createMany([
            ['name' => 'Escolher as cores', 'position' => 1],
            ['name' => 'Fazer o cabeçalho', 'position' => 2],
        ]);

        $other = User::where('email', UserSeeder::OTHER_EMAIL)->firstOrFail();

        Project::factory()
            ->count(3)
            ->for($other)
            ->has(
                Task::factory()
                    ->count(2)
                    ->has(
                        Stage::factory()
                            ->count(3)
                            ->sequence(['position' => 1], ['position' => 2], ['position' => 3])
                    )
            )
            ->create();
    }
}
