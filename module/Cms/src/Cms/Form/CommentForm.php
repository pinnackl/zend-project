<?php
namespace Cms\Form;


use Zend\Form\Form,
    Zend\Form\Element;

use Cms\Entity\Menu;

class CommentForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('comment');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'postmenu');



        $titleField = new Element\Text('com_email');
        $titleField->setLabel('Email');
        $this->add($titleField);

        //Menu Name
        $titleField = new Element\Text('com_title');
        $titleField->setLabel('Titre commentaire');
        $this->add($titleField);

        //Menu Name
        $titleField = new Element\Textarea('com_text');
        $titleField->setLabel('Commentaire');
        $this->add($titleField);

        $idField = new Element\Hidden('com_active');
        $idField->setAttribute('value', '1');
        $this->add($idField);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Commenter',
                'id' => 'submitbuttonmenu',
                'class' => 'btn waves-effect waves-light'
            ),

        ));
    }
}