<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 mb-1">Utilisateurs</h1>
        <p class="text-muted mb-0">Gestion des comptes (admins, enseignants, délégués, étudiants)</p>
    </div>
    <a class="btn btn-primary" href="<?= $base ?>/users/create">Nouvel utilisateur</a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Matricule</th>
                    <th>Rôle</th>
                    <th>Créé le</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucun utilisateur pour le moment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= (int) $user['id_user'] ?></td>
                            <td><?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?></td>
                            <td><?= htmlspecialchars($user['matricule']) ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                            <td><?= htmlspecialchars($user['cree_le']) ?></td>
                            <td class="text-end d-flex gap-2 justify-content-end">
                                <a class="btn btn-sm btn-outline-secondary" href="<?= $base ?>/users/edit?id=<?= (int) $user['id_user'] ?>">Modifier</a>
                                <form method="post" action="<?= $base ?>/users/delete" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                    <input type="hidden" name="id" value="<?= (int) $user['id_user'] ?>">
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
