<?php
namespace Cms\Controller;


use Cms\Form\CategoryFilter;
use Cms\Form\CategoryForm;
use Cms\Form\MenuFilter;
use Cms\Form\MenuForm;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Query;
/**
 * Controller des Menus
 */
class MenuController extends AbstractActionController
{
    protected $menusTable = null;
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
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        if(!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }
        $resultSet = $this->getEntityManager()->getRepository('Cms\Entity\Menu')->findAll();
        return new ViewModel(array(
            'menus' => $resultSet,
        ));
    }
    public function addAction()
    {
        $form = new MenuForm();

        $resultSet = $this->getEntityManager()->getRepository('Cms\Entity\Category')->findAll();

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter(new MenuFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                unset($data['submit']);
                $this->getMenusTable()->insert($data);
                return $this->redirect()->toRoute('cms/default', array('controller' => 'menu', 'action' => 'index'));
            }
        }
        return new ViewModel(array('form' => $form, 'categories' => $resultSet));
    }
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('cms/default', array('controller' => 'category', 'action' => 'index'));

        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {
            $repository = $entityManager->getRepository('Cms\Entity\Menu');
            $category = $repository->find($id);
            $entityManager->remove($category);
            $entityManager->flush();
        }
        catch (\Exception $ex) {
            echo $ex->getMessage(); // this never will be seen fi you don't comment the redirect
            return $this->redirect()->toRoute('cms/default', array('controller' => 'menu', 'action' => 'index'));
        }
        return $this->redirect()->toRoute('cms/default', array('controller' => 'menu', 'action' => 'index'));
    }

    public function activeAction()
    {
        $id = $this->params()->fromRoute('id');

        $user_id = $this->identity()->getUsrId();

        $data = ['com_active' => 1];

        $this->getMenusTable()->update($data, array('user_id' => $user_id));

        return $this->redirect()->toRoute('cms/default', array('controller' => 'comment', 'action' => 'index'));
    }

    public function desactiveAction()
    {
        $id = $this->params()->fromRoute('id');

        $user_id = $this->identity()->getUsrId();

        $data = ['com_active' => 0];

        $this->getMenusTable()->update($data, array('user_id' => $user_id));

        return $this->redirect()->toRoute('cms/default', array('controller' => 'comment', 'action' => 'index'));
    }


    public function getMenusTable()
    {
        // I have a Table data Gateway ready to go right out of the box
        if (!$this->menusTable) {
            $this->menusTable = new TableGateway(
                'menus',
                $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
            );
        }
        return $this->menusTable;
    }
}
