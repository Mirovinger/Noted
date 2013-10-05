<?php

class XenDevelop_Noted_TemplateHook_Public
{
    public static function accountWrapperSidebar($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template)
    {
        if ($hookName == 'account_wrapper_sidebar_your_account') {
            $sidebarEntry = $template->create('XenDevelop_Noted_account_sidebar_entry', $template->getParams());
            $rendered = $sidebarEntry->render();
            $contents .= $rendered;
        }
    }
} 
