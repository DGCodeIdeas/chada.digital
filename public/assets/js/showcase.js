/*!
 * Chada Digital — showcase.js
 * Project filtering + detail modal for showcase.html.
 * Pure vanilla JS, no framework dependency.
 */

document.addEventListener('DOMContentLoaded', function () {
  const filterButtons = document.querySelectorAll('.filter-btn');
  const projectItems = document.querySelectorAll('.project-item');

  filterButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      filterButtons.forEach(function (btn) {
        btn.setAttribute('data-active', 'false');
      });
      button.setAttribute('data-active', 'true');

      const selectedCategory = button.getAttribute('data-category');

      projectItems.forEach(function (item) {
        const itemCategory = item.getAttribute('data-category');
        const shouldShow = selectedCategory === 'all' || itemCategory === selectedCategory;

        if (shouldShow) {
          item.style.display = 'block';
          item.style.animation = 'fadeIn 0.5s ease-out';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });

  const projectCards = document.querySelectorAll('.project-card');
  projectCards.forEach(function (card) {
    card.addEventListener('click', function () {
      const project = JSON.parse(card.getAttribute('data-project'));
      openProjectModal(project);
    });
  });

  const closeBtn = document.getElementById('project-modal-close');
  if (closeBtn) closeBtn.addEventListener('click', closeProjectModal);

  const modalEl = document.getElementById('project-modal');
  if (modalEl) {
    modalEl.addEventListener('click', function (e) {
      if (e.target === e.currentTarget) {
        closeProjectModal();
      }
    });
  }

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      const modal = document.getElementById('project-modal');
      if (modal && !modal.classList.contains('hidden')) {
        closeProjectModal();
      }
    }
  });
});

function openProjectModal(project) {
  const modal = document.getElementById('project-modal');
  const backdrop = modal.querySelector('.modal-backdrop');
  const panel = modal.querySelector('.modal-panel');

  document.getElementById('project-modal-title').textContent = project.title;
  document.getElementById('project-modal-image').src = project.image;
  document.getElementById('project-modal-image').alt = project.alt;
  document.getElementById('project-modal-category').textContent = project.category;
  document.getElementById('project-modal-description').textContent = project.description;
  document.getElementById('project-modal-link').href = project.href;

  modal.classList.remove('hidden');
  modal.setAttribute('aria-hidden', 'false');

  const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;

  document.documentElement.style.overflow = 'hidden';
  document.body.style.overflow = 'hidden';
  document.body.style.paddingRight = scrollbarWidth + 'px';

  requestAnimationFrame(function () {
    backdrop.style.opacity = '1';
    backdrop.style.backdropFilter = 'blur(12px)';
    backdrop.style['-webkit-backdrop-filter'] = 'blur(12px)';
    panel.style.opacity = '1';
    panel.style.transform = 'scale(1) translateY(0)';
  });
}

function closeProjectModal() {
  const modal = document.getElementById('project-modal');
  const backdrop = modal.querySelector('.modal-backdrop');
  const panel = modal.querySelector('.modal-panel');

  backdrop.style.opacity = '0';
  backdrop.style.backdropFilter = 'blur(0px)';
  backdrop.style['-webkit-backdrop-filter'] = 'blur(0px)';
  panel.style.opacity = '0';
  panel.style.transform = 'scale(0.95) translateY(1rem)';

  setTimeout(function () {
    modal.classList.add('hidden');
    modal.setAttribute('aria-hidden', 'true');
    document.documentElement.style.overflow = '';
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
  }, 300);
}
