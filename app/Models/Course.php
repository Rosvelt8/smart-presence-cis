<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Course extends Model
{
    public function all(): array
    {
        $sql = 'SELECT c.id_course, c.titre, c.description, c.cree_le, c.enseignant, u.prenom, u.nom
                FROM Course c
                LEFT JOIN Utilisateur u ON u.id_user = c.enseignant
                ORDER BY c.titre';
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll() ?: [];
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT c.*, u.prenom, u.nom
            FROM Course c
            LEFT JOIN Utilisateur u ON u.id_user = c.enseignant
            WHERE c.id_course = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $course = $stmt->fetch();

        return $course ?: null;
    }

    public function create(array $data, int $userId): void
    {
        $stmt = $this->db->prepare('INSERT INTO Course (titre, description, enseignant, id_user_crea) VALUES (:titre, :description, :teacher, :creator)');
        $stmt->execute([
            ':titre' => $data['titre'],
            ':description' => $data['description'] ?? null,
            ':teacher' => $data['enseignant'],
            ':creator' => $userId,
        ]);
    }

    public function update(int $id, array $data, int $userId): void
    {
        $stmt = $this->db->prepare('UPDATE Course SET titre = :titre, description = :description, enseignant = :teacher WHERE id_course = :id');
        $stmt->execute([
            ':titre' => $data['titre'],
            ':description' => $data['description'] ?? null,
            ':teacher' => $data['enseignant'],
            ':id' => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM Course WHERE id_course = :id');
        $stmt->execute([':id' => $id]);
    }
}
