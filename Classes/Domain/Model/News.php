<?php
namespace MyVendor\Blog\Domain\Model;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use GeorgRinger\News\Domain\Model\FileReference;

class News extends \GeorgRinger\News\Domain\Model\News{
	
    /**
     * @var ObjectStorage<FileReference>
     */
    protected ObjectStorage $featureImage;

    protected string $subtitle = '';
    protected string $descriptionNews = '';
	protected string $locationSimple;

    public function __construct()
    {
        parent::__construct();
        $this->featureImage = new ObjectStorage();
    }
     
    // Feature Image
    public function getFeatureImage(): ObjectStorage
    {
        return $this->featureImage;
    }

    public function setFeatureImage(ObjectStorage $featureImage): void
    {
        $this->featureImage = $featureImage;
    }

    public function addFeatureImage(FileReference $fileReference): void
    {
        $this->featureImage->attach($fileReference);
    }

    public function removeFeatureImage(FileReference $fileReference): void
    {
        $this->featureImage->detach($fileReference);
    }

    // Subtitle
    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    // Description
    public function getDescriptionNews(): string
    {
        return $this->descriptionNews;
    }

    public function setDescriptionNews(string $descriptionNews): void
    {
        $this->descriptionNews = $descriptionNews;
    }

	// for testing only
   	public function getLocationSimple(): string
   	{
      	return $this->locationSimple;
   	}

   	public function setLocationSimple(string $locationSimple)
   	{
      	$this->locationSimple = $locationSimple;
   	}
}
