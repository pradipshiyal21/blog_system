<?php
declare(strict_types=1);

namespace MyVendor\Blog\Xclass;

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\Components\Buttons\LinkButton;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AddDocHeaderButton extends ButtonBar
{
    public function getButtons(): array
    {
        $buttons = parent::getButtons();
        
        $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
        $myButton = GeneralUtility::makeInstance(LinkButton::class)
            ->setHref('#21')
            ->setTitle('My Button')
            ->setShowLabelText(true)
            ->setIcon($iconFactory->getIcon('actions-add', Icon::SIZE_SMALL));

        $buttons['left'][0][] = $myButton;
        return $buttons;
    }
}