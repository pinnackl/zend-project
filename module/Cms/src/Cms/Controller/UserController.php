<?php
namespace Cms\Controller;

use Auth\Entity\User;
use Auth\Form\UserFilter;
use Auth\Form\UserForm;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Form\FormInterface,
    Cms\Form\PageForm,
    Cms\Entity\Page,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Query;

/**
 * Controller des Pages
 */
class UserController extends AbstractActionController
{

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
        $form = new UserForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter(new UserFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                unset($data['submit']);
                if (empty($data['usr_registration_date'])) $data['usr_registration_date'] = '2013-07-19 12:00:00';
                $this->getUsersTable()->insert($data);
                return $this->redirect()->toRoute('auth/default', array('controller' => 'admin', 'action' => 'index'));
            }
        }
        return new ViewModel(array('form' => $form));

    }

    public function editAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        //Si l'Id est vie on redirige vers l'ajout
        if (!$id) {
            return $this->redirect()->toRoute('page', array('action'=>'add'));
        }
        //Sinon on charge la page correspondant à l'Id
        $page = $this->getEntityManager()->find('Cms\Entity\Page', $id);
        $form = new PageForm();


        //On charge ces données dans le formulaire initialise aussi les InputFilter
        $form->setBindOnValidate(false);
        $form->bind($page);

        $form->get('category_id')->setValue($page->getCategory() != null ? $page->getCategory()->getId() : '');
        $form->get('submit')->setAttribute('label', 'Edit');
        $request = $this->getRequest();

        //Vérifie le type de la requête
        if ($request->isPost()) {
            $form->setData($request->getPost());
            //Contrôle les champs
            if ($form->isValid()) {
                $categoryId = $form->get('category_id')->getValue();
                $form->bindValues();
                $category = null;
                if (!empty($categoryId)) {
                    $category = $this->getEntityManager()->find('Cms\Entity\Category', $categoryId);
                }
                $page->setCategory($category);
                $this->getEntityManager()->flush();

                //Redirection vers la liste des pages
                return $this->redirect()->toRoute('page');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id) {
            return $this->redirect()->toRoute('page');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');
            if ($del == 'Oui') {
                $id = (int)$request->getPost('id');
                $page = $this->getEntityManager()->find('Cms\Entity\Page', $id);
                if ($page) {
                    $this->getEntityManager()->remove($page);
                    $this->getEntityManager()->flush();
                }
            }

            //Redirection vers la liste des pages
            return $this->redirect()->toRoute('page');
        }
        return array(
            'id' => $id,
            'page' => $this->getEntityManager()->find('Cms\Entity\Page', $id)
        );
    }

    public function viewAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        //Si l'Id est vie on redirige vers la liste
        if (!$id) {
            return $this->redirect()->toRoute('page');
        }
        try{
            //Sinon on charge la page correspondant à l'Id
            $page = $this->getEntityManager()->find('Cms\Entity\Page', $id);
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
}