<?php
declare(strict_types=1);

namespace MyVendor\Blog\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use MyVendor\Blog\Domain\Model\Post;

class CommentRepository extends Repository
{
    public function findApprovedByPost(Post $post)
    {      
        $query = $this->createQuery();
        return $query->matching(
            $query->logicalAnd(
                $query->equals('post', $post), 
                $query->equals('isApproved', 1)
            ))->execute();
    }
}