<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>
<div class="d-flex justify-content-center align-items-center min-vh-75 py-5">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="text-center mb-4">
            <img src="<?= $base ?>/assets/images/logo.png" alt="CIS Formation" height="70">
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5 mb-3 text-center">Nouveau mot de passe</h2>
                <p class="text-muted small text-center mb-4">Choisissez un mot de passe sécurisé (6 caractères minimum).</p>
                <form method="post" action="<?= $base ?>/reset-password/update" class="vstack gap-3">
                    <div>
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div>
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>
