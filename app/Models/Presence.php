<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;
use PDOStatement;
use RuntimeException;

class Presence extends Model
{
    public function getAll(): array
    {
        $sql = <<<SQL
            SELECT
                p.id_presence,
                CONCAT(u.prenom, ' ', u.nom) AS student_name,
                p.statut,
                s.date_cours,
                s.heure_debut,
                s.heure_fin,
                cl.nom AS classe,
                co.titre AS cours
            FROM Presence p
            INNER JOIN Utilisateur u ON u.id_user = p.id_user
            INNER JOIN Session s ON s.id_session = p.id_session
            INNER JOIN Classe cl ON cl.id_class = s.id_classe
            INNER JOIN Course co ON co.id_course = s.id_course
            ORDER BY s.date_cours DESC, s.heure_debut DESC, student_name ASC
        SQL;

        $stmt = $this->db->query($sql);
        return $stmt instanceof PDOStatement ? $stmt->fetchAll() : [];
    }

    public function record(array $data): void
    {
        $sql = <<<SQL
            INSERT INTO Presence (
                id_session,
                id_user,
                statut,
                id_marque_par,
                id_valide_par,
                id_user_crea,
                id_user_modif
            ) VALUES (
                :session_id,
                :student_id,
                :statut,
                :marker_id,
                :validator_id,
                :creator_id,
                :modifier_id
            )
            ON DUPLICATE KEY UPDATE
                statut = VALUES(statut),
                id_user_modif = VALUES(id_user_modif),
                id_valide_par = VALUES(id_valide_par),
                modifie_le = CURRENT_TIMESTAMP
        SQL;

        $markerId = $data['marker_id'] ?? null;
        $validatorId = $data['validator_id'] ?? null;

        $stmt = $this->db->prepare($sql);
        $success = $stmt->execute([
            ':session_id' => $data['session_id'],
            ':student_id' => $data['student_id'],
            ':statut' => $data['statut'],
            ':marker_id' => $markerId,
            ':validator_id' => $validatorId,
            ':creator_id' => $markerId,
            ':modifier_id' => $markerId,
        ]);

        if (!$success) {
            throw new RuntimeException('Impossible d\'enregistrer la présence.');
        }
    }
}
