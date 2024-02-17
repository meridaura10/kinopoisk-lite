<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Mapper\MovieMapper;

class HomeController extends Controller
{
    public function __invoke(): void
    {
        $movieMapper = new MovieMapper($this->database());
        $movies = $movieMapper->all();

        $this->view('home', [
            'movies' => $movies,
        ]);

        $this->view('home');
    }
}
