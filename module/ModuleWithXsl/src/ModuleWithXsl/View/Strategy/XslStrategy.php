<?php

namespace ModuleWithXsl\View\Strategy;

use Zend\View\Strategy\PhpRendererStrategy;
use Zend\View\ViewEvent;

class XslStrategy extends PhpRendererStrategy
{
    public function injectResponse(ViewEvent $e)
    {
        parent::injectResponse($e);

        if ($e->getRequest()->getQuery('xml', false) !== false) {
            $e->getResponse()->getHeaders()->addHeaderLine(
                'content-type',
                'text/xml'
            );
        }
    }
}
