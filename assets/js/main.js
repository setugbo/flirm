/* =====================================
   FLIRM SOLICITORS - Main JavaScript
   ===================================== */

document.addEventListener('DOMContentLoaded', function() {

  // ===== LOADER =====
  const loader = document.getElementById('loader');
  if (loader) {
    setTimeout(function() {
      loader.classList.add('hidden');
    }, 2000);
  }

  // ===== HEADER SCROLL EFFECT =====
  const header = document.getElementById('siteHeader');
  let lastScroll = 0;

  window.addEventListener('scroll', function() {
    const currentScroll = window.pageYOffset;

    if (currentScroll > 100) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }

    lastScroll = currentScroll;
  });

  // ===== MOBILE NAV =====
  const toggle = document.getElementById('mobileToggle');
  const nav = document.getElementById('mainNav');
  const overlay = document.getElementById('navOverlay');

  if (toggle && nav && overlay) {
    toggle.addEventListener('click', function() {
      toggle.classList.toggle('active');
      nav.classList.toggle('open');
      overlay.classList.toggle('show');
      document.body.style.overflow = nav.classList.contains('open') ? 'hidden' : '';
    });

    overlay.addEventListener('click', function() {
      toggle.classList.remove('active');
      nav.classList.remove('open');
      overlay.classList.remove('show');
      document.body.style.overflow = '';
    });

    // Close on link click
    nav.querySelectorAll('a').forEach(function(link) {
      link.addEventListener('click', function() {
        toggle.classList.remove('active');
        nav.classList.remove('open');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
      });
    });
  }

  // ===== SCROLL TO TOP =====
  const scrollBtn = document.getElementById('scrollTop');
  if (scrollBtn) {
    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 400) {
        scrollBtn.classList.add('show');
      } else {
        scrollBtn.classList.remove('show');
      }
    });

    scrollBtn.addEventListener('click', function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ===== SCROLL ANIMATIONS =====
  const animateElements = document.querySelectorAll('.animate-on-scroll');

  const observerOptions = {
    threshold: 0.15,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  animateElements.forEach(function(el) {
    observer.observe(el);
  });

  // ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
  document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
    anchor.addEventListener('click', function(e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // ===== COUNTER ANIMATION =====
  function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-target'));
    const duration = 2000;
    const step = Math.ceil(target / (duration / 16));
    let current = 0;

    const timer = setInterval(function() {
      current += step;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      element.textContent = current.toLocaleString();
    }, 16);
  }

  document.querySelectorAll('.counter').forEach(function(counter) {
    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          animateCounter(counter);
          observer.unobserve(counter);
        }
      });
    }, { threshold: 0.5 });
    observer.observe(counter);
  });

  // ===== PARALLAX EFFECT ON HERO =====
  const hero = document.querySelector('.hero');
  if (hero) {
    window.addEventListener('scroll', function() {
      const scrolled = window.pageYOffset;
      const heroContent = hero.querySelector('.hero-grid');
      if (heroContent && scrolled < hero.offsetHeight) {
        heroContent.style.transform = 'translateY(' + (scrolled * 0.15) + 'px)';
        heroContent.style.opacity = 1 - (scrolled / hero.offsetHeight * 0.5);
      }
    });
  }

  // ===== PRACTICE AREA CARD TILT =====
  document.querySelectorAll('.practice-card').forEach(function(card) {
    card.addEventListener('mousemove', function(e) {
      const rect = this.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      const centerX = rect.width / 2;
      const centerY = rect.height / 2;
      const rotateX = (y - centerY) / 20;
      const rotateY = (centerX - x) / 20;
      this.style.transform = 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-8px)';
    });

    card.addEventListener('mouseleave', function() {
      this.style.transform = '';
    });
  });

  // ===== FORM SUBMISSION =====
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(this);
      const btn = this.querySelector('button[type="submit"]');
      const originalText = btn.innerHTML;
      btn.innerHTML = 'Sending...';
      btn.disabled = true;

      fetch('send-message.php', {
        method: 'POST',
        body: formData
      })
      .then(function(response) { return response.json(); })
      .then(function(data) {
        const alertDiv = document.createElement('div');
        alertDiv.className = data.success ? 'alert alert-success' : 'alert alert-error';
        alertDiv.textContent = data.message;
        contactForm.prepend(alertDiv);
        if (data.success) { contactForm.reset(); }
        btn.innerHTML = originalText;
        btn.disabled = false;
        setTimeout(function() { alertDiv.remove(); }, 5000);
      })
      .catch(function() {
        btn.innerHTML = originalText;
        btn.disabled = false;
      });
    });
  }
});
