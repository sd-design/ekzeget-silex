<?php
//turns control sequences into markup
/**
 * @var \Silex\Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var string $txt
 */
$patterns = array (
    //notes
    '/\@(\d{1,3})/', //link
    '/\*(\d{1,3})/', //backlink
    '/={3}(.*?)={2}/', //block of footnotes
    '/\+{3}(.*?)\+{2}/', //source

    //other commentaries
    '/(?:\*){3}|(?:\*\s){3}/'
);
$replace = array (
    //notes
    '<a name="v_${1}"></a><sup><a href="#${1}">[${1}]</a></sup>',  //link
    '<a name="${1}"></a><a href="#v_${1}">${1}</a>', //back link
    '<br /></p><p><small><span style="color: #888; margin-left: 15px; font-weight: normal; font-family: Arial">' . $app['t']('notes') . '</span></small><hr /></p><p></p><small>$1</small></p>', //block of footnotes start
    '<br /></p><p><small><span style="color: #888; margin-left: 15px; font-weight: normal; font-family: Arial">' . $app['t']('source') . '</span></small><hr /></p><p><small>$1</small></p>', //source

    //other commentaries
    '<br /></p><p><big><span style="margin-left: 15px; font-weight: 100; font-family: Arial">' . $app['t']('other_commentary') . '</span></big></p><br /><p>'
);
echo preg_replace($patterns, $replace, $txt);