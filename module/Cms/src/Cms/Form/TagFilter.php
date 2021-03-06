<?php
namespace Cms\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class TagFilter extends InputFilter
{
    public function __construct()
    {
        // self::__construct(); // parnt::__construct(); - trows and error
        $this->add(array(
            'name'     => 'tag_name',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 128,
                    ),
                ),
            ),
        ));
    }
}