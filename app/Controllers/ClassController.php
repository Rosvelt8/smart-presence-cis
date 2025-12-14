<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Classe;

class ClassController extends Controller
{
    private Classe $classModel;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->ensureAdmin();
        $this->classModel = new Classe($config);
    }

    public function index(): void
    {
        $classes = $this->classModel->all();
        $this->render('classes.index', compact('classes'));
    }

    public function create(): void
    {
        $this->render('classes.create');
    }

    public function store(): void
    {
        $payload = $this->sanitize($_POST);
        if (empty($payload['nom'])) {
            $_SESSION['error'] = 'Le nom de la classe est requis.';
            $this->redirect('/classes/create');
        }

        $this->classModel->create($payload, (int) ($_SESSION['user']['id_user'] ?? 0));
        $_SESSION['success'] = 'Classe créée avec succès';
        $this->redirect('/classes');
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $classe = $this->classModel->find($id);
        if (!$classe) {
            $_SESSION['error'] = 'Classe introuvable.';
            $this->redirect('/classes');
        }

        $this->render('classes.edit', compact('classe'));
    }

    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        $payload = $this->sanitize($_POST);
        if ($id <= 0 || empty($payload['nom'])) {
            $_SESSION['error'] = 'Impossible de mettre à jour la classe.';
            $this->redirect('/classes');
        }

        $this->classModel->update($id, $payload, (int) ($_SESSION['user']['id_user'] ?? 0));
        $_SESSION['success'] = 'Classe mise à jour';
        $this->redirect('/classes');
    }

    public function destroy(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['error'] = 'Classe introuvable.';
            $this->redirect('/classes');
        }

        $this->classModel->delete($id);
        $_SESSION['success'] = 'Classe supprimée';
        $this->redirect('/classes');
    }

    private function ensureAdmin(): void
    {
        if (($_SESSION['user']['role'] ?? null) !== 'AD') {
            $_SESSION['error'] = 'Accès réservé aux administrateurs.';
            $this->redirect('/login');
        }
    }

    private function sanitize(array $data): array
    {
        return array_map(static fn($value) => is_string($value) ? trim($value) : $value, $data);
    }
}
