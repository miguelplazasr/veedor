<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 16/03/16
 * Time: 17:56
 */

namespace AppBundle\Handler;


use AppBundle\Document\Category;
use AppBundle\Form\Type\CategoryType;
use AppBundle\Form\InvalidFormException;

class CategoryHandler extends DocumentHandler
{


    public function process( $document, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new CategoryType(), $document, array('method' => $method));

        $form->submit($parameters, "PATCH" !== $method);

        if ($form->isValid()) {

            $document = $form->getData();

            $this->dm->persist($document);
            $this->dm->flush($document);

            return $document;

        }

        throw new InvalidFormException('Invalid submitted data', $form);

    }


}