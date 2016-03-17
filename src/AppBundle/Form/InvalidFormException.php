<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 25/08/15
 * Time: 12:56 PM
 */

namespace AppBundle\Form;


class InvalidFormException extends \RuntimeException
{
    protected $form;

    public function __construct($message, $form = null)
    {
        parent::__construct($message);
        $this->form = $form;
    }

    /**
     * @return array|null
     */
    public function getForm()
    {
        return $this->form;
    }

}