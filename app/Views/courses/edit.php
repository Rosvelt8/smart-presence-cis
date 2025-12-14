<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Modifier le cours</h1>
    <a class="btn btn-outline-secondary" href="<?= $base ?>/courses">Retour</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $base ?>/courses/update" class="row g-3">
            <input type="hidden" name="id" value="<?= (int) $course['id_course'] ?>">
            <div>
                <label class="form-label">Titre du cours</label>
                <input type="text" name="titre" class="form-control" value="<?= htmlspecialchars($course['titre']) ?>" required>
            </div>
            <div>
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($course['description'] ?? '') ?></textarea>
            </div>
            <div>
                <label class="form-label">Enseignant</label>
                <select name="enseignant" class="form-select" required>
                    <option value="">-- Sélectionner --</option>
                    <?php foreach ($teachers as $teacher): ?>
                        <option value="<?= (int) $teacher['id_user'] ?>" <?= $course['enseignant'] == $teacher['id_user'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($teacher['prenom']) ?> <?= htmlspecialchars($teacher['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Mettre à jour</button>
        </form>
    </div>
</div>
