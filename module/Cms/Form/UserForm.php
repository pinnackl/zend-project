<?php
namespace Cms\Form;

use Cms\Entity\User;
use Zend\Form\Form,
    Zend\Form\Element;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class UserForm extends Form {

    protected $categoryField;

    public function __construct() {
        parent::__construct('user');
        $this->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new User());

        //Méthode d'envoie (GET,POST)
        $this->setAttribute('method', 'post');
        //Définition des champs

        //User Id
        $idField = new Element\Hidden('id');
        $this->add($idField);

        //Email
        $titleField = new Element\Text('email');
        $titleField->setLabel('Email');
        $this->add($titleField);

        //First Name
        $firstNameField = new Element\Text('first_name');
        $firstNameField->setLabel('First Name');
        $this->add($firstNameField);

        //Last Name
        $lasttNameField = new Element\Text('last_name');
        $lasttNameField->setLabel('Last Name');
        $this->add($lasttNameField);

        //Password
        $contentField = new Element\Text('password');
        $contentField->setLabel('Password');
        $this->add($contentField);

        //Role
        $idField = new Element\Select('role');
        $idField->setLabel('Roles');
        $this->add($idField);

        $submitField = new Element\Submit('submit');
        $submitField->setValue('Envoyer');
        $submitField->setAttributes(array('id' => 'submitbutton'));
        $this->add($submitField);
    }

    /**
     * Allow controller to set Roles
     *
     * @param array $roles
     */
    public function setRoles($roles = array())
    {
        $this->get('role')->setValueOptions($roles);
    }
}