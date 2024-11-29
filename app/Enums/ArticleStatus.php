<?php

namespace App\Enums;

enum ArticleStatus: int
{
    case PENDING = 1;
    case APPROVED = 2;
    case ARCHIVED = 3;
}
