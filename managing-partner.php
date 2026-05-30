<?php require_once 'includes/header.php'; ?>
<?php $partner = getPartner(); ?>

<section class="page-hero">
    <div class="container">
        <h1>Managing Partner</h1>
        <p class="breadcrumb"><a href="<?= SITE_URL ?>">Home</a> / <span>Managing Partner</span></p>
    </div>
</section>

<section class="section section-white">
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
                <div class="partner-bio"><?= nl2br(htmlspecialchars($partner['bio'] ?? '')) ?></div>
                <div style="margin-top:32px; padding-top:24px; border-top:1px solid var(--light-gray);">
                    <h4 style="font-size:0.85rem; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; color:#999; margin-bottom:16px;">Connect</h4>
                    <div style="display:flex; gap:12px;">
                        <a href="#" class="social-icon" style="border-color:var(--light-gray); color:var(--medium-gray);"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-icon" style="border-color:var(--light-gray); color:var(--medium-gray);"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon" style="border-color:var(--light-gray); color:var(--medium-gray);"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
