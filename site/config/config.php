<?php
require_once __DIR__ . '/helpers.php';

use Kirby\Cms\File;

return [
    'debug' => true,
    'languages' => true,
    'cache' => [
        'pages' => false,
        'release' => true
    ],
    'content.salt' => 'am9erxDkNJAEoJJqFTroDoFc4umAAqVDEvkRvtmywnCxuUEXjfCs9JE2JMo3JZP4',
    'cookie.key' => 'tRi3FdrNggis5tJokH5wyPqDT5D3ZmuKnrkHhxC2vZCroaagySi5UPZK7JxaavUY',
    'hooks' => [
        'file.create:after' => function (File $file) {
            if ($file->type() == 'image') {
                $file->update(['template' => 'image']);
            } else if ($file->type() == 'video') {
                $file->update(['template' => 'video']);
            }
        }
    ]
];
