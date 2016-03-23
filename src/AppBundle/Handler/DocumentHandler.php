<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 14/03/16
 * Time: 8:42
 */

namespace AppBundle\Handler;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Form\FormFactoryInterface;
use AppBundle\Form\InvalidFormException;
use Symfony\Component\HttpFoundation\Response;

abstract class DocumentHandler implements HandlerInterface
{

    protected $dm;
    protected $documentClass;
    protected $repository;
    protected $formFactory;
    protected $formType;

    function __construct($documentClass, $formType)
    {
        $this->documentClass = $documentClass;
        $this->formType = $formType;
    }

    public function setDocumentManager(DocumentManager $dm)
    {
        $this->dm = $dm;
        $this->repository = $this->dm->getRepository($this->documentClass);
    }

    public function setFormFactory(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function all()
    {
        return $this->repository->findAll();
    }

    public function get($id)
    {
        return $this->repository->find($id);
    }

    public function delete($id)
    {
        $document = $this->get($id);

        try {
            $this->dm->remove($document);
            $this->dm->flush();

            return true;

        } catch (\Exception $e) {

            return $e;

        }
    }

    public function post(array $parameters)
    {
        $document = $this->createDocumentClass();

        return $this->process($document, $parameters, $method = 'POST');
    }

    public function put($id, array $parameters)
    {
        $document = $this->get($id);

        return $this->process($document, $parameters, $method = 'PUT');
    }

    public function patch($document, array $parameters)
    {
        return $this->process($document, $parameters, $method = 'PATCH');
    }

    public function process($document, array $parameters, $method = "PUT")
    {


        $form = $this->formFactory->create($this->createDocumentType(), $document, array('method' => $method));

        $form->submit($parameters, "PATCH" !== $method);

        if ($form->isValid()) {

            $document = $form->getData();

            dump($document);

            $this->dm->persist($document);
            $this->dm->flush($document);

            return $document;

        }

        throw new InvalidFormException('Invalid submitted data', $form);

    }

    public function createDocumentClass()
    {
        $class = $this->documentClass;
        $document = new $class;

        return $document;
    }

    public function createDocumentType()
    {
        $type = $this->formType;
        $documentType = new $type;

        return $documentType;
    }

    public function documentPrefix()
    {
        $prefix = explode('\\', $this->documentClass);
        return strtolower(end($prefix));
    }

    public function documentName()
    {
        $prefix = explode('\\', $this->documentClass);
        return end($prefix);
    }
}