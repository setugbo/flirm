<?php require_once 'includes/header.php'; ?>

<section class="page-hero">
    <div class="container">
        <h1>404</h1>
        <p class="breadcrumb"><span>Page Not Found</span></p>
    </div>
</section>

<section class="section section-white">
    <div class="container text-center">
        <div style="max-width:500px; margin:0 auto;">
            <div style="font-family:var(--font-serif); font-size:8rem; font-weight:700; color:var(--light-gray); line-height:1;">404</div>
            <h2 style="font-family:var(--font-serif); font-size:2rem; font-weight:700; margin:24px 0 16px;">Page Not Found</h2>
            <p style="color:var(--medium-gray); margin-bottom:32px;">The page you are looking for might have been removed or is temporarily unavailable.</p>
            <a href="<?= SITE_URL ?>" class="btn btn-outline-light" style="justify-content:center;">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
