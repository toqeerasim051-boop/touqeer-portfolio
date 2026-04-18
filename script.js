/**
 * script.js — Portfolio main JavaScript
 * Features: scroll reveal, navbar scroll, theme toggle, contact form, scroll-to-top
 */
'use strict';

/* ─────────────────────────────────────────────────────────
   1. NAVBAR — scroll effect
──────────────────────────────────────────────────────────── */
const navbar = document.getElementById('navbar');
const SCROLL_THRESHOLD = 50;

function handleNavbarScroll() {
  if (!navbar) return;
  if (window.scrollY > SCROLL_THRESHOLD) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
}
window.addEventListener('scroll', handleNavbarScroll, { passive: true });
handleNavbarScroll(); // run on load

/* Active nav link on scroll */
const sections = document.querySelectorAll('section[id]');
const navLinks  = document.querySelectorAll('.nav-link');

function setActiveNav() {
  let current = '';
  sections.forEach(sec => {
    const top = sec.offsetTop - navbar.offsetHeight - 20;
    if (window.scrollY >= top) current = sec.id;
  });
  navLinks.forEach(link => {
    link.classList.remove('active');
    if (link.getAttribute('href') === '#' + current) link.classList.add('active');
  });
}
window.addEventListener('scroll', setActiveNav, { passive: true });

/* Close mobile navbar on link click */
document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', () => {
    const menu = document.getElementById('navMenu');
    if (menu && menu.classList.contains('show')) {
      const toggler = document.querySelector('.navbar-toggler');
      toggler && toggler.click();
    }
  });
});

/* ─────────────────────────────────────────────────────────
   2. SCROLL REVEAL (Intersection Observer)
──────────────────────────────────────────────────────────── */
const revealObs = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      revealObs.unobserve(entry.target);
    }
  });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

/* ─────────────────────────────────────────────────────────
   3. THEME TOGGLE (dark ↔ light)
──────────────────────────────────────────────────────────── */
const themeBtn  = document.getElementById('theme-toggle');
const themeIcon = themeBtn ? themeBtn.querySelector('i') : null;
const HTML      = document.documentElement;

function applyTheme(theme) {
  if (theme === 'light') {
    HTML.classList.add('light-theme');
    if (themeIcon) themeIcon.className = 'bi bi-moon-fill';
  } else {
    HTML.classList.remove('light-theme');
    if (themeIcon) themeIcon.className = 'bi bi-sun-fill';
  }
}

const savedTheme = localStorage.getItem('portfolio-theme') || 'dark';
applyTheme(savedTheme);

if (themeBtn) {
  themeBtn.addEventListener('click', () => {
    const next = HTML.classList.contains('light-theme') ? 'dark' : 'light';
    localStorage.setItem('portfolio-theme', next);
    applyTheme(next);
  });
}

/* ─────────────────────────────────────────────────────────
   4. CONTACT FORM — client-side validation + fetch submit
──────────────────────────────────────────────────────────── */
const contactForm = document.getElementById('contactForm');

if (contactForm) {
  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    clearErrors();

    const name    = document.getElementById('fname').value.trim();
    const email   = document.getElementById('femail').value.trim();
    const subject = document.getElementById('fsubject').value.trim();
    const message = document.getElementById('fmessage').value.trim();
    let valid = true;

    if (name.length < 2) {
      showError('nameError', 'Please enter your name (at least 2 characters).');
      valid = false;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showError('emailError', 'Please enter a valid email address.');
      valid = false;
    }
    if (subject.length < 3) {
      showError('subjectError', 'Subject must be at least 3 characters.');
      valid = false;
    }
    if (message.length < 10) {
      showError('messageError', 'Message must be at least 10 characters.');
      valid = false;
    }
    if (!valid) return;

    // UI: loading state
    const btn  = document.getElementById('submitBtn');
    const text = btn.querySelector('.btn-text');
    const load = btn.querySelector('.btn-loading');
    btn.disabled = true;
    text.classList.add('d-none');
    load.classList.remove('d-none');
    setStatus('', '');

    try {
      const data = new FormData(contactForm);
      const res  = await fetch(contactForm.action, { method: 'POST', body: data });
      const json = await res.json();

      if (json.success) {
        contactForm.reset();
        setStatus('success', "✓ Message sent! I'll get back to you soon.");
      } else {
        setStatus('error', json.message || 'Something went wrong. Please try again.');
      }
    } catch {
      setStatus('error', 'Network error. Please check your connection and try again.');
    } finally {
      btn.disabled = false;
      text.classList.remove('d-none');
      load.classList.add('d-none');
    }
  });
}

function showError(id, msg) {
  const el = document.getElementById(id);
  if (el) { el.textContent = msg; el.style.display = 'block'; }
}
function clearErrors() {
  document.querySelectorAll('.ferr').forEach(el => { el.textContent = ''; el.style.display = 'none'; });
}
function setStatus(type, msg) {
  const el = document.getElementById('formStatus');
  if (!el) return;
  el.textContent  = msg;
  el.className    = 'form-status mt-3' + (type ? ' form-status--' + type : '');
  el.style.display = msg ? 'block' : 'none';
}

/* ─────────────────────────────────────────────────────────
   5. FOOTER YEAR
──────────────────────────────────────────────────────────── */
const yearEl = document.getElementById('year');
if (yearEl) yearEl.textContent = new Date().getFullYear();
