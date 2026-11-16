<?php

namespace App\Http\Controllers;

use App\Models\Difficulty;
use App\Models\Learning;
use App\Models\Project;
use App\Models\Stage;
use App\Models\Task;
use Illuminate\Http\Response;

abstract class Controller
{
    protected function ensureIsOwner(Project|Task|Stage|Learning|Difficulty $model): void
    {
        abort_unless(
            $model->isOwnedBy(request()->user()),
            Response::HTTP_FORBIDDEN,
            'Este registro pertence a outro usuário.',
        );
    }
}
