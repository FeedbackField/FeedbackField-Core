<?php

namespace FeedbackFieldBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackValidator;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class AdminProjectExportTrelloNewType extends AbstractType {


    public function buildForm(FormBuilderInterface $builder, array $options) {



        $builder->add('key', 'text', array(
            'required' => true,
            'label'=>'Trello Key'
        ));

        $builder->add('token', 'text', array(
            'required' => true,
            'label'=>'Trello Token'
        ));

        $builder->add('list_id', 'text', array(
            'required' => true,
            'label'=>'Trello List ID'
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


