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
                
                $entityManager->persist($user);
                $entityManager->flush();
                
                $mail = new MailController();
                $mail->initMail('accountCreated',$user->getUsrEmail());
                
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
                $user = $entityManager->getRepository('Auth\Entity\User')->findOneBy(array('usrEmail' => $usrEmail)); //
                $password = $this->generatePassword();
                
                $bcrypt = new Bcrypt();
                
                $user->setUsrPassword($bcrypt->create($password));
                $entityManager->persist($user);
                $entityManager->flush();
                
                $mail = new MailController();
                $mail->initMail('forgotPassword',$usrEmail,$password);
                
                return $this->redirect()->toRoute('auth/default', array('controller'=>'registration', 'action'=>'password-change-success'));
            }
        }
        return new ViewModel(array('form' => $form));
    }
    
    public function passwordChangeSuccessAction()
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


    public function prepareData($user)
    {
        $bcrypt = new Bcrypt();
        
        $user->setUsrPassword($bcrypt->create($user->getUsrPassword()));
        $user->setUsrlId(2);
        $user->setLngId(1);
        $user->setUsrRegistrationDate(new \DateTime());
        return $user;
    }



    public function generatePassword($length = 10, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
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