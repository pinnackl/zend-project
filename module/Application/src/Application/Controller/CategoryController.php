<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Form\Annotation\AnnotationBuilder;

use Zend\Form\Element;

// hydration tests
use Zend\Stdlib\Hydrator;

// for Doctrine annotation
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;

//- use Doctrine\Common\Persistence\ObjectManager;

class CategoryController extends AbstractActionController
{


    public function viewAction()
    {
        var_dump('dans view category');
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        var_dump($id);
        die();
        if (!$id) {
            return $this->redirect()->toRoute('home');
        }
        try{
            $category = $this->getEntityManager()->find('Cms\Entity\Category', $id);
        }
        catch(\Exception $e){
            //Si la page n'existe pas en base on génère une erreur 404
            $response   = $this->response;
            $event	  = $this->getEvent();
            $routeMatch = $event->getRouteMatch();
            $response->setStatusCode(404);
            $event->setParam('exception', new \Exception('Page Inconnue'.$id));
            $event->setController('page');
            var_dump('dans catch');
            die();
            return ;
        }
//        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
//        $dql = "SELECT ctgr_id FROM Cms\Entity\Page p WHERE p.ctgr_id= ". $id;
//        var_dump($dql);
//
//        $query = $entityManager->createQuery($dql);
//        $query->setMaxResults(30);
//        $pages = $query->getResult();
        $resultSet = $this->getEntityManager()->getRepository('Cms\Entity\Category')->findBy(['ctgr_id'=> $id]);
        var_dump($resultSet);
        return new ViewModel(array(
            'category' => $category,
        ));
    }
}