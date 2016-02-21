<?php

namespace Cms\Controller;

use Cms\Form\CommentForm;
use Zend\Db\TableGateway\TableGateway;
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

use Auth\Controller\MailController;

use Cms\Entity\Comment;

class CommentController extends AbstractActionController
{
	protected $commentsTable = null;


    public function indexAction()
	{
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));
		$entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');	
		$dql = "SELECT c, u, l, a  FROM Cms\Entity\Comment c LEFT JOIN c.author u LEFT JOIN c.language l LEFT JOIN c.article a WHERE a.artcId = ?1";
		$query = $entityManager->createQuery($dql);
		$query->setMaxResults(30);
		$query->setParameter(1, $id);
		// I will get a collection of Articles
		$comments = $query->getResult();	
		return new ViewModel(array(
			'id' => $id,
			'comments' => $comments
		));		        		
	}
	
    public function addAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) return $this->redirect()->toRoute('cms/default', array('controller' => 'index', 'action' => 'index'));
		$entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		$comment = new Comment;
        try {
			$repository = $entityManager->getRepository('Cms\Entity\Article');
			$article = $repository->findOneBy(array('artcId' => $id));			
			$comment->setArticle($article);
        }
        catch (\Exception $ex) {
           return $this->redirect()->toRoute('cms/default', array(
               'controller' => 'index',
				'action' => 'index'
            ));
        }

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
        if ($request->isPost()) {
			 $form->setData($request->getPost());
			  if ($form->isValid()) {
                $data = $form->getData();
                $this->prepareData($comment);
                if (!$auth->hasIdentity()) {
                    $comment->setComUsername($data['com_username']);	
                    $comment->setComEmail($data['com_email']);	
                }
				$entityManager->persist($comment);
				$entityManager->flush();
				
                $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                  
                $admin_id = 3;  
                $sql = "SELECT u.usrEmail, u.usrName FROM Auth\Entity\User u WHERE u.usrlId= ". $admin_id;
                $query = $entityManager->createQuery($sql);
                $admins = $query->getResult();
                  
                $mail = new MailController();
                foreach($admins as $admin)
                {
                    $mail->initMail('commentCreated',$admin['usrEmail'],$admin['usrName'],$article->getArtcTitle());
                }

                return $this->redirect()->toRoute('cms/default', array('controller' => 'comment', 'action' => 'index', 'id' => $id), true);
			  }
		}

        return array(
			'id' => $id,
			'form' => $form
		);		
	}
	
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id2', 0);		
        if (!$id) {
            return $this->redirect()->toRoute('cms/default', array(
                'controller' => 'comment',
				'action' => 'add'
            ), true);
        }
		$entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        try {
			$repository = $entityManager->getRepository('Cms\Entity\Comment');
			$comment = $repository->getCommentForEdit($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('cms/default', array(
                'controller' => 'comment',
				'action' => 'index'
            ), true);
        }			
		
		$builder = new DoctrineAnnotationBuilder($entityManager);
		$form = $builder->createForm( $comment );
		$form->get('language')->setAttribute('class', 'browser-default');
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
		
		$form->setHydrator(new DoctrineHydrator($entityManager,'GraceDrops\Entity\Comment'));
		$send = new Element('send');
		$send->setValue('Edit');
		$send->setAttributes(array(
			'class' => 'btn waves-effect waves-light',
			'type'  => 'submit'
		));
		$form->add($send);
		
		$form->bind($comment);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
				$entityManager->persist($comment);
				$entityManager->flush();

				return $this->redirect()->toRoute('cms/default', array('controller' => 'comment', 'action' => 'index'), true);
            }
        }
		
        return array(
            'id' => $id,
            'form' => $form,
        );		
	}
	
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id2', 0);
        if (!$id) {
			return $this->redirect()->toRoute('cms/default', array('controller' => 'comment', 'action' => 'index'), true);
        }
		
		$entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        try {
			$repository = $entityManager->getRepository('Cms\Entity\Comment');
			$comment = $repository->find($id);
			$entityManager->remove($comment);
			$entityManager->flush();
		}
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('cms/default', array(
				'controller' => 'comment',
                'action' => 'index'
            ), true);
        }		
		return $this->redirect()->toRoute('cms/default', array(
				'controller' => 'comment',
                'action' => 'index'
        ), true);
	}

	public function activeAction()
	{
		$id = $this->params()->fromRoute('id');

		$user_id = $this->identity()->getUsrId();

		$data = ['com_active' => 1];

		$this->getCommentsTable()->update($data, array('user_id' => $user_id));

		return $this->redirect()->toRoute('cms/default', array('controller' => 'comment', 'action' => 'index'));
	}

	public function desactiveAction()
	{
		$id = $this->params()->fromRoute('id');

		$user_id = $this->identity()->getUsrId();

		$data = ['com_active' => 0];

		$this->getCommentsTable()->update($data, array('user_id' => $user_id));

		return $this->redirect()->toRoute('cms/default', array('controller' => 'comment', 'action' => 'index'));
	}
	
	public function prepareData($comment)
	{
		$comment->setComCreated(new \DateTime());
		$auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		if ($auth->hasIdentity()) {
			$user = $auth->getIdentity();
            $comment->setAuthor($user);	
		    $comment->setComEmail($user->getUsrEmail());	
		    $comment->setComUsername($user->getUsrName());	
		}
	}

	public function getCommentsTable()
	{
		if (!$this->commentsTable) {
			$this->commentsTable = new TableGateway(
				'comments',
				$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
			);
		}
		return $this->commentsTable;
	}
}