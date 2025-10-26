<?php

declare(strict_types=1);

namespace App\Storage;

enum Schema: string
{
    case User     = 'user';
    const COLUMNS = [
        self::User->value => ['id', 'identity', 'roles', 'details'],
    ];

    public function getColumns(): array
    {
        return self::COLUMNS[$this->value];
    }
}
