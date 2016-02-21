<?php
namespace Cms\Form;


use Zend\Form\Form,
    Zend\Form\Element;
class TagForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('tag');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add(array(
            'name' => 'tag_name',
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
                'class' => 'btn waves-effect waves-light'
            ),

        ));
    }
}