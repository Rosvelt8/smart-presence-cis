<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

abstract class Model
{
    protected PDO $db;

    public function __construct(
        protected array $config
    ) {
        $this->db = $this->connect();
    }

    private function connect(): PDO
    {
        $db = $this->config['db'] ?? [];

        $dsn = sprintf(
            '%s:host=%s;port=%s;dbname=%s;charset=%s',
            $db['driver'] ?? 'mysql',
            $db['host'] ?? '127.0.0.1',
            $db['port'] ?? 3306,
            $db['database'] ?? 'smart_presence',
            $db['charset'] ?? 'utf8mb4'
        );

        try {
            return new PDO($dsn, $db['username'] ?? 'root', $db['password'] ?? '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            throw new \RuntimeException('Connexion à la base impossible: ' . $e->getMessage());
        }
    }
}
