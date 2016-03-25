<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 22/03/16
 * Time: 20:19
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Issue
 * @package AppBundle\Document
 *
 * @MongoDB\Document()
 */
class Issue
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
    private $comment;

    /**
     * @var
     * @MongoDB\ReferenceOne(targetDocument="Category", inversedBy="issues")
     */
    private $category;

    /**
     * @MongoDB\File()
     *
     */
    private $image;


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
     * Set comment
     *
     * @param string $comment
     * @return self
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get comment
     *
     * @return string $comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set category
     *
     * @param Category $category
     * @return self
     */
    public function setCategory(\AppBundle\Document\Category $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set image
     *
     * @param file $image
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get image
     *
     * @return file $image
     */
    public function getImage()
    {
        return $this->image;
    }
}
