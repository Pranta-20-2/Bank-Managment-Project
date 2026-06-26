<?php
/** @var array $user */
/** @var array $transactions */
?>
<div class="space-y-8">
    <?php require __DIR__ . '/../partials/flash.php'; ?>

    <div class="rounded-2xl border border-slate-800 bg-gradient-to-br from-blue-600/20 to-slate-900/50 p-6">
        <p class="text-sm text-slate-400">Current balance</p>
        <p class="mt-2 text-3xl font-semibold text-white">$<?= number_format((float) ($user['balance'] ?? 0), 2) ?></p>
        <p class="mt-1 text-xs text-slate-500">Account: <?= htmlspecialchars($user['email'] ?? '') ?></p>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-6">
            <h2 class="text-sm font-semibold text-white">Deposit</h2>
            <form method="POST" action="/deposit" class="mt-4 space-y-3">
                <input type="number" name="amount" min="0.01" step="0.01" required placeholder="Amount"
                    class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-white outline-none focus:border-blue-500">
                <button type="submit" class="w-full rounded-xl bg-emerald-600 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500">Deposit</button>
            </form>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-6">
            <h2 class="text-sm font-semibold text-white">Withdraw</h2>
            <form method="POST" action="/withdraw" class="mt-4 space-y-3">
                <input type="number" name="amount" min="0.01" step="0.01" required placeholder="Amount"
                    class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-white outline-none focus:border-blue-500">
                <button type="submit" class="w-full rounded-xl bg-amber-600 py-2.5 text-sm font-semibold text-white hover:bg-amber-500">Withdraw</button>
            </form>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-6">
            <h2 class="text-sm font-semibold text-white">Transfer</h2>
            <form method="POST" action="/transfer" class="mt-4 space-y-3">
                <input type="email" name="recipient_email" required placeholder="Recipient email"
                    class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-white outline-none focus:border-blue-500">
                <input type="number" name="amount" min="0.01" step="0.01" required placeholder="Amount"
                    class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-white outline-none focus:border-blue-500">
                <button type="submit" class="w-full rounded-xl bg-blue-600 py-2.5 text-sm font-semibold text-white hover:bg-blue-500">Transfer</button>
            </form>
        </div>
    </div>

    <div>
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-white">Recent transactions</h2>
            <a href="/transactions" class="text-xs font-medium text-blue-400 hover:text-blue-300">View all</a>
        </div>
        <?php $showUser = false; require __DIR__ . '/../partials/transactions-table.php'; ?>
    </div>
</div>
