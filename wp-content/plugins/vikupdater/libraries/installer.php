<?php
/**
 * @package     VikUpdater
 * @subpackage  installer
 * @author      E4J s.r.l.
 * @copyright   Copyright (C) 2018 E4J s.r.l. All Rights Reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        https://vikwp.com
 */

defined('ABSPATH') or die('No script kiddies please!');

class VikUpdaterInstall {

	protected static $init = false;

	public static function init() {
		// init only if not done yet
		if (static::$init === false)
		{
			// handle installation message
			add_action('admin_notices', array('VikUpdaterInstall', 'handleMessage'));
			

			/**
			 *
			 * @since 1.2.1
			 * 
			 * Added new value to trigger update check.
			 *
			 * Register hooks and actions here
			 */
			add_option('vikupdater_update_lastcheck', time());
			// mark flag as true to avoid init it again
			static::$init = true;
		}
	}

	public static function activatePlugin() {
		add_option('vikupdater_onactivate', 1);
	}

	public static function deactivatePlugin() {
		delete_option('vikupdater_onactivate');
	}

	public static function handleMessage() {
		// if we are in the admin section and the plugin has been activated
		if (is_admin() && get_option('vikupdater_onactivate') == 1)
		{
			// delete the activation flag to avoid displaying the message more than once
			delete_option('vikupdater_onactivate');

			?>
			<div class="notice is-dismissible activate-success">
				<p>
					<strong><?php _e('Thank you for activating our plugin! Check the options page to begin registering your products.', 'vikupdater');?></strong>
					<a href="https://vikwp.com">https://vikwp.com</a>
				</p>
			</div>
			<?php
		}
	}
}
