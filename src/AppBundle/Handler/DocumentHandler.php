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

abstract class DocumentHandler implements HandlerInterface
{

    protected $dm;
    private $documentClass;
    private $repository;
    protected $formFactory;

    function __construct(DocumentManager $dm, $documentClass, FormFactoryInterface $formFactory)
    {
        $this->dm = $dm;
        $this->documentClass = $documentClass;
        $this->repository = $this->dm->getRepository($this->documentClass);
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

    public function post(array $parameters)
    {
        $document = $this->createDocumentClass();

        return $this->process($document, $parameters, $method = 'POST');
    }

    public function createDocumentClass()
    {
        $class = $this->documentClass;
        $document = new $class;

        return $document;
    }

    public function createDocumentType()
    {
        $type = $this->documentName().'Type';
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