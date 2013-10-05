<?php
/**
 * Created by PhpStorm.
 * User: euan
 * Date: 05/10/13
 * Time: 12:33
 */

class XenDevelop_Noted_ViewPublic_Account_Noted extends XenForo_ViewPublic_Base
{
    public function renderHtml()
    {
        $this->_params['editorTemplate'] = XenForo_ViewPublic_Helper_Editor::getEditorTemplate(
                                                                           $this, 'message', $this->_params['notes']
        );
    }
} 
