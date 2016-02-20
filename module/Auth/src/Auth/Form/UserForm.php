<?php
namespace Auth\Form;

use Zend\Form\Form;

class UserForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'user_name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Username',
            ),
        ));

        $this->add(array(
            'name' => 'user_password',
            'attributes' => array(
                'type'  => 'password',
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));



        $this->add(array(
            'name' => 'user_email',
            'attributes' => array(
                'type'  => 'email',
            ),
            'options' => array(
                'label' => 'E-mail',
            ),
        ));

        $this->add(array(
            'name' => 'user_role_id',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Role',
                'value_options' => array(
                    '1' => 'Public',
                    '2' => 'Member',
                    '3' => 'Admin',
                ),
            ),
            'attributes' => array(
                'class' => 'browser-default',
            ),

        ));

        $this->add(array(
            'name' => 'lang_id',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Language',
                'value_options' => array(
                    '1' => 'English',
                    '2' => 'French',
                    '3' => 'German',
                ),
            ),
            'attributes' => array(
                'class' => 'browser-default',
            ),

        ));

        $this->add(array(
            'name' => 'user_picture',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Picture URL',
            ),
        ));

        $this->add(array(
            'name' => 'user_registration_date',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Date',
                 'class' => 'datepicker'// 'text'
            ),
            'options' => array(
                'label' => 'Registration Date',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save',
                'id' => 'submitbutton',
                'class' => 'btn waves-effect waves-light'
            ),
        ));
    }
}