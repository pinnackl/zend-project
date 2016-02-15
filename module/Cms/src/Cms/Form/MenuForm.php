<?php
namespace Cms\Form;

use Zend\Form\Form;
use Cms\Entity\Menu;

class MenuForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('menu');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'menu_name',
            'require' => false,
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Menu Name',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn waves-effect waves-light'
            ),

        ));
    }
}