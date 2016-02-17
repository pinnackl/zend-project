<?php
namespace Cms\Form;

use Zend\Form\Form;

class CategoryForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('category');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'ctgr_name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Username',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Envoyer',
                'id' => 'submitbutton',
                'class' => 'btn waves-effect waves-light'
            ),

        ));
    }
}