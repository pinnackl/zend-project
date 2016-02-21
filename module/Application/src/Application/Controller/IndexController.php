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

use Zend\Tag\ItemList;
use Zend\Tag\Item;

class IndexController extends AbstractActionController
{

    protected $em;
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction()
    {
        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $dql = "SELECT a, u, l, c FROM Cms\Entity\Article a LEFT JOIN a.author u LEFT JOIN a.language l LEFT JOIN a.categories c WHERE a.parent IS NULL";
        $query = $entityManager->createQuery($dql);
        $query->setMaxResults(30);
        $articles = $query->getResult();
        
        $tags = $this->getEntityManager()->getRepository('Cms\Entity\Tag')->findAll();
        $list = new ItemList();
        foreach ($tags as $tag)
        {
            $list[] = new Item(array('title' => $tag->getTagName(), 'weight' => count($tag->getArticles()), 'params' => array('id' => $tag->getTagId())));
        }
        
        $list->spreadWeightValues(array(55, 60, 65, 70, 75, 80, 85, 90, 95, 100));
        
        $resultSet = $this->getEntityManager()->getRepository('Cms\Entity\Category')->findAll();
            return new ViewModel(array(
            'categories' => $resultSet,
            'list' => $list,
        ));

        return new ViewModel(array('articles' => $articles));
    }

}
