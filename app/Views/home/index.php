<?php $base = rtrim($config['base_url'] ?? '', '/'); ?>

<section class="bg-primary text-white rounded-4 p-4 p-lg-5 mb-4">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <p class="text-uppercase small fw-semibold mb-2">Cameroon Institute of Specialisation</p>
            <h1 class="display-5 fw-bold">Smart Presence, la tour de contrôle CIS</h1>
            <p class="lead mb-4">Supervisez classes, sessions et présences avec des outils fiables et accessibles à toute l'équipe pédagogique.</p>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-warning text-dark" href="<?= $base ?>/login">Démarrer</a>
                <a class="btn btn-outline-light" href="<?= $base ?>/attendances">Voir le tableau</a>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card bg-white text-dark border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="<?= $base ?>/assets/images/logo.png" alt="Logo CIS" height="48">
                        <div>
                            <p class="text-muted small mb-0">Statistiques hebdo</p>
                            <h5 class="mb-0">Smart Presence</h5>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col">
                            <p class="h3 fw-bold mb-0">40+</p>
                            <small class="text-muted">Sessions</small>
                        </div>
                        <div class="col border-start">
                            <p class="h3 fw-bold mb-0">1K+</p>
                            <small class="text-muted">Présences</small>
                        </div>
                        <div class="col border-start">
                            <p class="h3 fw-bold mb-0">4</p>
                            <small class="text-muted">Rôles</small>
                        </div>
                    </div>
                    <ul class="list-unstyled mt-3 mb-0">
                        <li class="d-flex align-items-center gap-2"><span class="badge bg-success rounded-pill">✓</span> Alertes retards & absences</li>
                        <li class="d-flex align-items-center gap-2"><span class="badge bg-success rounded-pill">✓</span> Rapports prêts pour l'administration</li>
                        <li class="d-flex align-items-center gap-2"><span class="badge bg-success rounded-pill">✓</span> Tableau de bord par classe</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Suivi instantané</h5>
                    <p class="card-text text-muted">Marquez les présences depuis n'importe quel appareil et synchronisez les rapports en temps réel.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Organisation claire</h5>
                    <p class="card-text text-muted">Classes, cours et sessions sont structurés pour garantir des analyses fiables.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Contrôle des rôles</h5>
                    <p class="card-text text-muted">Admins, enseignants, délégués et étudiants disposent d'outils adaptés à leur mission.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-light rounded-4 p-4 p-md-5 mb-5">
    <h2 class="h4 fw-bold text-center mb-4">Votre routine digitale en 3 étapes</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0">
                <div class="card-body">
                    <span class="badge bg-primary rounded-pill mb-3">1</span>
                    <h5>Planifiez</h5>
                    <p class="text-muted mb-0">Associez cours, classes et horaires pour construire vos sessions officielles.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0">
                <div class="card-body">
                    <span class="badge bg-primary rounded-pill mb-3">2</span>
                    <h5>Enregistrez</h5>
                    <p class="text-muted mb-0">Enseignants ou délégués capturent P / A / R / J en quelques secondes.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0">
                <div class="card-body">
                    <span class="badge bg-primary rounded-pill mb-3">3</span>
                    <h5>Analysez</h5>
                    <p class="text-muted mb-0">Identifiez les tendances et diffusez les rapports à l'administration.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="fs-5 fst-italic">« Depuis que nous utilisons Smart Presence, les retards sont traités en moins de 24h et nos apprenants se sentent accompagnés. »</p>
                    <p class="fw-semibold mb-0">Coordination pédagogique CIS Formation</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100 bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Focus excellence</h5>
                    <p class="card-text">La plateforme s'intègre naturellement au workflow CIS Formation et prépare l'ouverture aux notifications mobiles.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-dark text-white rounded-4 p-4 p-lg-5">
    <div class="text-center">
        <h2 class="fw-bold mb-3">Prêt à professionnaliser la présence au CIS&nbsp;?</h2>
        <p class="mb-4">Lancez-vous dès aujourd'hui et centralisez la relation entre l'école, les enseignants et les apprenants.</p>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <a class="btn btn-warning text-dark" href="<?= $base ?>/login">Se connecter</a>
            <a class="btn btn-outline-light" href="<?= $base ?>/attendances">Explorer les présences</a>
        </div>
    </div>
</section>
