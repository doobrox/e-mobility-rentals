<?php
/**
 * @package     VikUpdaterLoader
 * @subpackage  libraries
 * @author      E4J s.r.l.
 * @copyright   Copyright (C) 2018 E4J s.r.l. All Rights Reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        https://vikwp.com
 */

defined('ABSPATH') or die('No script kiddies please!');

class VikUpdaterHelper {

	public static function ValidateHash($hash) {
		if (preg_match("/([a-zA-Z0-9]{6,})\-[a-z]_([a-zA-Z0-9]{6,})\-([a-zA-Z0-9]{3,})/", $hash)) {
			return true;
		} else {
			VikUpdaterHelper::ReportMessage(__('Invalid Product Code! Please refer to our documentation to find the correct product code.', 'vikupdater'));
			return false;
		}
	}

	public static function GetInstalledVersion($sku) {
		return apply_filters("vikwp_vikupdater_".$sku."_version", "");
	}

	public static function GetInstalledPath($sku) {
		return apply_filters("vikwp_vikupdater_".$sku."_path", "");
	}

	public static function RemoveProduct($hash) {
		$storedProducts = json_decode(get_option("vikupdater_products"), true);
		if (isset($storedProducts[$hash])) {
			unset($storedProducts[$hash]);
			update_option("vikupdater_products", json_encode($storedProducts));
			return true;
		}
		self::ReportMessage(__('Product is not registered! Please make sure you have registered the product before you try removing it!', 'vikupdater'));
		return false;
	}

	public static function CheckAllCurrentVersion() {
		$storedProducts = json_decode(get_option("vikupdater_products"), true);
		if (is_array($storedProducts)) {
			foreach ($storedProducts as $hash => $jsonProduct) {
				$product = json_decode($jsonProduct, true);
				$sku = explode('-', $hash)[2];
				self::CheckCurrentVersion($product, $sku);
				$storedProducts[$hash] = json_encode($product);
			}
		}
		update_option("vikupdater_products", json_encode($storedProducts));
	}

	public static function CheckCurrentVersion(&$product, $sku) {
		$product['installedVersion'] = VikUpdaterHelper::GetInstalledVersion($sku);
		$product['path'] = VikUpdaterHelper::GetInstalledPath($sku);
		if ($product['installedVersion'] == "") {
			self::SetProductUninstalled($product);
		}

		/**
		 *
		 * @since 1.3
		 *
		 *	If product version and product path exist then it is installed. Before, if product was not active was shown as not installed. 
		 *
		 *
		 */
		$product['installed'] = ($product['installedVersion'] != "" && $product['path'] != "") ? true : false;

		/**
		 *
		 * @since 1.3
		 *
		 *	Replaced ">" with version_compare: was causing an error. (case: 1.0.7 was greater than 1.0.10)
		 *
		 *
		 */

		$product['latest'] = (isset($product['version']) && version_compare($product['installedVersion'], $product['version'], '>=')) ? true : false;
	}

	public static function SetProductUninstalled(&$product) {
		$product['latest'] = false;
		$product['installed'] = false;
		$product['path'] = "";
		$product['installedVersion'] = "";
	}

	public static function UpdateChecksNumber() {
		if (time() > ((int)get_option("vikupdater_last_version_failed_check") + (3600))) {
			update_option("vikupdater_version_checks", 0);
		}
		if (time() > ((int)get_option("vikupdater_last_registration_failed_check") + (3600))) {
			update_option("vikupdater_registration_checks", 0);
		}
	}

	public static function ReportMessage($error_message, $suffix = "error") { ?>
<div class="notice is-dismissible notice-<?php echo $suffix;?>">
	<p>
		<strong><?php echo $error_message; ?></strong>
	</p>
</div>
	<?php }
}
