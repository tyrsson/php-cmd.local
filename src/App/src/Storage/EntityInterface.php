<?php

declare(strict_types=1);

namespace App\Storage;

interface EntityInterface
{
    public function getId(): string|int|null;
    public function toArray(): array;
}
