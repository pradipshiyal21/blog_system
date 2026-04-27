<?php

declare(strict_types=1);

namespace MyVendor\Blog\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This file is part of the "Blog" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2026 
 */

/**
 * Post
 */
class Post extends AbstractEntity
{
    protected ObjectStorage $comments;
    

    /**
     * title
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $title = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * images
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $images = null;

    /**
     * date
     *
     * @var \DateTime
     */
    protected $date = null;

    public function __construct()
    {
        $this->comments = new ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Returns the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Returns the images
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the images
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $images
     * @return void
     */
    public function setImages(\TYPO3\CMS\Extbase\Domain\Model\FileReference $images)
    {
        $this->images = $images;
    }

    /**
     * Returns the date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the date
     *
     * @param \DateTime $date
     * @return void
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    public function getComments(): ObjectStorage
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): void
    {
        $this->comments->attach($comment);
    }

    public function removeComment(Comment $comment): void
    {
        $this->comments->detach($comment);
    }
}
