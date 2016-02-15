<?php
namespace Cms\Form;
use Zend\Form\Form,
    Zend\Form\Element,
    Cms\Entity\Page;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class PageForm extends Form {

    protected $categoryField;

    public function __construct() {
        parent::__construct('page');

        //Méthode d'envoie (GET,POST)
        $this->setAttribute('method', 'post');
        //Définition des champs

        //Page Title
        $titleField = new Element\Text('title');
        $titleField->setLabel('Titre');
        $this->add($titleField);

        //Page Content
        $contentField = new Element\Textarea('content');
        $contentField->setLabel('Contenu');
        $this->add($contentField);

        //Page Category
        $idField = new Element\Select('ctgr_id');
        $idField->setAttribute('class', 'browser-default');
        $idField->setLabel('Category');
        $this->add($idField);

        $submitField = new Element\Submit('submit');
        $submitField->setValue('Envoyer');
        $submitField->setAttributes(array('id' => 'submitbutton', 'class' => 'btn waves-effect waves-light'));
        $this->add($submitField);
    }

    /**
     * Allow controller to set Categories
     *
     * @param array $categories
     */
    public function setCategories($categories = array())
    {
        $this->get('ctgr_id')->setValueOptions($categories);
    }
}