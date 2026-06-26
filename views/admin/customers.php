<?php /** @var array $customers */ ?>
<div class="space-y-6">
    <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-6">
        <h2 class="text-sm font-semibold text-white">All registered customers</h2>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-800 text-sm">
                <thead class="bg-slate-900/80">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium text-slate-400">Name</th>
                        <th class="px-4 py-3 text-left font-medium text-slate-400">Email</th>
                        <th class="px-4 py-3 text-right font-medium text-slate-400">Balance</th>
                        <th class="px-4 py-3 text-left font-medium text-slate-400">Joined</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    <?php if (empty($customers)): ?>
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500">No customers registered yet.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td class="px-4 py-3 text-slate-200"><?= htmlspecialchars($customer['name'] ?? '') ?></td>
                        <td class="px-4 py-3 text-slate-400"><?= htmlspecialchars($customer['email'] ?? '') ?></td>
                        <td class="px-4 py-3 text-right font-medium text-emerald-400">$<?= number_format((float) ($customer['balance'] ?? 0), 2) ?></td>
                        <td class="px-4 py-3 text-slate-500"><?= htmlspecialchars(date('M j, Y', strtotime($customer['created_at'] ?? 'now'))) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
