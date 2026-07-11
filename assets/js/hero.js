/**
 * AfrilandCorp hero carousel.
 *
 * Upgrades the flat, scrollable shelf rendered by PHP into a 3D fan of
 * prospectus volumes. All state lives in `active`; layout() projects it
 * onto CSS custom properties (--tx/--tz/--ry per volume, --dim on its
 * cover) that main.css composes into the 3D transform.
 */
(function () {
    'use strict';

    var shelf = document.querySelector('[data-carousel]');
    if (!shelf) {
        return;
    }

    var viewport = shelf.querySelector('[data-viewport]');
    var track = shelf.querySelector('[data-track]');
    var items = Array.prototype.slice.call(track.querySelectorAll('.dossier'));
    if (items.length === 0) {
        return;
    }

    document.documentElement.classList.add('js');

    var panelBox = document.querySelector('[data-panel]');
    var panels = panelBox
        ? Array.prototype.slice.call(panelBox.querySelectorAll('.panel__card'))
        : [];
    var prevBtn = shelf.querySelector('[data-prev]');
    var nextBtn = shelf.querySelector('[data-next]');
    var dotsBox = shelf.querySelector('[data-dots]');
    var chips = Array.prototype.slice.call(shelf.querySelectorAll('[data-chips] .chip'));

    var active = 0;
    items.some(function (el, i) {
        if (el.classList.contains('is-active')) {
            active = i;
            return true;
        }
        return false;
    });

    /* Panel swaps should be announced to assistive tech. */
    if (panelBox) {
        panelBox.setAttribute('aria-live', 'polite');
    }

    var dots = [];
    if (dotsBox) {
        items.forEach(function (item, i) {
            var dot = document.createElement('button');
            dot.type = 'button';
            dot.className = 'shelf__dot';
            dot.setAttribute('aria-label', 'Show project ' + (i + 1) + ' of ' + items.length);
            dot.addEventListener('click', function () {
                setActive(i);
            });
            dotsBox.appendChild(dot);
            dots.push(dot);
        });
        dotsBox.removeAttribute('aria-hidden');
    }

    function spacing() {
        var value = parseFloat(getComputedStyle(track).getPropertyValue('--spacing'));
        return isNaN(value) ? 148 : value;
    }

    function layout() {
        var gap = spacing();

        items.forEach(function (el, i) {
            var offset = i - active;
            var distance = Math.abs(offset);
            var tx;
            var tz;
            var ry;
            var dim;

            if (offset === 0) {
                /* face the viewer, pulled forward, a hint of spine showing */
                tx = 0;
                tz = 230;
                ry = 9;
                dim = 0;
            } else {
                /* uniform fan, receding slightly the further from centre */
                tx = offset * gap + (offset > 0 ? 1 : -1) * gap * 0.42;
                tz = -70 - distance * 28;
                ry = 54;
                dim = Math.min(0.1 + distance * 0.09, 0.5);
            }

            el.style.setProperty('--tx', tx.toFixed(1) + 'px');
            el.style.setProperty('--tz', tz.toFixed(1) + 'px');
            el.style.setProperty('--ry', ry + 'deg');
            el.style.setProperty('--dim', dim.toFixed(2));
            /* the track is flat (see main.css), so painter's order is ours */
            el.style.zIndex = String(100 - distance);
            el.classList.toggle('is-active', offset === 0);

            var link = el.querySelector('.dossier__link');
            if (link) {
                if (offset === 0) {
                    link.setAttribute('aria-current', 'true');
                } else {
                    link.removeAttribute('aria-current');
                }
            }
        });

        panels.forEach(function (panel, i) {
            panel.classList.toggle('is-active', i === active);
        });

        dots.forEach(function (dot, i) {
            dot.classList.toggle('is-active', i === active);
        });

        var activeGroup = items[active].getAttribute('data-group');
        chips.forEach(function (chip) {
            chip.classList.toggle('is-active', chip.getAttribute('data-group') === activeGroup);
        });

        if (prevBtn) {
            prevBtn.disabled = active === 0;
        }
        if (nextBtn) {
            nextBtn.disabled = active === items.length - 1;
        }
    }

    function setActive(index) {
        var next = Math.max(0, Math.min(items.length - 1, index));
        if (next === active) {
            return;
        }
        active = next;
        layout();
    }

    /* --- selection: first click activates, second click follows the link --- */

    var suppressClick = false;

    /* Chrome focuses a link on mousedown, and focus selects the volume
       (see focusin below) — so by the time the click event fires the
       volume is already active. Remember focus-driven selections so the
       click that belongs to the same gesture selects instead of opening. */
    var focusSelect = { index: -1, time: 0 };

    items.forEach(function (el, i) {
        var link = el.querySelector('.dossier__link');
        if (!link) {
            return;
        }
        link.addEventListener('click', function (event) {
            if (suppressClick) {
                event.preventDefault();
                return;
            }
            if (i !== active) {
                event.preventDefault();
                setActive(i);
                return;
            }
            if (focusSelect.index === i && Date.now() - focusSelect.time < 400) {
                event.preventDefault();
            }
        });
    });

    /* keyboard focus follows the same rule: focusing a volume selects it */
    track.addEventListener('focusin', function (event) {
        var item = event.target.closest ? event.target.closest('.dossier') : null;
        if (item) {
            var index = items.indexOf(item);
            if (index !== active) {
                focusSelect = { index: index, time: Date.now() };
                setActive(index);
            }
        }
    });

    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            setActive(active - 1);
        });
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            setActive(active + 1);
        });
    }

    /* sector chips: jump to the group's first project; if already inside
       the group, cycle through its projects */
    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            var group = chip.getAttribute('data-group');
            var indexes = [];
            items.forEach(function (el, i) {
                if (el.getAttribute('data-group') === group) {
                    indexes.push(i);
                }
            });
            if (indexes.length === 0) {
                return;
            }
            var position = indexes.indexOf(active);
            setActive(position === -1 ? indexes[0] : indexes[(position + 1) % indexes.length]);
        });
    });

    shelf.addEventListener('keydown', function (event) {
        switch (event.key) {
            case 'ArrowLeft':
                event.preventDefault();
                setActive(active - 1);
                break;
            case 'ArrowRight':
                event.preventDefault();
                setActive(active + 1);
                break;
            case 'Home':
                event.preventDefault();
                setActive(0);
                break;
            case 'End':
                event.preventDefault();
                setActive(items.length - 1);
                break;
        }
    });

    /* --- swipe (pointer events cover touch, pen and mouse drag) --- */

    /* links are natively draggable, which would hijack mouse swipes */
    track.addEventListener('dragstart', function (event) {
        event.preventDefault();
    });

    var startX = null;
    var startY = null;
    var dragging = false;

    viewport.addEventListener('pointerdown', function (event) {
        startX = event.clientX;
        startY = event.clientY;
        dragging = true;
        suppressClick = false;
    });

    window.addEventListener('pointermove', function (event) {
        if (!dragging || startX === null) {
            return;
        }
        if (Math.abs(event.clientX - startX) > 12) {
            suppressClick = true;
        }
    });

    window.addEventListener('pointerup', function (event) {
        if (!dragging) {
            return;
        }
        dragging = false;

        var dx = event.clientX - startX;
        var dy = event.clientY - startY;
        startX = null;
        startY = null;

        if (Math.abs(dx) > 48 && Math.abs(dx) > Math.abs(dy)) {
            setActive(active + (dx < 0 ? 1 : -1));
        }

        /* the click event fires synchronously after pointerup; clear after */
        setTimeout(function () {
            suppressClick = false;
        }, 0);
    });

    window.addEventListener('pointercancel', function () {
        dragging = false;
        startX = null;
        startY = null;
    });

    /* --- horizontal trackpad scroll steps the fan --- */

    var wheelLock = 0;

    viewport.addEventListener('wheel', function (event) {
        if (Math.abs(event.deltaX) <= Math.abs(event.deltaY)) {
            return;
        }
        event.preventDefault();
        var now = Date.now();
        if (now - wheelLock < 380 || Math.abs(event.deltaX) < 12) {
            return;
        }
        wheelLock = now;
        setActive(active + (event.deltaX > 0 ? 1 : -1));
    }, { passive: false });

    /* --- keep the fan proportioned across breakpoints --- */

    var resizeFrame = null;
    window.addEventListener('resize', function () {
        if (resizeFrame) {
            cancelAnimationFrame(resizeFrame);
        }
        resizeFrame = requestAnimationFrame(layout);
    });

    /* --- entrance: start gathered behind the centre, then fan out --- */

    items.forEach(function (el, i) {
        el.style.setProperty('--tx', '0px');
        el.style.setProperty('--tz', '-340px');
        el.style.setProperty('--ry', '54deg');
        el.style.setProperty('--dim', '0.55');
        el.style.zIndex = String(100 - Math.abs(i - active));
    });

    /* two frames so the gathered state paints before transitions enable
       (with reduced motion the CSS disables transitions and the fan
       simply appears in place) */
    requestAnimationFrame(function () {
        requestAnimationFrame(function () {
            document.documentElement.classList.add('js-anim');
            items.forEach(function (el, i) {
                el.style.transitionDelay = (Math.abs(i - active) * 55) + 'ms';
            });
            layout();
            setTimeout(function () {
                items.forEach(function (el) {
                    el.style.transitionDelay = '';
                });
            }, 1500);
        });
    });
})();
