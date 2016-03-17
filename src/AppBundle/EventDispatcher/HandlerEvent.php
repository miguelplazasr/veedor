<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 14/03/16
 * Time: 10:42
 */

namespace AppBundle\EventDispatcher;


use Symfony\Component\EventDispatcher\Event;

class HandlerEvent extends Event
{
    private $document;

    private $container;

    function __construct($document, $container)
    {
        $this->document = $document;
        $this->container = $container;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function getContainer()
    {
        return $this->container;
    }
}