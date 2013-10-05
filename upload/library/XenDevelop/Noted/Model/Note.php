<?php

/**
 * Model class for manipulating user notes.
 *
 * @author Euan Torano <euan@xendevelop.com>
 */
class XenDevelop_Noted_Model_Note extends XenForo_Model
{
    /**
     * Returns notes for a certain user.
     *
     * @param int $userId
     *
     * @return string
     */
    public function getNotesForUser($userId = 0)
    {
        $userId = (int) $userId;
        $queryString = 'SELECT content FROM xf_user_notes WHERE user_id = ? LIMIT 1;';
        $content = $this->_getDb()->fetchOne($queryString, $userId);
        return $content;
    }

    /**
     * Returns the ID of the notes entry for a certain user.
     *
     * @param int $userId
     *
     * @return string
     */
    public function getNotesIdForUser($userId = 0)
    {
        $userId = (int) $userId;
        $queryString = 'SELECT id FROM xf_user_notes WHERE user_id = ? LIMIT 1;';
        $content = $this->_getDb()->fetchOne($queryString, $userId);
        return (int) $content;
    }

    /**
     * Get notes by their ID in the database.
     *
     * @param int $noteId The ID of the note to get.
     *
     * @return array|false
     */
    public function getNotesById($noteId = 0)
    {
        $noteId = (int) $noteId;
        $queryString = 'SELECT * FROM xf_user_notes WHERE id = ? LIMIT 1;';
        $content = $this->_getDb()->fetchRow($queryString, $noteId);
        return $content;
    }
} 
