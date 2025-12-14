<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\AttendanceController;
use App\Controllers\ClassController;
use App\Controllers\CourseController;
use App\Controllers\SessionController;
use App\Controllers\UserController;
use App\Controllers\HomeController;

return [
    '/' => [HomeController::class, 'index'],
    '/home' => [HomeController::class, 'index'],
    '/login' => [AuthController::class, 'login'],
    '/authenticate' => [AuthController::class, 'authenticate'],
    '/logout' => [AuthController::class, 'logout'],
    '/forgot-password' => [AuthController::class, 'forgotPassword'],
    '/forgot-password/verify' => [AuthController::class, 'verifyIdentity'],
    '/reset-password' => [AuthController::class, 'showResetForm'],
    '/reset-password/update' => [AuthController::class, 'updatePassword'],

    '/attendances' => [AttendanceController::class, 'index'],
    '/attendances/create' => [AttendanceController::class, 'create'],
    '/attendances/store' => [AttendanceController::class, 'store'],

    '/users' => [UserController::class, 'index'],
    '/users/create' => [UserController::class, 'create'],
    '/users/store' => [UserController::class, 'store'],
    '/users/edit' => [UserController::class, 'edit'],
    '/users/update' => [UserController::class, 'update'],
    '/users/delete' => [UserController::class, 'destroy'],

    '/classes' => [ClassController::class, 'index'],
    '/classes/create' => [ClassController::class, 'create'],
    '/classes/store' => [ClassController::class, 'store'],
    '/classes/edit' => [ClassController::class, 'edit'],
    '/classes/update' => [ClassController::class, 'update'],
    '/classes/delete' => [ClassController::class, 'destroy'],
    '/classes/assign-student' => [ClassController::class, 'assignStudent'],
    '/classes/remove-student' => [ClassController::class, 'removeStudent'],
    '/classes/assign-teacher' => [ClassController::class, 'assignTeacher'],
    '/classes/remove-teacher' => [ClassController::class, 'removeTeacher'],
    '/classes/assign-course' => [ClassController::class, 'assignCourse'],
    '/classes/remove-course' => [ClassController::class, 'removeCourse'],

    '/courses' => [CourseController::class, 'index'],
    '/courses/create' => [CourseController::class, 'create'],
    '/courses/store' => [CourseController::class, 'store'],
    '/courses/edit' => [CourseController::class, 'edit'],
    '/courses/update' => [CourseController::class, 'update'],
    '/courses/delete' => [CourseController::class, 'destroy'],

    '/sessions' => [SessionController::class, 'index'],
    '/sessions/create' => [SessionController::class, 'create'],
    '/sessions/store' => [SessionController::class, 'store'],
];
