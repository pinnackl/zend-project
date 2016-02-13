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
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'doctrine' => array(
        'authentication' => array( // this part is for the Auth adapter from DoctrineModule/Authentication
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                // object_repository can be used instead of the object_manager key
                'identity_class' => 'Auth\Entity\User', //'Application\Entity\User',
                'identity_property' => 'usrName', // 'username', // 'email',
                'credential_property' => 'usrPassword', // 'password',
                'credential_callable' => function(Entity\User $user, $passwordGiven) { // not only User
                    // return my_awesome_check_test($user->getPassword(), $passwordGiven);
                    // echo '<h1>callback user->getPassword = ' .$user->getPassword() . ' passwordGiven = ' . $passwordGiven . '</h1>';
                    //- if ($user->getPassword() == md5($passwordGiven)) { // original
                    // ToDo find a way to access the Service Manager and get the static salt from config array
                    if ($user->getUsrPassword() == md5('aFGQ475SDsdfsaf2342' . $passwordGiven . $user->getUsrPasswordSalt()) &&
                        $user->getUsrActive() == 1) {
                        return true;
                    }
                    else {
                        return false;
                    }
                },
            ),
        ),

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

