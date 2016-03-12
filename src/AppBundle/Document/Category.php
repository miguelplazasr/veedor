<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 12/03/16
 * Time: 17:32
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Category
 * @package AppBundle\Document
 *
 * @MongoDB\Document()
 */
class Category
{
    /**
     * @var
     * @MongoDB\Id()
     */
    protected $id;

    /**
     * @var
     * @MongoDB\String()
     */
    protected $name;

    /**
     * @var
     * @MongoDB\String()
     */
    protected $description;




    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }
}
