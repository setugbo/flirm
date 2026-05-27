(function() {
  var COOKIE_NAME = 'flirm_cookie_consent';
  var COOKIE_VERSION = 1;
  var COOKIE_DAYS = 365;

  function getCookie(name) {
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? decodeURIComponent(match[2]) : null;
  }

  function setCookie(name, value, days) {
    var expires = new Date(Date.now() + days * 864e5).toUTCString();
    document.cookie = name + '=' + encodeURIComponent(JSON.stringify(value)) + ';expires=' + expires + ';path=/';
  }

  function showBanner() {
    var banner = document.getElementById('cookieBanner');
    if (banner) banner.style.display = 'block';
  }

  function hideBanner() {
    var banner = document.getElementById('cookieBanner');
    if (banner) banner.style.display = 'none';
  }

  function acceptAll() {
    setCookie(COOKIE_NAME, { v: COOKIE_VERSION, necessary: true, analytics: true, marketing: true }, COOKIE_DAYS);
    hideBanner();
  }

  function acceptNecessary() {
    setCookie(COOKIE_NAME, { v: COOKIE_VERSION, necessary: true, analytics: false, marketing: false }, COOKIE_DAYS);
    hideBanner();
  }

  function showSettings() {
    var modal = document.getElementById('cookieModal');
    if (modal) modal.style.display = 'flex';
  }

  function saveSettings() {
    var analytics = document.getElementById('cookieAnalytics') && document.getElementById('cookieAnalytics').checked;
    var marketing = document.getElementById('cookieMarketing') && document.getElementById('cookieMarketing').checked;
    setCookie(COOKIE_NAME, { v: COOKIE_VERSION, necessary: true, analytics: analytics, marketing: marketing }, COOKIE_DAYS);
    var modal = document.getElementById('cookieModal');
    if (modal) modal.style.display = 'none';
    hideBanner();
  }

  function closeModal(e) {
    if (e.target === e.currentTarget) {
      var modal = document.getElementById('cookieModal');
      if (modal) modal.style.display = 'none';
    }
  }

  var existing = getCookie(COOKIE_NAME);
  if (!existing) {
    document.addEventListener('DOMContentLoaded', function() {
      showBanner();
    });
  }

  window.cookieAcceptAll = acceptAll;
  window.cookieAcceptNecessary = acceptNecessary;
  window.cookieShowSettings = showSettings;
  window.cookieSaveSettings = saveSettings;
  window.cookieCloseModal = closeModal;

  document.addEventListener('click', function(e) {
    if (e.target && e.target.id === 'cookieModal') closeModal(e);
  });
})();
