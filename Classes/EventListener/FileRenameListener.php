<?php

namespace MyVendor\Blog\EventListener;

use TYPO3\CMS\Core\Resource\Event\AfterFileRenamedEvent;
use MyVendor\Blog\Service\BlogService;

class FileRenameListener
{
    public function __construct(private readonly BlogService $blogService) {
    
    }

    public function __invoke(AfterFileRenamedEvent $event): void
    {
        $file = $event->getFile();
        $blogTitle = $this->blogService->getBlogTitleByFile($file->getProperty('uid'));

        if (!$blogTitle) {
            return;
        }

        $slug = $this->slugify($blogTitle);
        $newName = $slug . '-' . $file->getName();

        if (str_starts_with($file->getName(), $slug)) {
            return;
        }

        $file->rename($newName);
    }

    private function slugify(string $text): string
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }
}