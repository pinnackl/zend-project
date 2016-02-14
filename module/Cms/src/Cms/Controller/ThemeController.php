<?php
namespace Cms\Controller;

use Cms\Form\PageFilter;
use Cms\Form\ThemeFilter;
use Cms\Form\ThemeForm;
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

    public function addAction()
    {
        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        //Vérifie le type de la requête
        $form = new ThemeForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter(new ThemeFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                unset($data['submit']);

                $this->getCategoriesTable()->insert($data);
                return $this->redirect()->toRoute('theme', array('controller' => 'theme', 'action' => 'index'));
            }
        }
        return array('form' => $form);
    }

}