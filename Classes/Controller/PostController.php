<?php

declare(strict_types=1);

namespace MyVendor\Blog\Controller;

use MyVendor\Blog\Domain\Model\Post;
use MyVendor\Blog\Domain\Model\Comment;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use MyVendor\Blog\Domain\Repository\PostRepository;
use MyVendor\Blog\Domain\Repository\CommentRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;

/**
 * This file is part of the "Blog" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2026 
 */

/**
 * PostController
 */
class PostController extends ActionController
{
    /**
     * action list
     */
    public function listAction(int $currentPage = 1): ResponseInterface
    {
        $query = $this->postRepository->createQuery();

        $order = strtolower($this->settings['sortOrder']) === 'desc' ? 'DESC' : 'ASC';
        $query->setOrderings(['date' => $order]);

        $filter = $this->request->hasArgument('filter') ? $this->request->getArgument('filter') : [];
        
        $keyword = $filter['keyword'] ?? '';
        $date = $filter['date'] ?? '';
        $constraints = [];

        if (!empty($keyword)) {
            $constraints[] = $query->like('title', '%' .$keyword. '%');
        }

        if (!empty($date)) {
            $constraints[] = $query->equals('date',new \DateTime($date));
        }

        if (!empty($constraints)) {
            $query->matching($query->logicalAnd(...$constraints));
        }

        $posts = $query->execute();

        $itemsPerPage = (int)$this->settings['limit'] > 0 ? (int)$this->settings['limit'] : $posts->count();
        $paginator = new QueryResultPaginator($posts, $currentPage, $itemsPerPage);
        $pagination = new SimplePagination($paginator);
        
        $this->view->assignMultiple([
            'posts' => $paginator->getPaginatedItems(),
            'pagination' => $pagination,
            'paginator' => $paginator,
            'filter' => $filter
        ]);
        
        if ((int)($this->request->getQueryParams()['type'] ?? 0) === 999) {
            return $this->htmlResponse(
                $this->view->renderPartial('Post/AjaxList', null, [
                    'posts' => $paginator->getPaginatedItems(),
                    'pagination' => $pagination,
                    'paginator' => $paginator,
                    'filter' => $filter
                ])
            );
        }
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \MyVendor\Blog\Domain\Model\Post $post
     */
    public function showAction(Post $post): ResponseInterface
    {
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($comments);
        $comments = $this->commentRepository->findApprovedByPost($post);
        $this->view->assignMultiple([
            'post' => $post,
            'comments' => $comments
        ]);
        return $this->htmlResponse();
    }

    /**
     * action edit
     *
     * @param \MyVendor\Blog\Domain\Model\Post $post
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("post")
     */
    public function editAction(\MyVendor\Blog\Domain\Model\Post $post): ResponseInterface
    {
        $this->view->assign('post', $post);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \MyVendor\Blog\Domain\Model\Post $post
     */
    public function updateAction(\MyVendor\Blog\Domain\Model\Post $post): ResponseInterface
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/main/en-us/User/Index.html', '', \TYPO3\CMS\Core\Type\ContextualFeedbackSeverity::WARNING);
        $this->postRepository->update($post);
        return $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \MyVendor\Blog\Domain\Model\Post $post
     */
    public function deleteAction(\MyVendor\Blog\Domain\Model\Post $post): ResponseInterface
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/main/en-us/User/Index.html', '', \TYPO3\CMS\Core\Type\ContextualFeedbackSeverity::WARNING);
        $this->postRepository->remove($post);
        return $this->redirect('list');
    }

    /**
     * action index
     */
    public function indexAction(): ResponseInterface
    {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('test');die();

        return $this->htmlResponse();
    }

    /**
     * @param DomainObjectRepository $domainObjectRepository
     */
    public function __construct(private readonly PostRepository $postRepository, private readonly CommentRepository $commentRepository)
    {
    }

    /**
     * action new
     */
    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param \MyVendor\Blog\Domain\Model\Post $newPost
     */
    public function createAction(\MyVendor\Blog\Domain\Model\Post $newPost): ResponseInterface
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/main/en-us/User/Index.html', '', \TYPO3\CMS\Core\Type\ContextualFeedbackSeverity::WARNING);
        $this->postRepository->add($newPost);
        return $this->redirect('list');
    }

    public function createCommentAction(Comment $comment, Post $post): ResponseInterface
    {
        $comment->setPost($post);
        $comment->setIsApproved(0);
        $this->commentRepository->add($comment);
        // $this->addFlashMessage('Your comment has been submitted and is awaiting approval.', '', \TYPO3\CMS\Core\Type\ContextualFeedbackSeverity::INFO);
        return $this->redirect('show', null, null, ['post' => $post]);
    }
}
