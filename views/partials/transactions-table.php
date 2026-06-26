<?php
/** @var array $transactions */
/** @var bool $showUser */
$showUser = $showUser ?? false;

$typeLabels = [
    'deposit' => 'Deposit',
    'withdraw' => 'Withdrawal',
    'transfer_in' => 'Transfer In',
    'transfer_out' => 'Transfer Out',
];
?>
<div class="overflow-x-auto rounded-2xl border border-slate-800">
    <table class="min-w-full divide-y divide-slate-800 text-sm">
        <thead class="bg-slate-900/80">
            <tr>
                <?php if ($showUser): ?>
                <th class="px-4 py-3 text-left font-medium text-slate-400">Customer</th>
                <?php endif; ?>
                <th class="px-4 py-3 text-left font-medium text-slate-400">Type</th>
                <th class="px-4 py-3 text-left font-medium text-slate-400">Description</th>
                <th class="px-4 py-3 text-right font-medium text-slate-400">Amount</th>
                <th class="px-4 py-3 text-right font-medium text-slate-400">Balance After</th>
                <th class="px-4 py-3 text-left font-medium text-slate-400">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800 bg-slate-900/40">
            <?php if (empty($transactions)): ?>
            <tr>
                <td colspan="<?= $showUser ? 6 : 5 ?>" class="px-4 py-8 text-center text-slate-500">No transactions found.</td>
            </tr>
            <?php else: ?>
            <?php foreach ($transactions as $txn): ?>
            <?php
                $type = $txn['type'] ?? '';
                $isCredit = in_array($type, ['deposit', 'transfer_in'], true);
            ?>
            <tr>
                <?php if ($showUser): ?>
                <td class="px-4 py-3 text-slate-300"><?= htmlspecialchars($txn['user_email'] ?? '') ?></td>
                <?php endif; ?>
                <td class="px-4 py-3 text-slate-300"><?= htmlspecialchars($typeLabels[$type] ?? ucfirst($type)) ?></td>
                <td class="px-4 py-3 text-slate-400"><?= htmlspecialchars($txn['description'] ?? '') ?></td>
                <td class="px-4 py-3 text-right font-medium <?= $isCredit ? 'text-emerald-400' : 'text-red-400' ?>">
                    <?= $isCredit ? '+' : '-' ?>$<?= number_format((float) ($txn['amount'] ?? 0), 2) ?>
                </td>
                <td class="px-4 py-3 text-right text-slate-300">$<?= number_format((float) ($txn['balance_after'] ?? 0), 2) ?></td>
                <td class="px-4 py-3 text-slate-500"><?= htmlspecialchars(date('M j, Y g:i A', strtotime($txn['created_at'] ?? 'now'))) ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
