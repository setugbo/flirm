<?php require_once 'includes/header.php'; ?>
<?php
$about = getAbout();
$partner = getPartner();
$mission = getMission();
$vision = getVision();
$reasons = getWhyChooseUs();
?>

<section class="page-hero">
    <div class="container">
        <h1>About Us</h1>
        <p class="breadcrumb"><a href="<?= SITE_URL ?>">Home</a> / <span>About Us</span></p>
    </div>
</section>

<section class="section section-white">
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
                <span class="section-tag">Who We Are</span>
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
            </div>
        </div>
    </div>
</section>

<section class="section section-light">
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

<?php require_once 'includes/footer.php'; ?>
