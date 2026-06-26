<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        Auth::guestOnly();

        $this->view('auth/login', [
            'error' => $_SESSION['login_error'] ?? null,
            'email' => $_SESSION['login_email'] ?? '',
        ]);

        unset($_SESSION['login_error'], $_SESSION['login_email']);
    }

    public function loginStore()
    {
        Auth::guestOnly();

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            $_SESSION['login_error'] = 'Please enter your email and password.';
            $_SESSION['login_email'] = $email;
            header('Location: /');
            exit;
        }

        $user = User::findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['login_error'] = 'Invalid email or password.';
            $_SESSION['login_email'] = $email;
            header('Location: /');
            exit;
        }

        Auth::login($this->sessionUser($user));

        header('Location: ' . Auth::homeRoute());
        exit;
    }

    public function logout()
    {
        Auth::logout();
        header('Location: /');
        exit;
    }

    public function register()
    {
        Auth::guestOnly();

        $this->view('auth/register', [
            'error' => $_SESSION['register_error'] ?? null,
            'name' => $_SESSION['register_name'] ?? '',
            'email' => $_SESSION['register_email'] ?? '',
        ]);

        unset($_SESSION['register_error'], $_SESSION['register_name'], $_SESSION['register_email']);
    }

    public function registerStore()
    {
        Auth::guestOnly();

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            $this->flashRegisterError('All fields are required.', $name, $email);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->flashRegisterError('Please enter a valid email address.', $name, $email);
        }

        if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
            $this->flashRegisterError('Password must be at least 8 characters with letters and numbers.', $name, $email);
        }

        if (User::findByEmail($email)) {
            $this->flashRegisterError('An account with this email already exists.', $name, $email);
        }

        $user = User::create($name, $email, $password, 'customer');

        Auth::login($this->sessionUser($user));

        header('Location: /dashboard');
        exit;
    }

    private function sessionUser(array $user): array
    {
        return [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'initials' => $this->initials($user['name']),
        ];
    }

    private function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name)) ?: [];

        if (count($parts) >= 2) {
            return strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
        }

        return strtoupper(substr($parts[0] ?? 'U', 0, 2));
    }

    private function flashRegisterError(string $message, string $name, string $email): void
    {
        $_SESSION['register_error'] = $message;
        $_SESSION['register_name'] = $name;
        $_SESSION['register_email'] = $email;
        header('Location: /register');
        exit;
    }
}
