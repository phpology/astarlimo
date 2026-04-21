/* ============================================
   A Star Limousine — main.js (Laravel version)
   Handles: mobile menu, scroll reveal,
            contact form (AJAX + CSRF)
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {

  /* === MOBILE NAV TOGGLE === */
  const toggle = document.getElementById('nav-toggle');
  const mobileMenu = document.getElementById('nav-mobile');
  const iconOpen = document.getElementById('icon-open');
  const iconClose = document.getElementById('icon-close');
  if (toggle && mobileMenu) {
    toggle.addEventListener('click', () => {
      const isOpen = mobileMenu.classList.toggle('open');
      iconOpen.style.display  = isOpen ? 'none'  : 'block';
      iconClose.style.display = isOpen ? 'block' : 'none';
    });
    mobileMenu.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
        iconOpen.style.display  = 'block';
        iconClose.style.display = 'none';
      });
    });
  }

  /* === SCROLL REVEAL === */
  const revealEls = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window && revealEls.length) {
    const obs = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
    revealEls.forEach(el => obs.observe(el));
  } else {
    revealEls.forEach(el => el.classList.add('visible'));
  }

  /* === CONTACT FORM (AJAX) === */
  const form = document.getElementById('enquiry-form');
  const formWrap = document.getElementById('form-wrap');
  const successBox = document.getElementById('form-success');

  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      // Clear previous errors
      form.querySelectorAll('.form-error').forEach(el => {
        el.style.display = 'none';
        el.textContent = '';
      });

      const get = id => document.getElementById(id);
      let clientValid = true;
      const clientErr = (id, msg) => {
        const el = document.getElementById(id + '-error');
        if (el) {
          el.style.display = 'block';
          el.textContent = msg || el.dataset.msg;
        }
        clientValid = false;
      };

      if (!get('f-name')?.value.trim())   clientErr('f-name');
      if (!get('f-phone')?.value.trim())  clientErr('f-phone');
      if (!get('f-email')?.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) clientErr('f-email');
      if (!get('f-vehicle')?.value)       clientErr('f-vehicle');
      if (!get('f-date')?.value)          clientErr('f-date');
      if ((get('f-message')?.value.trim().length ?? 0) < 5) clientErr('f-message');

      if (!clientValid) return;

      const btn = form.querySelector('button[type="submit"]');
      btn.disabled = true;
      btn.textContent = 'Sending...';

      try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
        const data = new FormData(form);

        const res = await fetch(form.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json',
          },
          body: data,
        });

        if (res.ok) {
          if (formWrap) formWrap.style.display = 'none';
          if (successBox) successBox.classList.add('visible');
        } else {
          const json = await res.json().catch(() => ({}));
          if (json.errors) {
            const fieldMap = {
              name: 'f-name', phone: 'f-phone', email: 'f-email',
              vehicle: 'f-vehicle', date: 'f-date', message: 'f-message',
            };
            Object.entries(json.errors).forEach(([field, msgs]) => {
              const errId = (fieldMap[field] || field) + '-error';
              const el = document.getElementById(errId);
              if (el) { el.style.display = 'block'; el.textContent = msgs[0]; }
            });
          }
          btn.disabled = false;
          btn.textContent = 'Send Enquiry';
        }
      } catch (err) {
        btn.disabled = false;
        btn.textContent = 'Send Enquiry';
      }
    });
  }
});
