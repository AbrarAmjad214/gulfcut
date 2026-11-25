const header = document.getElementById('site-header');
const burger = document.querySelector('.burger');
const nav = document.getElementById('main-nav');
const drop = document.querySelector('.drop');
const dropToggle = document.querySelector('.drop-toggle');
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

window.addEventListener('scroll', () => {
    header?.classList.toggle('scrolled', window.scrollY > 8);
}, { passive: true });

function setMenu(open) {
    if (!nav || !burger) return;
    nav.classList.toggle('open', open);
    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
}

burger?.addEventListener('click', () => setMenu(!nav.classList.contains('open')));

dropToggle?.addEventListener('click', () => {
    const open = drop.classList.toggle('open');
    dropToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
});

nav?.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
        if (window.matchMedia('(max-width: 760px)').matches) setMenu(false);
    });
});

document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') return;
    if (nav?.classList.contains('open')) {
        setMenu(false);
        burger?.focus();
    }
    if (drop?.contains(document.activeElement)) {
        document.activeElement.blur();
    }
});

// Reveal on scroll. Without IntersectionObserver everything is shown at once.
const animated = document.querySelectorAll('[data-animate]');
if (reduceMotion || !('IntersectionObserver' in window)) {
    animated.forEach((el) => el.classList.add('in'));
} else {
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('in');
            revealObserver.unobserve(entry.target);
        });
    }, { rootMargin: '0px 0px -8% 0px' });
    animated.forEach((el) => revealObserver.observe(el));
}

// Testimonials: rotate, pause on hover/focus, never auto-rotate for reduced motion.
const quoteBox = document.getElementById('quotes');
const quotes = quoteBox ? [...quoteBox.querySelectorAll('.quote')] : [];
const dots = document.getElementById('quote-dots');
let quoteIndex = 0;
let paused = false;

function showQuote(index) {
    quoteIndex = index;
    quotes.forEach((quote, i) => quote.classList.toggle('on', i === index));
    [...dots.children].forEach((dot, i) => {
        dot.classList.toggle('on', i === index);
        dot.setAttribute('aria-pressed', i === index ? 'true' : 'false');
    });
}

if (quotes.length > 1 && dots) {
    quotes.forEach((_, index) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = index === 0 ? 'on' : '';
        button.setAttribute('aria-label', 'Show testimonial ' + (index + 1));
        button.setAttribute('aria-pressed', index === 0 ? 'true' : 'false');
        button.addEventListener('click', () => showQuote(index));
        dots.appendChild(button);
    });

    const wrap = quoteBox.parentElement;
    ['mouseenter', 'focusin'].forEach((type) => wrap.addEventListener(type, () => { paused = true; }));
    ['mouseleave', 'focusout'].forEach((type) => wrap.addEventListener(type, () => { paused = false; }));

    if (!reduceMotion) {
        setInterval(() => {
            if (!paused && !document.hidden) showQuote((quoteIndex + 1) % quotes.length);
        }, 6000);
    }
}

// Count-up numbers.
const counters = document.querySelectorAll('[data-count]');
if (counters.length && 'IntersectionObserver' in window && !reduceMotion) {
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting || entry.target.dataset.done) return;
            entry.target.dataset.done = '1';
            const target = Number(entry.target.dataset.count);
            const start = performance.now();
            const tick = (now) => {
                const progress = Math.min(1, (now - start) / 1600);
                const eased = 1 - Math.pow(1 - progress, 3);
                entry.target.textContent = Math.round(target * eased);
                if (progress < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
        });
    }, { threshold: 0.6 });
    counters.forEach((counter) => counterObserver.observe(counter));
}

// Lead tracking: sends call / WhatsApp / email clicks and form submits to GA4 or GTM when present.
function track(name, detail) {
    const payload = { event: 'lead_' + name, link_url: detail };
    if (typeof window.gtag === 'function') window.gtag('event', payload.event, { link_url: detail });
    else if (Array.isArray(window.dataLayer)) window.dataLayer.push(payload);
}

document.addEventListener('click', (event) => {
    const link = event.target.closest('[data-track]');
    if (link && link.tagName === 'A') track(link.dataset.track, link.getAttribute('href'));
});

document.querySelectorAll('form[data-track]').forEach((form) => {
    form.addEventListener('submit', () => track(form.dataset.track, window.location.pathname));
});
