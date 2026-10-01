<?php

/** @var \Kirby\Cms\Site $site */
/** @var \Kirby\Cms\Page $page */

$blog = $site->find('blog');
$articles = $blog->children()->listed()->sortBy('date', 'desc')->limit(10);
?>
<div id="blog-carousel" class="relative w-full h-full mb-12">

    <?php foreach ($articles as $article): ?>
        <!-- Slide -->
        <article
            class="carousel-cell group mr-6 last:mr-0 select-none
            w-[80%] h-auto aspect-2/3 
            md:w-auto md:h-96 md:aspect-4/5
            first:md:aspect-[16/10]
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
                            <span><?= $author->name() ?></span>
                        <?php endif ?>
                    </div>

                    <!-- Title -->
                    <k3 class="text-white text-2xl md:text-xl font-bold tracking-wide"><?= $article->title()->html() ?></h3>
                </div>
            </a>
        </article>

    <?php endforeach ?>

</div>