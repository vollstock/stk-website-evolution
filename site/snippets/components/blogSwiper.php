<?php

/** @var \Kirby\Cms\Site $site */
/** @var \Kirby\Cms\Page $page */

$blog = $site->find('blog');
$i = 0;
$articles = $blog->children()->listed()->sortBy('date', 'desc')->limit(5);
?>
<div id="blog-swiper" class="swiper w-full h-full select-none overflow-visible! mb-12">
    <div class="swiper-wrapper">
        <?php foreach ($articles as $article): ?>

            <article class=" swiper-slide group
                 aspect-1/1 md:aspect-3/2 lg:aspect-5/4 bg-gray-600 rounded-2xl overflow-clip shadow-sm hover:shadow-xl dark:border dark:border-gray-600
                 transform-gpu transition! duration-200 scale-100 lg:hover:scale-105 rotate-0 lg:hover:-rotate-1">
                <a href="<?= $article->url() ?>">
                    <?php if ($poster = $article->poster()->toFile()): ?>
                        <img src="<?= $poster->resize(850, 564, 80)->url() ?>" class="size-full object-cover transform-gpu transition-transform duration-300 group-hover:scale-110" loading="lazy" />
                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                    <?php endif ?>
                    <div
                        class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/60 p-4 flex flex-col justify-end gap-1 h-full w-full justify-end">
                        <div class="text-xs text-gray-300 text-shadow-md/10 flex items-center flex-nowrap whitespace-now">
                            <span><?= $article->date()->toDate('d.m.Y') ?></span>
                            <?php if ($article->author()->isNotEmpty() && $article->date()->isNotEmpty()): ?>
                                <span class="mx-2 text-shadow-none">|</span>
                            <?php endif ?>
                            <?php if ($author = $article->author()->toUser()): ?>
                                <?php if ($avatar = $author->avatar()): ?>
                                    <img class="size-5 mr-1 rounded-full inline border-background/50 border" src="<?= $avatar->resize(40, 40, 80)->url() ?>" />
                                <?php endif ?>
                                <span><?= $author->name() ?></span>
                            <?php endif ?>
                        </div>

                        <span class="text-white font-medium tracking-wider text-shadow-lg/30"><?= $article->title()->html() ?></span>
                    </div>
                </a>
            </article>
            <?php $i++ ?>
        <?php endforeach ?>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <!-- <div class="swiper-scrollbar"></div> -->
</div>