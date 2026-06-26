<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Services\AccountService;

class CustomerController extends Controller
{
    private AccountService $accounts;

    public function __construct()
    {
        $this->accounts = new AccountService();
    }

    public function dashboard()
    {
        Auth::requireCustomer();

        $user = User::findById(Auth::user()['id']);
        $transactions = Transaction::byUserId($user['id']);

        $this->view('customer/dashboard', [
            'title' => 'Dashboard',
            'activePage' => 'dashboard',
            'user' => $user,
            'transactions' => array_slice($transactions, 0, 5),
            'success' => $_SESSION['success'] ?? null,
            'error' => $_SESSION['error'] ?? null,
        ], 'home');

        unset($_SESSION['success'], $_SESSION['error']);
    }

    public function transactions()
    {
        Auth::requireCustomer();

        $user = User::findById(Auth::user()['id']);

        $this->view('customer/transactions', [
            'title' => 'My Transactions',
            'activePage' => 'transactions',
            'user' => $user,
            'transactions' => Transaction::byUserId($user['id']),
        ], 'home');
    }

    public function deposit()
    {
        Auth::requireCustomer();
        $this->handleAction(fn () => $this->accounts->deposit(
            Auth::user()['id'],
            (float) ($_POST['amount'] ?? 0)
        ), 'Deposit successful.');
    }

    public function withdraw()
    {
        Auth::requireCustomer();
        $this->handleAction(fn () => $this->accounts->withdraw(
            Auth::user()['id'],
            (float) ($_POST['amount'] ?? 0)
        ), 'Withdrawal successful.');
    }

    public function transfer()
    {
        Auth::requireCustomer();
        $this->handleAction(fn () => $this->accounts->transfer(
            Auth::user()['id'],
            trim($_POST['recipient_email'] ?? ''),
            (float) ($_POST['amount'] ?? 0)
        ), 'Transfer completed successfully.');
    }

    private function handleAction(callable $action, string $successMessage): void
    {
        try {
            $action();
            $_SESSION['success'] = $successMessage;
        } catch (\InvalidArgumentException $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: /dashboard');
        exit;
    }
}
