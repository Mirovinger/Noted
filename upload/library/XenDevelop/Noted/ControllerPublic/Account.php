<?php

class XenDevelop_Noted_ControllerPublic_Account  extends XFCP_XenDevelop_Noted_ControllerPublic_Account
{
    /**
     * Display the user notes page.
     */
    public function actionNoted()
    {
        $visitorId = XenForo_Visitor::getUserId();

        if (!XenForo_Visitor::getInstance()->hasPermission('general', 'XenDevelop_Noted_access')) {
            return $this->responseNoPermission();
        }

        $notes = $this->_getNoteModel()->getNotesForUser($visitorId);

        $templateVars = array(
            'notes' => $notes,
        );

        return $this->_getWrapper(
                    'noted', 'view',
                        $this->responseView('XenDevelop_Noted_ViewPublic_Account_Noted', 'XenDevelop_Noted_view', $templateVars)
        );
    }

    public function actionNotedSave()
    {
        $this->_assertPostOnly();

        if (!XenForo_Visitor::getInstance()->hasPermission('general', 'XenDevelop_Noted_access')) {
            return $this->responseNoPermission();
        }

        $noteModel = $this->_getNoteModel();
        $visitorId = XenForo_Visitor::getUserId();

        $message = $this->getHelper('Editor')->getMessageText('message', $this->_input);
        $message = XenForo_Helper_String::autoLinkBbCode($message);

        $writer = XenForo_DataWriter::create('XenDevelop_Noted_DataWriter_Note');

        if ($existingNotesId = $noteModel->getNotesIdForUser($visitorId)) {
            $existingData = array(
                'id' => (int) $existingNotesId,
                'user_id' => $visitorId,
            );

            $writer->setExistingData($existingData);
        } else {
            $writer->set('user_id', $visitorId);
        }

        $writer->set('content', $message);

        if ($writer->save()) {
            return $this->responseRedirect(
                        XenForo_ControllerResponse_Redirect::SUCCESS,
                            XenForo_Link::buildPublicLink('account/noted')
            );
        } else {
            return $this->responseRedirect(
                        XenForo_ControllerResponse_Redirect::ERROR,
                            XenForo_Link::buildPublicLink('account/noted')
            );
        }
    }

    /**
     * @return XenDevelop_Model_Note
     */
    protected function _getNoteModel()
    {
        return $this->getModelFromCache('XenDevelop_Noted_Model_Note');
    }
} 
