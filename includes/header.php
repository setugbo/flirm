<?php
require_once 'includes/functions.php';
$site = getSetting('site_name');
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= getPageTitle($current_page) ?></title>
    <meta name="description" content="FLIRM SOLICITORS - Professional legal services in Lagos, Nigeria. Corporate law, real estate, litigation, intellectual property, family law. Integrity, Excellence & Results.">
    <meta name="keywords" content="FLIRM SOLICITORS, law firm Lagos, corporate law Nigeria, legal services, real estate lawyer, litigation, intellectual property, Onyemaechi Harris Basil">
    <meta name="author" content="FLIRM SOLICITORS">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= SITE_URL . basename($_SERVER['PHP_SELF']) ?>">
    <?php $favicon = getSetting('favicon_url'); if (imgExists($favicon)): ?>
    <link rel="icon" type="image/x-icon" href="<?= SITE_URL . htmlspecialchars($favicon) ?>">
    <?php endif; ?>
    <meta property="og:title" content="<?= getPageTitle($current_page) ?>">
    <meta property="og:description" content="Professional legal services rooted in integrity, excellence & results.">
    <meta property="og:url" content="<?= SITE_URL . basename($_SERVER['PHP_SELF']) ?>">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>css/style.css">
</head>
<body>
    <?php if ($current_page === 'index'): ?>
    <div id="loader" class="loader">
        <div class="loader-content">
            <div class="loader-logo">FLIRM</div>
            <div class="loader-bar"><span></span></div>
        </div>
    </div>
    <?php endif; ?>

    <header class="site-header" id="siteHeader">
        <div class="header-top">
            <div class="container header-top-inner">
                <span class="header-contact"><i class="fas fa-phone"></i> 08037059291</span>
                <span class="header-contact"><i class="fas fa-envelope"></i> info@flirm.com.ng</span>
                <span class="header-contact"><i class="fas fa-map-marker-alt"></i> Ikeja, Lagos</span>
            </div>
        </div>
        <div class="header-main">
            <div class="container header-main-inner">
                <a href="<?= SITE_URL ?>" class="site-logo">
                    <?php $logo_url = getSetting('logo_url'); if (imgExists($logo_url)): ?>
                    <img src="<?= SITE_URL . htmlspecialchars($logo_url) ?>" alt="FLIRM SOLICITORS" style="height:40px;width:auto;">
                    <?php else: ?>
                    FLIRM <span>SOLICITORS</span>
                    <?php endif; ?>
                </a>
                <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle navigation">
                    <span></span><span></span><span></span>
                </button>
                <nav class="main-nav" id="mainNav">
                    <ul>
                        <li><a href="<?= SITE_URL ?>" class="<?= $current_page == 'index' ? 'active' : '' ?>">Home</a></li>
                        <li><a href="<?= SITE_URL ?>about.php" class="<?= $current_page == 'about' ? 'active' : '' ?>">About Us</a></li>
                        <li><a href="<?= SITE_URL ?>practice-areas.php" class="<?= $current_page == 'practice-areas' ? 'active' : '' ?>">Practice Areas</a></li>
                        <li><a href="<?= SITE_URL ?>attorneys.php" class="<?= $current_page == 'attorneys' ? 'active' : '' ?>">Our Attorneys</a></li>
                        <li><a href="<?= SITE_URL ?>consulting.php" class="<?= $current_page == 'consulting' ? 'active' : '' ?>">Consulting</a></li>
                        <li><a href="<?= SITE_URL ?>contact.php" class="<?= $current_page == 'contact' ? 'active' : '' ?>">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div class="nav-overlay" id="navOverlay"></div>
