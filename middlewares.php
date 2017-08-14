<?php
namespace middlewares;
/*
 * TODO
 * check version existence
 * by default find first priority version of user's language
 * add column version.sort
 * move hardcoded constants
 * refactor
 *
*/
/** @var \Silex\Application $app */

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

$chooseVersion = function (Request $request, Application $app) {
    $bibleVersion = $request->get('bible_version')
                    ?? $request->cookies->get('bible_version');
    $app['bible_version'] = $bibleVersion ?? 'st_text';
};

$app->before($chooseVersion);