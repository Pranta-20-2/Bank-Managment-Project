<?php

namespace App\Models;

use App\Core\File;

class Transaction
{
    private static function file(): File
    {
        return new File(__DIR__ . '/../../storage/transactions.json');
    }

    public static function all(): array
    {
        $transactions = self::file()->read();

        usort($transactions, fn ($a, $b) => strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));

        return $transactions;
    }

    public static function byUserId(string $userId): array
    {
        return array_values(array_filter(
            self::all(),
            fn (array $txn) => ($txn['user_id'] ?? '') === $userId
        ));
    }

    public static function byUserEmail(string $email): array
    {
        $email = strtolower(trim($email));

        return array_values(array_filter(
            self::all(),
            fn (array $txn) => strtolower($txn['user_email'] ?? '') === $email
        ));
    }

    public static function record(array $transaction): void
    {
        self::file()->update(function (array &$transactions) use ($transaction): void {
            $transactions[] = $transaction;
        });
    }
}
