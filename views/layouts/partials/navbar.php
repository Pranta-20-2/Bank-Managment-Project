<?php
/** @var string|null $title */

use App\Core\Auth;

$user = Auth::user();
?>
<header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-slate-800 bg-slate-950/80 px-8 backdrop-blur-sm">
    <div>
        <h1 class="text-lg font-semibold text-white"><?= htmlspecialchars($title ?? 'Dashboard') ?></h1>
        <p class="text-xs text-slate-500"><?= Auth::isAdmin() ? 'Admin portal' : 'Customer banking portal' ?></p>
    </div>

    <div class="flex items-center gap-4">
        <div class="relative hidden sm:block">
            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input
                type="search"
                placeholder="Search accounts, transactions..."
                class="w-64 rounded-xl border border-slate-800 bg-slate-900/60 py-2 pl-10 pr-4 text-sm text-slate-200 placeholder-slate-500 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
            >
        </div>

        <button type="button" class="relative rounded-xl p-2 text-slate-400 transition hover:bg-slate-800 hover:text-slate-200" aria-label="Notifications">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
            <span class="absolute right-1.5 top-1.5 h-2 w-2 rounded-full bg-blue-500"></span>
        </button>

        <div class="flex items-center gap-3 rounded-xl border border-slate-800 bg-slate-900/60 py-1.5 pl-1.5 pr-4">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600/20 text-xs font-semibold text-blue-400">
                <?= htmlspecialchars($user['initials'] ?? 'U') ?>
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-medium text-slate-200"><?= htmlspecialchars($user['name'] ?? 'User') ?></p>
                <p class="text-xs text-slate-500"><?= htmlspecialchars($user['email'] ?? '') ?></p>
            </div>
        </div>
    </div>
</header>
