<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public function findByMatricule(string $matricule): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM Utilisateur WHERE matricule = :matricule LIMIT 1');
        $stmt->execute([':matricule' => $matricule]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function listStudents(): array
    {
        $stmt = $this->db->query("SELECT id_user, nom, prenom FROM Utilisateur WHERE role = 'ET' ORDER BY nom, prenom");
        return $stmt->fetchAll() ?: [];
    }

    public function listTeachers(): array
    {
        $stmt = $this->db->query("SELECT id_user, nom, prenom FROM Utilisateur WHERE role = 'ENS' ORDER BY nom, prenom");
        return $stmt->fetchAll() ?: [];
    }

    public function listAll(): array
    {
        $stmt = $this->db->query('SELECT id_user, nom, prenom, matricule, role, cree_le FROM Utilisateur ORDER BY cree_le DESC');
        return $stmt->fetchAll() ?: [];
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare('INSERT INTO Utilisateur (nom, prenom, matricule, role, mdp) VALUES (:nom, :prenom, :matricule, :role, :mdp)');
        $stmt->execute([
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':matricule' => $data['matricule'],
            ':role' => $data['role'],
            ':mdp' => $data['password'],
        ]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM Utilisateur WHERE id_user = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function update(int $id, array $data): void
    {
        $fields = [
            'nom' => ':nom',
            'prenom' => ':prenom',
            'matricule' => ':matricule',
            'role' => ':role',
        ];

        $setParts = [];
        $params = [
            ':id' => $id,
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':matricule' => $data['matricule'],
            ':role' => $data['role'],
        ];

        foreach ($fields as $column => $placeholder) {
            $setParts[] = $column . ' = ' . $placeholder;
        }

        if (!empty($data['password'])) {
            $setParts[] = 'mdp = :mdp';
            $params[':mdp'] = $data['password'];
        }

        $sql = 'UPDATE Utilisateur SET ' . implode(', ', $setParts) . ' WHERE id_user = :id LIMIT 1';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM Utilisateur WHERE id_user = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
    }

    public function updatePassword(int $userId, string $hashedPassword): void
    {
        $stmt = $this->db->prepare('UPDATE Utilisateur SET mdp = :password, modifie_le = CURRENT_TIMESTAMP WHERE id_user = :id LIMIT 1');
        $stmt->execute([
            ':password' => $hashedPassword,
            ':id' => $userId,
        ]);
    }
}
