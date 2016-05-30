<?php

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */


namespace FeedbackFieldBundle;


class FeedbackFieldTypeFinderService {


    protected $container;

    /**
     * FeedbackFieldTypeURL constructor.
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    protected $fieldTypes = array();

    public function addFieldType(FeedbackFieldTypeServiceInterface $feedbackFieldTypeServiceInterface) {
        $this->fieldTypes[$feedbackFieldTypeServiceInterface->getId()] = $feedbackFieldTypeServiceInterface;
    }

    public function getFieldTypes() {
        return $this->fieldTypes;
    }

    public function getFieldTypeById($id) {
        return isset($this->fieldTypes[$id]) ? $this->fieldTypes[$id] : null;
    }

}