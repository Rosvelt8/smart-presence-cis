<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>
<div class="d-flex justify-content-center align-items-center min-vh-75 py-5">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="text-center mb-4">
            <img src="<?= $base ?>/assets/images/logo.png" alt="CIS Formation" height="70">
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h4 mb-4 text-center">Connexion</h2>
                <form method="post" action="<?= $base ?>/authenticate" class="vstack gap-3">
                    <div>
                        <label class="form-label">Matricule</label>
                        <input type="text" class="form-control" name="matricule" required>
                    </div>
                    <div>
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Se connecter</button>
                </form>
                <div class="text-center mt-3">
                    <a href="<?= $base ?>/forgot-password" class="link-primary">Mot de passe oublié ?</a>
                </div>
            </div>
        </div>
    </div>
</div>
