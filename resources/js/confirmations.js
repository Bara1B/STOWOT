/* Global Tailwind confirm modal controller */
(function() {
  let modal, titleEl, messageEl, okBtn, cancelBtn;
  let pendingAction = null;

  function ensureModal() {
    if (modal) return true;
    modal = document.getElementById('confirm-modal');
    if (!modal) return false;
    titleEl = document.getElementById('confirm-title');
    messageEl = document.getElementById('confirm-message');
    okBtn = document.getElementById('confirm-ok');
    cancelBtn = document.getElementById('confirm-cancel');

    cancelBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal();
    });
    okBtn.addEventListener('click', () => {
      const act = pendingAction;
      pendingAction = null;
      closeModal();
      if (act) act();
    });
    return true;
  }

  function openConfirm(opts) {
    if (!ensureModal()) {
      const ok = window.confirm(opts && opts.message ? opts.message : 'Anda yakin?');
      if (ok && opts && typeof opts.onConfirm === 'function') opts.onConfirm();
      return;
    }
    titleEl.textContent = (opts && opts.title) || 'Konfirmasi';
    messageEl.textContent = (opts && opts.message) || 'Anda yakin?';
    pendingAction = opts && opts.onConfirm;
    modal.classList.remove('hidden');
  }

  function closeModal() {
    if (!modal) return;
    modal.classList.add('hidden');
  }

  // Intercept submit events that would trigger browser confirm, and route to modal instead
  document.addEventListener('submit', function(e) {
    const form = e.target;

    // If form explicitly opts-in via data-confirm
    const dataMessage = form.getAttribute('data-confirm');
    const hasDelete = (form.method && form.method.toUpperCase() === 'POST' &&
      form.querySelector('input[name="_method"][value="DELETE"]'));

    const hasInlineConfirm = form.getAttribute('onsubmit') && form.getAttribute('onsubmit').includes('confirm(');

    if (dataMessage || hasDelete || hasInlineConfirm) {
      e.preventDefault();
      e.stopImmediatePropagation();
      // clear inline to avoid loops
      if (hasInlineConfirm) form.removeAttribute('onsubmit');
      openConfirm({
        title: hasDelete ? 'Hapus Data' : 'Konfirmasi',
        message: dataMessage || (hasDelete ? 'Anda yakin ingin menghapus data ini?' : 'Anda yakin ingin melanjutkan?'),
        onConfirm: () => form.submit(),
      });
    }
  }, true); // capture phase to run before inline onsubmit

  // Click handler for links/buttons with data-confirm
  document.addEventListener('click', function(e) {
    const trigger = e.target.closest('[data-confirm]');
    if (!trigger) return;
    const message = trigger.getAttribute('data-confirm');

    // If it's a link and not a form submit
    if (trigger.tagName === 'A' && trigger.href) {
      e.preventDefault();
      openConfirm({
        title: 'Konfirmasi',
        message: message || 'Anda yakin?',
        onConfirm: () => {
          window.location.href = trigger.href;
        },
      });
    }
  });
})();
