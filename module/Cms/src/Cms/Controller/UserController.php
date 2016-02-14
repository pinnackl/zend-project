<?php
namespace Cms\Controller;

use Auth\Form\UserFilter;
use Auth\Form\UserForm;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Query;


use Zend\Db\TableGateway\TableGateway;

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
        var_dump('coucou');

            $resultSet = $this->getEntityManager()->getRepository('Auth\Entity\User')->findAll();

            return new ViewModel(array(
                'users' => $resultSet,
            ));


    }

    public function addAction()
    {
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        if(!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }

        $form = new UserForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter(new UserFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                unset($data['submit']);
                if (empty($data['user_registration_date'])) $data['user_registration_date'] = '2013-07-19 12:00:00';
                $this->getUsersTable()->insert($data);
                return $this->redirect()->toRoute('user', array('controller' => 'user', 'action' => 'index'));
            }
        }
        return new ViewModel(array('form' => $form));
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

    // D - delete
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        if ($id) {
            $this->getUsersTable()->delete(array('user_id' => $id));
        }

        return $this->redirect()->toRoute('auth/default', array('controller' => 'admin', 'action' => 'index'));
    }

    public function viewAction()
    {
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        if(!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        //Si l'Id est vie on redirige vers la liste
        if (!$id) {
            return $this->redirect()->toRoute('page');
        }
        try{
            //Sinon on charge la page correspondant à l'Id
            $page = $this->getEntityManager()->find('Cms-old\Entity\Page', $id);
        }
        catch(\Exception $e){
            //Si la page n'existe pas en base on génère une erreur 404
            $response   = $this->response;
            $event	  = $this->getEvent();
            $routeMatch = $event->getRouteMatch();
            $response->setStatusCode(404);
            $event->setParam('exception', new \Exception('Page Inconnue'.$id));
            $event->setController('page');
            return ;
        }
        return new ViewModel(array(
            'page' => $page
        ));
    }


    public function getUsersTable()
    {
        // I have a Table data Gateway ready to go right out of the box
        if (!$this->usersTable) {
            $this->usersTable = new TableGateway(
                'users',
                $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
//				new \Zend\Db\TableGateway\Feature\RowGatewayFeature('user_id') // Zend\Db\RowGateway\RowGateway Object
//				ResultSetPrototype
            );
        }
        return $this->usersTable;
    }

}