<?php require_once 'includes/header.php'; ?>
<?php $areas = getPracticeAreas(); ?>

<section class="page-hero">
    <div class="container">
        <h1>Practice Areas</h1>
        <p class="breadcrumb"><a href="<?= SITE_URL ?>">Home</a> / <span>Practice Areas</span></p>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="text-center animate-on-scroll">
            <span class="section-tag">Our Expertise</span>
            <h2 class="section-title">Comprehensive Legal Solutions</h2>
            <div class="title-line center"></div>
            <p class="section-subtitle">We provide strategic legal solutions across multiple practice areas, protecting your interests with professionalism and dedication.</p>
        </div>
        <div class="practice-grid" style="margin-top:50px;">
<?php foreach ($areas as $area): ?>
            <div class="practice-card animate-on-scroll">
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

<?php require_once 'includes/footer.php'; ?>
