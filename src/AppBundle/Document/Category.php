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
 * @MongoDB\Document(repositoryClass="AppBundle\Document\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var
     * @MongoDB\Id()
     */
    private $id;

    /**
     * @var
     * @MongoDB\String()
     */
    private $name;

    /**
     * @var
     * @MongoDB\String()
     */
    private $description;

    /**
     * @var
     * @MongoDB\ReferenceMany(targetDocument="Issue", mappedBy="category", cascade="all")
     */
    private $issues = array();




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

    public function __construct()
    {
        $this->issues = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add issue
     *
     * @param Issue $issue
     */
    public function addIssue(\AppBundle\Document\Issue $issue)
    {
        $this->issues[] = $issue;
    }

    /**
     * Remove issue
     *
     * @param Issue $issue
     */
    public function removeIssue(\AppBundle\Document\Issue $issue)
    {
        $this->issues->removeElement($issue);
    }

    /**
     * Get issues
     *
     * @return \Doctrine\Common\Collections\Collection $issues
     */
    public function getIssues()
    {
        return $this->issues;
    }
}
