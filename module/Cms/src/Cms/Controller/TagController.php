<?php
namespace Cms\Controller;


use Cms\Form\TagFilter;
use Cms\Form\TagForm;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Query;
/**
 * Controller des Tags
 */
class TagController extends AbstractActionController
{
    protected $tagsTable = null;
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
        $resultSet = $this->getEntityManager()->getRepository('Cms\Entity\Tag')->findAll();
        return new ViewModel(array(
            'tags' => $resultSet,
        ));
    }
    public function addAction()
    {

        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        if(!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }

        $form = new TagForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter(new TagFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                unset($data['submit']);
                $this->getTagsTable()->insert($data);
                return $this->redirect()->toRoute('cms/default', array('controller' => 'tag', 'action' => 'index'));
            }
        }
        return new ViewModel(array('form' => $form));
    }
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('cms/default', array('controller' => 'tag', 'action' => 'index'));

        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {
            $repository = $entityManager->getRepository('Cms\Entity\Tag');
            $tag = $repository->find($id);
            $entityManager->remove($tag);
            $entityManager->flush();
        }
        catch (\Exception $ex) {
            echo $ex->getMessage(); // this never will be seen fi you don't comment the redirect
            return $this->redirect()->toRoute('cms/default', array('controller' => 'tag', 'action' => 'index'));
        }
        return $this->redirect()->toRoute('cms/default', array('controller' => 'tag', 'action' => 'index'));
    }

    public function getTagsTable()
    {
        // I have a Table data Gateway ready to go right out of the box
        if (!$this->tagsTable) {
            $this->tagsTable = new TableGateway(
                'tags',
                $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
            );
        }
        return $this->tagsTable;
    }
}
