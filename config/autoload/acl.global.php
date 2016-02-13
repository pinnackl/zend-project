<?php
// http://p0l0.binware.org/index.php/2012/02/18/zend-framework-2-authentication-acl-using-eventmanager/
// First I created an extra config for ACL (could be also in module.config.php, but I prefer to have it in a separated file)
return array(
    'acl' => array(
        'roles' => array(
            'guest'   => null,
            'member'  => 'guest',
            'admin'  => 'member',
        ),
        'resources' => array(
            'allow' => array(
//-                'user' => array(
//-                    'login' => 'guest',
//-                    'all'   => 'member'
//-                )

                'Application\Controller\Index' => array(
                    'all'   => 'guest'
                ),

                'Auth\Controller\Index' => array(
                    // 'index' => 'guest',
                    // 'all'   => 'member',
                    'all'   => 'guest'
                ),

                'Auth\Controller\Hello' => array(
                    'all'   => 'guest'
                ),
                'Auth\Controller\FormTests' => array(
                    'all'   => 'guest'
                ),

                'Auth\Controller\User' => array(
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),

                'Cms\Controller\Category' => array(
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),

                'Cms\Controller\PageController' => array(
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),

                'Auth\Controller\Registration' => array(
                    'all' => 'guest'
                ),
                'CsnCms\Controller\Index' => array(
                    // 'all'   => 'guest'
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),
                'CsnCms\Controller\Translation' => array(
                    // 'all'   => 'guest'
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),
                'CsnCms\Controller\Comment' => array(
                    // 'all'   => 'guest'
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),
                'Auth\Controller\Admin' => array(
                    'all'	=> 'admin',
                ),

                // for CMS articles
                'Public Resource' => array(
                    'view'	=> 'guest',
                ),
                'Private Resource' => array(
                    'view'	=> 'member',
                ),
                'Admin Resource' => array(
                    'view'	=> 'admin',
                ),
            )
        )
    )
);