<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class UserController extends Controller
{
    private User $userModel;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->ensureAdmin();
        $this->userModel = new User($config);
    }

    public function index(): void
    {
        $users = $this->userModel->listAll();
        $this->render('users.index', compact('users'));
    }

    public function create(): void
    {
        $this->render('users.create');
    }

    public function store(): void
    {
        $payload = $this->sanitize($_POST);

        $required = ['nom', 'prenom', 'matricule', 'role'];
        foreach ($required as $field) {
            if (empty($payload[$field])) {
                $_SESSION['error'] = 'Veuillez remplir tous les champs obligatoires.';
                $this->redirect('/users/create');
            }
        }

        if (empty($payload['password']) || strlen($payload['password']) < 6) {
            $_SESSION['error'] = 'Mot de passe requis (6 caractères minimum).';
            $this->redirect('/users/create');
        }

        $payload['password'] = password_hash($payload['password'], PASSWORD_DEFAULT);

        $this->userModel->create($payload);
        $_SESSION['success'] = 'Utilisateur créé avec succès';
        $this->redirect('/users');
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['error'] = 'Utilisateur introuvable';
            $this->redirect('/users');
        }

        $user = $this->userModel->findById($id);
        if (!$user) {
            $_SESSION['error'] = 'Utilisateur introuvable';
            $this->redirect('/users');
        }

        $this->render('users.edit', compact('user'));
    }

    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['error'] = 'Utilisateur introuvable';
            $this->redirect('/users');
        }

        $payload = $this->sanitize($_POST);
        $required = ['nom', 'prenom', 'matricule', 'role'];
        foreach ($required as $field) {
            if (empty($payload[$field])) {
                $_SESSION['error'] = 'Veuillez remplir tous les champs obligatoires.';
                $this->redirect('/users/edit?id=' . $id);
            }
        }

        if (!empty($payload['password'])) {
            if (strlen($payload['password']) < 6) {
                $_SESSION['error'] = 'Mot de passe trop court.';
                $this->redirect('/users/edit?id=' . $id);
            }
            $payload['password'] = password_hash($payload['password'], PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $payload);
        $_SESSION['success'] = 'Utilisateur mis à jour';
        $this->redirect('/users');
    }

    public function destroy(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['error'] = 'Utilisateur introuvable';
            $this->redirect('/users');
        }

        $this->userModel->delete($id);
        $_SESSION['success'] = 'Utilisateur supprimé';
        $this->redirect('/users');
    }

    private function ensureAdmin(): void
    {
        $role = $_SESSION['user']['role'] ?? null;
        if ($role !== 'AD') {
            $_SESSION['error'] = 'Accès réservé aux administrateurs.';
            $this->redirect('/login');
        }
    }

    private function sanitize(array $data): array
    {
        return array_map(static fn($value) => is_string($value) ? trim($value) : $value, $data);
    }
}
