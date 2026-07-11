<?php

declare(strict_types=1);

require __DIR__ . '/lib/helpers.php';

$projects = require __DIR__ . '/data/projects.php';

$slug    = (string) ($_GET['slug'] ?? '');
$project = find_project($projects, $slug);

if ($project === null) {
    http_response_code(404);
}

$p = $project;

?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $project ? e($project['title']) . ' — AfrilandCorp' : 'Project not found — AfrilandCorp' ?></title>
    <?php if ($project): ?>
    <meta name="description" content="<?= e($project['description']) ?>">
    <?php endif; ?>
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
            <a href="index.php#portfolio">Portfolio</a>
        </nav>
        <a class="site-head__cta" href="mailto:invest@afrilandcorp.com?subject=Investor%20access">Investor Access</a>
    </header>

    <main class="project">
        <?php if ($project === null): ?>

        <section class="project__missing">
            <h1 class="project__title">Project not found</h1>
            <p class="panel__desc">The prospectus you are looking for is not in the current portfolio.</p>
            <p><a class="btn btn--primary" href="index.php#portfolio">Back to the portfolio</a></p>
        </section>

        <?php else: ?>

        <article class="project__sheet" style="--accent: <?= e($project['accent']) ?>;">
            <p class="project__crumbs">
                <a href="index.php#portfolio">Portfolio</a>
                <span aria-hidden="true">/</span>
                <span>N°<?= e($project['number']) ?></span>
            </p>

            <div class="project__layout">
                <div class="project__coverbox" aria-hidden="true">
                    <span class="project__cover3d">
                        <?php include __DIR__ . '/partials/cover.php'; ?>
                    </span>
                </div>

                <div class="project__body">
                    <h1 class="project__title"><?= e($project['title']) ?></h1>
                    <p class="project__tagline"><?= e($project['tagline']) ?></p>

                    <dl class="panel__meta project__meta">
                        <div class="panel__fact">
                            <dt>Sector</dt>
                            <dd><?= e($project['sector']) ?></dd>
                        </div>
                        <div class="panel__fact">
                            <dt>Location</dt>
                            <dd><?= e($project['location']) ?></dd>
                        </div>
                        <div class="panel__fact">
                            <dt>Investment stage</dt>
                            <dd><?= e($project['stage']) ?></dd>
                        </div>
                        <div class="panel__fact">
                            <dt>Target capital</dt>
                            <dd><?= e($project['capital']) ?></dd>
                        </div>
                    </dl>

                    <p class="panel__desc"><?= e($project['description']) ?></p>

                    <section class="project__brochure" id="brochure">
                        <h2>Brochure &amp; data room</h2>
                        <p class="panel__desc">
                            The detailed prospectus, financial model and data-room access for
                            <?= e($project['title']) ?> are shared with qualified investors on request.
                        </p>
                        <div class="panel__actions">
                            <a class="btn btn--primary" href="mailto:invest@afrilandcorp.com?subject=<?= rawurlencode('Brochure request — ' . $project['title']) ?>">Request the Brochure</a>
                            <a class="btn btn--ghost" href="mailto:invest@afrilandcorp.com?subject=<?= rawurlencode('Investor enquiry — ' . $project['title']) ?>">Contact Investor Relations</a>
                        </div>
                    </section>
                </div>
            </div>
        </article>

        <?php endif; ?>
    </main>

    <footer class="site-foot">
        <span>© MMXXVI AfrilandCorp</span>
        <span>Yaoundé · Douala · Paris</span>
    </footer>
</body>
</html>
