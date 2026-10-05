<?php

/** @var \Kirby\Cms\Page $page */
/** @var \Kirby\Cms\Site $site */
?>

<footer
    aria-describedby="footer-heading"
    class="w-full bg-gray-800 bg-cover bg-bottom! bg-fixed!"
    style="box-shadow: inset 0 2rem 8rem black; background: url('/assets/img/asphalt-background.jpg');">

    <?php snippet('components/container', slots: true) ?>
    <?php slot() ?>

    <h1 id="footer-heading" class="visually-hidden">Footer menu</h1>

    <div class="md:grid auto-cols-fr grid-flow-col gap-12">

        <?php foreach ($site->menu()->toStructure() as $i => $item): ?>
            <div class="text-sm text-gray-300">
                <?php if ($item->hasSubmenu()->toBool()): ?>
                    <h2 class="font-semibold text-gray-50 mb-6"><?= $item->title() ?></h2>
                    <ul>

                        <?php foreach ($item->subMenu()->toStructure() as $child): ?>
                            <?php $isExternal = isexternal($child->link()->toUrl()); ?>
                            <li class="my-2">
                                <a href="<?= $child->link()->toUrl() ?>" class="flex gap-3 group"
                                    <?php if ($isExternal): ?>
                                    data-no-instant
                                    <?php endif ?>>
                                    <span class="group-hover:text-amber-400"><?= $child->title() ?></span>
                                    <?php if ($isExternal): ?>
                                        <?= icon('assets/vendor/tabler/external-link.svg', "text-gray-600 size-4") ?>
                                    <?php endif ?>
                                </a>
                            </li>
                        <?php endforeach ?>

                    </ul>
                <?php else: ?>
                    <a href="<?= $item->link()->toUrl() ?>" class="font-semibold text-gray-50 hover:text-amber-400">
                        <?= $item->title() ?>
                    </a>
                <?php endif ?>
            </div>
        <?php endforeach ?>

    </div>

    <?php endslot() ?>
    <?php endsnippet() ?>
</footer>

<?= js([
    '/assets/js/main.min.js',
    // '/assets/vendor/quicklink/quicklink.umd.js',
    // '/assets/vendor/instantclick/instantclick.min.js',
    '/assets/vendor/fastclick/fastclick.min.js'
], ['data-no-instant']) ?>

<?php if ($page->intendedTemplate()->name() === 'home'): ?>
    <?= js([
        '/assets/js/components/downloadBox.js',
        // '/assets/vendor/flickity/flickity.pkgd.min.js',
        '/assets/vendor/snappy/snappy.js',
    ], ['defer' => true, 'data-no-instant']) ?>
<?php endif ?>

<script data-no-instant>
    window.menu = new Menu();
    window.addEventListener("load", (event) => {
        // quicklink.listen();
        // InstantClick.init();
        FastClick.attach(document.body);
    }, false);
</script>

<?= js('@auto', ['defer' => true, 'data-no-instant']) ?>
</body>

</html>