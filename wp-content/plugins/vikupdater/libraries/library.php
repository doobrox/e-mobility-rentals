<?php
/**
 * @package     VikUpdaterLoader
 * @subpackage  libraries
 * @author      E4J s.r.l.
 * @copyright   Copyright (C) 2021 E4J s.r.l. All Rights Reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        https://vikwp.com
 * @since       1.5.0
 */


class VikUpdaterLibrary {
    
    public static function checkupdates() {

        $settings = self::loadSettings();
        $settings['updatedays'] = empty($settings['updatedays']) ? 7 : $settings['updatedays'];
        $lastCheck = get_option('vikupdater_update_lastcheck', null);
        $needtoup = true; 
        $needtoupself = true;
        $productstoup = array();
        if (empty($lastCheck)) {
            add_option('vikupdater_update_lastcheck', time());
        }
        if ((time() - $lastCheck) > 24*60*60*$settings['updatedays'] || $lastCheck == time()) {
            update_option('vikupdater_update_lastcheck', time());
            $storedProducts = json_decode(get_option("vikupdater_products"), true);
            if (empty($storedProducts)) {
                $needtoup = false;
            } else {
                $productstoup = VikUpdaterContact::CheckLatestVersion(1);
                if (!count($productstoup)) {
                    $needtoup = false;
                }
            }
            if(VikUpdaterContact::CheckSelfVersion() == 'latest') {
                $needtoupself = false;
            }
        }

        //@TODO IF BOTH ARE FALSE, THEN DO NOTHING, OTHERWISE DO AUTO UPDATE OF WHAT IS NEEDED
    }

    public static function loadMenu ($current = 'dashboard') {

    }

    public static function loadSettings () {
        $settings = array();
        return $settings;
    }

}