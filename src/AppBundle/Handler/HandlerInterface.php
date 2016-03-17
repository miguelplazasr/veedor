<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 13/03/16
 * Time: 19:29
 */

namespace AppBundle\Handler;


interface HandlerInterface
{

    public function all();

    public function get($id);

    public function post(array $parameters);

    public function process($document, array $parameters, $method = null);

    public function createDocumentClass();

}