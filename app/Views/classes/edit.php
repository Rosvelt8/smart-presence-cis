<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Modifier la classe</h1>
    <a class="btn btn-outline-secondary" href="<?= $base ?>/classes">Retour</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $base ?>/classes/update" class="vstack gap-3">
            <input type="hidden" name="id" value="<?= (int) $classe['id_class'] ?>">
            <div>
                <label class="form-label">Nom de la classe</label>
                <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($classe['nom']) ?>" required>
            </div>
            <div>
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($classe['description'] ?? '') ?></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Mettre à jour</button>
        </form>
    </div>
</div>
