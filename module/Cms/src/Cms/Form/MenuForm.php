<?php
namespace Cms\Form;


use Zend\Form\Form,
    Zend\Form\Element;

use Cms\Entity\Menu;

class MenuForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('menu');
        $this->setAttribute('method', 'post');

        //Menu Name
        $titleField = new Element\Text('menu_name');
        $titleField->setLabel('Menu Name');
        $this->add($titleField);

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