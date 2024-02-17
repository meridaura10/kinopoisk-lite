<?php

namespace App\Mapper;

use App\Kernel\Mapper\Mapper;
use App\Models\Movie;

class MovieMapper extends Mapper
{
    public function table(): string
    {
        return 'movies';
    }

    public function model(): string
    {
        return Movie::class;
    }
}
