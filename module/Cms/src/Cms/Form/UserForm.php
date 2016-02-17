<?php
namespace Cms\Form;

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
                'class' => 'browser-default'
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
                'attribute' => array(
                    'class' => 'browser-default'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'user_active',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Active',
                'value_options' => array(
                    '0' => 'No',
                    '1' => 'Yes',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'user_question',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Question',
            ),
        ));

        $this->add(array(
            'name' => 'user_answer',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Answer',
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
            'name' => 'user_password_salt',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Password Salt',
            ),
        ));

        $this->add(array(
            'name' => 'user_registration_date',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\DateTime', // 'text'
            ),
            'options' => array(
                'label' => 'Registration Date',
            ),
        ));

        $this->add(array(
            'name' => 'user_registration_token',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Registration Token',
            ),
        ));

        $this->add(array(
            'name' => 'user_email_confirmed',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'E-mail was confirmed?',
                'value_options' => array(
                    '0' => 'No',
                    '1' => 'Yes',
                ),
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