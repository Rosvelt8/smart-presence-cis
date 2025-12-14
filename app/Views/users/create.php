<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Nouvel utilisateur</h1>
    <a class="btn btn-outline-secondary" href="<?= $base ?>/users">Retour</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= $base ?>/users/store" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Matricule</label>
                <input type="text" name="matricule" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Rôle</label>
                <select name="role" class="form-select" required>
                    <option value="AD">Administrateur</option>
                    <option value="ENS">Enseignant</option>
                    <option value="DEL">Délégué</option>
                    <option value="ET">Étudiant</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Créer</button>
            </div>
        </form>
    </div>
</div>
