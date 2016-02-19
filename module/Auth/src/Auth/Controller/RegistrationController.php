<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Auth\Entity\User;


// Doctrine Annotations
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;

// Zend Annotation
use Zend\Form\Annotation\AnnotationBuilder;
// for the form
use Zend\Form\Element;

use Auth\Form\RegistrationForm;
use Auth\Form\RegistrationFilter;
use Auth\Form\ForgottenPasswordForm;
use Auth\Form\ForgottenPasswordFilter;

//use Zend\Mail\Message;
use Auth\Controller\MailController;

use Zend\Crypt\Password\Bcrypt;

class RegistrationController extends AbstractActionController
{

    public function indexAction()
    {
        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $user = new User;
        //1)  A lot of work to manualy change the form add fields etc. Better use a form class
//-		$form = $this->getRegistrationForm($entityManager, $user);

        // 2) Better use a form class
        $form = new RegistrationForm();
        $form->get('submit')->setValue('Register');
        $form->setHydrator(new DoctrineHydrator($entityManager,'Aut\Entity\User'));

        $form->bind($user);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter(new RegistrationFilter($this->getServiceLocator()));
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->prepareData($user);
                
                $mail = new MailController();
                $mail->initMail('accountCreated',$user->getUsrEmail());
                
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirect()->toRoute('auth/default', array('controller'=>'registration', 'action'=>'registration-success'));
            }
        }
        return new ViewModel(array('form' => $form));
    }
    
    public function registrationSuccessAction()
    {
        $user_email = null;
        $flashMessenger = $this->flashMessenger();
        if ($flashMessenger->hasMessages()) {
            foreach($flashMessenger->getMessages() as $key => $value) {
                $user_email .=  $value;
            }
        }
        return new ViewModel(array('user_email' => $user_email));
    }


    public function forgottenPasswordAction()
    {
        $form = new ForgottenPasswordForm();
        $form->get('submit')->setValue('Send');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter(new ForgottenPasswordFilter($this->getServiceLocator()));
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $usrEmail = $data['usrEmail'];
                $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                $user = $entityManager->getRepository('AuthDoctrine\Entity\User')->findOneBy(array('usrEmail' => $usrEmail)); //
                $password = $this->generatePassword();
                
                $mail = new MailController();
                $mail->initMail('forgotPassword',$usrEmail,$password);
                
                $user->setUsrPassword($password);
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirect()->toRoute('auth/default', array('controller'=>'registration', 'action'=>'password-change-success'));
            }
        }
        return new ViewModel(array('form' => $form));
    }


    public function prepareData($user)
    {
        $bcrypt = new Bcrypt();
        
        $user->setUsrPassword($bcrypt->create($user->getUsrPassword()));
        $user->setUsrlId(2);
        $user->setLngId(1);
        $user->setUsrRegistrationDate(new \DateTime());
        return $user;
    }



    public function generatePassword($l = 8, $c = 0, $n = 0, $s = 0) {
        // get count of all required minimum special chars
        $count = $c + $n + $s;
        $out = '';
        // sanitize inputs; should be self-explanatory
        if(!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
            trigger_error('Argument(s) not an integer', E_USER_WARNING);
            return false;
        }
        elseif($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
            trigger_error('Argument(s) out of range', E_USER_WARNING);
            return false;
        }
        elseif($c > $l) {
            trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
            return false;
        }
        elseif($n > $l) {
            trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
            return false;
        }
        elseif($s > $l) {
            trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
            return false;
        }
        elseif($count > $l) {
            trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
            return false;
        }

        // all inputs clean, proceed to build password

        // change these strings if you want to include or exclude possible password characters
        $chars = "abcdefghijklmnopqrstuvwxyz";
        $caps = strtoupper($chars);
        $nums = "0123456789";
        $syms = "!@#$%^&*()-+?";

        // build the base password of all lower-case letters
        for($i = 0; $i < $l; $i++) {
            $out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }

        // create arrays if special character(s) required
        if($count) {
            // split base password to array; create special chars array
            $tmp1 = str_split($out);
            $tmp2 = array();

            // add required special character(s) to second array
            for($i = 0; $i < $c; $i++) {
                array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
            }
            for($i = 0; $i < $n; $i++) {
                array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
            }
            for($i = 0; $i < $s; $i++) {
                array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
            }

            // hack off a chunk of the base password array that's as big as the special chars array
            $tmp1 = array_slice($tmp1, 0, $l - $count);
            // merge special character(s) array with base password array
            $tmp1 = array_merge($tmp1, $tmp2);
            // mix the characters up
            shuffle($tmp1);
            // convert to string for output
            $out = implode('', $tmp1);
        }

        return $out;
    }

    public function getUsersTable()
    {
        if (!$this->usersTable) {
            $sm = $this->getServiceLocator();
            $this->usersTable = $sm->get('Auth\Model\UsersTable');
        }
        return $this->usersTable;
    }

    

    // ToDo Ask yourself
    // 1) do we need a separate Entity Registration to handle registration
    // 2) do we have to use form
    // 3) do we have to use User Entity and do what we are doing here. Manually adding removing elements
    // Is not completed
    public function getRegistrationForm($entityManager, $user)
    {
        $builder = new DoctrineAnnotationBuilder($entityManager);
        $form = $builder->createForm( $user );
        $form->setHydrator(new DoctrineHydrator($entityManager,'Auth\Entity\User'));
        $filter = $form->getInputFilter();
        $form->remove('usrlId');
        $form->remove('lngId');
        $form->remove('usrPicture');
        $form->remove('usrRegistrationDate');

        $form->add(array(
            'name' => 'usrPasswordConfirm',
            'attributes' => array(
                'type'  => 'password',
            ),
            'options' => array(
                'label' => 'Confirm Password',
            ),
        ));

        $form->add(array(
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => array(
                'label' => 'Please verify you are human',
                'captcha' => new \Zend\Captcha\Figlet(),
            ),
        ));

        $send = new Element('submit');
        $send->setValue('Register'); // submit
        $send->setAttributes(array(
            'type'  => 'submit'
        ));
        $form->add($send);
        // ...
        return $form;
    }
}