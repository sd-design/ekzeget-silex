<?php
/**
 * @var \Application $app
 * @var string $contents
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 */
use models\User;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

?>
<!DOCTYPE html>
<html>
    <head>
        <title>ekzeget.ru - <?= $app['t']('admin_title') ?></title>
    </head>
    <body>
    <?php
    $form = $app['form.factory']->createBuilder(FormType::class, ['lang' => substr($app['current_locale'], 0, 2)])
                ->add('lang', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, [
                    'choices' => array_combine($app['supported_langs'], array_keys($app['supported_langs'])),
                    'label' => $app['t']('lang'),
                ])
                ->getForm();
    echo $app['twig']->render('form.twig', array('form' => $form->createView()));
    ?>
    <?= $this->render('menu.editor') ?>
    <?php if ($app['security.authorization_checker']->isGranted(User::ROLE_ADMIN)):?>
        <?= $this->render('menu.admin') ?>
    <?php endif; ?>
    <br /><br />
    <?= $contents ?>
    <script>
        document.forms[0].onchange = function (e) {
            window.location.href = location.protocol + '//' + e.target.value + '.' + location.host + location.pathname;
        };
    </script>
    <script>
        jQuery(document).on("pdocrud_on_load pdocrud_after_submission pdocrud_after_ajax_action", function (event, container) {
            $('textarea').attr('required', false); // in order to fix outdated CKEditor
        });

        var $insertButtons = $('.pdocrud-submit[data-action=insert]');
        if ($insertButtons.length === 2) {
            $insertButtons[0].parentElement.style.visibility = 'hidden';

            jQuery(document).ready(function () {
                if (window.CKEDITOR && CKEDITOR.replace) {
                    CKEDITOR.replace = function (...params) {
                        try {
                            return CKEDITOR.replace(...params);
                        } catch (e) {}
                    };
                }

                jQuery($insertButtons[1].parentElement.parentElement).submit(function setInsertId(e) {
                    e.preventDefault();
                    jQuery(document).on("pdocrud_after_submission", function onAcquireId(event, obj, response) {
                        jQuery(document).off("pdocrud_after_submission");
                        $('.id-field').val(JSON.parse(response).data);
                        jQuery($insertButtons[1].parentElement.parentElement).submit();
                    });
                    jQuery._data($insertButtons[1].parentElement.parentElement, "events" ).submit[0] = null;
                    $insertButtons[0].click();
                    return false;
                });
            });
        }
    </script>
    <style>
        ul#tables_menu {
            list-style-type: none;
            padding: 0;
            font-size: 16px;
        }

        ul#tables_menu li {
            display: none;
        }
        ul#tables_menu:hover li {
            display: list-item;
        }

        ul#tables_menu li:nth-child(odd) a {
            background: #1357ad;
            color: #fff;
        }

        ul#tables_menu li:nth-child(even) a {
            background: #f4f5ff;
            color: #000;
        }
    </style>
    </body>
</html>