<?php
/**
 * @var \Application $app
 * @var \widgets\Widget $this
 * @var string $assets
 * @var array $versions
 */
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

/* @var Form $form */
$form = $app['form.factory']->createNamedBuilder(null, FormType::class)
    ->setMethod('GET')
    ->add('bible_version', ChoiceType::class, array(
        'attr' => array('class' => 'form-control', 'ng-model' => 'urlVersion', 'ng-change' => 'chooserVersion()'),
        'choices' => $versions,
        'label' => false,
        'data' => $app['bible_version'],

    ))
    ->getForm();

echo $app['twig']->render('form.twig', array('form' => $form->createView()));