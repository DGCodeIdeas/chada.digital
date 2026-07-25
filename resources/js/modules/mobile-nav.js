/**
 * Mobile navigation toggle.
 * Handles hamburger/X icon swap, aria-expanded, and close-on-link-click.
 *
 * @param {string} toggleId - ID of the toggle button
 * @param {string} panelId  - ID of the mobile menu panel
 * @param {string|null} [iconId=null] - Optional ID of the SVG icon element
 */
export function initMobileNav(toggleId, panelId, iconId = null) {
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

  toggle.addEventListener('click', () => {
    setOpen(panel.classList.contains('hidden'));
  });

  panel.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
      setOpen(false);
    });
  });
}