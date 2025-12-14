<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Nouvelle classe</h1>
    <a class="btn btn-outline-secondary" href="<?= $base ?>/classes">Retour</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $base ?>/classes/store" class="vstack gap-3">
            <div>
                <label class="form-label">Nom de la classe</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div>
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Enregistrer</button>
        </form>
    </div>
</div>
