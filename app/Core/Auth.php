<?php

namespace App\Core;

class Auth
{
    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    public static function login(array $user): void
    {
        $_SESSION['user'] = $user;
    }

    public static function logout(): void
    {
        unset($_SESSION['user']);
    }

    public static function isAdmin(): bool
    {
        return self::check() && (self::user()['role'] ?? '') === 'admin';
    }

    public static function isCustomer(): bool
    {
        return self::check() && (self::user()['role'] ?? '') === 'customer';
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            header('Location: /');
            exit;
        }
    }

    public static function requireAdmin(): void
    {
        self::requireLogin();

        if (!self::isAdmin()) {
            header('Location: /dashboard');
            exit;
        }
    }

    public static function requireCustomer(): void
    {
        self::requireLogin();

        if (!self::isCustomer()) {
            header('Location: /admin');
            exit;
        }
    }

    public static function guestOnly(): void
    {
        if (!self::check()) {
            return;
        }

        header('Location: ' . self::homeRoute());
        exit;
    }

    public static function homeRoute(): string
    {
        return self::isAdmin() ? '/admin' : '/dashboard';
    }
}
