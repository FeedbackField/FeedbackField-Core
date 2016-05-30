<?php

namespace FeedbackFieldBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackValidator;
use Symfony\Component\Form\FormBuilderInterface;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class AdminProjectNewType extends AbstractType {


    public function buildForm(FormBuilderInterface $builder, array $options) {

      $builder->add('title', 'text', array(
          'required' => true,
          'label'=>'Title'
      ));

      $builder->add('publicId', 'text', array(
          'required' => true,
          'label'=>'PublicId'
      ));


    }

    public function getName() {
        return 'project';
    }

    public function getDefaultOptions(array $options) {
        return array(
        );
    }
}
