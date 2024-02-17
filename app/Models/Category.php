<?php

namespace App\Models;

use App\Kernel\Model\Model;

class Category extends Model
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $created_at,
        public readonly string $updated_at,
    ) {

    }
}
