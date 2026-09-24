<?php

function icon(string $filePath, string|array $class = ''): string
{
    $class = is_array($class) ? implode(' ', $class) : $class;
    return str_replace(
        '<svg',
        sprintf('<svg %s', 'class="' . $class . '"'),
        svg($filePath)
    );
}

function isexternal(?string $url)
{
    if (empty($url)) return false;
    $domain = parse_url(kirby()->site()->url(), PHP_URL_HOST);

    $internal = (
        false !== stripos($url, '//' . $domain) || // include "//my-domain.com" and "http://my-domain.com"
        (
            0 !== strpos($url, '//') &&            // exclude protocol relative URLs, like "//example.com"
            0 === strpos($url, '/')                // include root-relative URLs, like "/demo"
        )
    );

    return !$internal;
}
