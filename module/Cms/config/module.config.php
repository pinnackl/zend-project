<?php
namespace Cms;
return array(
    'router' => array(
        'routes' => array(
            //Page Controller
            'page' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/page[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'cms/page',
                        'action'     => 'index',
                    ),
                ),
            ),
            //Category Controller
            'category' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/category[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'cms/category',
                        'action'     => 'index',
                    ),
                ),
            ),

            //User Controller
            'user' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/user[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'cms/user',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),


    'controllers' => array(
        'invokables' => array(
            'cms/page' => 'Cms\Controller\PageController',
            'cms/category' => 'Cms\Controller\CategoryController',
            'cms/user' => 'Cms\Controller\UserController',
        ),
    ),


    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/cms/index/index.phtml',


        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),

        /**
         * Generating proxies on runtime and using array cache instead of apc(u)
         * greatly reduces the performance. So, you may want to override
         * this settings on production environment.
         */
        'configuration' => array(
            'orm_default' => array(
                'proxy_dir' => 'data/DoctrineORMModule/Proxy',
                'proxy_namespace' => 'DoctrineORMModule\Proxy',
            ),
        ),
    ),
);