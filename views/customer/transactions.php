<?php /** @var array $transactions */ ?>
<div class="space-y-6">
    <div>
        <h2 class="mb-4 text-sm font-semibold text-white">All my transactions</h2>
        <?php $showUser = false; require __DIR__ . '/../partials/transactions-table.php'; ?>
    </div>
</div>
