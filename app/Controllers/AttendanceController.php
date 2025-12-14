<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Presence;
use App\Models\Session;
use App\Models\User;

class AttendanceController extends Controller
{
    private Presence $presenceModel;
    private Session $sessionModel;
    private User $userModel;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->presenceModel = new Presence($config);
        $this->sessionModel = new Session($config);
        $this->userModel = new User($config);
    }

    public function index(): void
    {
        $attendances = $this->presenceModel->getAll();
        $this->render('attendance.index', compact('attendances'));
    }

    public function create(): void
    {
        $sessions = $this->sessionModel->upcoming();
        $students = $this->userModel->listStudents();
        $this->render('attendance.create', compact('sessions', 'students'));
    }

    public function store(): void
    {
        $sessionId = (int)($_POST['session_id'] ?? 0);
        $studentId = (int)($_POST['student_id'] ?? 0);
        $status = $_POST['status'] ?? 'P';

        if ($sessionId <= 0 || $studentId <= 0) {
            $_SESSION['error'] = 'Veuillez choisir une session et un étudiant.';
            $this->redirect('/attendances/create');
        }

        $currentUserId = $_SESSION['user']['id_user'] ?? null;

        $this->presenceModel->record([
            'session_id' => $sessionId,
            'student_id' => $studentId,
            'statut' => $status,
            'marker_id' => $currentUserId,
            'validator_id' => null,
        ]);

        $_SESSION['success'] = 'Présence enregistrée';
        $this->redirect('/attendances');
    }
}
