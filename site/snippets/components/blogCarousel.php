<?php

/** @var \Kirby\Cms\Site $site */
/** @var \Kirby\Cms\Page $page */

$blog = $site->find('blog');
$articles = $blog->children()->listed()->sortBy('date', 'desc')->limit(8);
$index = 0;
?>
<div class="snappy-carousel w-full h-full" aria-labelledby="blog-carousel-heading">
    <h1 id="blog-carousel-heading" class="visually-hidden">Recent blog posts</h1>
    <ul class="scroll-container scrollbar-none gap-6 md:p-6!">
        <?php foreach ($articles as $article): ?>
            <!-- Slide -->
            <li class="slide">
                <article
                    class="group mr-6 last:mr-0 select-none
                    w-[66vw] h-auto aspect-2/3 
                    md:w-auto md:h-96
                    <?php if ($index === 0): ?>
                    md:aspect-[16/10]
                    <?php else: ?>
                    md:aspect-4/5
                    <?php endif; ?>
                    ">
                    <a href="<?= $article->url() ?>"
                        class="
                relative block w-full h-full
                origin-center transition-[scale,rotate,box-shadow]! duration-200 scale-100 md:hover:scale-105 rotate-0 md:hover:-rotate-1
                group bg-gray-600 rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-600
                ">
                        <!-- Image -->
                        <?php if ($poster = $article->poster()->toFile()): ?>
                            <img
                                src="<?= $poster->resize(850, 564, 60)->url() ?>"
                                class="size-full object-cover transition-transform duration-300 group-hover:scale-110"
                                alt="<?= $poster->alt() ?>"
                                loading="lazy" />
                        <?php endif ?>

                        <!-- Meta -->
                        <div
                            class="absolute inset-0 bg-gradient-to-b from-transparent via-black/40 md:via-transparent to-black/60 p-6 flex flex-col justify-end gap-3 h-full w-full justify-end">
                            <div class="font-medium text-white text-shadow-md flex items-center flex-nowrap whitespace-now">
                                <span><?= $article->date()->toDate('d.m.Y') ?></span>
                                <?php if ($article->author()->isNotEmpty() && $article->date()->isNotEmpty()): ?>
                                    <span class="mx-2 text-gray-300 text-shadow-none">|</span>
                                <?php endif ?>
                                <?php if ($author = $article->author()->toUser()): ?>
                                    <?php if ($avatar = $author->avatar()): ?>
                                        <img class="size-6 mr-1 rounded-full inline border-background/30 border" src="<?= $avatar->resize(40, 40, 80)->url() ?>" alt="Profile image" />
                                    <?php endif ?>
                                    <span><?= $author->name() ?> <?= $index ?></span>
                                <?php endif ?>
                            </div>

                            <!-- Title -->
                            <k3 class="text-white text-2xl md:text-xl font-bold tracking-wide"><?= $article->title()->html() ?></h3>
                        </div>
                    </a>
                </article>
            </li>

            <?php $index++; ?>
        <?php endforeach ?>
    </ul>

    <div class="flex items-center mt-6 md:mt-0 gap-3 flex-wrap">
        <div class="flex hidden md:flex">
            <button class="prev size-8 rounded-md flex items-center justify-center text-sky-600 dark:text-sky-500 disabled:opacity-30 hover:bg-gray-100 active:hover:bg-gray-200" aria-label="Previous blog post"><?= icon("/assets/vendor/tabler/chevron-left.svg"); ?></button>
            <button class="next size-8 rounded-md flex items-center justify-center text-sky-600 dark:text-sky-500 disabled:opacity-30 hover:bg-gray-100 active:hover:bg-gray-200" aria-label="Next blog post"><?= icon("/assets/vendor/tabler/chevron-right.svg"); ?></button>
        </div>
        <ul class="pagination flex gap-3 flex-wrap grow"></ul>
        <?php if ($blog =  $site->find('blog')): ?>
            <a href="<?= $blog->url() ?>" class="flex items-center gap-3 dark:text-gray-300 hover:text-orange-400">
                All blog articles
                <?= icon('assets/vendor/tabler/chevron-right.svg', 'size-8 md:size-4 text-orange-500') ?>
            </a>
        <?php endif ?>
    </div>
</div>