<?php

namespace views\assets;


class LegacyMainAsset extends AssetBundle
{
    protected static $assets = [
        'css' => [
            '/css/bootstrap.min.css',
            '/css/jscroll.css',
            '/css/style.css'
        ],
        'js' => [
            '//vk.com/js/api/openapi.js',
            '/js/third_party.js',
            '/js/angular.min.js',
            '/js/app_calendar.js',
            '/js/inline_scripts.js',
            '/js/jmousewhell.js',
            '/js/jscroll.js',

        ]
       
    ];
}