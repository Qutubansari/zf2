<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Signup\Controller\Index' => 'Signup\Controller\IndexController',
            'Signup\Controller\Dashboard' => 'Signup\Controller\DashboardController',
            'Signup\Controller\Signup' => 'Signup\Controller\SignupController'
        )
    ),
    'router' => array(
        'routes' => array(
            'signup' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/index',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
            
            'signup' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/signup',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Signup',
                        'action' => 'signup'
                    ),
                ),
            ),
            'logout' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'logout'
                    ),
                ),
            ),
            'add' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'add'
                    ),
                ),
            ),
            'list' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/list',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'list'
                    )
                )
            ),
            'addRole' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/addRole',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'addRole'
                    ),
                ),
            ),
            'listRole' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/listRole',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'listRole'
                    )
                )
            ),
            'addUserRole' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/addUserRole',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'addUserRole'
                    )
                )
            ),
            'addRoleMenu' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/addRoleMenu',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'addRoleMenu'
                    )
                )
            ),
            'dashboard' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/dashboard',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'add'
                    ),
                ),
            ),
            
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Signup\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            
            'register' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/register',
                    'defaults' => array(                        
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Signup',
                        'action' => 'signup'
                    ),
                ),
            )
            ,

            
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
            
            'foo' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/foo',
                    'defaults' => array(
                        
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Index',
                        'action' => 'foo'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
            
            'dashboard' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/dashboard',
                    'defaults' => array(
                        
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'add'
                    ),
                ),
            )
            ,
            
            'start' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/start',
                    'defaults' => array(
                        
                        '__NAMESPACE__' => 'Signup\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'index'
                    ),
                ),
            ),
            
        ),
        
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Signup' => __DIR__ . '/../view'
        ),
        // 'layout/public' => __DIR__ . '/../view/layout/public.phtml',
        
    ),
);
