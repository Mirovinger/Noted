<?php

class XenDevelop_Noted_Listener
{
    private static $createTableQuery = <<<SQL
    CREATE TABLE IF NOT EXISTS `xf_user_notes` (
        `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        `user_id` int(10) unsigned NOT NULL,
        `content` text,
        PRIMARY KEY (`id`),
        KEY `user_id` (`user_id`)
    );
SQL;

    private static $dropTableQuery = <<<SQL
    DROP TABLE IF EXISTS `xf_user_notes`;
SQL;

    /**
     * Register class extensions.
     *
     * @param       $class The class being called.
     * @param array $extend Array of extenders.
     */
    public static function extendAccountController($class, array &$extend)
    {
        if ($class == 'XenForo_ControllerPublic_Account') {
            $extenders = array(
                'XenDevelop_Noted_ControllerPublic_Account',
            );

            $extend = array_merge($extend, $extenders);
        }
    }

    /**
     * Function to be called on install.
     *
     * @param array $installedAddon Details about the addon being installed.
     */
    public static function install($installedAddon)
    {
        $version = 0;
        if (is_array($installedAddon)) {
            $version = (int) $installedAddon['version_id'];
        }

        $db = XenForo_Application::getDb();

        if ($version < 100) {
            $db->query(XenDevelop_Noted_Listener::$createTableQuery);
        }
    }

    /**
     * Function to be called on uninstall.
     */
    public static function uninstall()
    {
        $db = XenForo_Application::getDb();
        $db->query(XenDevelop_Noted_Listener::$dropTableQuery);
    }
} 
