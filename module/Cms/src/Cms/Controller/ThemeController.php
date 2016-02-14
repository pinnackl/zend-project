<?php
namespace Cms\Controller;

use Cms\Form\PageFilter;
use Cms\Form\ThemeFilter;
use Cms\Form\ThemeForm;
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
class ThemeController extends AbstractActionController
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
        $resultSet = $this->getEntityManager()->getRepository('Cms\Entity\Theme')->findAll();

        return new ViewModel(array(
            'themes' => $resultSet,
        ));
    }

    public function activeAction()
    {
        $id = $this->params()->fromRoute('id');

        $user_id = $this->identity()->getUsrId();

        $data = ['user_theme_id' => $id];

        $this->getUsersTable()->update($data, array('user_id' => $user_id));

        return $this->redirect()->toRoute('cms/default', array('controller' => 'theme', 'action' => 'index'));
    }

    public function desactiveAction()
    {
        $id = $this->params()->fromRoute('id');

        $user_id = $this->identity()->getUsrId();

        $data = ['user_theme_id' => $id];

        $this->getUsersTable()->update($data, array('user_id' => $user_id));

        return $this->redirect()->toRoute('cms/default', array('controller' => 'theme', 'action' => 'index'));
    }


    public function getUsersTable()
    {
        if (!$this->usersTable) {
            $this->usersTable = new TableGateway(
                'users',
                $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
            );
        }
        return $this->usersTable;
    }

}