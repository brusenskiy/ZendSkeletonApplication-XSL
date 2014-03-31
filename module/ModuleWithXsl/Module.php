<?php

namespace ModuleWithXsl;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach('render', array($this, 'registerXslStrategy'), 100);

//        $sm = $e->getApplication()->getServiceManager();
//        $sharedEvents = $e->getApplication()->getEventManager()->getSharedManager();
//        $sharedEvents->attach(
//            __NAMESPACE__,
//            MvcEvent::EVENT_DISPATCH,
//            function($e) use ($sm) {
//                $strategy = $sm->get('ViewXslStrategy');
//                $view     = $sm->get('ViewManager')->getView();
//                $strategy->attach($view->getEventManager());
//            },
//            100
//        );
    }

    /**
     * @param  \Zend\Mvc\MvcEvent $e The MvcEvent instance
     * @return void
     */
    public function registerXslStrategy($e)
    {
        $matches = $e->getRouteMatch();
        if (!$matches) return;

        $controller = $matches->getParam('controller');

        if (false !== strpos($controller, __NAMESPACE__)) {
            $app      = $e->getTarget();
            $locator  = $app->getServiceManager();
            $view     = $locator->get('Zend\View\View');
            $strategy = $locator->get('ViewXslStrategy');

            $view->getEventManager()->attach($strategy, 100);
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
