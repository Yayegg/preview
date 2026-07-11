<?php

declare(strict_types=1);

require __DIR__ . '/lib/helpers.php';

$projects = require __DIR__ . '/data/projects.php';

?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AfrilandCorp — Building Sustainable Industries Across Africa</title>
    <meta name="description" content="AfrilandCorp is an investment platform developing flagship ventures in agro-industry, renewable energy and sustainable infrastructure across Africa.">
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='6' fill='%23143228'/%3E%3Cpath d='M16 7l7 18h-3.4l-1.5-4h-4.2l-1.5 4H9z' fill='%23dcc27a'/%3E%3C/svg%3E">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <header class="site-head">
        <a class="site-head__brand" href="index.php">
            <svg class="site-head__mark" viewBox="0 0 32 32" aria-hidden="true"><rect width="32" height="32" rx="6" fill="#143228"/><path d="M16 7l7 18h-3.4l-1.5-4h-4.2l-1.5 4H9z" fill="#dcc27a"/></svg>
            <span>AfrilandCorp</span>
        </a>
        <nav class="site-head__nav" aria-label="Primary">
            <a href="#portfolio">Portfolio</a>
            <a href="#portfolio">Approach</a>
            <a href="#portfolio">Insights</a>
        </nav>
        <a class="site-head__cta" href="mailto:invest@afrilandcorp.com?subject=Investor%20access">Investor Access</a>
    </header>

    <main>
        <?php include __DIR__ . '/partials/hero.php'; ?>
    </main>

    <footer class="site-foot">
        <span>© MMXXVI AfrilandCorp</span>
        <span>Yaoundé · Douala · Paris</span>
    </footer>

    <script src="assets/js/hero.js" defer></script>
</body>
</html>
