<?php
namespace Cms\Controller;
use Cms\Form\CategoryFilter;
use Cms\Form\CategoryForm;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Form\FormInterface,
    Cms\Entity\Category,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Query;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;
/**
 * Controller des Categories
 */
class CategoryController extends AbstractActionController
{
    protected $categoriesTable = null;
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
        $resultSet = $this->getEntityManager()->getRepository('Cms\Entity\Category')->findAll();
        return new ViewModel(array(
            'categories' => $resultSet,
        ));
    }
    public function addAction()
    {

        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        if(!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }

        $form = new CategoryForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter(new CategoryFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                unset($data['submit']);

                $this->getCategoriesTable()->insert($data);
                return $this->redirect()->toRoute('category', array('controller' => 'category', 'action' => 'index'));
            }
        }
        return new ViewModel(array('form' => $form));
    }
    public function deleteAction()
    {
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        if(!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id) {
            return $this->redirect()->toRoute('category');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');
            if ($del == 'Oui') {
                $id = (int)$request->getPost('id');
                $category = $this->getEntityManager()->find('Cms\Entity\Category', $id);
                if ($category) {
                    $this->getEntityManager()->remove($category);
                    $this->getEntityManager()->flush();
                }
            }
            //Redirection vers la liste des Categories
            return $this->redirect()->toRoute('category');
        }
        return array(
            'id' => $id,
            'category' => $this->getEntityManager()->find('Cms\Entity\Category', $id)
        );
    }

    public function getCategoriesTable()
    {
        // I have a Table data Gateway ready to go right out of the box
        if (!$this->categoriesTable) {
            $this->categoriesTable = new TableGateway(
                'categories',
                $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
//				new \Zend\Db\TableGateway\Feature\RowGatewayFeature('user_id') // Zend\Db\RowGateway\RowGateway Object
//				ResultSetPrototype
            );
        }
        return $this->categoriesTable;
    }
}
