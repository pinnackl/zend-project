<?php

namespace Cms;

return array(
	'controllers' => array(
        'invokables' => array(
            'Cms\Controller\Index' => 'Cms\Controller\IndexController',
            'Cms\Controller\Translation' => 'Cms\Controller\TranslationController',
            'Cms\Controller\Comment' => 'Cms\Controller\CommentController',
			'Cms\Controller\User' => 'Cms\Controller\UserController',
			'Cms\Controller\Page' => 'Cms\Controller\PageController',
			'Cms\Controller\Category' => 'Cms\Controller\CategoryController',
			'Cms\Controller\Theme' => 'Cms\Controller\ThemeController',
        ),
    ),	
    'router' => array(
        'routes' => array(
			'cms' => array(
				'type'    => 'Literal',
				'options' => array(
					'route'    => '/admin',
					'defaults' => array(
						'__NAMESPACE__' => 'Cms\Controller',
						'controller'    => 'Index',
						'action'        => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type'    => 'Segment',
						'options' => array(
							// 'route'    => '/[:controller[/:action[/:id]]]',
							'route'    => '/[:controller[/:action[/:id[/:id2]]]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
							),
							'defaults' => array(
							),
						),
					),
					'user' => array(
						'type'    => 'Literal',
						'options' => array(
							'route'    => '/user',
							'defaults' => array(
								'__NAMESPACE__' => 'Cms\Controller',
								'controller'    => 'Index',
								'action'        => 'index',
							),
						),
						'may_terminate' => true,
					),

					'category' => array(
						'type'    => 'Literal',
						'options' => array(
							'route'    => '/category',
							'defaults' => array(
								'__NAMESPACE__' => 'Cms\Controller',
								'controller'    => 'Index',
								'action'        => 'index',
							),
						),
						'may_terminate' => true,
					),

					'page' => array(
						'type'    => 'Literal',
						'options' => array(
							'route'    => '/page',
							'defaults' => array(
								'__NAMESPACE__' => 'Cms\Controller',
								'controller'    => 'Index',
								'action'        => 'index',
							),
						),
						'may_terminate' => true,
					),

					'theme' => array(
						'type'    => 'Literal',
						'options' => array(
							'route'    => '/page',
							'defaults' => array(
								'__NAMESPACE__' => 'Cms\Controller',
								'controller'    => 'Index',
								'action'        => 'index',
							),
						),
						'may_terminate' => true,
					),
				),
			),

		),
	),


    'view_manager' => array(
        'template_path_stack' => array(
            'cms' => __DIR__ . '/../view'
        ),
		
		'display_exceptions' => true,
    ),
    'doctrine' => array(
        'driver' => array(
			__NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
					__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
					__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                )
            )
        )
    ),
);