<?php

namespace ModuleWithXsl\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
//use Zend\View\Model\ViewModel;
use ModuleWithXsl\View\Model\XslModel;

class IndexController extends AbstractActionController
{
    public function onDispatch(MvcEvent $_e)
    {
        $this->layout()->setTemplate('module-with-xsl/layout');
        $result = parent::onDispatch($_e);
    }

    public function indexAction()
    {
//        return new ViewModel();
        $model = new XslModel();

        $model->message = 'XSL rules';
        $model->date = \Ext\Date::getXml(time());

        return $model;
    }
}
