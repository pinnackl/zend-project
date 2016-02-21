<?php

namespace Authorize;

// for Acl
use Authorize\Acl\Acl;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
	
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
	
	public function onBootstrap(\Zend\EventManager\EventInterface $e) // use it to attach event listeners
	{
		$application = $e->getApplication();
		$em = $application->getEventManager();
		$em->attach('route', array($this, 'onRoute'), -100);
	}
	
	// WORKING the main engine for ACL
	public function onRoute(\Zend\EventManager\EventInterface $e)
	{
		$application = $e->getApplication();
		$routeMatch = $e->getRouteMatch();
		$sm = $application->getServiceManager();
		$auth = $sm->get('Zend\Authentication\AuthenticationService');
		$config = $sm->get('Config');
		$acl = new Acl($config);
		// everyone is guest untill it gets logged in
		$role = Acl::DEFAULT_ROLE; // The default role is guest $acl
		// with Doctrine
		if ($auth->hasIdentity()) {
			$user = $auth->getIdentity();
			$usrlId = $user->getUsrlId(); // Use a view to get the name of the role
				// TODO we don't need that if the names of the roles are comming from the DB
				switch ($usrlId) {
					case 1 :
						$role = Acl::DEFAULT_ROLE; // guest
						break;
					case 2 :
						$role = 'member';
						break;
					case 3 :
						$role = 'admin';
						break;
					default :
						$role = Acl::DEFAULT_ROLE; // guest
						break;
			}
		}

		$controller = $routeMatch->getParam('controller');
		$action = $routeMatch->getParam('action');

		if (!$acl->hasResource($controller)) {
			throw new \Exception('Resource ' . $controller . ' not defined');
		}
		
		if (!$acl->isAllowed($role, $controller, $action)) {
			$url = $e->getRouter()->assemble(array(), array('name' => 'home'));
			$response = $e->getResponse();

			$response->getHeaders()->addHeaderLine('Location', $url);
			$response->setStatusCode(302);
			$response->sendHeaders();
			exit;
		}
	}
}