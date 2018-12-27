<?php

namespace ElementareTeilchen\Contrast\ViewHelpers\Contrast;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * View helper to print contrast toggle link
 *
 * Define this in views as follows:
 * {namespace etc=ElementareTeilchen\Contrast\ViewHelpers}
 *
 * <etc:contrast.toggleLink class="contrast__link  link-list__item__link" addQueryString="false">
 *     <f:translate key="page.contrastView" extensionName="contrast" />
 * </etc:contrast.toggleLink>
 *
 */
class ToggleLinkViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{

    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     * Arguments initialization
     *
     * @return void
     */
    public function initializeArguments()
    {
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('absolute', 'boolean', 'If set, the URI of the rendered link is absolute', false);
        $this->registerTagAttribute('argumentsToBeExcludedFromQueryString', 'array', 'arguments to be removed from the URI. Only active if $addQueryString = TRUE', false);
        $this->registerTagAttribute('addQueryString', 'boolean', 'If set, the current query parameters will be kept in the URI', false);
        $this->registerTagAttribute('rel', 'string', 'Specifies the relationship between the current document and the linked document', false);
    }


    /**
     * @return string Rendered page URI
     */
    public function render()
    {
        $uriBuilder = $this->renderingContext->getControllerContext()->getUriBuilder();
        $uriBuilder->reset()
#			->setTargetPageUid($GLOBALS['TSFE']->id)
            ->setCreateAbsoluteUri($this->parameters['absolute'])
            ->setAddQueryString($this->parameters['addQueryString'])
            ->setAddQueryStringMethod('GET');
        if (is_array($this->parameters['argumentsToBeExcludedFromQueryString'])) {
            $uriBuilder->setArgumentsToBeExcludedFromQueryString($this->parameters['argumentsToBeExcludedFromQueryString']);
        }

        if (GeneralUtility::_GET('contrast')) {
            $uriBuilder->setArguments(['contrast' => 0]);
            #$uriBuilder->setArgumentsToBeExcludedFromQueryString(['contrast']);
        } else {
            $uriBuilder->setArguments(['contrast' => 1]);
        }

        $uri = $uriBuilder->build();

#		\TYPO3\CMS\Core\Utility\DebugUtility::debug(GeneralUtility::_GET('contrast'));
#		\TYPO3\CMS\Core\Utility\DebugUtility::debug($uri);

        if ((string)$uri !== '') {
            $this->tag->addAttribute('href', $uri);
            $this->tag->addAttribute('rel', 'nofollow');
            $this->tag->setContent($this->renderChildren());
            $result = $this->tag->render();
        } else {
            $result = $this->renderChildren();
        }

        return $result;
    }

}
