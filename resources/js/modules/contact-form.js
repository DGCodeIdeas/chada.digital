/**
 * Chada Digital contact form handler.
 * Validates fields, submits via AJAX to /api/contact,
 * manages loading/success/error states, and supports honeypot fields.
 */
export function initChadaContactForm() {
  const form = document.getElementById('chada-contact-form');
  const successEl = document.getElementById('form-success');
  const submitBtn = document.getElementById('chada-submit-btn');
  const submitLabel = document.getElementById('chada-submit-label');
  const submitArrow = document.getElementById('chada-submit-arrow');
  const submitSpinner = document.getElementById('chada-submit-spinner');
  const formError = document.getElementById('chada-form-error');

  if (!form || !submitBtn) return;

  // Get CSRF token from meta tag
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

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
    form.querySelectorAll('.chada-field-input').forEach((el) => {
      el.classList.remove('is-invalid');
    });
    form.querySelectorAll('.chada-error-msg').forEach((el) => {
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
    if (submitLabel) submitLabel.textContent = loading ? 'Sending\u2026' : 'Send Message';
    if (submitArrow) submitArrow.style.display = loading ? 'none' : '';
    if (submitSpinner) submitSpinner.style.display = loading ? '' : 'none';
  }

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    clearErrors();

    // Honeypot check
    const formData = new FormData(form);
    if (formData.get('bot-field')) {
      return; // Silently ignore spam
    }

    if (!validate()) return;

    setLoading(true);

    try {
      const response = await fetch('/api/contact', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        },
        body: new URLSearchParams(formData).toString(),
      });

      if (response.ok) {
        form.style.display = 'none';
        if (successEl) successEl.style.display = 'flex';
      } else {
        const data = await response.json().catch(() => ({}));
        if (data.errors) {
          Object.entries(data.errors).forEach(([field, messages]) => {
            setFieldError(field, messages[0]);
          });
        }
        if (formError) formError.textContent = data.message || 'Something went wrong. Please try again.';
        setLoading(false);
      }
    } catch {
      if (formError) formError.textContent = 'Unable to send. Please check your connection and try again.';
      setLoading(false);
    }
  });
}