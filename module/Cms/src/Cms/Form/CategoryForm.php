<?php
namespace Cms\Form;


use Zend\Form\Form,
    Zend\Form\Element;
class CategoryForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('category');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add(array(
            'name' => 'ctgr_name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Username',
            ),
        ));

        // Image Category
        $titleField = new Element\File('ctgr_image_filename');
        $titleField->setLabel('Image catégroy');
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