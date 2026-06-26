<?php if (!empty($success)): ?>
<div class="mb-6 rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-300">
    <?= htmlspecialchars($success) ?>
</div>
<?php endif; ?>

<?php if (!empty($error)): ?>
<div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">
    <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>
