<?php

namespace AppBundle\Controller\web;

use AppBundle\Document\Category;
use AppBundle\Form\Type\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

    }

    public function getDocumentHandler()
    {
        return $this->get('app.handler.category');
    }

    /**
     * @Route("/create", name="category_new")
     *
     * @return Response
     */
    public function createAction(Request $request)
    {

        $newDocument = $this->getDocumentHandler()->post(
            $request->request->all()
        );

        return $newDocument;
        /*
        return $this->render(
            ':default:index.html.twig',
            array(
                'creado' => 'registro creado.',
            )
        );*/
    }

    /**
     * @Route("/{id}/edit", name="category_edit")
     * @Method("GET")
     *
     * @param $id
     * @return Response
     */
    public function editAction($id)
    {
        $document = $this->getDocumentHandler()->get($id);

        $editForm = $this->createForm(
            new CategoryType(),
            $document,
            array(
                'action' => $this->generateUrl('category_update', array('id' => $document->getId())),
                'method' => 'PUT',
            )
        );

        return $this->render(
            ':default:edit.html.twig',
            array(
                'document' => $document,
                'edit_form' => $editForm->createView(),
            )
        );
    }

    /**
     * @Route("/{id}", name="category_update")
     * @Method("PUT")
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {

        $this->getDocumentHandler()->put($id, $request->request->all());

        return $this->render(
            ':default:index.html.twig',
            array(
                'creado' => 'registro'. $id .'actualizado.',
            )
        );


    }

    /**
     * @Route("/new")
     */
    public function newAction()
    {
        $document = new Category();
        $form = $this->createForm(
            new CategoryType,
            $document,
            array(
                'action' => $this->generateUrl('category_new'),
                'method' => 'POST',
            )
        );

        return $this->render(
            ':default:new.html.twig',
            array(
                'form' => $form->createView(),
                'document' => $document,
            )
        );

    }
}
