<?php
defined('TYPO3') || die();

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
// $pluginSignature = 'blog_bloglist';

$ctypekey = ExtensionUtility::registerPlugin(
    'Blog',
    'Bloglist',
    'Blog List',
    'blog-plugin-bloglist',
    'plugins',
    'TEST DESC',
    'FILE:EXT:blog/Configuration/FlexForms/ForSorting.xml',
);

ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;Configuration, pi_flexform',
    $ctypekey,
    'after:subheader',
);

ExtensionManagementUtility::addPiFlexFormValue(
    '',
    'FILE:EXT:blog/Configuration/FlexForms/ForSorting.xml',
    'blog_bloglist',
);


// $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
//     $pluginSignature,
//     'FILE:EXT:blog/Configuration/FlexForms/for_sorting.xml'
// );

// $GLOBALS['TCA']['tt_content']['types'][$pluginSignature] = [
//     'showitem' => '
//         --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
//             --palette--;;general,
//             --palette--;;headers,
//         --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,
//             pages, recursive,
//         --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
//             --palette--;;hidden,
//             --palette--;;access,
//     ',
// ];