<?php
$appName = $config['app_name'] ?? 'Smart Presence';
$baseUrl = rtrim($config['base_url'] ?? '', '/');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($appName) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    <?php $isAdmin = !empty($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'AD'; ?>

    <?php if (!empty($isAuthView)): ?>
        <main class="container-fluid px-3">
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php include $viewFile; ?>
        </main>
    <?php elseif ($isAdmin): ?>
        <div class="d-flex">
            <aside class="text-white d-flex flex-column p-4" style="width: 260px; min-height: 100vh; background-color: #0b4faa;">
                <div class="text-center mb-4">
                    <img src="<?= $baseUrl ?>/assets/images/logo.png" alt="CIS Formation" height="48">
                    <p class="mt-2 mb-0 fw-semibold">Administration</p>
                    <small class="text-white-50">Bonjour <?= htmlspecialchars($_SESSION['user']['prenom'] ?? '') ?></small>
                </div>
                <nav class="nav nav-pills flex-column gap-2">
                    <?php 
                        $attendanceActive = str_starts_with($viewName, 'attendance');
                        $userActive = str_starts_with($viewName, 'users');
                        $classActive = str_starts_with($viewName, 'classes');
                        $courseActive = str_starts_with($viewName, 'courses');
                        $sessionActive = str_starts_with($viewName, 'sessions');
                    ?>
                    <a class="nav-link <?= $viewName === 'home.index' ? 'active bg-white text-dark' : 'text-white-50' ?>" href="<?= $baseUrl ?>/">Accueil</a>
                    <a class="nav-link <?= $attendanceActive ? 'active bg-white text-dark' : 'text-white-50' ?>" href="<?= $baseUrl ?>/attendances">Présences</a>
                    <a class="nav-link text-white-50" href="<?= $baseUrl ?>/attendances/create">Ajouter une présence</a>
                    <a class="nav-link <?= $classActive ? 'active bg-white text-dark' : 'text-white-50' ?>" href="<?= $baseUrl ?>/classes">Classes</a>
                    <a class="nav-link <?= $courseActive ? 'active bg-white text-dark' : 'text-white-50' ?>" href="<?= $baseUrl ?>/courses">Cours</a>
                    <a class="nav-link <?= $sessionActive ? 'active bg-white text-dark' : 'text-white-50' ?>" href="<?= $baseUrl ?>/sessions">Sessions</a>
                    <a class="nav-link <?= $userActive ? 'active bg-white text-dark' : 'text-white-50' ?>" href="<?= $baseUrl ?>/users">Utilisateurs</a>
                    <a class="nav-link text-white-50" href="#">Rapports (à venir)</a>
                </nav>
                <div class="mt-auto">
                    <a class="btn btn-outline-light w-100" href="<?= $baseUrl ?>/logout">Déconnexion</a>
                </div>
            </aside>
            <main class="flex-grow-1 p-4">
                <?php if (!empty($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (!empty($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php include $viewFile; ?>
            </main>
        </div>
    <?php else: ?>
        <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="<?= $baseUrl ?>/">
                    <img src="<?= $baseUrl ?>/assets/images/logo.png" alt="CIS Formation" height="40">
                    <span class="fw-semibold"><?= htmlspecialchars($appName) ?></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Basculer la navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                        <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>/">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>/attendances">Présences</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>/attendances/create">Ajouter</a></li>
                        <li class="nav-item">
                            <a class="btn btn-warning text-dark" href="<?= $baseUrl ?>/login">Connexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container my-4">
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php include $viewFile; ?>
        </main>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
