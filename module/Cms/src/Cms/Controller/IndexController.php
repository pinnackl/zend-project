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

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        var_dump('kikoo');
        $message = $this->params()->fromQuery('name', 'world');
        return ['message' => ''.$message] ;
    }

    public function helloAction()
    {
        $message = $this->params()->fromQuery('name', 'world');
        return ['message' => 'hello'.$message];
    }
}
