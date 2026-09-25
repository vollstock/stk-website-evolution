<?php

/** @var \Kirby\Cms\Site $site */
/** @var \Kirby\Cms\Page $page */
?>
<?= snippet("layout/header"); ?>

<section class="pt-24">
    <?php snippet('components/container', slots: true); ?>
    <?php slot(); ?>
    <h1 class="text-center md:text-left text-xl md:text-2xl tracking-wide font-bold text-white text-shadow-md/20">
        The Champions
    </h1>
    <h2 class="text-center md:text-left mt-2 text-3xl md:text-4xl font-black text-yellow-400 text-shadow-lg/30">
        of SuperTuxKart
    </h2>
    <p>Text about all characters being open source mascots.</p>
    
    <!-- TODO: Make this a swiper and add some gimmicks like shaking character images and a nice asphalt background -->
    <?php foreach ($site->characters()->toStructure() as $character): ?>
        <div class="w-[75%] aspect-16/10 shrink-0 bg-gray-500"></div>
        <h3 class="dark:text-gray-200 font-bold text-3xl"><?= $character->name()->kt() ?></h3>
        <div class="dark:text-gray-200"><?= $character->text()->kt() ?></div>
    <?php endforeach ?>
    
    <?php endslot(); ?>
    <?php endsnippet(); ?>
</section>

<!-- CTA -->
<section class="bg-red-500">
    <?php snippet('components/container', slots: true); ?>
    <?php slot(); ?>
    Sers
    <?php endslot(); ?>
    <?php endsnippet(); ?>
</section>

<script>
    const characters = <?= json_encode($site->characters()->toStructure()->toArray()) ?>;
    console.log(characters);
</script>

<?= snippet("layout/footer"); ?>