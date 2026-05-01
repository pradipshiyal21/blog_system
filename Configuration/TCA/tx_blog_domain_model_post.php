<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:blog/Resources/Private/Language/locallang_db.xlf:tx_blog_domain_model_post',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'sortby' => 'sorting',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,description',
        'iconfile' => 'EXT:blog/Resources/Public/Icons/tx_blog_domain_model_post.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'title, slug, description, images, date, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_blog_domain_model_post',
                'foreign_table_where' => 'AND {#tx_blog_domain_model_post}.{#pid}=###CURRENT_PID### AND {#tx_blog_domain_model_post}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'value' => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'format' => 'datetime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:blog/Resources/Private/Language/locallang_db.xlf:tx_blog_domain_model_post.title',
            'description' => 'LLL:EXT:blog/Resources/Private/Language/locallang_db.xlf:tx_blog_domain_model_post.title.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'required' => true,
                'default' => ''
            ],
            
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:blog/Resources/Private/Language/locallang_db.xlf:tx_blog_domain_model_post.description',
            'description' => 'LLL:EXT:blog/Resources/Private/Language/locallang_db.xlf:tx_blog_domain_model_post.description.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'fieldControl' => [
                    'fullScreenRichtext' => [
                        'disabled' => false,
                    ],
                ],
                'cols' => 40,
                'rows' => 15,
            ],
            
        ],
        'images' => [
            'exclude' => true,
            'label' => 'LLL:EXT:blog/Resources/Private/Language/locallang_db.xlf:tx_blog_domain_model_post.images',
            'description' => 'LLL:EXT:blog/Resources/Private/Language/locallang_db.xlf:tx_blog_domain_model_post.images.description',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-media-types',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference',
                ],
                'overrideChildTca' => [
                    'types' => [
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '--palette--;;imageoverlayPalette,--palette--;;filePalette',
                        ],
                    ],
                ],
                'maxitems' => 1,
            ],
            
        ],
        'date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:blog/Resources/Private/Language/locallang_db.xlf:tx_blog_domain_model_post.date',
            'description' => 'LLL:EXT:blog/Resources/Private/Language/locallang_db.xlf:tx_blog_domain_model_post.date.description',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'default' => time()
            ],
            
        ],
        'slug' => [
            'exclude' => true,
            'label' => 'Slug',
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => ['title'],
                    'fieldSeparator' => '-',
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => '',
            ],
        ],
    ],
];
