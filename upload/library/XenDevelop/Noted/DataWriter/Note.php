<?php

class XenDevelop_Noted_DataWriter_Note extends XenForo_DataWriter
{
    /**
     * Gets the fields that are defined for the table. See parent for explanation.
     *
     * @return array
     */
    protected function _getFields()
    {
        return array(
            'xf_user_notes' => array(
                'id' => array('type' => self::TYPE_UINT, 'autoIncrement' => true),
                'user_id' => array('type' => self::TYPE_UINT, 'required' => true),
                'content' => array('type' => self::TYPE_STRING, 'required' => false),
            )
        );
    }

    /**
     * Gets the actual existing data out of data that was passed in. See parent for explanation.
     *
     * @param mixed
     *
     * @return array|false
     */
    protected function _getExistingData($data)
    {
        if (!$id = $this->_getExistingPrimaryKey($data, 'id')) {
            return false;
        }

        return array('xf_user_notes' => $this->_getNoteModel()->getNotesById($id));
    }

    /**
     * Gets SQL condition to update the existing record.
     *
     * @return string
     */
    protected function _getUpdateCondition($tableName)
    {
        return 'user_id = ' . $this->_db->quote($this->getExisting('user_id'));
    }

    /**
     * @return XenDevelop_Noted_Model_Note
     */
    protected function _getNoteModel()
    {
        return $this->getModelFromCache('XenDevelop_Noted_Model_Note');
    }
} 
