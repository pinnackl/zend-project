<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Cms\Entity\Comment;
use Cms\Form\CommentForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Form\Element;

// hydration tests
use Zend\Stdlib\Hydrator;

// for Doctrine annotation
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;

class ArticleController extends AbstractActionController
{

    protected $em;
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function viewAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id) {
            return $this->redirect()->toRoute('home');
        }
        try{
            $article = $this->getEntityManager()->find('Cms\Entity\Article', $id);
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

//        $dql ="SELECT p FROM Cms\Entity\Page p WHERE p.category = ".$id;
//        $query = $this->getEntityManager()->createQuery($dql);
//        $pages = $query->getResult();

        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $comment = new Comment;

        $form = new CommentForm();
        $form->remove('comCreated');
        $form->remove('author');
        $form->remove('article');

        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        if ($auth->hasIdentity()) {
            $form->remove('com_email');
            $form->remove('com_author');
        }

        foreach ($form->getElements() as $element){
            if(method_exists($element, 'getProxy')){
                $proxy = $element->getProxy();
                if(method_exists($proxy, 'setObjectManager')){
                    $proxy->setObjectManager($entityManager);
                }
            }
        }

        $form->setHydrator(new DoctrineHydrator($entityManager,'Cms\Entity\Comment'));
        $form->bind($comment);

        $request = $this->getRequest();

        return new ViewModel(array(
            'article' => $article,
            'form' => $form,
        ));
    }
}
