<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 mb-1">Cours</h1>
        <p class="text-muted mb-0">Gérez les matières enseignées au sein du programme CIS.</p>
    </div>
    <a class="btn btn-primary" href="<?= $base ?>/courses/create">Nouveau cours</a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Enseignant</th>
                    <th>Créé le</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($courses)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Aucun cours enregistré pour le moment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?= (int) $course['id_course'] ?></td>
                            <td><?= htmlspecialchars($course['titre']) ?></td>
                            <td><?= htmlspecialchars($course['description'] ?? '-') ?></td>
                            <td>
                                <?php if (!empty($course['prenom'])): ?>
                                    <?= htmlspecialchars($course['prenom']) ?> <?= htmlspecialchars($course['nom']) ?>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted">Non assigné</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($course['cree_le']) ?></td>
                            <td class="text-end d-flex gap-2 justify-content-end">
                                <a class="btn btn-sm btn-outline-secondary" href="<?= $base ?>/courses/edit?id=<?= (int) $course['id_course'] ?>">Modifier</a>
                                <form method="post" action="<?= $base ?>/courses/delete" onsubmit="return confirm('Supprimer ce cours ?');">
                                    <input type="hidden" name="id" value="<?= (int) $course['id_course'] ?>">
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
