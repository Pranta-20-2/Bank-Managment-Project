<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        Auth::requireAdmin();

        $customers = User::customers();
        $transactions = Transaction::all();

        $this->view('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'activePage' => 'dashboard',
            'customerCount' => count($customers),
            'transactionCount' => count($transactions),
            'recentTransactions' => array_slice($transactions, 0, 5),
        ], 'home');
    }

    public function customers()
    {
        Auth::requireAdmin();

        $this->view('admin/customers', [
            'title' => 'Customers',
            'activePage' => 'customers',
            'customers' => User::customers(),
        ], 'home');
    }

    public function transactions()
    {
        Auth::requireAdmin();

        $email = trim($_GET['email'] ?? '');
        $transactions = $email !== '' ? Transaction::byUserEmail($email) : Transaction::all();

        $this->view('admin/transactions', [
            'title' => 'Transactions',
            'activePage' => 'transactions',
            'transactions' => $transactions,
            'searchEmail' => $email,
        ], 'home');
    }
}
