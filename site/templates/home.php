<?php

/** @var \Kirby\Cms\Page $page */
/** @var \Kirby\Cms\Site $site */

use Kirby\Toolkit\A;
?>
<?= snippet("layout/header"); ?>

<!-- Hero -->
<section class="bg-gray-900 w-full h-screen lg:aspect-video flex items-center relative">
    <?php if ($bg = $page->heroBackground()->toFile()): ?>
        <?php if ($bg->type() === 'video'): ?>
            <!-- TODO: poster image -->
            <video autoplay playsinline loop muted
                class="w-full h-full object-cover md:object-[75%_0] lg:object-right center absolute inset-0"
                poster="">
                <source src="<?= $bg->url() ?>" type="video/mp4" />
            </video>
        <?php elseif ($bg->type() === 'image'): ?>
            <img src="<?= $bg->url() ?>"
                class="w-full h-full object-cover md:object-[75%_0] lg:object-right center absolute inset-0"
                alt="">
        <?php endif ?>
    <?php endif ?>

    <?php snippet('components/container', ['class' => 'z-0 flex justify-center md:justify-end h-full items-center'], slots: true) ?>
    <?php slot() ?>
    <div class="md:mx-6 pt-16">
        <h1 class="text-center md:text-left text-xl md:text-2xl tracking-wide font-bold text-white text-shadow-md/20">
            <?= $page->heroTitle()->kt() ?></h1>
        <h2 class="text-center md:text-left mt-2 text-4xl md:text-5xl font-black text-yellow-400 text-shadow-lg/30">
            <?= $page->heroSubtitle()->kt() ?></h2>
        <?= snippet("components/downloadBox"); ?>
    </div>
    <?php endslot() ?>
    <?php endsnippet() ?>
</section>


<!-- News -->
<section class="overflow-hidden">
    <?php snippet('components/container', ['class' => 'flex flex-col items-center gap-8'], slots: true) ?>
    <?php slot() ?>
    <!-- Headline -->
    <h1 class="text-3xl font-bold text-sky-400">Latest News</h1>

    <!-- Swiper -->
    <?php snippet('components/blogSwiper') ?>

    <!-- Links -->
    <div class="flex gap-12">
        <a href="https://members.supertuxkart.net/" class="flex items-center gap-3 text-gray-300 hover:text-orange-400">
            <?= icon('assets/vendor/tabler/brand-patreon.svg', 'size-4 text-gray-500') ?>
            Articles on Patreon
            <?= icon('assets/vendor/tabler/chevron-right.svg', 'size-4 text-orange-500') ?>
        </a>

        <?php if ($blog =  $site->find('blog')): ?>
            <a href="<?= $blog->url() ?>" class="flex items-center gap-3 text-gray-300 hover:text-orange-400">
                <?= icon('assets/vendor/tabler/rss.svg', 'size-4 text-gray-500') ?>
                Articles in the blog
                <?= icon('assets/vendor/tabler/chevron-right.svg', 'size-4 text-orange-500') ?>
            </a>
        <?php endif ?>
    </div>
    <?php endslot() ?>
    <?php endsnippet() ?>
</section>


<!-- Call to action -->
<section class="min-h-200 flex items-start lg:items-center relative">
    <!-- Background -->
    <?php if ($bg = $page->ctaBackground()->toFile()): ?>
        <?php if ($bg->type() === 'video'): ?>
            <!-- TODO: poster image -->
            <!-- TODO: focal point (from poster?) -->
            <video autoplay playsinline loop muted
                class="w-full h-full object-cover md:object-[75%_0] lg:object-right center absolute inset-0"
                poster="">
                <source src="<?= $bg->url() ?>" type="video/mp4" />
            </video>
        <?php elseif ($bg->type() === 'image'): ?>
            <img src="<?= $bg->url() ?>"
                class="w-full h-full object-cover md:object-[75%_0] lg:object-right center absolute inset-0"
                alt="">
        <?php endif ?>
    <?php endif ?>

    <!-- Text box -->
    <?php snippet('components/container', ['class' => 'z-0 flex lg:justify-end'], slots: true) ?>
    <?php slot() ?>
    <div class="flex flex-col gap-4 w-100 bg-white dark:bg-gray-200 p-8 rounded-xl md:mx-6 my-6 shadow">
        <h1 class="text-lg font-bold text-gray-500 tracking-wide"><?= $page->ctaTitle()->kt() ?></h1>
        <h2 class="-mt-3 md:text-left text-2xl md:text-3xl font-black text-orange-400 tracking-wide"><?= $page->ctaSubtitle() ?></h2>
        <div><?= $page->ctaText()->kt() ?></div>

        <?php snippet('components/button', ['class' => 'whitespace-nowrap mt-3 max-w-full max-w-96', 'variant' => 'white', "size" => "sm"], slots: true) ?>
        <?php slot() ?>
        <span>Get involved</span>
        <?= icon('assets/vendor/tabler/arrow-right.svg', 'text-gray-400') ?>
        <?php endslot() ?>
        <?php endsnippet() ?>
    </div>
    <?php endslot() ?>
    <?php endsnippet() ?>
</section>


<!-- About -->
<section>
    <?php snippet('components/container', ['class' => 'flex flex-col gap-8 text-gray-700 dark:text-white text-lg lg:text-center lg:w-200 pb-0!'], slots: true) ?>
    <?php slot() ?>
    <div>
        <h1 class="text-sky-500 text-lg mb-0 tracking-wide"><?= $page->aboutTitle()->kt() ?></h1>
        <h2 class="text-orange-500 text-3xl font-bold mt-0 tracking-wider"><?= $page->aboutSubTitle()->kt() ?></h2>
    </div>

    <p class="font-light tracking-wide"><?= $page->aboutText()->kt() ?></p>

    <?php endslot() ?>
    <?php endsnippet() ?>

    <!-- Features -->
    <?php snippet('components/container', ['class' => 'text-gray-700 dark:text-white pt-6! lg:pt-12!'], slots: true) ?>
    <?php slot() ?>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-12 md:gap-16">

        <?php foreach ($page->features()->toStructure() as $feature): ?>
            <div class="flex gap-4">
                <?php if ($icon = $feature->icon()->toFile()): ?>
                    <img src="<?= $icon->resize(96, 96, 80)->url() ?>" class="size-12 object-contain" />
                <?php endif ?>
                <div>
                    <h1 class="text-orange-500 font-bold inline mr-2"><?= $feature->title()->kt() ?></h1>
                    <p class="inline"><?= $feature->text()->kt() ?></p>
                </div>
            </div>
        <?php endforeach ?>

    </div>
    <?php endslot() ?>
    <?php endsnippet() ?>
</section>

<?= snippet("layout/footer"); ?>