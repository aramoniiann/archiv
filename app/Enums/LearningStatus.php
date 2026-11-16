<?php

namespace App\Enums;

enum LearningStatus: string
{
    case ToStudy = 'to_study';
    case Studying = 'studying';
    case Review = 'review';
    case Learned = 'learned';
}
