<?php

declare(strict_types=1);

/**
 * Escape a value for safe HTML output.
 */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 * Find a project by slug, or null when unknown.
 */
function find_project(array $projects, string $slug): ?array
{
    foreach ($projects as $project) {
        if ($project['slug'] === $slug) {
            return $project;
        }
    }

    return null;
}

/**
 * Engraved line-art motif for a dossier cover.
 *
 * Each motif is a small stroke-based SVG drawn in currentColor so the
 * project accent colour flows in from CSS. They stand in for aerial
 * photography until real imagery is available (set 'image' on the
 * project to swap them out).
 */
function motif_svg(string $motif): string
{
    static $art = null;

    if ($art === null) {
        $open = '<svg viewBox="0 0 160 110" fill="none" stroke="currentColor"'
              . ' stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"'
              . ' role="presentation" focusable="false">';

        $art = [
            'livestock' =>
                $open
                . '<path d="M12 88h136" opacity=".4"/>'
                . '<path d="M30 88V60c0-9 7-16 16-16h20c9 0 16 7 16 16v28"/>'
                . '<path d="M94 88V66c0-8 6-14 14-14h14c8 0 14 6 14 14v22" opacity=".55"/>'
                . '<circle cx="48" cy="74" r="4" fill="currentColor" stroke="none"/>'
                . '<circle cx="62" cy="78" r="4" fill="currentColor" stroke="none" opacity=".7"/>'
                . '<circle cx="114" cy="76" r="4" fill="currentColor" stroke="none" opacity=".6"/>'
                . '<path d="M46 30h24M58 22v16" opacity=".35"/>'
                . '</svg>',

            'palm' =>
                $open
                . '<path d="M12 92h136" opacity=".4"/>'
                . '<path d="M82 92c-2-18-2-32 0-46"/>'
                . '<path d="M82 46C68 32 52 26 34 29"/>'
                . '<path d="M82 46c14-14 30-20 48-17"/>'
                . '<path d="M82 45C72 26 62 17 48 12"/>'
                . '<path d="M82 45c10-19 20-28 34-33"/>'
                . '<path d="M82 44c-1-16 0-26 0-34"/>'
                . '<circle cx="74" cy="52" r="3" fill="currentColor" stroke="none" opacity=".7"/>'
                . '<circle cx="90" cy="52" r="3" fill="currentColor" stroke="none" opacity=".7"/>'
                . '</svg>',

            'charcoal' =>
                $open
                . '<path d="M14 88h132" opacity=".4"/>'
                . '<path d="M34 88c0-26 19-42 46-42s46 16 46 42"/>'
                . '<path d="M52 88c0-16 12-26 28-26s28 10 28 26" opacity=".5"/>'
                . '<path d="M80 38c-6-8 6-13 0-21" opacity=".7"/>'
                . '<path d="M96 42c-4-6 4-10 0-16" opacity=".4"/>'
                . '<circle cx="68" cy="78" r="2.5" fill="currentColor" stroke="none" opacity=".9"/>'
                . '<circle cx="90" cy="74" r="2.5" fill="currentColor" stroke="none" opacity=".5"/>'
                . '</svg>',

            'solar' =>
                $open
                . '<path d="M14 70h132" opacity=".45"/>'
                . '<path d="M52 70a28 28 0 0 1 56 0"/>'
                . '<path d="M80 22V10M50 32l-8-9M110 32l8-9M36 54l-12-4M124 54l12-4" opacity=".75"/>'
                . '<path d="M22 84c12-7 26-7 38 0s26 7 38 0 26-7 38 0" opacity=".55"/>'
                . '<path d="M22 96c12-7 26-7 38 0s26 7 38 0 26-7 38 0" opacity=".3"/>'
                . '</svg>',

            'avocado' =>
                $open
                . '<g fill="currentColor" stroke="none" opacity=".4">'
                . '<circle cx="24" cy="82" r="2.5"/><circle cx="48" cy="82" r="2.5"/><circle cx="72" cy="82" r="2.5"/>'
                . '<circle cx="24" cy="96" r="2.5"/><circle cx="48" cy="96" r="2.5"/><circle cx="72" cy="96" r="2.5"/>'
                . '</g>'
                . '<path d="M108 14c9 12 22 20 22 34a22 22 0 1 1-44 0c0-14 13-22 22-34z"/>'
                . '<circle cx="108" cy="52" r="8" opacity=".6"/>'
                . '<path d="M48 40c8-12 22-17 34-14-5 13-18 20-34 14z" opacity=".5"/>'
                . '</svg>',

            'energy' =>
                $open
                . '<path d="M14 88h132" opacity=".4"/>'
                . '<circle cx="80" cy="46" r="9"/>'
                . '<path d="M80 37V12"/>'
                . '<path d="M88 51l21 13"/>'
                . '<path d="M72 51L51 64"/>'
                . '<path d="M80 55v33"/>'
                . '<path d="M52 46a28 28 0 0 1 56 0" opacity=".35"/>'
                . '<path d="M40 46a40 40 0 0 1 80 0" opacity=".18"/>'
                . '</svg>',

            'agropark' =>
                $open
                . '<path d="M80 20l60 30-60 30-60-30z"/>'
                . '<path d="M40 40l60 30M60 30l60 30M120 40L60 70M100 30L40 60" opacity=".3"/>'
                . '<path d="M80 52l20 10-20 10-20-10z"/>'
                . '<path d="M60 62v14l20 10 20-10V62" opacity=".8"/>'
                . '<path d="M80 72v14" opacity=".8"/>'
                . '</svg>',

            'future' =>
                $open
                . '<path d="M14 96h132" opacity=".25"/>'
                . '<circle cx="30" cy="76" r="3" fill="currentColor" stroke="none"/>'
                . '<circle cx="62" cy="42" r="3" fill="currentColor" stroke="none"/>'
                . '<circle cx="96" cy="60" r="3" fill="currentColor" stroke="none"/>'
                . '<circle cx="128" cy="28" r="3" fill="currentColor" stroke="none"/>'
                . '<path d="M30 76L62 42l34 18 32-32" opacity=".45"/>'
                . '<circle cx="62" cy="42" r="9" opacity=".35"/>'
                . '<path d="M120 82h20M130 72v20" opacity=".8"/>'
                . '</svg>',
        ];
    }

    return $art[$motif] ?? $art['future'];
}
