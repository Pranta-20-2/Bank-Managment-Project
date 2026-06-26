<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;

class AccountService
{
    public function deposit(string $userId, float $amount): array
    {
        $this->validateAmount($amount);

        $user = User::findById($userId);

        if (!$user) {
            throw new \InvalidArgumentException('User not found.');
        }

        $balance = round((float) $user['balance'] + $amount, 2);
        User::updateBalance($userId, $balance);

        $transaction = $this->buildTransaction($user, 'deposit', $amount, $balance, 'Cash deposit');
        Transaction::record($transaction);

        return ['balance' => $balance, 'transaction' => $transaction];
    }

    public function withdraw(string $userId, float $amount): array
    {
        $this->validateAmount($amount);

        $user = User::findById($userId);

        if (!$user) {
            throw new \InvalidArgumentException('User not found.');
        }

        if ((float) $user['balance'] < $amount) {
            throw new \InvalidArgumentException('Insufficient balance.');
        }

        $balance = round((float) $user['balance'] - $amount, 2);
        User::updateBalance($userId, $balance);

        $transaction = $this->buildTransaction($user, 'withdraw', $amount, $balance, 'Cash withdrawal');
        Transaction::record($transaction);

        return ['balance' => $balance, 'transaction' => $transaction];
    }

    public function transfer(string $fromUserId, string $toEmail, float $amount): array
    {
        $this->validateAmount($amount);

        $sender = User::findById($fromUserId);
        $recipient = User::findByEmail($toEmail);

        if (!$sender || !$recipient) {
            throw new \InvalidArgumentException('Sender or recipient not found.');
        }

        if (($recipient['role'] ?? '') !== 'customer') {
            throw new \InvalidArgumentException('Transfers are only allowed to customer accounts.');
        }

        if ($sender['id'] === $recipient['id']) {
            throw new \InvalidArgumentException('You cannot transfer to your own account.');
        }

        if ((float) $sender['balance'] < $amount) {
            throw new \InvalidArgumentException('Insufficient balance for transfer.');
        }

        $senderBalance = round((float) $sender['balance'] - $amount, 2);
        $recipientBalance = round((float) $recipient['balance'] + $amount, 2);

        User::updateBalance($sender['id'], $senderBalance);
        User::updateBalance($recipient['id'], $recipientBalance);

        $outTxn = $this->buildTransaction(
            $sender,
            'transfer_out',
            $amount,
            $senderBalance,
            'Transfer to ' . $recipient['email'],
            $recipient['email']
        );

        $inTxn = $this->buildTransaction(
            $recipient,
            'transfer_in',
            $amount,
            $recipientBalance,
            'Transfer from ' . $sender['email'],
            $sender['email']
        );

        Transaction::record($outTxn);
        Transaction::record($inTxn);

        return [
            'balance' => $senderBalance,
            'transactions' => [$outTxn, $inTxn],
        ];
    }

    private function validateAmount(float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than zero.');
        }
    }

    private function buildTransaction(
        array $user,
        string $type,
        float $amount,
        float $balanceAfter,
        string $description,
        ?string $relatedEmail = null
    ): array {
        return [
            'id' => uniqid('txn-', true),
            'user_id' => $user['id'],
            'user_email' => $user['email'],
            'type' => $type,
            'amount' => round($amount, 2),
            'balance_after' => round($balanceAfter, 2),
            'description' => $description,
            'related_email' => $relatedEmail,
            'created_at' => date('c'),
        ];
    }
}
