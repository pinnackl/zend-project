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
        $this->setAttribute('id', 'postmenu');

        //Menu Name
        $titleField = new Element\Text('menu_name');
        $titleField->setLabel('Menu Name');
        $this->add($titleField);

        $idField = new Element\Hidden('order');
        $idField->setAttribute('id', 'order');
        $this->add($idField);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Envoyer',
                'id' => 'submitbuttonmenu',
                'class' => 'btn waves-effect waves-light'
            ),

        ));
    }
}