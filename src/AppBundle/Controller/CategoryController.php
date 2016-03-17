<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 13/03/16
 * Time: 22:17
 */

namespace AppBundle\Controller;


use AppBundle\Form\Type\CategoryType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CategoryController extends FOSRestController
{

    public function getCategoryHandler()
    {
        return $this->get('app.handler.category');
    }

    /**
     * List all Events
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes={
     *      200 = "Returned when successful",
     *      400 = "Returned when errors"
     * }
     * )
     *
     * @return mixed
     */
    public function getCategoryAction()
    {

        return $this->getCategoryHandler()->all();
    }

    /**
     * Create a Page from the submitted data.
     *
     * @ApiDoc(
     *  resource = true,
     *  description = "Creates a new page from the submitted data.",
     *  input = "AppBundle\Form\Type\CategoryType",
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      400 = "Returned when the form has errors"
     *  }
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postCategoryAction(Request $request)
    {

        try {
            $newCategory = $this->getCategoryHandler()->post(
                $request->request->all()
            );
            $routeOptions = array(
                '_format' => $request->get('_format'),
            );

            return $this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $exception->getCode();
        }

    }

    /**
     * Presents the form to use to create a new person.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @return FormTypeInterface
     */
    public function newCategoryAction()
    {

        return $this->createForm(new CategoryType());
    }




}