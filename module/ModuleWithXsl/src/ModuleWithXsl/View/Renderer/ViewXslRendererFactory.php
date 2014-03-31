<?php

namespace ModuleWithXsl\View\Renderer;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ViewXslRendererFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xslRenderer = new XslRenderer();
        return $xslRenderer;
    }
}
