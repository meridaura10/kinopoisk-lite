<?php

namespace App\Controllers\Admin;

use App\Kernel\Controller\Controller;
use App\Mapper\CategoryMapper;
use App\Mapper\MovieMapper;

class AdminMovieController extends Controller
{
    private MovieMapper $movieMapper;

    private CategoryMapper $categoryMapper;

    public function create(): void
    {
        $categories = $this->categoryMapper()->all();
        $this->view('admin/movies/create', [
            'categories' => $categories,
        ]);
    }

    public function edit(): void
    {
        $categories = $this->categoryMapper()->all();
        $movie = $this->movieMapper()->find(['id' => $this->request()->input('id')]);
        $this->view('admin/movies/edit', [
            'categories' => $categories,
            'movie' => $movie,
        ]);
    }

    public function delete(): void
    {
        $this->movieMapper()->delete([
            'id' => $this->request()->input('id'),
        ]);

        $this->redirect('/admin');
    }

    public function update(): void
    {
        $validation = $this->request()->validate([
            'image' => ['image', 'nullable'],
            'category' => ['required'],
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect("/admin/movies/edit?id={$this->request()->input('id')}");
        }

        $data = [
            'name' => $this->request()->input('name'),
            'category_id' => $this->request()->input('category_id'),
            'description' => $this->request()->input('description'),
        ];

        if (! $this->request()->file('image')->empty()) {
            $img = $this->request()->file('image')->move('movies');
            $data = array_merge($data, ['preview' => $img]);
        }

        $this->movieMapper()->update(
            $data,
            [
                'id' => $this->request()->input('id'),
            ]
        );

        $this->redirect('/admin');
    }

    public function store(): void
    {
        $validation = $this->request()->validate([
            'image' => ['image', 'required'],
            'category' => ['required'],
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/admin/movies/create');
        }

        $this->movieMapper()->create([
            'category_id' => $this->request()->input('category'),
            'name' => $this->request()->input('name'),
            'description' => $this->request()->input('description'),
            'preview' => $this->request()->file('image')->move('movies'),
        ]);

        $this->redirect('/admin');
    }

    private function movieMapper(): MovieMapper
    {
        if (! isset($this->mapper)) {
            $this->movieMapper = new MovieMapper($this->database());
        }

        return $movieMapper = new MovieMapper($this->database());
    }

    private function categoryMapper(): CategoryMapper
    {
        if (! isset($this->mapper)) {
            $this->categoryMapper = new CategoryMapper($this->database());
        }

        return $this->categoryMapper = new CategoryMapper($this->database());
    }
}
