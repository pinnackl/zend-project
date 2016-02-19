<?php
namespace Cms\Controller;

use Cms\Form\PageFilter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Form\FormInterface,
    Cms\Form\PageForm,
    Cms\Entity\Page,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Query;

use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;

/**
 * Controller des Pages
 */
class PageController extends AbstractActionController
{
    protected $pagesTable = null;
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
        $resultSet = $this->getEntityManager()->getRepository('Cms\Entity\Page')->findAll();

        return new ViewModel(array(
            'pages' => $resultSet,
        ));
    }

    public function addAction()
    {
        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        //Vérifie le type de la requête
        $form = new PageForm();
        $request = $this->getRequest();

        //Initialise la liste des categories
        $categories = $this->getEntityManager()->getRepository('Cms\Entity\Category')->findAll();
        $options = array(""=>"");
        foreach($categories as $cat) {
            $options[$cat->getCtgrId()] = $cat->getCtgrName();
        }
        $form->setCategories($options);

        $menus = $this->getEntityManager()->getRepository('Cms\Entity\Menu')->findAll();
        $articles = $this->getEntityManager()->getRepository('Cms\Entity\Article')->findAll();

        $options = array(""=>"");
        foreach($menus as $menu) {
            $options[$menu->getMenuId()] = $menu->getMenuName();
        }
//        $form->setMenus($options);

        if ($request->isPost()) {
            $form->setInputFilter(new PageFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                unset($data['submit']);
                $this->getPagesTable()->insert($data);
                return $this->redirect()->toRoute('cms/default', array('controller' => 'page', 'action' => 'index'));
            }
        }
        return array(   'form' => $form,
                        'articles' => $articles,
                        'menus' => $menus
                    );
    }

    public function editAction()
    {
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        if(!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        //Si l'Id est vie on redirige vers l'ajout
        if (!$id) {
            return $this->redirect()->toRoute('page', array('action'=>'add'));
        }
        //Sinon on charge la page correspondant à l'Id
        $page = $this->getEntityManager()->find('Cms\Entity\Page', $id);
        $form = new PageForm();

        //Initialise la liste des categories
        $categories = $this->getEntityManager()->getRepository('Cms\Entity\Category')->findAll();
        $options = array(""=>"");
        foreach($categories as $cat) {
            $options[$cat->getCtgrId()] = $cat->getCtgrName();
        }
        $form->setCategories($options);
        $form->bind($page);

        $form->get('ctgr_id')->setValue($page->getCategory() != null ? $page->getCategory()->getCtgrId() : '');
        $menus = $this->getEntityManager()->getRepository('Cms\Entity\Menu')->findAll();
        $articles = $this->getEntityManager()->getRepository('Cms\Entity\Article')->findAll();

        $options = array(""=>"");
        foreach($menus as $menu) {
            $options[$menu->getMenuId()] = $menu->getMenuName();
        }
//        $form->setMenus($options);
//        $form->get('menu_id')->setValue($page->getMenu() != null ? $page->getMenu()->getMenuId() : '');

        $request = $this->getRequest();
        //Vérifie le type de la requête
        if ($request->isPost()) {
            $form->setData($request->getPost());
            //Contrôle les champs
            if ($form->isValid()) {
                $categoryId = $form->get('ctgr_id')->getValue();
                $form->bindValues();
                $category = null;
                if (!empty($categoryId)) {
                    $category = $this->getEntityManager()->find('Cms\Entity\Category', $categoryId);
                }
                $page->setCategory($category);
                $this->getEntityManager()->flush();

                //Redirection vers la liste des pages
                return $this->redirect()->toRoute('cms/default', array('controller' => 'page', 'action' => 'index'));
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id) {
            return $this->redirect()->toRoute('cms/default', array('controller' => 'page', 'action' => 'index'));
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
            return $this->redirect()->toRoute('cms/default', array('controller' => 'page', 'action' => 'index'));
        }
        return array(
            'id' => $id,
            'page' => $this->getEntityManager()->find('Cms\Entity\Page', $id)
        );
    }

    public function viewAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id) {
            return $this->redirect()->toRoute('page');
        }
        try{
            $page = $this->getEntityManager()->find('Cms\Entity\Page', $id);
            //var_dump(json_decode($page->block_element));
        }

        //Récupérer les éléments json to block_element
        //$menu = $this->getEntityManager()->find('Cms\Entity\Menu', $id);
        //$articles = $this->getEntityManager()->find('Cms\Entity\Article', $id);

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

    public function getPagesTable()
    {
        if (!$this->pagesTable) {
            $this->pagesTable = new TableGateway(
                'pages',
                $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
            );
        }
        return $this->pagesTable;
    }
}