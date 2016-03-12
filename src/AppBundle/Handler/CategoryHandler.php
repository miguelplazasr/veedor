<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 12/03/16
 * Time: 17:43
 */
namespace AppBundle\Handler;


use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use AppBundle\Form\InvalidFormException;
use Symfony\Component\Form\FormFactoryInterface;

class CategoryHandler implements HandlerInterface
{
    private $em;
    private $entityClass;
    private $repository;
    private $formFactory;



    public function __construct(EntityManager $em, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->em = $em;
        $this->entityClass = $entityClass;
        $this->repository = $this->em->getRepository($this->entityClass);
        $this->formFactory = $formFactory;

    }

    /**
     * @param Category $entity
     * @param array $parameters
     * @param string $method
     * @throws InvalidFormException
     *
     * @return Category|mixed
     */
    public function process(Category $entity, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new CategoryType(), $entity, array('method' => $method));

        $form->submit($parameters['category'], "PATCH" !== $method);

        if ($form->isValid()) {

            $entity = $form->getData();

            $this->em->persist($entity);
            $this->em->flush($entity);

            return $entity;

        }

        throw new InvalidFormException('Invalid submitted data', $form);

    }

    /**
     * Get all Category
     *
     * @return array
     */
    public function all()
    {
        return $this->repository->findAll();
    }

    /**
     * Get a Entity given the identifier
     *
     * @param mixed $id
     * @return null|object
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Post Entity, create new entity
     *
     * @param array $parameters
     * @return bool
     */
    public function post(array $parameters)
    {
        $entity = $this->createEntity();

        return $this->process($entity, $parameters, "POST");

    }
    
    /**
     * Edit Category Entity
     *
     * @param  $entity Category
     * @param array $parameters
     *
     * @return Category
     */
    public function put(Category $entity, array $parameters)
    {
        return $this->process($entity, $parameters, 'PUT');

    }

    /**
     * Edit partial Category Entity
     *
     * @param Category $entity
     * @param array $parameters
     * @return Category
     */
    public function patch(Category $entity, array $parameters)
    {
        return $this->process($entity, $parameters, 'PATCH');
    }

    /**
     * @return mixed
     */
    public function createEntity()
    {
        $class = $this->entityClass;
        $entity = new $class;

        return $entity;
    }

    public function delete($id) {

        $entity = $this->get($id);

        try {
            $this->em->remove($entity);
            $this->em->flush();

            return true;

        } catch (\Exception $e) {

            return $e;

        }

    }
}