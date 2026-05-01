<?php
namespace MyVendor\Blog\Service;

use TYPO3\CMS\Core\Database\ConnectionPool;

class BlogService
{
    public function __construct(private readonly ConnectionPool $connectionPool) {

    }

    public function getBlogTitleByFile(int $fileUid): ?string
    {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('sys_file_reference');
        $row = $queryBuilder->select('uid_foreign', 'tablenames')->from('sys_file_reference')
            ->where($queryBuilder->expr()->eq('uid_local', $fileUid))
            ->executeQuery()
            ->fetchAssociative();

        if (!$row) {
            return null;
        }

        $blogUid = (int)$row['uid_foreign'];

        $blog = $this->connectionPool->getQueryBuilderForTable('tx_blog_domain_model_post')
            ->select('title')
            ->from('tx_blog_domain_model_post')
            ->where($queryBuilder->expr()->eq('uid', $blogUid))
            ->executeQuery()
            ->fetchAssociative();

        return $blog['title'] ?? null;
    }
}