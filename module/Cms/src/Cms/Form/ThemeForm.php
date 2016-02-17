<?php
namespace Cms\Form;

use Zend\Form\Form;

class ThemeForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('theme');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'theme_name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Name',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Envoyer',
                'id' => 'submitbutton',
            ),
        ));
    }
}