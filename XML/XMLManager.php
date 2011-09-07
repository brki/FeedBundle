<?php

namespace Nekland\FeedBundle\XML;

class XMLManager
{
    private $filename;
    protected $xml;
    private $new;

    public function __construct($filename)
    {
        $this->filename = $filename;

        if ($this->new = !file_exists($this->filename)) {

            $this->xml = new \DomDocument('1.0', 'utf-8');
        } else {

            $this->xml = new \DomDocument();
            $this->xml->load($this->filename);
        }
    }


    public function addTextNode($nodeName, $content, \DOMNode $parentNode, $wrapInCdata=false)
    {
        $node = $this->xml->createElement($nodeName);
        $node = $parentNode->appendChild($node);

        if ($wrapInCdata) {
            $node_text = $this->xml->createCDATASection($content);
        } else {
            $node_text = $this->xml->createTextNode($content);
        }
        $node->appendChild($node_text);

        return $node;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getXml()
    {
        return $this->xml;
    }

    public function isNew()
    {
        return $this->new;
    }

    public function save()
    {
        return $this->xml->save($this->filename);
    }
}
