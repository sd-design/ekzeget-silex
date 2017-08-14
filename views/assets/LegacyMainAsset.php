<?php

namespace views\assets;


class LegacyMainAsset extends AssetBundle
{
    protected static $assets = [
        'js' => [
            '//vk.com/js/api/openapi.js',
            '/js/third_party.js',
            '/js/inline_scripts.js',
            '/js/jmousewhell.js',
            '/js/jscroll.js',

        ],
        'css' => [
            '/css/bootstrap.min.css',
            '/css/jscroll.css',
            '/css/style.css'
        ]
    ];
}