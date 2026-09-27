<?php

/** @var \Kirby\Cms\Site $site */
/** @var \Kirby\Cms\Page $page */
/** @var \Kirby\Cms\App $kirby */

$siteTitle = $site->title()->value();
$pageTitle = $page->title()->value();
$metaTitle = $page->isHomePage() ? $siteTitle : $pageTitle . ' | ' . $siteTitle;
$description = $page->metaDescription()->value()
    ?: $page->text()->value()
    ?: $page->heroSubtitle()->value()
    ?: 'SuperTuxKart is a free and open-source kart racing game with exciting tracks, characters and game modes.';
$description = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($description), ENT_QUOTES, 'UTF-8')));
$description = mb_substr($description, 0, 160);
$shareImage = $page->poster()->toFile() ?? $page->heroBackground()->toFile();
$escape = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="<?= $escape($kirby->language()->code()) ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $escape($description) ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= $escape($page->url()) ?>">
    <title><?= $escape($metaTitle) ?></title>
    <meta property="og:type" content="<?= $page->intendedTemplate()->name() === 'blogArticle' ? 'article' : 'website' ?>">
    <meta property="og:site_name" content="<?= $escape($siteTitle) ?>">
    <meta property="og:title" content="<?= $escape($metaTitle) ?>">
    <meta property="og:description" content="<?= $escape($description) ?>">
    <meta property="og:url" content="<?= $escape($page->url()) ?>">
    <?php if ($shareImage): ?>
        <meta property="og:image" content="<?= $escape($shareImage->url()) ?>">
    <?php endif ?>
    <meta name="twitter:card" content="<?= $shareImage ? 'summary_large_image' : 'summary' ?>">
    <meta name="twitter:title" content="<?= $escape($metaTitle) ?>">
    <meta name="twitter:description" content="<?= $escape($description) ?>">
    <?php if ($shareImage): ?>
        <meta name="twitter:image" content="<?= $escape($shareImage->url()) ?>">
    <?php endif ?>
    <?= css(['assets/css/styles.css', '@auto']) ?>
    <?php if ($page->intendedTemplate()->name() === 'home'): ?>
        <?= css('assets/vendor/swiper/swiper-bundle.min.css') ?>
    <?php endif ?>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body class="bg-white dark:bg-gray-900 ">

    <?= snippet('components/menu'); ?>