<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:blog/Resources/Private/Language/locallang_db.xlf:tx_blog_domain_model_comment',
        'label' => 'first_name',
        'label_alt' => 'last_name',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'first_name,last_name,email,comment',
        'iconfile' => 'EXT:blog/Resources/Public/Icons/tiger.jpg'
    ],
    'types' => [
        '1' => ['showitem' => 'first_name, last_name, email, comment, is_approved, post, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden'],
    ],
    'columns' => [
        'first_name' => [
            'label' => 'First Name',
            'config' => [
                'type' => 'input',
            ],
        ],
        'last_name' => [
            'label' => 'Last Name',
            'config' => [
                'type' => 'input',
            ],
        ],
        'email' => [
            'label' => 'Email Address',
            'config' => [
                'type' => 'input',
                'eval' => 'email',
            ],
        ],
        'comment' => [
            'label' => 'Your Comment',
            'config' => [
                'type' => 'text',
            ],
        ],
        'is_approved' => [
            'label' => 'Approved',
             'config' => [
                 'type' => 'check',
                 'default' => 0,
                 'renderType' => 'checkboxToggle',
             ],
        ],
        'post' => [
            'label' => 'Select Post',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_blog_domain_model_post',
                'maxitems' => 1,
            ],
        ],
    ],
];