const header = document.getElementById('site-header');
const burger = document.querySelector('.burger');
const nav = document.getElementById('main-nav');

window.addEventListener('scroll', () => {
    header?.classList.toggle('scrolled', window.scrollY > 8);
}, { passive: true });

burger?.addEventListener('click', () => {
    const open = nav.classList.toggle('open');
    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
});

const drop = document.querySelector('.drop');
const dropToggle = document.querySelector('.drop-toggle');
dropToggle?.addEventListener('click', () => {
    const open = drop.classList.toggle('open');
    dropToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
});

nav?.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
        if (!window.matchMedia('(max-width: 760px)').matches) return;
        nav.classList.remove('open');
        burger?.setAttribute('aria-expanded', 'false');
    });
});

const quotes = [...document.querySelectorAll('#quotes .quote')];
const dots = document.getElementById('quote-dots');
let quoteIndex = 0;

if (quotes.length && dots) {
    quotes.forEach((_, index) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = index === 0 ? 'on' : '';
        button.setAttribute('aria-label', 'Show testimonial ' + (index + 1));
        button.addEventListener('click', () => showQuote(index));
        dots.appendChild(button);
    });

    setInterval(() => showQuote((quoteIndex + 1) % quotes.length), 5200);
}

function showQuote(index) {
    quoteIndex = index;
    quotes.forEach((quote, i) => quote.classList.toggle('on', i === index));
    [...dots.children].forEach((dot, i) => dot.classList.toggle('on', i === index));
}

const counters = document.querySelectorAll('[data-count]');
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

document.querySelectorAll('[data-video]').forEach((button) => {
    button.addEventListener('click', () => {
        const frame = document.createElement('div');
        frame.className = 'video-frame';
        frame.innerHTML = `<iframe src="https://www.youtube.com/embed/${button.dataset.video}?autoplay=1" title="Gulf Cut video" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
        button.replaceWith(frame);
    });
});
