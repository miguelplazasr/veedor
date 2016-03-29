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
 * @MongoDB\Document(repositoryClass="AppBundle\Document\Repository\IssueRepository")
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

    /** @MongoDB\File */
    private $file;

    /** @MongoDB\String() */
    private $filename;

    /** @MongoDB\String() */
    private $mimeType;

    /** @MongoDB\Date */
    private $uploadDate;

    /** @MongoDB\Int() */
    private $length;

    /** @MongoDB\Int() */
    private $chunkSize;

    /** @MongoDB\String() */
    private $md5;


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



    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function getMimeType()
    {
        return $this->mimeType;
    }

    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
    }

    public function getChunkSize()
    {
        return $this->chunkSize;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getMd5()
    {
        return $this->md5;
    }

    public function getUploadDate()
    {
        return $this->uploadDate;
    }

    /**
     * Set uploadDate
     *
     * @param string $uploadDate
     * @return self
     */
    public function setUploadDate($uploadDate)
    {
        $this->uploadDate = $uploadDate;
        return $this;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return self
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * Set chunkSize
     *
     * @param string $chunkSize
     * @return self
     */
    public function setChunkSize($chunkSize)
    {
        $this->chunkSize = $chunkSize;
        return $this;
    }

    /**
     * Set md5
     *
     * @param string $md5
     * @return self
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;
        return $this;
    }
}
