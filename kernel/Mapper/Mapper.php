<?php

namespace App\Kernel\Mapper;

use App\Kernel\Database\Contracts\DatabaseInterface;
use App\Kernel\Model\Model;

abstract class Mapper
{
    public function __construct(
        private DatabaseInterface $database,
    ) {
    }

    abstract public function table(): string;

    abstract public function model(): string;

    public function create(array $data): ?Model
    {
        $id = $this->database->insert($this->table(), $data);

        $data = $this->database->first($this->table(), ['id' => $id]);

        $model = $this->model();

        return new $model(...$data);
    }

    public function update(array $data, array $conditions = []): bool
    {
        return $this->database->update($this->table(), $data, $conditions);
    }

    public function all(): array
    {
        $data = $this->database->get($this->table());

        return array_map(function ($data) {
            $model = $this->model();

            return new $model(...$data);
        }, $data);
    }

    public function find(array $data): ?Model
    {

        $data = $this->database->first($this->table(), $data);

        if (! $data) {
            return null;
        }

        $model = $this->model();

        return new $model(...$data);
    }

    public function delete(array $data): bool
    {
        return $this->database->delete($this->table(), $data);
    }
}
