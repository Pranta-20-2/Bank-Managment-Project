# Bank Management

A PHP MVC bank management system with **Admin** and **Customer** roles. Uses OOP, JSON file storage, PHP sessions, Composer autoloading, and Tailwind CSS.

## Requirements

- PHP 8.1+
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (for Tailwind CSS)

## Setup

```bash
composer install
npm install
npm run build
php -S localhost:8000 -t public
```

Open [http://localhost:8000](http://localhost:8000)

User and transaction data is stored in `storage/users.json` and `storage/transactions.json`.

To reset data, delete both JSON files and refresh the app.

## Demo accounts

| Role     | Email              | Password    |
|----------|--------------------|-------------|
| Admin    | `admin@bank.com`   | `admin1234` |
| Customer | `john@example.com` | `password1` |
| Customer | `jane@example.com` | `password1` |

Customers can also register at `/register`.

## Features

### Admin
- View all transactions across all users
- Search transactions by customer email
- View list of all registered customers

### Customer
- Register with name, email, password
- Login with email and password
- View account balance
- View personal transaction history
- Deposit money
- Withdraw money
- Transfer money to another customer by email

## Routes

| Method | URI                   | Description                |
|--------|-----------------------|----------------------------|
| GET    | `/`                   | Login page                 |
| POST   | `/login`              | Sign in                    |
| GET    | `/logout`             | Sign out                   |
| GET    | `/register`           | Registration form          |
| POST   | `/register`           | Create customer account    |
| GET    | `/admin`              | Admin dashboard            |
| GET    | `/admin/customers`    | All customers              |
| GET    | `/admin/transactions` | All/search transactions    |
| GET    | `/dashboard`          | Customer dashboard         |
| GET    | `/transactions`       | Customer transactions      |
| POST   | `/deposit`            | Deposit funds              |
| POST   | `/withdraw`           | Withdraw funds             |
| POST   | `/transfer`           | Transfer to another user   |

## Architecture

```
app/
├── Controllers/     AuthController, AdminController, CustomerController
├── Core/            Auth, Controller, File, Router
├── Models/          User, Transaction
└── Services/        AccountService (deposit, withdraw, transfer)

storage/
├── users.json       Users (admin + customers with balances)
└── transactions.json Transaction history

views/
├── admin/           Admin pages
├── auth/            Login & register
├── customer/        Customer pages
└── layouts/         Shared layout, sidebar, navbar
```

## Technical notes

- **OOP**: Models, services, and controllers use classes and namespaces (`App\`)
- **File storage**: `App\Core\File` reads/writes JSON with file locking
- **Sessions**: `App\Core\Auth` manages logged-in users
- **Composer**: PSR-4 autoload for `App\` namespace

## GitHub submission

Push this project to GitHub and share your repository link with your instructor.

```bash
git add .
git commit -m "Complete bank management system with admin and customer roles"
git remote add origin https://github.com/YOUR_USERNAME/bank-management.git
git push -u origin main
```
