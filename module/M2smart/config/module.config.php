<?php

namespace M2smart;

return array(
    
    
    'router' => array(
        'routes' => array(
            'm2smart-home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'M2smart\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),   
                'm2smart-admin-interna' => array(
                'type' => 'Segment',    
                'options' => array(
                    'route' => '/admin/[:controller[/:action]][/:id]',
                     'constraints' => array(
                        'id'=> '[0-9]+'
                    )       
                ),
            ),  
            'm2smart-admin' => array(
                'type' => 'Segment',    
                'options' => array(
                    'route' => '/admin/[:controller[/:action]]',
                    'defaults' => array(
                        'action'=>'index',
                        
                    ),
                ),
            ),      
            
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'M2smart\Controller\Index' => 'M2smart\Controller\IndexController',
             'setores' => 'M2smartAdmin\Controller\SetoresController',
         
            ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'm2smart/index/index' => __DIR__ . '/../view/m2smart/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    //Configuração do Doctrine
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);
