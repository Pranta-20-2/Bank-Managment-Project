<!DOCTYPE html>
<?php
/** @var string $content */
/** @var string|null $title */
/** @var string|null $activePage */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Bank Management') ?> — Bank Management</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
    <div class="flex min-h-screen">
        <?php require __DIR__ . '/partials/sidebar.php'; ?>

        <div class="flex min-h-screen flex-1 flex-col pl-64">
            <?php require __DIR__ . '/partials/navbar.php'; ?>

            <main class="flex-1 p-8">
                <?= $content ?? '' ?>
            </main>
        </div>
    </div>
</body>
</html>
