<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Planifier une session</h1>
    <a class="btn btn-outline-secondary" href="<?= $base ?>/sessions">Retour au calendrier</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $base ?>/sessions/store" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Classe</label>
                <select name="id_classe" class="form-select" required>
                    <option value="">-- Sélectionner --</option>
                    <?php foreach ($classes as $classe): ?>
                        <option value="<?= (int) $classe['id_class'] ?>"><?= htmlspecialchars($classe['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Cours</label>
                <select name="id_course" class="form-select" required>
                    <option value="">-- Sélectionner --</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= (int) $course['id_course'] ?>"><?= htmlspecialchars($course['titre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Date</label>
                <input type="date" name="date_cours" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Heure de début</label>
                <input type="time" name="heure_debut" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Heure de fin (optionnel)</label>
                <input type="time" name="heure_fin" class="form-control">
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Planifier</button>
            </div>
        </form>
    </div>
</div>
