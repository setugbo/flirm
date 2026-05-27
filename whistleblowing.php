<?php require_once 'includes/header.php'; ?>
<?php $page = getPageContent('whistleblowing'); ?>

<section class="page-hero">
    <div class="container">
        <h1><?= htmlspecialchars($page['title']) ?></h1>
        <p class="breadcrumb"><a href="<?= SITE_URL ?>">Home</a> / <span><?= htmlspecialchars($page['title']) ?></span></p>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="legal-content" style="max-width:800px;margin:0 auto;">
            <?= $page['content'] ?>
            <p style="margin-top:40px; color:var(--medium-gray); font-size:0.85rem;">
                Last updated: <?= date('F j, Y', strtotime($page['updated_at'])) ?>
            </p>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
