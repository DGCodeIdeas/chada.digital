/*!
 * Chada Digital — main.js
 * Pure vanilla JS (no framework). Powers index.html:
 * mobile nav, contact form, projects modal, footer year.
 *
 * Also backs the Sterling & Vale demo pages, which load this
 * same file for their mobile nav + contact form.
 */

/* ----------------------------------------------------------------
 * Toast notifications
 * ------------------------------------------------------------- */

function ensureToastRoot() {
  let root = document.getElementById('toast-root');
  if (!root) {
    root = document.createElement('div');
    root.id = 'toast-root';
    root.style.position = 'fixed';
    root.style.top = '1rem';
    root.style.left = '50%';
    root.style.transform = 'translateX(-50%)';
    root.style.zIndex = '200';
    root.style.display = 'flex';
    root.style.flexDirection = 'column';
    root.style.gap = '0.5rem';
    root.style.pointerEvents = 'none';
    document.body.appendChild(root);
  }
  return root;
}

function toast(message, type) {
  const root = ensureToastRoot();

  const el = document.createElement('div');
  el.setAttribute('role', 'status');
  el.textContent = message;

  const isError = type === 'error';
  el.style.pointerEvents = 'auto';
  el.style.minWidth = '260px';
  el.style.maxWidth = '360px';
  el.style.padding = '0.85rem 1.1rem';
  el.style.borderRadius = '0.75rem';
  el.style.fontSize = '0.85rem';
  el.style.fontWeight = '500';
  el.style.lineHeight = '1.4';
  el.style.boxShadow = '0 10px 30px -10px rgba(0,0,0,0.45)';
  el.style.background = isError ? '#3a1212' : '#10241c';
  el.style.color = isError ? '#fecaca' : '#bbf7d0';
  el.style.border = '1px solid ' + (isError ? '#7f1d1d' : '#14532d');
  el.style.opacity = '0';
  el.style.transition = 'opacity 200ms ease, transform 200ms ease';
  el.style.transform = 'translateY(-8px)';

  root.appendChild(el);
  requestAnimationFrame(function () {
    el.style.opacity = '1';
    el.style.transform = 'translateY(0)';
  });

  setTimeout(function () {
    el.style.opacity = '0';
    el.style.transform = 'translateY(-8px)';
    setTimeout(function () {
      el.remove();
    }, 200);
  }, 3800);
}

/* ----------------------------------------------------------------
 * Mobile nav (main header #nav-toggle/#mobile-menu, and the
 * Sterling & Vale demo's #sv-nav-toggle/#sv-mobile-menu, which
 * also swaps its toggle button's icon between hamburger/X)
 * ------------------------------------------------------------- */

function initMobileNav(toggleId, panelId, iconId) {
  const toggle = document.getElementById(toggleId);
  const panel = document.getElementById(panelId);
  if (!toggle || !panel) return;

  const icon = iconId ? document.getElementById(iconId) : null;
  const MENU_PATHS = '<path d="M4 5h16"></path><path d="M4 12h16"></path><path d="M4 19h16"></path>';
  const X_PATHS = '<path d="M18 6 6 18"></path><path d="m6 6 12 12"></path>';

  function setOpen(isOpen) {
    panel.classList.toggle('hidden', !isOpen);
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    if (icon) {
      icon.innerHTML = isOpen ? X_PATHS : MENU_PATHS;
      icon.classList.toggle('lucide-menu', !isOpen);
      icon.classList.toggle('lucide-x', isOpen);
    }
  }

  toggle.addEventListener('click', function () {
    setOpen(panel.classList.contains('hidden'));
  });

  panel.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      setOpen(false);
    });
  });
}

/* ----------------------------------------------------------------
 * Chada Digital contact form (#chada-contact-form on index.html)
 * ------------------------------------------------------------- */

function initChadaContactForm() {
  const form = document.getElementById('chada-contact-form');
  const successEl = document.getElementById('form-success');
  const submitBtn = document.getElementById('chada-submit-btn');
  const submitLabel = document.getElementById('chada-submit-label');
  const submitArrow = document.getElementById('chada-submit-arrow');
  const submitSpinner = document.getElementById('chada-submit-spinner');
  const formError = document.getElementById('chada-form-error');

  if (!form || !submitBtn) return;

  function getInput(name) {
    return form.querySelector('[name="' + name + '"]');
  }

  function setFieldError(name, message) {
    const group = getInput(name)?.closest('.chada-form-group');
    if (!group) return;
    const input = group.querySelector('.chada-field-input');
    const msg = group.querySelector('.chada-error-msg');
    input?.classList.add('is-invalid');
    if (msg) msg.textContent = message;
  }

  function clearErrors() {
    form.querySelectorAll('.chada-field-input').forEach(function (el) {
      el.classList.remove('is-invalid');
    });
    form.querySelectorAll('.chada-error-msg').forEach(function (el) {
      el.textContent = '';
    });
    if (formError) formError.textContent = '';
  }

  function validate() {
    let valid = true;

    const name = getInput('name');
    const email = getInput('email');
    const message = getInput('message');

    if (!name?.value.trim()) {
      setFieldError('name', 'Your name is required.');
      valid = false;
    }

    if (!email?.value.trim()) {
      setFieldError('email', 'Your email address is required.');
      valid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
      setFieldError('email', 'Please enter a valid email address.');
      valid = false;
    }

    if (!message?.value.trim()) {
      setFieldError('message', 'A message is required.');
      valid = false;
    }

    return valid;
  }

  function setLoading(loading) {
    submitBtn.disabled = loading;
    submitBtn.style.opacity = loading ? '0.65' : '';
    submitBtn.style.cursor = loading ? 'not-allowed' : '';
    submitBtn.style.transform = loading ? 'none' : '';
    if (submitLabel) submitLabel.textContent = loading ? 'Sending…' : 'Send Message';
    if (submitArrow) submitArrow.style.display = loading ? 'none' : '';
    if (submitSpinner) submitSpinner.style.display = loading ? '' : 'none';
  }

  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    clearErrors();

    if (!validate()) return;

    setLoading(true);

    try {
      // NOTE: /api/contact does not exist in this static build.
      // This will be implemented server-side once this migrates to Laravel.
      const response = await fetch('/api/contact', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(new FormData(form)).toString(),
      });

      if (response.ok) {
        form.style.display = 'none';
        if (successEl) successEl.style.display = 'flex';
      } else {
        if (formError) formError.textContent = 'Something went wrong. Please try again.';
        setLoading(false);
      }
    } catch {
      if (formError) formError.textContent = 'Unable to send. Please check your connection and try again.';
      setLoading(false);
    }
  });
}

/* ----------------------------------------------------------------
 * Sterling & Vale contact form (#sv-contact-form demo page)
 * ------------------------------------------------------------- */

function initSterlingContactForm() {
  const form = document.getElementById('sv-contact-form');
  if (!form) return;

  form.addEventListener('submit', async function (e) {
    e.preventDefault();

    const name = form.querySelector('[name="name"]')?.value.trim();
    const email = form.querySelector('[name="email"]')?.value.trim();
    const message = form.querySelector('[name="message"]')?.value.trim();

    if (!name || !email || !message) {
      toast('Please fill in all required fields.', 'error');
      return;
    }

    const submitBtn = form.querySelector('button[type="submit"], button');
    const originalText = submitBtn ? submitBtn.innerHTML : '';
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = 'Sending…';
    }

    // Demo page has no backend — simulate submission.
    await new Promise(function (resolve) { setTimeout(resolve, 700); });
    toast("Thank you — we'll be in touch within one business day.", 'success');
    form.reset();

    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
    }
  });
}

/* ----------------------------------------------------------------
 * Footer year
 * ------------------------------------------------------------- */

function initFooterYear() {
  document.querySelectorAll('#footer-year, #copyright-year').forEach(function (el) {
    el.textContent = String(new Date().getFullYear());
  });
}

/* ----------------------------------------------------------------
 * Projects Modal ("View All Projects" grid on index.html)
 * ------------------------------------------------------------- */

function initProjectsModal() {
  const openBtn = document.getElementById('view-all-projects-btn');
  const modal = document.getElementById('projects-modal');
  const closeBtn = document.getElementById('projects-modal-close');
  if (!modal) return;

  const backdrop = modal.querySelector('.modal-backdrop');
  const panel = modal.querySelector('.modal-panel');
  const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;

  let scrollY = 0;
  let lastFocused = null;

  const focusableSelectors = 'a[href], button, textarea, input[type=text], input[type=radio], input[type=checkbox], select';

  function handleKeyDown(e) {
    const focusables = Array.from(modal.querySelectorAll(focusableSelectors)).filter(function (el) {
      return el.offsetParent !== null;
    });
    if (focusables.length === 0) return;

    const first = focusables[0];
    const last = focusables[focusables.length - 1];

    if (e.key === 'Tab' && e.shiftKey) {
      if (document.activeElement === first) {
        e.preventDefault();
        last.focus();
      }
    } else if (e.key === 'Tab') {
      if (document.activeElement === last) {
        e.preventDefault();
        first.focus();
      }
    } else if (e.key === 'Escape') {
      close();
    }
  }

  function handleBackdropClick(e) {
    if (e.target === modal || e.target === backdrop) {
      close();
    }
  }

  function open() {
    lastFocused = document.activeElement;
    scrollY = window.scrollY || document.documentElement.scrollTop;
    document.documentElement.style.overflow = 'hidden';
    document.body.style.overflow = 'hidden';
    document.body.style.paddingRight = scrollbarWidth + 'px';
    modal.classList.remove('hidden');
    modal.setAttribute('aria-hidden', 'false');

    requestAnimationFrame(function () {
      backdrop.style.opacity = '1';
      backdrop.style.backdropFilter = 'blur(12px)';
      backdrop.style.webkitBackdropFilter = 'blur(12px)';
      panel.style.opacity = '1';
      panel.style.transform = 'scale(1) translateY(0)';
    });

    const focusables = Array.from(modal.querySelectorAll(focusableSelectors)).filter(function (el) {
      return el.offsetParent !== null;
    });
    if (focusables.length) focusables[0].focus();

    document.addEventListener('keydown', handleKeyDown);
    modal.addEventListener('click', handleBackdropClick);
  }

  function close() {
    backdrop.style.opacity = '0';
    backdrop.style.backdropFilter = 'blur(0px)';
    backdrop.style.webkitBackdropFilter = 'blur(0px)';
    panel.style.opacity = '0';
    panel.style.transform = 'scale(0.95) translateY(1rem)';

    setTimeout(function () {
      modal.classList.add('hidden');
      modal.setAttribute('aria-hidden', 'true');
      document.documentElement.style.overflow = '';
      document.body.style.overflow = '';
      document.body.style.paddingRight = '';
      window.scrollTo(0, scrollY);
      document.removeEventListener('keydown', handleKeyDown);
      modal.removeEventListener('click', handleBackdropClick);
      if (lastFocused) lastFocused.focus();
    }, 300);
  }

  if (openBtn) openBtn.addEventListener('click', open);
  if (closeBtn) closeBtn.addEventListener('click', close);
}

/* ----------------------------------------------------------------
 * Init
 * ------------------------------------------------------------- */

document.addEventListener('DOMContentLoaded', function () {
  initMobileNav('nav-toggle', 'mobile-menu');
  initMobileNav('sv-nav-toggle', 'sv-mobile-menu', 'sv-nav-icon');
  initChadaContactForm();
  initSterlingContactForm();
  initFooterYear();
  initProjectsModal();
});
