<?php

declare(strict_types=1);

namespace MyVendor\Blog\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use MyVendor\Blog\Domain\Repository\PostRepository;
use Psr\Http\Message\ResponseInterface;

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
class PostController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * action list
     */
    public function listAction(): ResponseInterface
    {
        $query = $this->postRepository->createQuery();

        $order = strtolower($this->settings['sortOrder']) === 'desc' ? 'DESC' : 'ASC';
        $query->setOrderings([
            'date' => $order
        ]);

        if (!empty($this->settings['limit'])) {
            $query->setLimit((int)$this->settings['limit']);
        }

        $querySettings = $query->getQuerySettings();
        $querySettings->setRespectStoragePage(true);
        $querySettings->setStoragePageIds([
            (int)$this->settings['storagePid']
        ]);

        $posts = $query->execute();
        $this->view->assign('posts', $posts);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \MyVendor\Blog\Domain\Model\Post $post
     */
    public function showAction(\MyVendor\Blog\Domain\Model\Post $post): ResponseInterface
    {
        $this->view->assign('post', $post);
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
    public function __construct(private readonly \MyVendor\Blog\Domain\Repository\PostRepository $postRepository)
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
}
