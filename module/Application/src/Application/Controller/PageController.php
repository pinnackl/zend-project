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

use Zend\Form\Element;
use Zend\Stdlib\Hydrator;

class PageController extends AbstractActionController
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
            $page = $this->getEntityManager()->find('Cms\Entity\Page', $id);
        }
        catch(\Exception $e){
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

        $menus = [];
        $articles = [];
        $stuctureElements = json_decode($page->block_element);
        if($stuctureElements) {
            foreach($stuctureElements as $structureElt) {
                switch($structureElt->element_type) {
                    case 'menu':
                        $menu = $this->getEntityManager()->find('Cms\Entity\Menu', $structureElt->element_id);
                        $menus[] = $menu;
                        break;
                    case 'article':
                        $article = $this->getEntityManager()->find('Cms\Entity\Article', $structureElt->element_id);
                        $articles[] = $article;
                        break;
                }
            }
        }

        return new ViewModel(array(
            'page' => $page,
            'menus' => $menus,
            'articles' => $articles,
        ));
    }
}
