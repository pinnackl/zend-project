<?php
namespace Cms\Controller;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Form\FormInterface,
    Cms\Form\CategoryForm,
    Cms\Entity\Category,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Query;
/**
 * Controller des Categories
 */
class CategoryController extends AbstractActionController
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
        $form->get('submit')->setAttribute('label', 'Add');
        $request = $this->getRequest();
        //Vérifie le type de la requête
        if ($request->isPost()) {
            $category = new Category();
            //Initialisation du formulaire à partir des données reçues
            $form->setData($request->getPost());
            //Ajout des filtres de validation basés sur l'objet Category
            $form->setInputFilter($category->getInputFilter());
            //Contrôle les champs
            if ($form->isValid()) {
                $category->exchangeArray($form->getData(FormInterface::VALUES_AS_ARRAY));
                $form->bindValues();
                $this->getEntityManager()->persist($category);
                $this->getEntityManager()->flush();
                //Redirection vers la liste des Categories
                return $this->redirect()->toRoute('category');
            }
        }
        return array('form' => $form);
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
}
