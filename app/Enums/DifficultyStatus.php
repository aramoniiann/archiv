<?php

namespace App\Enums;

enum DifficultyStatus: string
{
    case Unresolved = 'unresolved';
    case Studying = 'studying';
    case Resolved = 'resolved';
}
