<?php

namespace Cms\Controller;

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

use Cms\Entity\Article;

class IndexController extends AbstractActionController
{
	// R - retriev
    public function indexAction()
	{
		$entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		$dql = "SELECT a, u, l, c FROM Cms\Entity\Article a LEFT JOIN a.author u LEFT JOIN a.language l LEFT JOIN a.categories c LEFT JOIN a.tags t WHERE a.parent IS NULL";
		$query = $entityManager->createQuery($dql);
		$query->setMaxResults(30);
		$articles = $query->getResult();

		return new ViewModel(array('articles' => $articles));
	}

    public function addAction()
	{
		$entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		$article = new Article;
		$form = $this->getForm($article, $entityManager, 'Add');
		
		$form->bind($article);

		$form->get('language')->setAttribute('class', 'browser-default');
		$form->get('resource')->setAttribute('class', 'browser-default');
		$form->get('categories')->setAttributes(array('class'=> 'browser-default', 'style'=> 'height:100px'));
		$form->get('tags')->setAttributes(array('class'=> 'browser-default', 'style'=> 'height:100px'));
		
        $request = $this->getRequest();

        if ($request->isPost()) {
			$files = $request->getFiles()->toArray();
			$httpadapter = new \Zend\File\Transfer\Adapter\Http();
			$filesize = new \Zend\Validator\File\Size(array('min' => 1000)); //1KB
			$extension = new \Zend\Validator\File\Extension(array('extension' => array('png')));
			$httpadapter->setValidators(array($filesize, $extension), $files['art_image_filename']['name']);
			if ($httpadapter->isValid()) {
				$route = $httpadapter->setDestination('public/article/');

				if ($httpadapter->receive($files['art_image_filename']['name'])) {
					$newfile = $httpadapter->getFileName();
				}
			}

			$post = $request->getPost();
			$form->setData($post);

			if ($form->isValid()) {
				$data = $form->getData();
				$article->setArtcImageFilename($files['art_image_filename']['name']);
				$this->prepareData($article);
				$entityManager->persist($article);
				$entityManager->flush();
				return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));
			}
		}
		return new ViewModel(array('form' => $form));
	}

	// U - update
    public function editAction()
	{
		$id = $this->params()->fromRoute('id');
		if (!$id) return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));

		$entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		
        try {
			$repository = $entityManager->getRepository('Cms\Entity\Article');
			$article = $repository->find($id);
        }
        catch (\Exception $ex) {
			echo $ex->getMessage(); // this never will be seen fi you don't comment the redirect
			return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));
        }
		
		$form = $this->getForm($article, $entityManager, 'Update');
		$form->get('language')->setAttribute('class', 'browser-default');
		$form->get('categories')->setAttributes(array('class'=> 'browser-default', 'style'=> 'height:100px'));
        $form->get('tags')->setAttributes(array('class'=> 'browser-default', 'style'=> 'height:100px'));

		$form->bind($article);
		
        $request = $this->getRequest();
        if ($request->isPost()) {
			$post = $request->getPost();
			// uncooment and fix if you want to control the date and time
//			$post->artcCreated = $post->artcCreatedDate . ' ' . $post->artcCreatedTime;
			$form->setData($post);
			 if ($form->isValid()) {
//				$this->prepareData($article);
				$entityManager->persist($article);
				$entityManager->flush();
                return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));
			 }
		}
		return new ViewModel(array('form' => $form, 'id' => $id));
	}		
	
	// D - delete
    public function deleteAction()
	{
		$id = $this->params()->fromRoute('id');
		if (!$id) return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));

		$entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		
        try {
			$repository = $entityManager->getRepository('Cms\Entity\Article');
			$article = $repository->find($id);
			$entityManager->remove($article);
			$entityManager->flush();			
        }
        catch (\Exception $ex) {
			echo $ex->getMessage(); // this never will be seen fi you don't comment the redirect
			return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));
        }		
		return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));
	}	
	
    public function viewAction()
	{
		$id = $this->params()->fromRoute('id');
		if (!$id) return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));

		$entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		
        try {
			$repository = $entityManager->getRepository('Cms\Entity\Article');
			$article = $repository->find($id);
			if (!is_object($article)) return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));
        }
        catch (\Exception $ex) {
			echo $ex->getMessage(); // this never will be seen fi you don't comment the redirect
			return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));
        }
		
		$sm = $this->getServiceLocator();
		$auth = $sm->get('Zend\Authentication\AuthenticationService');		
		$config = $sm->get('Config');
		$acl = new \Authorize\Acl\Acl($config);
		// everyone is guest untill it gets logged in
		$role = \Authorize\Acl\Acl::DEFAULT_ROLE;
		if ($auth->hasIdentity()) {
			$user = $auth->getIdentity();
			// ToDo assign Role Onject instead of role id
			$usrlId = $user->getUsrlId(); // Use a view to get the name of the role
				// TODO we don't need that if the names of the roles are comming from the DB
				switch ($usrlId) {
					case 1 :
						$role = \Authorize\Acl\Acl::DEFAULT_ROLE; // guest
						break;
					case 2 :
						$role = 'member';
						break;
					case 3 :
						$role = 'admin';
						break;
					default :
						$role = \Authorize\Acl\Acl::DEFAULT_ROLE; // guest
						break;
			}			
		}

		$resource = $article->getResource()->getRsName();
		$privilege = 'view';
		if (!$acl->hasResource($resource)) {
			throw new \Exception('Resource ' . $resource . ' not defined');
		}
		
		if (!$acl->isAllowed($role, $resource, $privilege)) {
			return $this->redirect()->toRoute('home');	
		}
		
		return new ViewModel(array('article' => $article));
	}
	
	public function getForm($article, $entityManager, $action)
	{
		$builder = new DoctrineAnnotationBuilder($entityManager);
		$form = $builder->createForm( $article );
		$form->setAttribute('enctype', 'multipart/form-data');
		
		//!!!!!! Start !!!!! Added to make the association tables work with select
		foreach ($form->getElements() as $element){
			if(method_exists($element, 'getProxy')){                
				$proxy = $element->getProxy();
				if(method_exists($proxy, 'setObjectManager')){  
					$proxy->setObjectManager($entityManager);
				}
			}           
		}

		//Image article
		$titleField = new Element\File('art_image_filename');
		$titleField->setLabel('Image article');
		$form->add($titleField);

//
//		 $form->add(array(
//			 'type' => 'Zend\Form\Element\Date',
//			 'name' => 'artcCreatedDate',
//			 'options' => array(
//					 'label' => 'Created Date'
//			 ),
//			 'attributes' => array(
//					 'min' => '2012-01-01',
//					 'max' => '2020-01-01',
//					 'step' => '1', // days; default step interval is 1 day
//				 		'class' => 'datepicker'
//			 )
//		 ));
//
//		 $form->add(array(
//			 'type' => 'Zend\Form\Element\Time',
//			 'name' => 'artcCreatedTime',
//			 'options'=> array(
//					 'label' => 'Created Time'
//			 ),
//			 'attributes' => array(
//					 'min' => '00:00:00',
//					 'max' => '23:59:59',
//					 'step' => '60', // seconds; default step interval is 60 seconds
//			 )
//		 ));

		$form->remove('artcCreated');
		$form->remove('parent');
		$form->remove('author');
		$form->setHydrator(new DoctrineHydrator($entityManager,'Cms\Entity\Article'));
		$send = new Element('send');
		$send->setValue($action); // submit
		$send->setAttributes(array(
			'type'  => 'submit',
			'class' => 'btn waves-effect waves-light'
		));
		$form->add($send);

		return $form;		
	}
	
	public function prepareData($article)
	{
		$article->setArtcCreated(new \DateTime());
		$auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		if ($auth->hasIdentity()) {
			$user = $auth->getIdentity();
		}
		$article->setAuthor($user);
	}
}