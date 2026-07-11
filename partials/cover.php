<?php

/**
 * Prospectus cover for one project.
 *
 * Expects $p — one entry from data/projects.php.
 * Rendered inside an <a>, so every element is a <span>.
 */
?>
<span class="cover" data-palette="<?= e($p['palette']) ?>" style="--accent: <?= e($p['accent']) ?>;">
    <span class="cover__band"></span>
    <span class="cover__frame"></span>
    <span class="cover__head">
        <span class="cover__brand">AfrilandCorp</span>
        <span class="cover__no">N°<?= e($p['number']) ?></span>
    </span>
    <span class="cover__art" aria-hidden="true">
        <?php if (!empty($p['image'])): ?>
            <img src="<?= e($p['image']) ?>" alt="" loading="lazy">
        <?php else: ?>
            <?= motif_svg($p['motif']) ?>
        <?php endif; ?>
    </span>
    <span class="cover__title"><?= e($p['title']) ?></span>
    <span class="cover__tag"><?= e($p['tagline']) ?></span>
    <span class="cover__peek"><?= e($p['sector']) ?> · <?= e($p['stage']) ?></span>
    <span class="cover__foot">
        <span>Investment Prospectus</span>
        <span>MMXXVI</span>
    </span>
</span>
