<?php

namespace App\Controllers\Admin;

use App\Kernel\Controller\Controller;
use App\Mapper\CategoryMapper;
use App\Mapper\MovieMapper;

class AdminHomeController extends Controller
{
    public function __invoke(): void
    {
        $categoryMapper = new CategoryMapper($this->database());
        $categories = $categoryMapper->all();

        $movieMapper = new MovieMapper($this->database());
        $movies = $movieMapper->all();

        $this->view('admin/home', [
            'categories' => $categories,
            'movies' => $movies,
        ]);
    }
}
