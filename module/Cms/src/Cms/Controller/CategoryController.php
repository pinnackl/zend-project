<?php
namespace Cms\Controller;


use Cms\Form\CategoryFilter;
use Cms\Form\CategoryForm;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Query;
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

            $files =  $request->getFiles()->toArray();
            $httpadapter = new \Zend\File\Transfer\Adapter\Http();
            $filesize  = new \Zend\Validator\File\Size(array('min' => 1000 )); //1KB
            $extension = new \Zend\Validator\File\Extension(array('extension' => array('png')));
            $httpadapter->setValidators(array($filesize, $extension), $files['ctgr_image_filename']['name']);
            if($httpadapter->isValid()) {
                $route = $httpadapter->setDestination('public/uploads/');

                if($httpadapter->receive($files['ctgr_image_filename']['name'])) {
                    $newfile = $httpadapter->getFileName();
                }
            }

            if ($form->isValid()) {
                $data = $form->getData();
                $data['ctgr_image_filename'] = $data['ctgr_image_filename']['name'];
                unset($data['submit']);
                $this->getCategoriesTable()->insert($data);
                return $this->redirect()->toRoute('cms/default', array('controller' => 'category', 'action' => 'index'));
            }
        }
        return new ViewModel(array('form' => $form));
    }
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('cms/default', array('controller' => 'category', 'action' => 'index'));

        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {
            $repository = $entityManager->getRepository('Cms\Entity\Category');
            $category = $repository->find($id);
            $entityManager->remove($category);
            $entityManager->flush();
        }
        catch (\Exception $ex) {
            echo $ex->getMessage(); // this never will be seen fi you don't comment the redirect
            return $this->redirect()->toRoute('cms/default', array('controller' => 'category', 'action' => 'index'));
        }
        return $this->redirect()->toRoute('cms/default', array('controller' => 'category', 'action' => 'index'));
    }

    public function getCategoriesTable()
    {
        // I have a Table data Gateway ready to go right out of the box
        if (!$this->categoriesTable) {
            $this->categoriesTable = new TableGateway(
                'categories',
                $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
            );
        }
        return $this->categoriesTable;
    }
}
