<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Course;
use App\Models\User;

class CourseController extends Controller
{
    private Course $courseModel;
    private User $userModel;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->ensureAdmin();
        $this->courseModel = new Course($config);
        $this->userModel = new User($config);
    }

    public function index(): void
    {
        $courses = $this->courseModel->all();
        $this->render('courses.index', compact('courses'));
    }

    public function create(): void
    {
        $teachers = $this->userModel->listTeachers();
        $this->render('courses.create', compact('teachers'));
    }

    public function store(): void
    {
        $payload = $this->sanitize($_POST);
        if (empty($payload['titre']) || empty($payload['enseignant'])) {
            $_SESSION['error'] = 'Le titre du cours est requis.';
            $this->redirect('/courses/create');
        }

        $this->courseModel->create($payload, (int) ($_SESSION['user']['id_user'] ?? 0));
        $_SESSION['success'] = 'Cours créé avec succès';
        $this->redirect('/courses');
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $course = $this->courseModel->find($id);
        if (!$course) {
            $_SESSION['error'] = 'Cours introuvable.';
            $this->redirect('/courses');
        }

        $teachers = $this->userModel->listTeachers();
        $this->render('courses.edit', compact('course', 'teachers'));
    }

    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        $payload = $this->sanitize($_POST);
        if ($id <= 0 || empty($payload['titre']) || empty($payload['enseignant'])) {
            $_SESSION['error'] = 'Impossible de mettre à jour le cours.';
            $this->redirect('/courses');
        }

        $this->courseModel->update($id, $payload, (int) ($_SESSION['user']['id_user'] ?? 0));
        $_SESSION['success'] = 'Cours mis à jour';
        $this->redirect('/courses');
    }

    public function destroy(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['error'] = 'Cours introuvable.';
            $this->redirect('/courses');
        }

        $this->courseModel->delete($id);
        $_SESSION['success'] = 'Cours supprimé';
        $this->redirect('/courses');
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
