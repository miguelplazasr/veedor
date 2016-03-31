<?php

namespace AppBundle\Controller\web;

use AppBundle\Document\Issue;
use AppBundle\Form\Type\IssueType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Issue controller.
 *
 * @Route("/issue")
 */
class IssueController extends Controller
{
    /**
     * @Route("/", name="issue_index")
     */
    public function indexAction(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $documents = $dm->getRepository('AppBundle:Issue')->countByCategory();

        return $this->render(':issue:index.html.twig', array(
            'documents' => $documents,

        ));


    }

    public function getHandler()
    {
        return $this->get('app.handler.issue');
    }

    /**
     * @Route("/create", name="issue_new")
     *
     * @return Response
     */
    public function createAction(Request $request)
    {

        $newDocument = $this->getHandler()->post(
            $request->request->all()
        );

        return $this->redirect($this->generateUrl('issue_index'));

    }

    /**
     * @Route("/{id}/edit", name="issue_edit")
     * @Method("GET")
     *
     * @param $id
     * @return Response
     */
    public function editAction($id)
    {
        $document = $this->getHandler()->get($id);

        $editForm = $this->createForm(
            new IssueType(),
            $document,
            array(
                'action' => $this->generateUrl('issue_update', array('id' => $document->getId())),
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
     * @Route("/{id}", name="issue_update")
     * @Method("PUT")
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {

        $this->getHandler()->put($id, $request->request->all());

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
        $document = new Issue();
        $form = $this->createForm(
            new IssueType,
            $document,
            array(
                'action' => $this->generateUrl('issue_new'),
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

    /**
     * @param $id
     * @return mixed
     *
     * @Route("/{id}/show", name="issue_show")
     */
    public function showAction($id)
    {

        $document = $this->getHandler()->get($id);


        $response = new Response();
        $response->headers->set('Content-Type', $document->getMimeType());

        $response->setContent($document->getFile()->getBytes());

        return $response;


        //return $this->render(':issue:show.html.twig', array(
         //   'document' => $document));

    }

    /**
     * @Route("/category/{category}")
     * @param $category
     * @return Response
     */
    public function getByCategoryAction($category)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $documents = $dm->getRepository('AppBundle:Issue')->findAllByCategory($category);

        return $this->render(
            'issue/index.html.twig',
            array(
                'documents' => $documents,
            )
        );
    }
}
