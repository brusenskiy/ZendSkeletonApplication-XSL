<?php

return array(
    'router' => array(
        'routes' => array(
            'xsl-example' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/xsl-example',
                    'defaults' => array(
                        'controller' => 'ModuleWithXsl\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'ViewXslStrategy' => 'ModuleWithXsl\View\Strategy\ViewXslStrategyFactory',
            'ViewXslRenderer' => 'ModuleWithXsl\View\Renderer\ViewXslRendererFactory',
        ),
//        'invokables' => array(
//            'XslRenderer' => 'ModuleWithXsl\View\Renderer\XslRenderer',
//        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'ModuleWithXsl\Controller\Index' => 'ModuleWithXsl\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'module-with-xsl/layout' => __DIR__ . '/../view/module-with-xsl/layout/layout.xsl',
//            'module-with-xsl/index/index'   => __DIR__ . '/../view/module-with-xsl/index/index.xsl',
        ),
        'template_path_stack' => array(
            'module-with-xsl' => __DIR__ . '/../view',
        ),
        'default_template_suffix' => 'xsl',
//        'strategies' => array(
//            'ViewXslStrategy'
//        ),
    ),
);
