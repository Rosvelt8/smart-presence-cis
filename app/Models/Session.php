<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Session extends Model
{
    public function upcoming(int $limit = 20): array
    {
        $sql = <<<SQL
            SELECT
                s.id_session,
                s.date_cours,
                s.heure_debut,
                s.heure_fin,
                cl.nom AS classe,
                co.titre AS cours
            FROM Session s
            INNER JOIN Classe cl ON cl.id_class = s.id_classe
            INNER JOIN Course co ON co.id_course = s.id_course
            ORDER BY s.date_cours DESC, s.heure_debut DESC
            LIMIT :limit
        SQL;

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll() ?: [];
    }

    public function getByClassAndRange(int $classId, string $startDate, string $endDate): array
    {
        $sql = <<<SQL
            SELECT
                s.id_session,
                s.date_cours,
                s.heure_debut,
                s.heure_fin,
                s.annule,
                cl.nom AS classe,
                co.titre AS cours,
                u.prenom AS enseignant_prenom,
                u.nom AS enseignant_nom
            FROM Session s
            INNER JOIN Classe cl ON cl.id_class = s.id_classe
            INNER JOIN Course co ON co.id_course = s.id_course
            LEFT JOIN Utilisateur u ON u.id_user = co.enseignant
            WHERE s.id_classe = :classId
              AND s.date_cours BETWEEN :start AND :end
            ORDER BY s.date_cours, s.heure_debut
        SQL;

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':classId' => $classId,
            ':start' => $startDate,
            ':end' => $endDate,
        ]);

        return $stmt->fetchAll() ?: [];
    }

    public function create(array $data, int $creatorId): void
    {
        $stmt = $this->db->prepare('INSERT INTO Session (id_course, id_classe, date_cours, heure_debut, heure_fin, id_user_crea) VALUES (:course, :classe, :date, :start, :end, :creator)');
        $stmt->execute([
            ':course' => $data['id_course'],
            ':classe' => $data['id_classe'],
            ':date' => $data['date_cours'],
            ':start' => $data['heure_debut'],
            ':end' => $data['heure_fin'] ?: null,
            ':creator' => $creatorId,
        ]);
    }
}
