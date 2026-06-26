<?php
/** @var int $customerCount */
/** @var int $transactionCount */
/** @var array $recentTransactions */
?>
<div class="space-y-8">
    <?php require __DIR__ . '/../partials/flash.php'; ?>

    <div class="grid gap-4 sm:grid-cols-2">
        <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-5">
            <p class="text-sm text-slate-400">Registered customers</p>
            <p class="mt-2 text-2xl font-semibold text-white"><?= (int) $customerCount ?></p>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-5">
            <p class="text-sm text-slate-400">Total transactions</p>
            <p class="mt-2 text-2xl font-semibold text-white"><?= (int) $transactionCount ?></p>
        </div>
    </div>

    <div>
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-white">Recent transactions (all users)</h2>
            <a href="/admin/transactions" class="text-xs font-medium text-blue-400 hover:text-blue-300">View all</a>
        </div>
        <?php $showUser = true; require __DIR__ . '/../partials/transactions-table.php'; ?>
    </div>
</div>
