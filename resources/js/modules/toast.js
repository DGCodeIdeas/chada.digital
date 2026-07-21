/**
 * Toast notification system.
 * Creates fixed-position toast notifications with auto-dismiss.
 *
 * @param {string} message  - The notification text
 * @param {'success'|'error'} [type='success'] - Visual style
 */
export function toast(message, type = 'success') {
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
  requestAnimationFrame(() => {
    el.style.opacity = '1';
    el.style.transform = 'translateY(0)';
  });

  setTimeout(() => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(-8px)';
    setTimeout(() => {
      el.remove();
    }, 200);
  }, 3800);
}

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