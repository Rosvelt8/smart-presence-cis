<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    private User $userModel;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->userModel = new User($config);
    }

    public function login(): void
    {
        $this->render('auth.login');
    }

    public function forgotPassword(): void
    {
        $this->render('auth.forgot');
    }

    public function authenticate(): void
    {
        $matricule = trim($_POST['matricule'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($matricule === '' || $password === '') {
            $_SESSION['error'] = 'Veuillez renseigner le matricule et le mot de passe.';
            $this->redirect('/login');
        }

        $user = $this->userModel->findByMatricule($matricule);

        if (!$user || !password_verify($password, $user['mdp'])) {
            $_SESSION['error'] = 'Identifiants invalides.';
            $this->redirect('/login');
        }

        $_SESSION['user'] = [
            'id_user' => $user['id_user'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'role' => $user['role'],
        ];

        $_SESSION['success'] = 'Bienvenue ' . $user['prenom'] . '!';
        $this->redirect('/attendances');
    }

    public function verifyIdentity(): void
    {
        $fullName = trim($_POST['full_name'] ?? '');
        $matricule = trim($_POST['matricule'] ?? '');

        if ($fullName === '' || $matricule === '') {
            $_SESSION['error'] = 'Veuillez renseigner le nom complet et le matricule.';
            $this->redirect('/forgot-password');
        }

        $user = $this->userModel->findByMatricule($matricule);

        if (!$user) {
            $_SESSION['error'] = 'Aucun utilisateur trouvé avec ce matricule.';
            $this->redirect('/forgot-password');
        }

        $expected = strtolower(trim($user['prenom'] . ' ' . $user['nom']));
        $provided = strtolower(trim(preg_replace('/\s+/', ' ', $fullName)));

        if ($expected !== $provided) {
            $_SESSION['error'] = 'Le nom complet ne correspond pas à ce matricule.';
            $this->redirect('/forgot-password');
        }

        $_SESSION['reset_user_id'] = (int) $user['id_user'];
        $_SESSION['success'] = 'Identité confirmée. Veuillez saisir un nouveau mot de passe.';
        $this->redirect('/reset-password');
    }

    public function showResetForm(): void
    {
        if (empty($_SESSION['reset_user_id'])) {
            $_SESSION['error'] = 'Veuillez d\'abord confirmer votre identité.';
            $this->redirect('/forgot-password');
        }

        $this->render('auth.reset');
    }

    public function updatePassword(): void
    {
        $userId = $_SESSION['reset_user_id'] ?? null;

        if (!$userId) {
            $_SESSION['error'] = 'Session de réinitialisation expirée.';
            $this->redirect('/forgot-password');
        }

        $password = $_POST['password'] ?? '';
        $confirmation = $_POST['password_confirmation'] ?? '';

        if ($password === '' || $confirmation === '') {
            $_SESSION['error'] = 'Veuillez saisir et confirmer le mot de passe.';
            $this->redirect('/reset-password');
        }

        if ($password !== $confirmation) {
            $_SESSION['error'] = 'Les mots de passe ne correspondent pas.';
            $this->redirect('/reset-password');
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Le mot de passe doit comporter au moins 6 caractères.';
            $this->redirect('/reset-password');
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $this->userModel->updatePassword((int) $userId, $hashed);

        unset($_SESSION['reset_user_id']);
        $_SESSION['success'] = 'Mot de passe mis à jour. Vous pouvez vous reconnecter.';
        $this->redirect('/login');
    }

    public function logout(): void
    {
        unset($_SESSION['reset_user_id']);
        $_SESSION = [];
        session_destroy();
        $this->redirect('/login');
    }
}
