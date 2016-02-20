<?php

return array(
    'acl' => array(
        'roles' => array(
            'guest'   => null,
            'member'  => 'guest',
            'admin'  => 'member',
        ),
        'resources' => array(
            'allow' => array(
                'Application\Controller\Index' => array(
                    'all'   => 'guest'
                ),

                'Application\Controller\Category' => array(
                    'all'   => 'guest'
                ),

                'Auth\Controller\Index' => array(
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

                'Cms\Controller\Page' => array(
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
                    'active' => 'admin',
                    'desactive'	=> 'admin',
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

                'Cms\Controller\Menu'=> array(
                    'view'	=> 'guest',
                    'index' => 'admin',
                    'add'	=> 'admin',
                    'edit'  => 'admin',
                    'delete'=> 'admin',
                    'active' => 'admin',
                    'desactive'	=> 'admin',
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