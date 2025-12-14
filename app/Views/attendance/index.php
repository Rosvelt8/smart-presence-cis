<section class="card">
    <header class="card-header">
        <h2>Liste des présences</h2>
        <a class="btn" href="<?= rtrim($config['base_url'] ?? '', '/') ?>/attendances/create">Nouvelle présence</a>
    </header>

    <?php if (empty($attendances)): ?>
        <p>Aucune présence enregistrée pour le moment.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Horaire</th>
                    <th>Classe</th>
                    <th>Cours</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendances as $attendance): ?>
                    <tr>
                        <td><?= htmlspecialchars($attendance['student_name']) ?></td>
                        <td><?= htmlspecialchars($attendance['statut']) ?></td>
                        <td><?= htmlspecialchars($attendance['date_cours']) ?></td>
                        <td><?= htmlspecialchars($attendance['heure_debut']) ?> - <?= htmlspecialchars($attendance['heure_fin']) ?></td>
                        <td><?= htmlspecialchars($attendance['classe']) ?></td>
                        <td><?= htmlspecialchars($attendance['cours']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
