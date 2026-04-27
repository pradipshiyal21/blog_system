<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Blog',
        'Bloglist',
        [
            \MyVendor\Blog\Controller\PostController::class => 'list, show, new, create, edit, update, delete, createComment'
        ],
        // non-cacheable actions
        [
            \MyVendor\Blog\Controller\PostController::class => 'list, create, update, delete, createComment'
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

})();

