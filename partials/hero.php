<?php

/**
 * AfrilandCorp hero — cinematic headline, 3D dossier fan and
 * dynamic information panel.
 *
 * Expects $projects — the array from data/projects.php.
 *
 * Progressive enhancement: without JavaScript the fan renders as a
 * horizontally scrollable shelf of flat covers (each one a plain link
 * to its project page) and every information card is shown stacked.
 * assets/js/hero.js upgrades this into the 3D carousel.
 */
?>
<section class="hero" id="portfolio">
    <div class="hero__bg" aria-hidden="true">
        <span class="hero__contours"></span>
        <span class="hero__sheen"></span>
        <span class="hero__grain"></span>
    </div>

    <header class="hero__head">
        <p class="hero__eyebrow">AfrilandCorp · Investment Portfolio</p>
        <h1 class="hero__title">
            Building Sustainable Industries
            <em>Across Africa</em>
        </h1>
        <p class="hero__lede">
            Eight flagship ventures across agro-industry, renewable energy and
            infrastructure — structured for investors who build for the long term.
        </p>
    </header>

    <div class="shelf" data-carousel>
        <button class="shelf__nav shelf__nav--prev" type="button" data-prev aria-label="Previous project">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 5l-7 7 7 7"/></svg>
        </button>

        <div class="shelf__viewport" data-viewport>
            <ul class="shelf__track" data-track role="list" aria-label="Flagship projects">
                <?php foreach ($projects as $i => $p): ?>
                <li
                    class="dossier<?= $i === 0 ? ' is-active' : '' ?>"
                    data-palette="<?= e($p['palette']) ?>"
                    data-group="<?= e($p['group']) ?>"
                    style="--accent: <?= e($p['accent']) ?>;"
                >
                    <span class="dossier__folder" aria-hidden="true"></span>
                    <span class="dossier__tab" aria-hidden="true">N°<?= e($p['number']) ?></span>
                    <span class="dossier__sheets" aria-hidden="true"></span>
                    <a
                        class="dossier__link"
                        href="project.php?slug=<?= e($p['slug']) ?>"
                        <?= $i === 0 ? 'aria-current="true"' : '' ?>
                        aria-label="<?= e($p['title'] . ' — ' . $p['tagline']) ?>"
                    >
                        <?php include __DIR__ . '/cover.php'; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <button class="shelf__nav shelf__nav--next" type="button" data-next aria-label="Next project">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg>
        </button>

        <div class="shelf__dots" data-dots aria-hidden="true"></div>

        <?php
            // sector families, in order of first appearance
            $groups = [];
            foreach ($projects as $p) {
                if (!in_array($p['group'], $groups, true)) {
                    $groups[] = $p['group'];
                }
            }
        ?>
        <div class="shelf__chips" data-chips role="group" aria-label="Browse projects by sector">
            <?php foreach ($groups as $group): ?>
            <button class="chip" type="button" data-group="<?= e($group) ?>"><?= e($group) ?></button>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="panel" data-panel>
        <?php foreach ($projects as $i => $p): ?>
        <article class="panel__card<?= $i === 0 ? ' is-active' : '' ?>" style="--accent: <?= e($p['accent']) ?>;">
            <header class="panel__head">
                <span class="panel__no" aria-hidden="true">N°<?= e($p['number']) ?></span>
                <h2 class="panel__title"><?= e($p['title']) ?></h2>
                <span class="panel__tagline"><?= e($p['tagline']) ?></span>
            </header>

            <dl class="panel__meta">
                <div class="panel__fact">
                    <dt>Sector</dt>
                    <dd><?= e($p['sector']) ?></dd>
                </div>
                <div class="panel__fact">
                    <dt>Location</dt>
                    <dd><?= e($p['location']) ?></dd>
                </div>
                <div class="panel__fact">
                    <dt>Investment stage</dt>
                    <dd><?= e($p['stage']) ?></dd>
                </div>
                <div class="panel__fact">
                    <dt>Target capital</dt>
                    <dd><?= e($p['capital']) ?></dd>
                </div>
            </dl>

            <p class="panel__desc"><?= e($p['description']) ?></p>

            <div class="panel__actions">
                <a class="btn btn--primary" href="project.php?slug=<?= e($p['slug']) ?>">Explore Project</a>
                <a class="btn btn--ghost" href="project.php?slug=<?= e($p['slug']) ?>#brochure">Download Brochure</a>
                <a class="btn btn--ghost" href="mailto:invest@afrilandcorp.com?subject=<?= rawurlencode('Investor enquiry — ' . $p['title']) ?>">Contact Investor Relations</a>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>
