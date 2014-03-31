<?php

namespace ModuleWithXsl\View\Strategy;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ViewXslStrategyFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xslRenderer = $serviceLocator->get('ViewXslRenderer');
        $xslRenderer->setHelperPluginManager($serviceLocator->get('ViewHelperManager'));
        $xslRenderer->setResolver($serviceLocator->get('ViewResolver'));
        $xslStrategy = new XslStrategy($xslRenderer);

        return $xslStrategy;
    }
}
