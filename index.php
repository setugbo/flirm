<?php require_once 'includes/header.php'; ?>
<?php
$hero = getHero();
$about = getAbout();
$partner = getPartner();
$areas = getPracticeAreas();
$reasons = getWhyChooseUs();
$mission = getMission();
$vision = getVision();
$contact = getContactInfo();
$consulting = getConsulting();
$socials = getSocialMedia();
?>

<!-- ===== HERO SECTION ===== -->
<section class="hero" id="home" style="<?= imgExists($hero['background_image'] ?? '') ? 'background:var(--black);' : '' ?>">
    <?php if (imgExists($hero['background_image'] ?? '')): ?>
    <div class="hero-bg" style="background:url('<?= SITE_URL . htmlspecialchars($hero['background_image']) ?>') center/cover no-repeat; opacity:0.25;"></div>
    <?php else: ?>
    <div class="hero-bg"></div>
    <?php endif; ?>
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <span class="hero-badge"><?= htmlspecialchars($hero['title'] ?? 'FLIRM SOLICITORS') ?></span>
                <h1 class="hero-title">
                    <?= htmlspecialchars($hero['subtitle'] ?? 'Professional Legal Services Rooted in Integrity, Excellence & Results') ?>
                </h1>
                <p class="hero-subtitle">
                    <?= htmlspecialchars($hero['description'] ?? '') ?>
                </p>
                <div class="hero-buttons">
                    <a href="#contact" class="btn btn-primary"><?= htmlspecialchars($hero['btn1_text'] ?? 'Book Consultation') ?> <i class="fas fa-arrow-right"></i></a>
                    <a href="#about" class="btn btn-outline"><?= htmlspecialchars($hero['btn3_text'] ?? 'Learn More') ?></a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-visual-content">
                    <div class="hero-initials">FS</div>
                    <div class="hero-visual-line"></div>
                    <div class="hero-visual-text">Since 2024</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== ABOUT SECTION ===== -->
<section class="section section-white" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="about-image-wrapper animate-on-scroll">
                <div class="about-image">
                    <?php if (imgExists($about['image_url'] ?? '')): ?>
                    <img src="<?= SITE_URL . htmlspecialchars($about['image_url']) ?>" alt="FLIRM SOLICITORS" style="width:100%;height:100%;object-fit:cover;">
                    <?php else: ?>
                    <div class="about-image-placeholder">
                        <div style="text-align:center;">
                            <div style="font-size:4rem; letter-spacing:4px;">FLIRM</div>
                            <div style="font-size:1rem; font-weight:300; color:#999; letter-spacing:2px;">SOLICITORS</div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="about-image-accordion">
                    <strong>100+</strong>
                    <span>Clients Served</span>
                </div>
            </div>
            <div class="about-content animate-on-scroll">
                <span class="section-tag">About Us</span>
                <h2><?= htmlspecialchars($about['heading'] ?? 'Who We Are') ?></h2>
                <?php
                $paragraphs = explode("\n", $about['content'] ?? '');
                foreach ($paragraphs as $p):
                    $p = trim($p);
                    if (!empty($p)):
                ?>
                <p><?= htmlspecialchars($p) ?></p>
                <?php
                    endif;
                endforeach;
                ?>
                <a href="about.php" class="btn btn-outline-light" style="margin-top:16px;">Read More <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- ===== PRACTICE AREAS ===== -->
<section class="section section-light" id="practice">
    <div class="container">
        <div class="text-center animate-on-scroll">
            <span class="section-tag">Our Expertise</span>
            <h2 class="section-title">Practice Areas</h2>
            <div class="title-line center"></div>
            <p class="section-subtitle">Comprehensive legal services across multiple practice areas, tailored to protect your interests and achieve your goals.</p>
        </div>
        <div class="practice-grid" style="margin-top:50px;">
<?php foreach ($areas as $area): ?>
            <div class="practice-card animate-on-scroll" id="area-<?= $area['id'] ?>">
                <div class="practice-icon">
                    <i class="fas <?= htmlspecialchars($area['icon_class'] ?? 'fa-gavel') ?>"></i>
                </div>
                <h3><?= htmlspecialchars($area['title']) ?></h3>
                <p><?= htmlspecialchars($area['short_description'] ?? '') ?></p>
                <?php if (!empty($area['services'])): ?>
                <ul class="practice-services">
                    <?php foreach (explode('|', $area['services']) as $service): ?>
                    <li><?= htmlspecialchars(trim($service)) ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
<?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===== MANAGING PARTNER ===== -->
<section class="section section-white" id="partner">
    <div class="container">
        <div class="partner-grid">
            <div class="partner-image animate-on-scroll">
                <?php if (imgExists($partner['image_url'] ?? '')): ?>
                <img src="<?= SITE_URL . htmlspecialchars($partner['image_url']) ?>" alt="<?= htmlspecialchars($partner['name'] ?? '') ?>" style="width:100%;height:100%;object-fit:cover;">
                <?php else: ?>
                <div class="partner-image-placeholder">
                    OB
                    <span>Onyemaechi Basil</span>
                </div>
                <?php endif; ?>
            </div>
            <div class="partner-info animate-on-scroll">
                <span class="section-tag">Leadership</span>
                <h2><?= htmlspecialchars($partner['name'] ?? 'Onyemaechi Harris Basil') ?></h2>
                <div class="partner-role"><?= htmlspecialchars($partner['title'] ?? 'Managing Partner') ?></div>
                <div class="title-line"></div>
                <p class="partner-bio"><?= nl2br(htmlspecialchars($partner['bio'] ?? '')) ?></p>
                <a href="managing-partner.php" class="btn btn-outline-light" style="margin-top:24px;">Full Profile <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHY CHOOSE US ===== -->
<section class="section section-dark">
    <div class="container">
        <div class="text-center animate-on-scroll">
            <span class="section-tag">Why Choose Us</span>
            <h2 class="section-title">Why FLIRM SOLICITORS?</h2>
            <div class="title-line center"></div>
        </div>
        <div class="why-grid" style="margin-top:50px;">
<?php foreach ($reasons as $reason): ?>
            <div class="why-card animate-on-scroll">
                <div class="why-icon">
                    <i class="fas <?= htmlspecialchars($reason['icon_class'] ?? 'fa-star') ?>"></i>
                </div>
                <h3><?= htmlspecialchars($reason['title']) ?></h3>
                <p><?= htmlspecialchars($reason['description']) ?></p>
            </div>
<?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===== MISSION & VISION ===== -->
<section class="section section-light" id="mission-vision">
    <div class="container">
        <div class="text-center animate-on-scroll">
            <span class="section-tag">Our Drive</span>
            <h2 class="section-title">Mission & Vision</h2>
            <div class="title-line center"></div>
        </div>
        <div class="mission-vision-grid" style="margin-top:50px;">
            <?php if ($mission): ?>
            <div class="mv-card animate-on-scroll">
                <div class="mv-number">01</div>
                <h3><?= htmlspecialchars($mission['title']) ?></h3>
                <p><?= htmlspecialchars($mission['content']) ?></p>
            </div>
            <?php endif; ?>
            <?php if ($vision): ?>
            <div class="mv-card animate-on-scroll">
                <div class="mv-number">02</div>
                <h3><?= htmlspecialchars($vision['title']) ?></h3>
                <p><?= htmlspecialchars($vision['content']) ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ===== CONSULTING ===== -->
<section class="section section-white" id="consulting">
    <div class="container">
        <div class="consulting-grid">
            <div class="consulting-info animate-on-scroll">
                <span class="section-tag">Our Sister Company</span>
                <h2><?= htmlspecialchars($consulting['company_name'] ?? 'FLIRM CONSULTING SERVICES LTD') ?></h2>
                <p class="consulting-tagline"><?= htmlspecialchars($consulting['tagline'] ?? '') ?></p>
                <?php
                $consultingParagraphs = explode("\n", $consulting['content'] ?? '');
                foreach (array_slice($consultingParagraphs, 0, 2) as $p):
                    $p = trim($p);
                    if (!empty($p)):
                ?>
                <p><?= htmlspecialchars($p) ?></p>
                <?php
                    endif;
                endforeach;
                ?>
                <ul class="consulting-services">
                    <li><i class="fas fa-check"></i> Legal Advisory & Property</li>
                    <li><i class="fas fa-check"></i> Event Management</li>
                    <li><i class="fas fa-check"></i> Property Management</li>
                    <li><i class="fas fa-check"></i> Recruitment & HR Support</li>
                    <li><i class="fas fa-check"></i> Project Management</li>
                    <li><i class="fas fa-check"></i> Administrative Support</li>
                </ul>
                <a href="consulting.php" class="btn btn-outline-light" style="margin-top:16px;">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="consulting-visual animate-on-scroll">
                <?php if (imgExists($consulting['image_url'] ?? '')): ?>
                <img src="<?= SITE_URL . htmlspecialchars($consulting['image_url']) ?>" alt="FLIRM CONSULTING" style="width:100%;height:auto;max-width:400px;object-fit:cover;border:1px solid var(--light-gray);">
                <?php else: ?>
                <div class="consulting-badge">
                    <h3>FLIRM</h3>
                    <h3 style="font-size:1.1rem; font-weight:300; font-style:italic; color:#999;">CONSULTING</h3>
                    <div style="width:40px; height:2px; background:rgba(255,255,255,0.3); margin:16px auto;"></div>
                    <p>Your Trusted Partner in Legal Advisory & Business Support</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ===== CONTACT SECTION ===== -->
<section class="section section-light" id="contact">
    <div class="container">
        <div class="text-center animate-on-scroll">
            <span class="section-tag">Get In Touch</span>
            <h2 class="section-title">Contact Us</h2>
            <div class="title-line center"></div>
            <p class="section-subtitle">Need professional legal assistance? Reach out to FLIRM SOLICITORS today.</p>
        </div>
        <div class="contact-grid" style="margin-top:50px;">
            <div class="animate-on-scroll">
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
                <div class="office-hours">
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
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required placeholder="Your full name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
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
                        <label for="message">Message</label>
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
