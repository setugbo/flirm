<?php
$footer = getFooterContent();
$socials = getSocialMedia();
$contact = getContactInfo();
?>
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col footer-brand">
                    <h3>FLIRM <span>SOLICITORS</span></h3>
                    <p><?= htmlspecialchars($footer['about_text'] ?? 'Professional Legal Services You Can Trust.') ?></p>
                    <div class="footer-contact-list">
                        <div class="footer-contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?= htmlspecialchars($footer['address'] ?? '') ?></span>
                        </div>
                        <div class="footer-contact-item">
                            <i class="fas fa-envelope"></i>
                            <span><?= htmlspecialchars($footer['email'] ?? '') ?></span>
                        </div>
                        <div class="footer-contact-item">
                            <i class="fas fa-phone"></i>
                            <span><?= htmlspecialchars($footer['phone'] ?? '') ?></span>
                        </div>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="<?= SITE_URL ?>">Home</a></li>
                        <li><a href="<?= SITE_URL ?>about.php">About Us</a></li>
                        <li><a href="<?= SITE_URL ?>practice-areas.php">Practice Areas</a></li>
                        <li><a href="<?= SITE_URL ?>managing-partner.php">Managing Partner</a></li>
                        <li><a href="<?= SITE_URL ?>consulting.php">Consulting</a></li>
                        <li><a href="<?= SITE_URL ?>contact.php">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Policies</h4>
                    <ul class="footer-links">
                        <li><a href="<?= SITE_URL ?>ndpr-compliance.php">NDPR Compliance</a></li>
                        <li><a href="<?= SITE_URL ?>privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="<?= SITE_URL ?>whistleblowing.php">Whistleblowing</a></li>
                        <li><a href="#" onclick="event.preventDefault();cookieShowSettings();">Cookie Settings</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Practice Areas</h4>
                    <ul class="footer-links">
<?php
$areas = getPracticeAreas();
foreach (array_slice($areas, 0, 5) as $area):
?>
                        <li><a href="<?= SITE_URL ?>practice-areas.php#area-<?= $area['id'] ?>"><?= htmlspecialchars($area['title']) ?></a></li>
<?php endforeach; ?>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="footer-social">
<?php foreach ($socials as $social): ?>
                        <a href="<?= htmlspecialchars($social['url']) ?>" class="social-icon" target="_blank" rel="noopener" aria-label="<?= htmlspecialchars($social['platform']) ?>">
                            <i class="fab <?= htmlspecialchars($social['icon_class']) ?>"></i>
                        </a>
<?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p><?= htmlspecialchars($footer['copyright_text'] ?? '© 2026 FLIRM SOLICITORS. All Rights Reserved.') ?></p>
            </div>
        </div>
    </footer>

    <button id="scrollTop" class="scroll-top" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </button>

    <div id="cookieBanner" class="cookie-banner">
        <div class="container">
            <p>This website uses cookies to improve your experience. By using our site, you agree to our <a href="<?= SITE_URL ?>privacy-policy.php">Privacy Policy</a>.</p>
            <div class="cookie-actions">
                <button class="cookie-btn cookie-btn-link" onclick="cookieShowSettings()">Settings</button>
                <button class="cookie-btn cookie-btn-secondary" onclick="cookieAcceptNecessary()">Reject All</button>
                <button class="cookie-btn cookie-btn-primary" onclick="cookieAcceptAll()">Accept All</button>
            </div>
        </div>
    </div>

    <div id="cookieModal" class="cookie-modal" onclick="cookieCloseModal(event)">
        <div class="cookie-modal-content">
            <h3>Cookie Preferences</h3>
            <div class="cookie-option">
                <div>
                    <label>Necessary</label>
                    <p>Required for basic site functionality.</p>
                </div>
                <input type="checkbox" checked disabled>
            </div>
            <div class="cookie-option">
                <div>
                    <label><input type="checkbox" id="cookieAnalytics"> Analytics</label>
                    <p>Help us improve our website with anonymous usage data.</p>
                </div>
            </div>
            <div class="cookie-option">
                <div>
                    <label><input type="checkbox" id="cookieMarketing"> Marketing</label>
                    <p>Used for targeted advertising and social media.</p>
                </div>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button class="cookie-btn cookie-btn-primary" onclick="cookieSaveSettings()">Save Preferences</button>
                <button class="cookie-btn cookie-btn-secondary" onclick="cookieAcceptAll()">Accept All</button>
            </div>
        </div>
    </div>

    <script src="<?= ASSETS_URL ?>js/main.js"></script>
    <script src="<?= ASSETS_URL ?>js/cookie-consent.js"></script>
</body>
</html>
