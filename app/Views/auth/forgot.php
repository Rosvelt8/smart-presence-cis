<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>
<div class="d-flex justify-content-center align-items-center min-vh-75 py-5">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="text-center mb-4">
            <img src="<?= $base ?>/assets/images/logo.png" alt="CIS Formation" height="70">
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5 mb-3 text-center">Mot de passe oublié</h2>
                <p class="text-muted small text-center mb-4">Saisissez votre nom complet et votre matricule pour vérifier votre identité.</p>
                <form method="post" action="<?= $base ?>/forgot-password/verify" class="vstack gap-3">
                    <div>
                        <label class="form-label">Nom complet</label>
                        <input type="text" class="form-control" name="full_name" placeholder="Prenom Nom" required>
                    </div>
                    <div>
                        <label class="form-label">Matricule</label>
                        <input type="text" class="form-control" name="matricule" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Vérifier mon identité</button>
                </form>
                <div class="text-center mt-3">
                    <a href="<?= $base ?>/login" class="link-secondary">Retour à la connexion</a>
                </div>
            </div>
        </div>
    </div>
</div>
