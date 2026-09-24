<?php

/** @var \Kirby\Cms\Page $page */
?>
<?= snippet("layout/header"); ?>

<h1 class="text-4xl font-bold"><?= $page->title() ?></h1>

<?= snippet("layout/footer"); ?>