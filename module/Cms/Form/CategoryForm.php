<?php
namespace Cms\Form;
use Zend\Form\Form,
    Zend\Form\Element,
    Cms\Entity\Category;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class CategoryForm extends Form {

    public function __construct() {
        parent::__construct('category');
        $this->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new Category());

        //Méthode d'envoie (GET,POST)
        $this->setAttribute('method', 'post');

        //Définition des champs

        //Category Id
        $idField = new Element\Hidden('id');
        $this->add($idField);

        //Category Name
        $titleField = new Element\Text('name');
        $titleField->setLabel('Nom');
        $this->add($titleField);

        $submitField = new Element\Submit('submit');
        $submitField->setValue('Envoyer');
        $submitField->setAttributes(array('id' => 'submitbutton'));
        $this->add($submitField);
    }
}