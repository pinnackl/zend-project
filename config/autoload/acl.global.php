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

                'cms/page' => array(
                    'all' =>'guest'
                ),

                'cms/user' => array(
                    'all' =>'guest'
                ),

                'cms/category' => array(
                    'all' =>'guest'
                ),

                'Application\Controller\Index' => array(
                    'all'   => 'guest'
                ),

                'Auth\Controller\Index' => array(
                    // 'index' => 'guest',
                    // 'all'   => 'member',
                    'all'   => 'guest'
                ),


                'Cms-old\Controller\Page' => array(
                    // 'index' => 'guest',
                    // 'all'   => 'member',
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

                'Cms-old\Controller\Category' => array(
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
                'Cms\Controller\Index' => array(
                    // 'all'   => 'guest'
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),
                'Cms\Controller\Translation' => array(
                    // 'all'   => 'guest'
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),
                'Cms\Controller\Comment' => array(
                    // 'all'   => 'guest'
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),
                'Cms\Controller\User'=> array(
             //       'all'   => 'guest'
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),

                'Cms\Controller\Category'=> array(
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),
                'Cms\Controller\Page'=> array(
    //       'all'   => 'guest'
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                ),
                'Cms\Controller\Theme'=> array(
                    //       'all'   => 'guest'
                    'index' => 'admin',
                    'active' => 'admin',
                    'desactive'	=> 'admin',
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