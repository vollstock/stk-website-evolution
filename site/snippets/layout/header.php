<?php

/** @var \Kirby\Cms\Site $site */
/** @var \Kirby\Cms\Page $page */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $site->title() ?></title>
    <?= css(['assets/css/styles.css', '@auto']) ?>
    <?php if ($page->intendedTemplate()->name() === 'home'): ?>
        <?= css('assets/vendor/swiper/swiper-bundle.min.css') ?>
    <?php endif ?>
</head>

<body>

    <?= snippet('components/menu'); ?>