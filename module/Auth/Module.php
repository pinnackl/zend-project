<?php

namespace Auth;

use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\ServiceManager\ServiceManager;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


    public function getServiceConfig()
    {
        return array(
//-			'aliases' => array( // !!! aliases not alias
//-				'Zend\Authentication\AuthenticationService' => 'doctrine_authenticationservice', // aliases can be overwriten
//-			),
            'factories' => array(
                // taken from DoctrineModule on GitHub
                // Please note that Iam using here a Zend\Authentication\AuthenticationService name, but it can be anything else
                // However, using the name Zend\Authentication\AuthenticationService will allow it to be recognised by the ZF2 view helper.
                // the configuration of doctrine.authenticationservice.orm_default is in module.config.php
                'Zend\Authentication\AuthenticationService' => function($serviceManager) {
//-				'doctrine_authenticationservice'  => function($serviceManager) {
                    // If you are using DoctrineORMModule:
                    return $serviceManager->get('doctrine.authenticationservice.orm_default');
                    // If you are using DoctrineODMModule:
                    //- return $serviceManager->get('doctrine.authenticationservice.odm_default');
                },
                // Add this for SMTP transport
                // ToDo move it ot a separate module CsnMail
                'mail.transport' => function (ServiceManager $serviceManager) {
                    $config = $serviceManager->get('Config');
                    $transport = new Smtp();
                    $options   = new SmtpOptions(array(
                        'name' => 'localhost.localdomain',
                        'host' => '127.0.0.1',
                        'port' => 25,
                    ));
                    $transport->setOptions($options);
                    //$transport->setOptions(new SmtpOptions($config['mail']['transport']['options']));
                    return $transport;
                },
            )
        );
    }

}
