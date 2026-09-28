<?php

/** @var \Kirby\Cms\Site $site */
?>
<header id="navbar" class="fixed left-0 right-0 z-50
    transition-top duration-300 top-0 lg:top-0!">
    <?php snippet('components/container', ['class' => 'pt-6! pb-0!'], slots: true) ?>
    <?php slot() ?>
    <nav aria-labelledby="mainmenulabel"
        class="bg-gray-950/90 w-full flex rounded-2xl items-center justify-between px-3 py-2 lg:py-4 lg:px-6 transition-all">
        <h2 id="mainmenulabel" class="sr-only">Main Menu</h2>

        <!-- Left (Logo) -->
        <div class="flex lg:flex-1 z-60">
            <a href="<?= $site->url() ?>" class="ml-6 scale-200 lg:scale-350 transition-transform">
                <img class="h-8 w-auto" src="/assets/img/logo-stke.png" alt="SuperTuxKart Evolution" />
            </a>
        </div>

        <!-- Mobile menu button -->
        <div id="mobile-menu" class="group flex lg:hidden">
            <button id="mobile-menu-button"
                class="z-60 -m-2.5 inline-flex gap-2 items-center p-2.5">
                <span class="text-gray-100 group-[.is-active]:hidden inline  text-sm/6 font-semibold">Menu</span>
                <span class="text-gray-800 dark:text-gray-100 hidden group-[.is-active]:inline text-sm/6 font-semibold">Close</span>
                <?= icon('assets/vendor/tabler/menu.svg', 'size-5 text-gray-400 transition-transform duration-400 rotate-0 group-[.is-active]:rotate-180 ease-out-back') ?>
            </button>

            <!-- Mobile menu -->
            <nav aria-labelledby="mobilemenulabel"
                class="bg-gray-50 dark:bg-gray-900 absolute inset-0 z-50 fixed
                    transition! duration-300 transition-discrete
                    opacity-0 group-[.is-active]:opacity-100 pointer-events-none group-[.is-active]:pointer-events-auto
                    flex
                    ">
                <h2 id="mobilemenulabel" class="sr-only">Main Menu</h2>
                <ul class="grow relative -top-4 group-[.is-active]:top-0 transition-top duration-300 mt-32 mb-8 mx-8 overflow-y-auto">
                    <?php foreach ($site->menu()->toStructure() as $item): ?>
                        <li class="flex">
                            <a
                                <?php if ($item->hasSubmenu()->toBool()): ?>
                                onclick="window.menu.submenu(0)"
                                <?php else: ?>
                                href="<?= $item->link()->toUrl() ?>"
                                <?php endif ?>
                                class="flex grow px-4 py-5 select-none
                                    rounded-xl hover:text-orange-500 dark:text-gray-200 hover:bg-black/3 active:bg-black/3 hover:dark:bg-white/5 active:dark:bg-white/5">
                                <span class="grow text-medium text-xl"><?= $item->title()->kt() ?></span>

                                <?php if ($item->hasSubmenu()->toBool()): ?>
                                    <?= icon("assets/vendor/tabler/chevron-right.svg", "text-orange-500") ?>
                                <?php endif ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </nav>
        </div>

        <!-- Middle -->
        <ul class="hidden lg:flex gap-2">
            <?php foreach ($site->menu()->toStructure() as $i => $item): ?>
                <?php if ($item->hasSubmenu()->toBool()): ?>
                    <li class="relative">

                        <button popovertarget="submenu-<?= $i ?>"
                            style="anchor-name: --menu-item-<?= $i ?>;"
                            class="relative flex items-center gap-x-1 text-gray-100  hover:bg-white/10 px-4 py-1 rounded">
                            <?= $item->title() ?>
                            <?= icon('assets/vendor/tabler/chevron-down.svg', "size-5 flex-none text-gray-400") ?>
                        </button>

                        <ul role="menu"
                            popover id="submenu-<?= $i ?>"
                            style="position-anchor: --menu-item-<?= $i ?>; position-area: bottom center;"
                            class="
                                starting:open:opacity-0 starting:open:translate-y-1
                                transition ease-out duration-300 
                                opacity-100 translate-y-0
                                z-10 p-4 mt-3 w-screen max-w-xs overflow-hidden rounded-2xl bg-white shadow-lg outline-1 outline-gray-900/5
                                ">
                            <?php foreach ($item->subMenu()->toStructure() as $child): ?>
                                <?php $isExternal = isexternal($child->link()->toUrl()); ?>
                                <li class="group relative flex items-center gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                    <a class="flex-auto" href="<?= $child->link()->toUrl() ?>"
                                        <?php if ($isExternal): ?>
                                        data-no-instant
                                        <?php endif ?>>
                                        <span class="font-semibold text-orange-500"><?= $child->title() ?></span>
                                        <p class="mt-1 text-gray-600"><?= $child->subTitle() ?></p>
                                    </a>
                                    <?php if ($isExternal): ?>
                                        <?= icon('assets/vendor/tabler/external-link.svg', "text-gray-300 size-5 shrink-0 group-hover:text-gray-400") ?>
                                    <?php endif ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <a href="<?= $item->link()->toUrl() ?>" class="text-gray-100 hover:text-orange-400 no-underline! ">
                        <li class="hover:bg-white/10 px-4 py-1 rounded">
                            <?= $item->title() ?>
                        </li>
                    </a>
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