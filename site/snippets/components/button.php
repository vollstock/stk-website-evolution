<?php

use Kirby\Toolkit\A;
use Kirby\CMS\HTML;

/** @var \Kirby\Template\Slot $slot */
$componentClasses = ['flex items-center justify-center tracking-wider'];

$variants = [
    'default' => [
        "text-white text-shadow-sm font-semibold",
        "border-1 border-orange-400",
        "bg-linear-to-b from-yellow-500 to-orange-500",
        "hover:from-yellow-400 hover:to-orange-400",
        "active:from-yellow-600 active:to-orange-600"
    ],
    'white' => [
        "text-orange-500 font-bold",
        "border-1 border-gray-200",
        "bg-linear-to-b from-white to-gray-100",
        "hover:from-white hover:to-gray-50",
        "active:from-gray-50 active:to-gray-100"
    ],
    'ghost' => [
        "text-orange-500 tracking-normal",
        "border-1 border-transparent",
        "bg-none shadow-none",
        "hover:bg-gray-50 hover:border-gray-50",
        "active:bg-gray-100"
    ]
];

$sizes = [
    "default" => ["py-2 px-12 gap-2 rounded-md"],
    "sm" => ["text-sm py-1.5 px-8 gap-2 rounded-md"],
    "lg" => ["py-3 px-12 gap-2 rounded-lg text-lg"],
];

if (!isset($variant)) $variant = 'default';
if (!isset($size)) $size = 'default';

if (!isset($class)) {
    $class = [];
} elseif (is_string($class)) {
    $class = [$class];
}
$componentClasses = A::append($componentClasses, $sizes[$size]);
$componentClasses = A::append($componentClasses, $variants[$variant]);
$class = A::append($componentClasses, $class);

if (!isset($href)) $href = '#';
?>
<a <?= HTML::attr('class', $class) ?> href="<?= $href ?>">
    <?= $slot ?>
</a>