<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 22/03/16
 * Time: 20:42
 */

namespace AppBundle\Controller;

use AppBundle\Form\Type\CategoryType;
use AppBundle\Form\Type\IssueType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class IssueController extends FOSRestController
{

    private function getHandler()
    {
        return $this->get('app.handler.issue');
    }

    /**
     * List all Issues
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
    public function getIssuesAction()
    {

        return $this->getHandler()->all();
    }

    /**
     * Get single Issue
     *
     * @ApiDoc(
     *  resource = true,
     *  output = "AppBundle\Document\Issue",
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      400 = "Returned when the page is not found"
     *  }
     * )
     * @param $id
     * @return array
     */
    public function getIssueAction($id)
    {
        return $this->getHandler()->get($id);

    }

    /**
     * Get Issues by category
     * @ApiDoc(
     *  resource=true,
     * output="AppBundle/Document/Issue",
     * statusCodes={
     *  200 = "Returned when successful",
     *  400 = "Returned when the page is not found"
     * }
     * )
     *
     * @param $category
     * @return mixed
     */
    public function getIssuesCategoryAction($category)
    {
        return $this->getHandler()->getIssuesByCategory($category);
    }

    /**
     * Create a Issue from the submitted data.
     *
     * @ApiDoc(
     *  resource = true,
     *  description = "Creates a new page from the submitted data.",
     *  input = "AppBundle\Form\Type\IssueType",
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
    public function postIssueAction(Request $request)
    {
        $newDocument = $this->getHandler()->post(
            $request->request->all()
        );

        return $newDocument; //$this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);


    }

    /**
     * Presents the form to use to create a new issue.
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
    public function newIssueAction()
    {

        return $this->createForm(new IssueType());
    }

    protected function getOr404($id)
    {
        if (!($document = $this->getHandler()->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }

        return $document;
    }

    /**
     * Put Issue.
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes={
     *      200 = "Returned when successful",
     *      400 = "Returned when errors"
     * }
     * )
     *
     * @param $id
     * @return bool|\Exception
     */
    public function deleteIssueAction($id)
    {
        return $this->getHandler()->delete($id);

    }

    /**
     * Delete Issue.
     *
     * @ApiDoc(
     *  resource = true,
     *  input = "AppBundle\Form\Type\IssueType",
     *  statusCodes={
     *      200 = "Returned when successful",
     *      400 = "Returned when errors"
     * }
     * )
     *
     * @param Request $request
     * @return bool|\Exception
     * @internal param $id
     */
    public function putIssueAction($id, Request $request)
    {
        $editDocument = $this->getHandler()->put(
            $id,
            $request->request->all()
        );

        return $editDocument; //$this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);


        /*
        try {
            $newCategory = $this->getCategoryHandler()->put(
                $id,
                $request->request->all()
            );
            $routeOptions = array(
                '_format' => $request->get('_format'),
            );

            return $this->routeRedirectView('post_category', $routeOptions, Codes::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $exception->getCode();
        }
        */

    }

}