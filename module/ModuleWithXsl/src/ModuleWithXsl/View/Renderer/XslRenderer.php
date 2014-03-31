<?php

namespace ModuleWithXsl\View\Renderer;

use ModuleWithXsl\View\Model\XslModel;
//use ModuleWithXsl\View\Model\XslModelSerializer;
use Zend\View\Renderer\PhpRenderer;

class XslRenderer extends PhpRenderer
{
    public function render($_nameOrModel, $_values = null)
    {
        if ($_values !== null) {
            $this->setVars($_values);
        }

        /** @var \Zend\Http\Request $r */
        $r = $this->getHelperPluginManager()->getServiceLocator()->get('Request');
        $isXml = $r->getQuery('xml', false) !== false;
        $xml = '';
        $type = $_nameOrModel instanceof XslModel || $isXml ? 'node' : 'cdata';

        foreach ($_nameOrModel->getVariables() as $var => $value) {
            \Ext\Xml::append($xml, call_user_func_array(
                array('\Ext\Xml', $type),
                array($var, $value)
            ));
        }

        $dom = \Ext\Xml\Dom::get(\Ext\Xml::node(
            $_nameOrModel instanceof XslModel ? 'view' : 'layout',
            $xml
        ));

        if ($isXml) {
            return \Ext\Xml\Dom::getXml($dom->documentElement);

        } else {

            $xsl = \Ext\Xml\Dom::load($this->resolver(
                $_nameOrModel->getTemplate()
            ));

            $proc = new \XSLTProcessor();
            $proc->importStylesheet($xsl);

            return $proc->transformToXml($dom);
        }
    }
}
