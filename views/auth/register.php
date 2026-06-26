<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — Bank Management</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-12">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(59,130,246,0.18),_transparent_55%)]"></div>
        <div class="pointer-events-none absolute -left-24 top-1/4 h-72 w-72 rounded-full bg-blue-600/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-24 bottom-1/4 h-72 w-72 rounded-full bg-indigo-500/10 blur-3xl"></div>

        <div class="relative w-full max-w-md">
            <div class="mb-8 text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 shadow-lg shadow-blue-600/30">
                    <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-semibold tracking-tight text-white">Create your account</h1>
                <p class="mt-2 text-sm text-slate-400">Join Bank Management to manage accounts securely.</p>
            </div>

            <div class="rounded-2xl border border-slate-800/80 bg-slate-900/70 p-8 shadow-2xl shadow-black/40 backdrop-blur-sm">
                <?php if (!empty($error)): ?>
                <div class="mb-5 rounded-xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">
                    <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="/register" class="space-y-5">
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-medium text-slate-300">Full name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            autocomplete="name"
                            placeholder="Jane Doe"
                            value="<?= htmlspecialchars($name ?? '') ?>"
                            class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >
                    </div>

                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-medium text-slate-300">Email address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            autocomplete="email"
                            placeholder="you@example.com"
                            value="<?= htmlspecialchars($email ?? '') ?>"
                            class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-medium text-slate-300">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >
                        <p class="mt-1.5 text-xs text-slate-500">Use at least 8 characters with letters and numbers.</p>
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/25 transition hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40 active:scale-[0.98]"
                    >
                        Create account
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-sm text-slate-400">
                Already have an account?
                <a href="/" class="font-medium text-blue-400 transition hover:text-blue-300">Sign in</a>
            </p>
        </div>
    </div>
</body>
</html>
