<?php

namespace ElementareTeilchen\Contrast\ViewHelpers\Contrast;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * returns css class if in contrast mode
 *
 * Define this in views as follows:
 * {namespace etc=ElementareTeilchen\Contrast\ViewHelpers}
 *
 * {etc:contrast.toggleCssClass(className:'t-contrast')}
 *
 */
class ToggleCssClassViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Initialize arguments.
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('cssClassName', 'string', 'Css class name which should be set if contrast view is active.', false);
    }
	/**
	 * Return css class name
	 * @return  string
	 */
	public function render() {
		if (GeneralUtility::_GET('contrast')) {
			return $this->arguments['cssClassName'];
		}

		return '';
	}
}
