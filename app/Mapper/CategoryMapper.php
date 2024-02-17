<?php

namespace App\Mapper;

use App\Kernel\Mapper\Mapper;
use App\Models\Category;

class CategoryMapper extends Mapper
{
    public function table(): string
    {
        return 'categories';
    }

    public function model(): string
    {
        return Category::class;
    }
}
