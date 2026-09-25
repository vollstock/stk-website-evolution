<?php

use Kirby\Http\Remote;

/** @var \Kirby\Cms\Site $site */

$releaseUrl = 'https://api.github.com/repos/supertuxkart/stk-code/releases/latest';
$appStoreLink = 'https://apps.apple.com/de/app/supertuxkart/id6737858957';
$playStoreLink = 'https://play.google.com/store/apps/details?id=org.supertuxkart.stk';

$platformFromName = static function (string $name): string {
    $name = strtolower($name);

    return match (true) {
        preg_match('/mac|\.dmg|macos|darwin|mac-signed/', $name) === 1 => 'macOS',
        preg_match('/iphone|ipad|ios/', $name) === 1 => 'iOS',
        preg_match('/windows|\.exe|win32|win-?/', $name) === 1 => 'Windows',
        preg_match('/android|\.apk/', $name) === 1 => 'Android',
        preg_match('/switch|nintendo|nx/', $name) === 1 => 'Nintendo Switch',
        preg_match('/src/', $name) === 1 => 'Source Code',
        preg_match('/linux|\.tar\.gz|appimage|\.deb|\.rpm/', $name) === 1 => 'Linux',
        default => 'Other',
    };
};

$architectureFromName = static function (string $name): string {
    $name = strtolower($name);

    return match (true) {
        preg_match('/aarch64|arm64/', $name) === 1 => 'ARM 64-bit',
        preg_match('/armv7|armv7l/', $name) === 1 => 'ARM 32-bit',
        preg_match('/x86_64|x64|amd64/', $name) === 1 => 'Intel / AMD 64-bit',
        preg_match('/i686|i386|x86/', $name) === 1 => 'Intel / AMD 32-bit',
        preg_match('/riscv64/', $name) === 1 => 'RISC-V 64-bit',
        preg_match('/apk/', $name) === 1 => '.apk',
        preg_match('/win/', $name) === 1 => 'Installer-less archive',
        preg_match('/switch/', $name) === 1 => 'Homebrew',
        default => '',
    };
};

$iconForPlatform = static function (string $platform): ?string {
    return match ($platform) {
        'Linux' => 'assets/img/brand-linux.svg',
        'Android' => 'assets/vendor/tabler/brand-android.svg',
        'macOS', 'iOS' => 'assets/vendor/tabler/brand-apple.svg',
        'Windows' => 'assets/vendor/tabler/brand-windows.svg',
        'Nintendo Switch' => 'assets/vendor/tabler/device-nintendo.svg',
        'Source Code' => 'assets/vendor/tabler/code.svg',
        default => null,
    };
};

$releaseCache = kirby()->cache('release');
$release = $releaseCache->get('releaseData');
// TODO: verify if cache is working and check whether this is causing some late server responses I have been seeing
if ($release === null) {
    try {
        $response = Remote::get($releaseUrl, [
            'headers' => [
                'Accept' => 'application/vnd.github+json',
                'X-GitHub-Api-Version' => '2022-11-28',
                'User-Agent' => 'SuperTuxKart-Website',
            ],
            'timeout' => 5,
        ]);

        if ($response->code() === 200) {
            $release = $response->json() ?? [];
            $releaseCache->set('releaseData', $release, 24 * 60);
        }
    } catch (Throwable $error) {
        // The download box is optional; a GitHub outage must not break the page.
    }
}

$groups = [];
foreach ($release['assets'] ?? [] as $asset) {
    $name = (string) ($asset['name'] ?? $asset['browser_download_url'] ?? '');
    $platform = $platformFromName($name);
    $groups[$platform][] = [
        'id' => (string) ($asset['id'] ?? md5($name)),
        'platform' => $platform,
        'architecture' => $architectureFromName($name),
        'url' => (string) ($asset['browser_download_url'] ?? ''),
        'size' => (int) ($asset['size'] ?? 0),
        'downloads' => (int) ($asset['download_count'] ?? 0),
        'icon' => $iconForPlatform($platform),
    ];
}

foreach ($groups as &$variants) {
    usort(
        $variants,
        static fn(array $a, array $b): int =>
        $b['downloads'] <=> $a['downloads'] ?: $b['size'] <=> $a['size']
    );
}
unset($variants);

$platformOrder = ['macOS', 'iOS', 'Windows', 'Linux', 'Android', 'Nintendo Switch', 'Source Code', 'Other'];
uksort($groups, static function (string $a, string $b) use ($groups, $platformOrder): int {
    $aDownloads = max(array_column($groups[$a], 'downloads'));
    $bDownloads = max(array_column($groups[$b], 'downloads'));

    return $bDownloads <=> $aDownloads
        ?: (array_search($a, $platformOrder, true) ?: PHP_INT_MAX)
        <=> (array_search($b, $platformOrder, true) ?: PHP_INT_MAX);
});

$fallbackOrder = ['Windows', 'macOS', 'Linux', 'Android', 'iOS', 'Nintendo Switch', 'Source Code', 'Other'];
$selected = null;
foreach ($fallbackOrder as $platform) {
    if (!empty($groups[$platform][0])) {
        $selected = $groups[$platform][0];
        break;
    }
}

$escape = static fn(string|int $value): string => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
?>
<div class="download-box mt-8 rounded-4xl py-6 flex flex-col gap-2 dark:bg-gray-100"
    data-download-box>

    <a data-ios-badge class="hidden" href="<?= $escape($appStoreLink) ?>">
        <img src="/assets/img/Download_on_the_App_Store_Badge_US-UK_RGB_blk_092917.svg" class="w-50" alt="Download on the App Store" />
    </a>
    <a data-android-badge class="hidden" href="<?= $escape($playStoreLink) ?>">
        <img src="/assets/img/GetItOnGooglePlay_Badge_Web_color_English.svg" class="w-50" alt="Get it on Google Play" />
    </a>

    <?php if ($selected): ?>
        <div data-desktop-download class="flex w-full justify-center mb-1">
            <a data-download-link download href="<?= $escape($selected['url']) ?>"
                class="
                    text-white text-shadow-sm font-semibold
                    border-1 border-orange-400
                    bg-linear-to-b from-yellow-500 to-orange-500
                    hover:from-yellow-400 hover:to-orange-400
                    active:from-yellow-600 active:to-orange-600
                    grow rounded-2xl rounded-r-none 
                    inline-flex items-center justify-center 
                    px-6 py-4 bg-yellow-400 text-gray-950 font-semibold">
                Download
            </a>

            <div class="relative flex">

                <button type="button" popovertarget="download-menu"
                    style="anchor-name: --download-menu"
                    class="
                        text-white text-shadow-sm font-semibold
                        border-1 border-orange-400
                        bg-linear-to-b from-yellow-500 to-orange-500
                        hover:from-yellow-400 hover:to-orange-400
                        active:from-yellow-600 active:to-orange-600
                        rounded-2xl rounded-l-none px-4 py-4 
                        gap-1 inline-flex items-center bg-yellow-400 text-gray-950"
                    aria-label="Select download">
                    <?php if ($selected['icon']): ?>
                        <?= icon($selected['icon'], 'size-4') ?>
                    <?php endif ?>
                    <span data-selected-architecture class="font-normal text-xs"><?= $escape($selected['architecture']) ?></span>
                    <?= icon('assets/vendor/tabler/chevron-down.svg', 'size-4.5') ?>
                </button>

                <ul id="download-menu" popover
                    style="position-anchor: --download-menu; position-area: bottom span-left;"
                    class="-mt-1 p-4 flex-col absolute max-h-70 overflow-y-scroll rounded-2xl bg-white shadow-lg outline-1 outline-gray-900/5">
                    <?php foreach ($groups as $index => $variants): ?>
                        <?php foreach ($variants as $variant): ?>
                            <li>
                                <button type="button" data-download-option
                                    data-id="<?= $escape($variant['id']) ?>"
                                    data-platform="<?= $escape($variant['platform']) ?>"
                                    data-architecture="<?= $escape($variant['architecture']) ?>"
                                    data-url="<?= $escape($variant['url']) ?>"
                                    class="cursor-pointer group relative flex items-center gap-x-4 rounded-lg px-4 py-1 text-sm/6 hover:bg-gray-200 whitespace-nowrap w-full text-left">
                                    <?php if ($variant['icon']): ?>
                                        <?= icon($variant['icon'], 'text-sky-400 size-4') ?>
                                    <?php endif ?>
                                    <span class="font-medium"><?= $escape($variant['platform']) ?></span>
                                    <span class="grow text-xs text-gray-400"><?= $escape($variant['architecture']) ?></span>
                                    <?php if ($variant['size'] > 0): ?>
                                        <span class="text-xs font-light text-gray-400"><?= round($variant['size'] / 1000000) ?> MB</span>
                                    <?php endif ?>
                                </button>
                            </li>
                        <?php endforeach ?>
                        <?php if ($index !== array_key_last($groups)): ?>
                            <hr class="my-2 text-gray-200" /><?php endif ?>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>

        <div data-release-meta class="flex md:row gap-2 px-4">
            <span class="text-xs text-gray-500 text-center">v <?= $escape($release['tag_name'] ?? '') ?></span>
            <span class="text-xs text-gray-300">|</span>
            <span class="text-xs text-gray-400 text-center"><?= !empty($release['published_at']) ? date('d.m.Y', strtotime($release['published_at'])) : '' ?></span>
            <span class="text-xs text-gray-300">|</span>
            <a href="<?= $site->find('downloads') ?>" class="text-xs text-center inline-flex items-center">
                See all Downloads
                <?= icon('assets/vendor/tabler/chevron-right.svg', 'size-3') ?>
            </a>
        </div>
    <?php endif ?>
</div>