<?php

namespace App\Controllers\Admin;

use App\Kernel\Controller\Controller;
use App\Mapper\CategoryMapper;

class AdminCategoryController extends Controller
{
    private CategoryMapper $mapper;

    public function create(): void
    {
        $this->view('admin/categories/create');
    }

    public function edit(): void
    {
        $category = $this->mapper()->find([
            'id' => $this->request()->input('id'),
        ]);

        $this->view('admin/categories/edit', [
            'category' => $category,
        ]);
    }

    public function update(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255'],
            'id' => ['required'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect("/admin/categories/edit?id={$this->request()->input('id')}");
        }

        $this->mapper()->update(
            [
                'name' => $this->request()->input('name'),
            ],
            [
                'id' => $this->request()->input('id'),
            ]
        );

        $this->redirect('/admin');
    }

    public function store(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/admin/categories/create');
        }

        $this->mapper()->create([
            'name' => $this->request()->input('name'),
        ]);

        $this->redirect('/admin');

    }

    public function delete(): void
    {
        $this->mapper()->delete([
            'id' => $this->request()->input('id'),
        ]);

        $this->redirect('/admin');
    }

    private function mapper(): CategoryMapper
    {
        if (! isset($this->mapper)) {
            $this->mapper = new CategoryMapper($this->database());
        }

        return $mapper = new CategoryMapper($this->database());
    }
}
