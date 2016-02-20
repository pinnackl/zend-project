<?php
namespace Cms\Controller;

use Auth\Controller\MailController;
use Auth\Entity\User;
use Auth\Form\UserFilter;
use Auth\Form\UserForm;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Query;

// Doctrine Annotations
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;

use Zend\Db\TableGateway\TableGateway;

use Zend\Crypt\Password\Bcrypt;

/**
 * Controller des User
 */
class UserController extends AbstractActionController
{
    protected $usersTable = null;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    /**
     * Action index récupère tous les enregistrements et les stocke
     * dans un ViewModel pour les transmettre à la vue
     */
    public function indexAction()
    {
        $resultSet = $this->getEntityManager()->getRepository('Auth\Entity\User')->findAll();

        return new ViewModel(array(
            'users' => $resultSet,
        ));
    }

    public function addAction()
    {

        $entityManager = $this->getEntityManager();
        $user = new User;
        //1)  A lot of work to manualy change the form add fields etc. Better use a form class
//-		$form = $this->getRegistrationForm($entityManager, $user);

        // 2) Better use a form class
        $form = new UserForm();
        $form->get('submit')->setValue('Register');
        $form->setHydrator(new DoctrineHydrator($entityManager,'Aut\Entity\User'));

        $form->bind($user);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter(new UserFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->prepareData($user);

                $entityManager->persist($user);
                $entityManager->flush();

                $mail = new MailController();
                $mail->initMail('accountCreated',$user->getUsrEmail(),$user->getUsrEmail());

                return $this->redirect()->toRoute('cms/default', array('controller'=>'user', 'action'=>'index'));
            }
        }
        return new ViewModel(array('form' => $form));

//
//        $form->setData($request->getPost());
//        if ($form->isValid()) {
//            //$this->prepareData($user);
//
//            if ($form->isValid()) {
//                $data = $form->getData();
//                unset($data['submit']);
//                if (empty($data['user_registration_date'])) $data['user_registration_date'] = '2013-07-19 12:00:00';
//                $this->getUsersTable()->insert($data);
//                return $this->redirect()->toRoute('cms/default', array('controller' => 'user', 'action' => 'index'));
//            }
//        }
//        return new ViewModel(array('form' => $form));
    }


    public function updateAction()
    {
        $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('auth/default', array('controller' => 'admin', 'action' => 'index'));
        $form = new UserForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter(new UserFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                unset($data['submit']);
                if (empty($data['user_registration_date'])) $data['user_registration_date'] = '2013-07-19 12:00:00';
                $this->getUsersTable()->update($data, array('user_id' => $id));
                return $this->redirect()->toRoute('auth/default', array('controller' => 'admin', 'action' => 'index'));
            }
        }
        else {
            $form->setData($this->getUsersTable()->select(array('user_id' => $id))->current());
        }

        return new ViewModel(array('form' => $form, 'id' => $id));
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        if ($id) {
            $this->getUsersTable()->delete(array('user_id' => $id));
        }

        return $this->redirect()->toRoute('cms/default', array('controller' => 'user', 'action' => 'index'));
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
        // I have a Table data Gateway ready to go right out of the box
        if (!$this->usersTable) {
            $this->usersTable = new TableGateway(
                'users',
                $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
            );
        }
        return $this->usersTable;
    }

}