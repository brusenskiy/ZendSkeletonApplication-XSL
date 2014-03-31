<?php

namespace ModuleWithXsl\View\Model;

use Ext\Xml;

class XslModelSerializer
{
    /** @var \DOMDocument */
    private $_dom;

    public function serialize($_node, $_instance)
    {
        $this->_dom = new \DOMDocument();

        $root = $this->_dom->createElement($_node);
        $this->_dom->appendChild($root);

        $this->_serializeData($root, $_instance);
        return $this->_dom;
    }

    private function _serializeData(\DOMElement $_parent,
                                    $_data,
                                    $_node = null)
    {
        if (is_object($_data) && $_data instanceof \DOMDocument) {
            $this->_appendDomObject($_parent, $_data, $_node);

        } elseif (is_object($_data)) {
            $this->_appendObject($_parent, $_data, $_node);

        } elseif (is_array($_data)) {
            $this->_appendArray($_parent, $_data, $_node);

        } else {
            $this->_appendString($_parent, $_data, $_node);
        }
    }

    private function _appendDomObject(\DOMElement $_parent,
                                      \DOMDocument $_dom,
                                      $_node = null)
    {
        if (!is_null($_node)) {
            $ele = $this->_dom->createElement(Xml::normalize($_node));
            $_parent->appendChild($ele);
            $parent = $ele;
        } else {
            $parent = $_parent;
        }

        if ($_dom->documentElement) {
            foreach ($_dom->documentElement->childNodes as $child) {
                $parent->appendChild($this->_dom->importNode($child, true));
            }
        }
    }

    private function _appendObject(\DOMElement $_parent,
                                   $_object,
                                   $_node = null)
    {
        if (!is_null($_node)) {
            $ele = $this->_dom->createElement(Xml::normalize($_node));
            $_parent->appendChild($ele);
            $parent = $ele;
        } else {
            $parent = $_parent;
        }

        $refl = new \ReflectionObject($_object);
        foreach ($refl->getProperties() as $property) {
            if ($property->isPublic()) {
                $this->_serializeData(
                    $parent,
                    $property->getValue($_object),
                    $property->getName()
                );
            }
        }
    }

    private function _appendArray(\DOMElement $_parent,
                                  array $_data,
                                  $_node = null)
    {
        if (!is_null($_node)) {
            $ele = $this->_dom->createElement(Xml::normalize($_node));
            $_parent->appendChild($ele);
            $parent = $ele;
        } else {
            $parent = $_parent;
        }

        foreach ($_data as $key => $value) {
            $this->_serializeData(
                $parent,
                $value,
                preg_match('/^[a-z_]+$/', $key) ? $key : 'item'
            );
        }
    }

    private function _appendString(\DOMElement $_parent, $_value, $_node = null)
    {
        if (!is_null($_node)) {
            $ele = $this->_dom->createElement(Xml::normalize($_node));
            $_parent->appendChild($ele);
            $parent = $ele;
        } else {
            $parent = $_parent;
        }

        $ele = $this->_dom->createCDATASection($_value);
        $parent->appendChild($ele);
        return $ele;
    }
}
