<?php
namespace widgets;

use models\Version;
use Silex\Application;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Cookie;

/*
 * TODO
 * check version existence
*/


class VersionChooser extends Widget
{
/*
 * @var Request $request
 * @var Response $response
 */
    protected $request,
              $response;


    public function run()
    {
        $app = get_app();

        $this->setCookie($app);

        return $this->render('version_chooser', [
            'versions' => Version::getChoicesList()
        ]);
    }

    public function setCookie(Application $app)
    {
        if (!isset($this->request)) {return;}

        if (!isset($app['bible_version'])) {
            throw new \DomainException('Bible version is NOT chosen');
        }
        if ($this->request->cookies->get('bible_version') !== $app['bible_version']) {
            $this->response->headers->setCookie(
                new Cookie('bible_version', $app['bible_version'], '+1 months')
            );
        }
    }
}