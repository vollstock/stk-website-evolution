<?php

/** @var \Kirby\Cms\Page $page */
?>
<?= snippet("layout/header"); ?>

<!-- Hero -->
<section class="bg-gray-600 w-full aspect-3/2 lg:aspect-16/10 relative">
    <?php if ($poster = $page->poster()->toFile()): ?>
        <img
            class="object-cover lg:absolute inset-0 w-full h-full"
            src="<?= $poster->url() ?>" alt="">
    <?php endif ?>

    <?php snippet('components/container', ['class' => 'prose prose-sm dark:prose-invert lg:absolute inset-x-0 bottom-0 w-full bg-white dark:bg-gray-800 lg:rounded-t-3xl flex flex-col justify-end items-center gap-6 pt-18! pb-8!'], slots: true) ?>
    <?php slot() ?>

    <!-- Meta -->
    <div class="text-xs flex items-center flex-nowrap whitespace-now">
        <span><?= $page->date()->toDate('d.m.Y') ?></span>
        <?php if ($page->author()->isNotEmpty() && $page->date()->isNotEmpty()): ?>
            <span class="mx-2 text-shadow-none">|</span>
        <?php endif ?>
        <?php if ($author = $page->author()->toUser()): ?>
            <!-- TODO: use smaller thumbnail -->
            <?php if ($avatar = $author->avatar()): ?>
                <img class="size-5 mr-1 rounded-full inline border-background/50 border" src="<?= $avatar->url() ?>" />
            <?php endif ?>
            <span><?= $author->name() ?></span>
        <?php endif ?>
    </div>

    <!-- Title -->
    <h1 class="text-5xl font-bold text-center"><?= $page->title() ?></h1>

    <!-- Tags -->
    <?php if ($tags = $page->tags()->split()): ?>
        <div class="flex flex-wrap justify-center gap-1">
            <?php foreach ($tags as $tag): ?>
                <span class="text-xs bg-gray-100 px-3 py-1 rounded-sm"><?= $tag ?></span>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <?php endslot() ?>
    <?php endsnippet() ?>
</section>

<?php snippet('components/container', ['class' => 'pt-6!'], slots: true) ?>
<?php slot() ?>

<div class="md:grid grid-cols-[auto_240px] gap-6 mt-6">
    <article class="prose prose-lg dark:prose-invert">
        <?= $page->text()->kt() ?>
    </article>
    <aside class="mt-6 md:mt-0">
        <div class=" sticky top-24">
            <?php if ($page->hasPrevListed()): ?>
                <a href="<?= $page->prevListed()->url() ?>">previous page</a>
            <?php endif ?>

            <?php if ($page->hasNextListed()): ?>
                <a href="<?= $page->nextListed()->url() ?>">next page</a>
            <?php endif ?>

            <p>Sharing</p>
            <p>Related</p>
        </div>
    </aside>
</div>

<div class="mt-6 bg-gray-100 p-6">
    Comments
</div>
<?php endslot() ?>
<?php endsnippet() ?>


<?= snippet("layout/footer"); ?>