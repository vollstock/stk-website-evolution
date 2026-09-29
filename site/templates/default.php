<?php

/** @var \Kirby\Cms\Page $page */
?>
<?= snippet("layout/header"); ?>

<section class="pt-24">
    <?php snippet('components/container', slots: true); ?>
    <?php slot() ?>

    <h1 class="text-4xl font-bold"><?= $page->title() ?></h1>

    <?php endslot() ?>
    <?php endsnippet() ?>
</section>

<?= snippet("layout/footer"); ?>