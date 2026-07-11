# AfrilandCorp — Hero Prototype

A working prototype of the AfrilandCorp homepage hero: a cinematic dark
opening with the headline **"Building Sustainable Industries Across
Africa"** and a horizontal 3D carousel that presents the flagship
projects as premium investment prospectuses (the Foliom-style "book fan",
adapted to the AfrilandCorp identity — forest green, charcoal and gold).

## Run it

Requires PHP 8+ (no dependencies, no build step):

```sh
php -S localhost:8000
```

Then open <http://localhost:8000>.

## What's inside

| Path | Role |
| --- | --- |
| `index.php` | Homepage shell (nav, hero, footer) |
| `partials/hero.php` | The hero component: headline, dossier fan, info panel |
| `partials/cover.php` | One prospectus cover (reused by hero + project pages) |
| `data/projects.php` | **The single source of truth** — the portfolio array |
| `lib/helpers.php` | Escaping helper + engraved cover motifs (inline SVG) |
| `project.php` | Project detail page (`?slug=…`), incl. brochure section |
| `assets/css/main.css` | All styling, incl. the 3D volume construction |
| `assets/js/hero.js` | Carousel state, interaction and layout projection |

## How the carousel works

- Each project renders as a real 3D volume: front cover, spine, page
  block and back board, positioned with `transform-style: preserve-3d`.
- `hero.js` keeps one piece of state (the active index) and projects it
  into CSS custom properties per volume — `--tx`, `--tz`, `--ry` and a
  `--dim` overlay. CSS composes those into the fan: side volumes sit at
  a uniform 54° with receding depth; the active volume swings toward the
  viewer, lifts, and floats gently.
- The information panel is rendered server-side for every project;
  JS simply switches which card is visible (with `aria-live` announcements).

### Interactions

- **Click / tap** a side volume to select it; click the active volume to
  open its project page.
- **Hover** raises a volume and reveals a sector · stage peek line.
- **Swipe** (touch/pen/mouse drag) and **horizontal trackpad scroll**
  step through the fan; **arrow buttons**, **dots**, **← → Home End**
  keys work too. Keyboard focus follows selection.
- **Sector chips** under the fan jump to a sector family's first project
  and cycle through the family on repeat clicks (driven by each
  project's `group` key).
- On load the volumes fan out from behind the centre with a slight
  stagger; the active volume floats gently and casts a faded floor
  reflection (WebKit/Blink).
- `prefers-reduced-motion` disables the entrance, float, sheen and
  transitions.

## Progressive enhancement

Without JavaScript the page stays fully functional: the fan degrades to
a flat, horizontally scrollable shelf where every cover is a plain link,
and all information cards render stacked below. `hero.js` adds the
`js`/`js-anim` classes that switch on the 3D presentation.

## Extending it

- **Add or reorder projects** in `data/projects.php` — covers, panel
  cards and detail pages all follow automatically.
- **Real photography**: set a project's `image` key to a path and the
  cover art area swaps the engraved motif for the photo (`object-fit:
  cover`). High-resolution aerial shots are the intended end state.
- **Brand tuning**: the palette lives in CSS custom properties at the
  top of `assets/css/main.css`; per-project accents live in the data
  array.
