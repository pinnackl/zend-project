<?php
namespace Cms;
use Zend\ModuleManager\Feature\ServiceProviderInterface,
    Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface;


use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\ServiceManager\ServiceManager;
/**
 * Classe de configuration du Module CMS
 * On implemente les interfaces des fonctionnalités de module que nous allons utiliser
 */
class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Construit la configuration des services
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
            ),
        );
    }
}