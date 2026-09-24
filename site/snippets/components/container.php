<?php

use Kirby\Toolkit\A;
use Kirby\CMS\HTML;

/** @var \Kirby\Template\Slot $slot */

if (!isset($class)) {
    $class = [];
} elseif (is_string($class)) {
    $class = [$class];
}
$class = A::append(['container', 'mx-auto', 'max-w-6xl', 'w-full', 'py-12', 'px-6', 'md:py-16', 'lg:py-32'], $class);
?>
<div <?= HTML::attr('class', $class) ?>>
    <?= $slot ?>
</div>