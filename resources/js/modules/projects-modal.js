/**
 * Projects modal ("View All Projects" grid).
 * Handles open/close, focus trapping, Escape key, backdrop click, and scroll lock.
 */
export function initProjectsModal() {
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
    const focusables = Array.from(modal.querySelectorAll(focusableSelectors)).filter((el) => {
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

    requestAnimationFrame(() => {
      backdrop.style.opacity = '1';
      backdrop.style.backdropFilter = 'blur(12px)';
      backdrop.style.webkitBackdropFilter = 'blur(12px)';
      panel.style.opacity = '1';
      panel.style.transform = 'scale(1) translateY(0)';
    });

    const focusables = Array.from(modal.querySelectorAll(focusableSelectors)).filter((el) => {
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

    setTimeout(() => {
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