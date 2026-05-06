<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$newColumns = [
    'feature_image' => [
        'exclude' => true,
        'label' => 'Feature Image',
        'config' => [
            'type' => 'file',
            'maxitems' => 1,
            'allowed' => 'common-image-types',
            'appearance' => [
                'createNewRelationLinkTitle' => 'Add Image',
            ],
        ],
    ],
    
    'subtitle' => [
        'exclude' => true,
        'label' => 'Subtitle',
        'config' => [
            'type' => 'input',
            'size' => 50,
            'eval' => 'trim',
        ],
    ],

    'description_news' => [
        'exclude' => true,
        'label' => 'Description',
        'config' => [
            'type' => 'text',
            'enableRichtext' => true,
            'richtextConfiguration' => 'custom',
            'cols' => 40,
            'rows' => 15,
        ],
    ],

    'location_simple' => [
      'exclude' => 1,
      'label' => 'My location',
      'config' => [
         'type' => 'input',
         'size' => 15
      ],
   ]
];

ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $newColumns);

ExtensionManagementUtility::addToAllTCAtypes(
    'tx_news_domain_model_news',
    'feature_image',
    '',
    'before:fal_media'
);

ExtensionManagementUtility::addToAllTCAtypes(
    'tx_news_domain_model_news',
    'subtitle',
    '',
    'after:title'
);

ExtensionManagementUtility::addToAllTCAtypes(
    'tx_news_domain_model_news',
    'description_news',
    '',
    'before:teaser'
);

ExtensionManagementUtility::addToAllTCAtypes(
    'tx_news_domain_model_news', 
    'location_simple', 
    '', 
    'before:teaser'
);

