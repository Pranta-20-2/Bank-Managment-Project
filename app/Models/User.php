<?php

namespace App\Models;

use App\Core\File;

class User
{
    private static function file(): File
    {
        return new File(__DIR__ . '/../../storage/users.json');
    }

    public static function all(): array
    {
        return self::file()->read();
    }

    public static function customers(): array
    {
        return array_values(array_filter(
            self::all(),
            fn (array $user) => ($user['role'] ?? '') === 'customer'
        ));
    }

    public static function findById(string $id): ?array
    {
        foreach (self::all() as $user) {
            if (($user['id'] ?? '') === $id) {
                return $user;
            }
        }

        return null;
    }

    public static function findByEmail(string $email): ?array
    {
        $email = strtolower(trim($email));

        foreach (self::all() as $user) {
            if (strtolower($user['email'] ?? '') === $email) {
                return $user;
            }
        }

        return null;
    }

    public static function create(string $name, string $email, string $password, string $role = 'customer'): array
    {
        $user = [
            'id' => uniqid('user-', true),
            'name' => trim($name),
            'email' => strtolower(trim($email)),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
            'balance' => 0.00,
            'created_at' => date('c'),
        ];

        self::file()->update(function (array &$users) use ($user): void {
            $users[] = $user;
        });

        return $user;
    }

    public static function updateBalance(string $id, float $balance): void
    {
        self::file()->update(function (array &$users) use ($id, $balance): void {
            foreach ($users as &$user) {
                if (($user['id'] ?? '') === $id) {
                    $user['balance'] = round($balance, 2);
                    break;
                }
            }
        });
    }
}
