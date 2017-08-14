<?php
/** @var \Application $app */

use models\User;
use models\UserQuery;
use Symfony\Component\HttpFoundation\RequestMatcher;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;


$app->register(new \Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'user_creation' => array(
            'pattern' => new RequestMatcher('^/user/$', null, ['POST']),
            'stateless' => true,
            'http' => true,
            'anonymous' => true,
        ),

        'restricted' => array(
            'pattern' => '^/admin/|^/user/',
            'stateless' => true,
            'http' => true,
            'anonymous' => false,
            'users' => function () use ($app) {
                return UserQuery::create();
            },
        ),

        'unsecured' => array(
            'pattern' => '^/.*$',
            'stateless' => true,
            'http' => true,
            'anonymous' => true,
        ),
    ),

    'security.default_encoder' => function () use ($app) {
        return new class($app['security.encoder.bcrypt.cost']) extends BCryptPasswordEncoder
        {
            public function encodePassword($raw, $salt)
            {
                return parent::encodePassword(sha1($raw), $salt);
            }

            public function isPasswordValid($encoded, $raw, $salt)
            {
                return parent::isPasswordValid($encoded, sha1($raw), $salt);
            }
        };
    },

    'security.role_hierarchy' => array(
        User::ROLE_EDITOR => [User::ROLE_USER,],
        User::ROLE_ADMIN  => [User::ROLE_EDITOR,],
    ),

    'security.access_rules' => array(
        array('^/admin', [User::ROLE_EDITOR,], $app['schema']),
        array(new RequestMatcher('^/user/', null, ['POST']), [User::ROLE_GUEST,], $app['schema']), //create profile
        array(new RequestMatcher('^.*$', null, ['GET']), [User::ROLE_GUEST,], $app['schema']), //force schema change
        array('^.*$', [User::ROLE_USER,], $app['schema']), // restrict /user/ area
    ),
));

$app['editor.allowed_tables'] = ['Tradition', 'author', 'book_commentary', 'Tradition_i18n', 'author_i18n', 'book_commentary_i18n'];

$app->register(new \services\ReCaptchaServiceProvider(), [
    'captcha.secret' => $app['captcha.secret']
]);