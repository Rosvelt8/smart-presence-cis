<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Session;

class SessionController extends Controller
{
    private Session $sessionModel;
    private Classe $classModel;
    private Course $courseModel;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->ensureAdmin();
        $this->sessionModel = new Session($config);
        $this->classModel = new Classe($config);
        $this->courseModel = new Course($config);
    }

    public function index(): void
    {
        $classes = $this->classModel->all();
        $selectedClass = (int) ($_GET['class_id'] ?? ($classes[0]['id_class'] ?? 0));

        $start = $_GET['start'] ?? date('Y-m-d', strtotime('monday this week'));
        $end = $_GET['end'] ?? date('Y-m-d', strtotime($start . ' +6 days'));

        $sessions = [];
        if ($selectedClass) {
            $sessions = $this->sessionModel->getByClassAndRange($selectedClass, $start, $end);
        }

        $events = array_map(static function (array $session): array {
            $teacherFullName = trim(($session['enseignant_prenom'] ?? '') . ' ' . ($session['enseignant_nom'] ?? ''));
            return [
                'title' => $teacherFullName ? sprintf('%s • %s', $session['cours'], $teacherFullName) : $session['cours'],
                'start' => $session['date_cours'] . 'T' . $session['heure_debut'],
                'end' => !empty($session['heure_fin']) ? $session['date_cours'] . 'T' . $session['heure_fin'] : null,
                'extendedProps' => [
                    'classe' => $session['classe'],
                    'annule' => (bool) $session['annule'],
                    'enseignant' => $teacherFullName,
                ],
            ];
        }, $sessions);

        $this->render('sessions.index', compact('classes', 'selectedClass', 'start', 'end', 'events'));
    }

    public function create(): void
    {
        $classes = $this->classModel->all();
        $courses = $this->courseModel->all();

        $this->render('sessions.create', compact('classes', 'courses'));
    }

    public function store(): void
    {
        $payload = $this->sanitize($_POST);
        $required = ['id_classe', 'id_course', 'date_cours', 'heure_debut'];

        foreach ($required as $field) {
            if (empty($payload[$field])) {
                $_SESSION['error'] = 'Tous les champs obligatoires doivent être remplis.';
                $this->redirect('/sessions/create');
            }
        }

        if (!empty($payload['heure_fin']) && $payload['heure_fin'] <= $payload['heure_debut']) {
            $_SESSION['error'] = 'L\'heure de fin doit être supérieure à l\'heure de début.';
            $this->redirect('/sessions/create');
        }

        $this->sessionModel->create($payload, (int) ($_SESSION['user']['id_user'] ?? 0));
        $_SESSION['success'] = 'Session planifiée avec succès';
        $this->redirect('/sessions');
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
