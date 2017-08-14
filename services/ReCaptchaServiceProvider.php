<?php

namespace services;


use GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ReCaptchaServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app)
    {
        $app['captcha'] = function ($app) {
            return new class($app['captcha.secret'])
            {
                private $secret;

                public function __construct(string $secret)
                {
                    $this->secret = $secret;
                }

                public function check(string $googleToken) : bool
                {
                    $httpClient = new Client();
                    $captchaResponse = $httpClient->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                        'secret' => $this->secret, 'response' => $googleToken
                    ]);
                    return true;
                    return json_decode($captchaResponse, true)['success'];
                }
            };
        };
    }
}