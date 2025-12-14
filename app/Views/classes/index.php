<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 mb-1">Classes</h1>
        <p class="text-muted mb-0">Organisez les différentes classes de CIS Formation.</p>
    </div>
    <a class="btn btn-primary" href="<?= $base ?>/classes/create">Nouvelle classe</a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Créée le</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($classes)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Aucune classe enregistrée pour le moment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($classes as $classe): ?>
                        <tr>
                            <td><?= (int) $classe['id_class'] ?></td>
                            <td><?= htmlspecialchars($classe['nom']) ?></td>
                            <td><?= htmlspecialchars($classe['description'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($classe['cree_le']) ?></td>
                            <td class="text-end d-flex gap-2 justify-content-end">
                                <a class="btn btn-sm btn-outline-secondary" href="<?= $base ?>/classes/edit?id=<?= (int) $classe['id_class'] ?>">Modifier</a>
                                <form method="post" action="<?= $base ?>/classes/delete" onsubmit="return confirm('Supprimer cette classe ?');">
                                    <input type="hidden" name="id" value="<?= (int) $classe['id_class'] ?>">
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
