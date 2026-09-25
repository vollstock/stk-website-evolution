<?php

/** @var \Kirby\Cms\Site $site */
?>
<header id="navbar" class="fixed top-0 left-0 right-0 z-50">
    <?php snippet('components/container', ['class' => 'pt-6! pb-0!'], slots: true) ?>
    <?php slot() ?>
    <nav aria-labelledby="mainmenulabel"
        class="bg-gray-950/90 w-full flex rounded-2xl items-center justify-between px-3 py-2 lg:py-4 lg:px-6 transition-all">
        <h2 id="mainmenulabel" class="sr-only">Main Menu</h2>

        <!-- Left (Logo) -->
        <div class="flex lg:flex-1">
            <a href="<?= $site->url() ?>" class="ml-6 scale-200 lg:scale-350 transition-transform">
                <img class="h-8 w-auto" src="/assets/img/logo-stke.svg" alt="SuperTuxKart Evolution" />
            </a>
        </div>

        <!-- Mobile menu button -->
        <div class="flex lg:hidden">
            <button class="-m-2.5 inline-flex gap-2 items-center p-2.5" @click="mobileMenuOpen = true">
                <span class="text-gray-100 text-sm/6 font-semibold">Menu</span>
                <?= icon('assets/vendor/tabler/menu.svg', 'size-5 text-gray-400') ?>
            </button>
        </div>

        <!-- Middle -->
        <ul class="hidden lg:flex gap-x-1">
            <?php foreach ($site->menu()->toStructure() as $i => $item): ?>
                <?php if ($item->hasSubmenu()->toBool()): ?>
                    <li class="relative">

                        <button popovertarget="submenu-<?= $i ?>"
                            style="anchor-name: --menu-item-<?= $i ?>;"
                            class="relative flex items-center gap-x-1 font-semibold text-gray-100  hover:bg-white/10 px-4 py-1 rounded">
                            <?= $item->title() ?>
                            <?= icon('assets/vendor/tabler/chevron-down.svg', "size-5 flex-none text-gray-400") ?>
                        </button>

                        <ul role="menu"
                            popover id="submenu-<?= $i ?>"
                            style="position-anchor: --menu-item-<?= $i ?>; position-area: bottom center;"
                            class="
                                starting:open:opacity-0 starting:open:translate-y-1
                                transition ease-out duration-200 
                                opacity-100 translate-y-0
                                z-10 p-4 mt-3 w-screen max-w-xs overflow-hidden rounded-2xl bg-white shadow-lg outline-1 outline-gray-900/5
                                ">
                            <?php foreach ($item->subMenu()->toStructure() as $child): ?>
                                <li class="relative flex items-center gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                    <a class="flex-auto" href="<?= $child->link()->toUrl() ?>">
                                        <span class="font-semibold text-orange-500"><?= $child->title() ?></span>
                                        <p class="mt-1 text-gray-600"><?= $child->subTitle() ?></p>
                                    </a>
                                    <?php if (isexternal($child->link()->toUrl())): ?>
                                        <?= icon('assets/vendor/tabler/external-link.svg', "text-gray-300 size-5") ?>
                                    <?php endif ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="text-sm/6 font-semibold text-gray-100! no-underline! hover:bg-white/10 px-4 py-1 rounded">
                        <a href="<?= $item->link()->toUrl() ?>">
                            <?= $item->title() ?>
                        </a>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
        </ul>

        <!-- Right -->
        <div class="hidden lg:flex lg:flex-1 lg:justify-end gap-6">
        </div>

    </nav>
    <?php endslot() ?>
    <?php endsnippet() ?>
</header>