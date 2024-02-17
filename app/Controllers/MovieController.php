<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Mapper\MovieMapper;

class MovieController extends Controller
{
    public function show()
    {
        $mapper = new MovieMapper($this->database());

        $movie = $mapper->find([
            'id' => $this->request()->input('id'),
        ]);

        $this->view('movie', [
            'movie' => $movie,
        ]);
    }
}
