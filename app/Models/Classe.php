<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Classe extends Model
{
    public function all(): array
    {
        $stmt = $this->db->query('SELECT id_class, nom, description, cree_le FROM Classe ORDER BY nom');
        return $stmt->fetchAll() ?: [];
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM Classe WHERE id_class = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $classe = $stmt->fetch();

        return $classe ?: null;
    }

    public function create(array $data, int $userId): void
    {
        $stmt = $this->db->prepare('INSERT INTO Classe (nom, description, id_user_crea) VALUES (:nom, :description, :creator)');
        $stmt->execute([
            ':nom' => $data['nom'],
            ':description' => $data['description'] ?? null,
            ':creator' => $userId,
        ]);
    }

    public function update(int $id, array $data, int $userId): void
    {
        $stmt = $this->db->prepare('UPDATE Classe SET nom = :nom, description = :description, id_user_modif = :modifier WHERE id_class = :id');
        $stmt->execute([
            ':nom' => $data['nom'],
            ':description' => $data['description'] ?? null,
            ':modifier' => $userId,
            ':id' => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM Classe WHERE id_class = :id');
        $stmt->execute([':id' => $id]);
    }
}
