<?php

namespace App\Kernel\Database;

use App\Kernel\Config\Contracts\ConfigInterface;
use App\Kernel\Database\Contracts\DatabaseInterface;

class Database implements DatabaseInterface
{
    private \PDO $pdo;

    public function __construct(
        private ConfigInterface $config,
    ) {
        $this->connect();
    }

    public function insert(string $table, array $data): int|false
    {
        $fields = array_keys($data);

        $columns = implode(', ', $fields);

        $binds = implode(',', array_map(fn ($field) => ":$field", $fields));

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {

            return false;
        }

        return (int) $this->pdo->lastInsertId();
    }

    public function first(string $table, array $conditions = []): ?array
    {
        $where = '';

        if (count($conditions)) {
            $where = 'WHERE '.implode('AND', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $where LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($conditions);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    private function connect()
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $userName = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');

        try {
            $this->pdo = new \PDO(
                "$driver:host=$host;post=$port;dbname=$database;charset=$charset",
                $userName, $password);
        } catch (\PDOException $exception) {
            exit("Database connect failed: {$exception->getMessage()}");
        }
    }

    public function get(string $table, array $conditions = []): array
    {
        $where = '';

        if (count($conditions)) {
            $where = 'WHERE '.implode('AND', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $where";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($conditions);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete(string $table, array $conditions = []): bool
    {
        try {
            $where = '';

            if (count($conditions)) {
                $where = 'WHERE '.implode('AND', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
            }

            $sql = "DELETE FROM $table $where";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute($conditions);

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function update(string $table, array $data, array $conditions = []): bool
    {
        try {
            $set = '';
            $where = '';

            if (count($conditions)) {
                $where = 'WHERE '.implode('AND', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
            }

            if (count($data)) {
                $set = implode(', ', array_map(fn ($field) => "$field = :$field", array_keys($data)));
            }

            $sql = "UPDATE $table SET $set $where";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([...$data, ...$conditions]);

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
