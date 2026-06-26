<?php

namespace App\Core;

class Seeder
{
    public static function run(): void
    {
        $usersFile = new File(__DIR__ . '/../../storage/users.json');

        if ($usersFile->exists()) {
            return;
        }

        $johnId = 'cust-john-001';
        $janeId = 'cust-jane-002';

        $usersFile->write([
            [
                'id' => 'admin-001',
                'name' => 'Bank Admin',
                'email' => 'admin@bank.com',
                'password' => password_hash('admin1234', PASSWORD_DEFAULT),
                'role' => 'admin',
                'balance' => 0,
                'created_at' => date('c'),
            ],
            [
                'id' => $johnId,
                'name' => 'John Smith',
                'email' => 'john@example.com',
                'password' => password_hash('password1', PASSWORD_DEFAULT),
                'role' => 'customer',
                'balance' => 4850.00,
                'created_at' => date('c'),
            ],
            [
                'id' => $janeId,
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'password' => password_hash('password1', PASSWORD_DEFAULT),
                'role' => 'customer',
                'balance' => 3350.00,
                'created_at' => date('c'),
            ],
        ]);

        $transactionsFile = new File(__DIR__ . '/../../storage/transactions.json');
        $transactionsFile->write([
            [
                'id' => 'txn-001',
                'user_id' => $johnId,
                'user_email' => 'john@example.com',
                'type' => 'deposit',
                'amount' => 2000.00,
                'balance_after' => 5000.00,
                'description' => 'Initial deposit',
                'related_email' => null,
                'created_at' => date('c', strtotime('-3 days')),
            ],
            [
                'id' => 'txn-002',
                'user_id' => $janeId,
                'user_email' => 'jane@example.com',
                'type' => 'deposit',
                'amount' => 3200.00,
                'balance_after' => 3200.00,
                'description' => 'Salary deposit',
                'related_email' => null,
                'created_at' => date('c', strtotime('-2 days')),
            ],
            [
                'id' => 'txn-003',
                'user_id' => $johnId,
                'user_email' => 'john@example.com',
                'type' => 'transfer_out',
                'amount' => 150.00,
                'balance_after' => 4850.00,
                'description' => 'Transfer to jane@example.com',
                'related_email' => 'jane@example.com',
                'created_at' => date('c', strtotime('-1 day')),
            ],
            [
                'id' => 'txn-004',
                'user_id' => $janeId,
                'user_email' => 'jane@example.com',
                'type' => 'transfer_in',
                'amount' => 150.00,
                'balance_after' => 3350.00,
                'description' => 'Transfer from john@example.com',
                'related_email' => 'john@example.com',
                'created_at' => date('c', strtotime('-1 day')),
            ],
        ]);
    }
}
