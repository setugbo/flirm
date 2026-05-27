<?php require_once 'includes/header.php'; ?>
<?php $contact = getContactInfo(); ?>

<section class="page-hero">
    <div class="container">
        <h1>Contact Us</h1>
        <p class="breadcrumb"><a href="<?= SITE_URL ?>">Home</a> / <span>Contact</span></p>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="text-center animate-on-scroll">
            <span class="section-tag">Get In Touch</span>
            <h2 class="section-title">Let's Talk</h2>
            <div class="title-line center"></div>
            <p class="section-subtitle">Need professional legal assistance or consultation? Contact FLIRM SOLICITORS today.</p>
        </div>
        <div class="contact-grid" style="margin-top:50px;">
            <div class="animate-on-scroll">
                <h3 style="font-family:var(--font-serif); font-size:1.8rem; font-weight:700; margin-bottom:8px;">Our Office</h3>
                <p style="color:var(--medium-gray); margin-bottom:24px;">We are available to discuss your legal needs. Visit us or reach out through any of the channels below.</p>
                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-info-text">
                            <h4>Office Address</h4>
                            <p><?= htmlspecialchars($contact['address'] ?? '') ?></p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-info-text">
                            <h4>Email</h4>
                            <p><?= htmlspecialchars($contact['email'] ?? '') ?></p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fas fa-phone"></i></div>
                        <div class="contact-info-text">
                            <h4>Phone</h4>
                            <p><?= htmlspecialchars($contact['phone'] ?? '') ?></p>
                        </div>
                    </div>
                </div>
                <?php if ($contact): ?>
                <div class="office-hours" style="margin-top:32px;">
                    <h4>Office Hours</h4>
                    <div class="hours-item">
                        <span class="hours-day">Monday – Friday</span>
                        <span class="hours-time"><?= htmlspecialchars($contact['office_hours_weekdays'] ?? '8:00 AM – 5:00 PM') ?></span>
                    </div>
                    <div class="hours-item">
                        <span class="hours-day">Saturday</span>
                        <span class="hours-time"><?= htmlspecialchars($contact['office_hours_saturday'] ?? 'By Appointment') ?></span>
                    </div>
                    <div class="hours-item">
                        <span class="hours-day">Sunday</span>
                        <span class="hours-time"><?= htmlspecialchars($contact['office_hours_sunday'] ?? 'Closed') ?></span>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="animate-on-scroll">
                <form class="contact-form" id="contactForm" method="POST">
                    <h3 style="font-family:var(--font-serif); font-size:1.4rem; font-weight:700; margin-bottom:24px;">Send a Message</h3>
                    <div class="form-group">
                        <label for="name">Full Name <span style="color:#cc0000;">*</span></label>
                        <input type="text" id="name" name="name" required placeholder="Your full name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address <span style="color:#cc0000;">*</span></label>
                        <input type="email" id="email" name="email" required placeholder="your@email.com">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="+234 800 000 0000">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="How can we help?">
                    </div>
                    <div class="form-group">
                        <label for="message">Message <span style="color:#cc0000;">*</span></label>
                        <textarea id="message" name="message" required placeholder="Tell us about your legal needs..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-light" style="width:100%; justify-content:center;">
                        Send Message <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
