<?php
/** @var array $transactions */
/** @var string $searchEmail */
?>
<div class="space-y-6">
    <form method="GET" action="/admin/transactions" class="flex flex-col gap-3 rounded-2xl border border-slate-800 bg-slate-900/50 p-6 sm:flex-row sm:items-end">
        <div class="flex-1">
            <label for="email" class="mb-1.5 block text-sm font-medium text-slate-300">Search by customer email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?= htmlspecialchars($searchEmail) ?>"
                placeholder="customer@example.com"
                class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-white placeholder-slate-500 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
            >
        </div>
        <button type="submit" class="rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-500">Search</button>
        <?php if ($searchEmail !== ''): ?>
        <a href="/admin/transactions" class="rounded-xl border border-slate-700 px-5 py-2.5 text-center text-sm text-slate-300 hover:bg-slate-800">Clear</a>
        <?php endif; ?>
    </form>

    <div>
        <h2 class="mb-4 text-sm font-semibold text-white">
            <?= $searchEmail !== '' ? 'Transactions for ' . htmlspecialchars($searchEmail) : 'All transactions' ?>
        </h2>
        <?php $showUser = true; require __DIR__ . '/../partials/transactions-table.php'; ?>
    </div>
</div>
