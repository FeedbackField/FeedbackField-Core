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
class AdminProjectFeedbackFieldDefinitionNewType extends AbstractType {


    protected $fieldTypes = array();

    /**
     * AdminProjectFeedbackFieldDefinitionNewType constructor.
     */
    public function __construct($container)
    {

        foreach($container->get('feedback_field_type_finder')->getFieldTypes() as $fieldType) {
            $this->fieldTypes[$fieldType->getTitle()] = $fieldType->getId();
        }

    }

    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder->add('title', 'text', array(
            'required' => true,
            'label'=>'Title'
        ));

        // TODO enforce slug like!
        $builder->add('publicId', 'text', array(
            'required' => true,
            'label'=>'Key'
        ));

        $builder->add('type', ChoiceType::class, array(
            'choices'  => $this->fieldTypes,
            'choices_as_values'=>true,
            'required' => true,
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


