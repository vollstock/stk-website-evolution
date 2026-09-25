<?php

/** @var \Kirby\Cms\Page $page */
/** @var \Kirby\Cms\Site $site */
?>

<footer class="w-full bg-gray-600 dark:bg-gray-950 p-3 lg:px-6 lg:py-8">
    <?php snippet('components/container', slots: true) ?>
    <?php slot() ?>

    <div class="md:grid auto-cols-fr grid-flow-col gap-12">

        <?php foreach ($site->menu()->toStructure() as $i => $item): ?>
            <div class="text-sm text-gray-300 dark:text-gray-600">
                <?php if ($item->hasSubmenu()->toBool()): ?>
                    <h3 class="font-semibold text-gray-50 dark:text-gray-400 mb-6"><?= $item->title() ?></h3>
                    <ul>

                        <?php foreach ($item->subMenu()->toStructure() as $child): ?>
                            <li class="my-2">
                                <a href="<?= $child->link()->toUrl() ?>" class="flex gap-3 group">
                                    <span class="group-hover:text-amber-400 dark:group-hover:text-amber-600"><?= $child->title() ?></span>
                                    <?php if (isexternal($child->link()->toUrl())): ?>
                                        <?= icon('assets/vendor/tabler/external-link.svg', "text-gray-600 size-4") ?>
                                    <?php endif ?>
                                </a>
                            </li>
                        <?php endforeach ?>

                    </ul>
                <?php else: ?>
                    <a href="<?= $item->link()->toUrl() ?>" class="font-semibold text-gray-50 dark:text-gray-400 hover:text-amber-400 dark:hover:text-amber-600">
                        <?= $item->title() ?>
                    </a>
                <?php endif ?>
            </div>
        <?php endforeach ?>

    </div>

    <?php endslot() ?>
    <?php endsnippet() ?>
</footer>

<?= js('assets/js/main.min.js') ?>

<?php if ($page->intendedTemplate()->name() === 'home'): ?>
    <?= js([
        'assets/js/downloadBox.js',
        'assets/vendor/swiper/swiper-bundle.min.js'
    ]) ?>
<?php endif ?>

<?= js('@auto') ?>
</body>

</html>