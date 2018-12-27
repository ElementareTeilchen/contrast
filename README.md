# Usage
You can use then view helpers of this extension to effectively add a contrast toogle to your page.

## namespace
Add the namespace like
{namespace etc=ElementareTeilchen\Contrast\ViewHelpers}

## CSS class to activate contrast view
Place this i.e. in the body tag or any wrapper html element

    <body class="yourClass {etc:contrast.toggleCssClass(className:'t-contrast')}">

## contrast link toggle
Add you contrast link like this:

    <etc:contrast.toggleLink class="contrast__link  link-list__item__link" addQueryString="false">
        <f:translate key="page.contrastView" extensionName="contrast" />
    </etc:contrast.toggleLink>
