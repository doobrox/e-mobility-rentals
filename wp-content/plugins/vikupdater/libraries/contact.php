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

class VikUpdaterContact {

	private static $baseUrl 		= "https://vikwp.com/api?task=%s";
	private static $validateTask 	= "products.validate";
	private static $downloadTask 	= "products.download";
	private static $freeDownload	= "products.freedownload";
	private static $updateTask 		= "products.version";

	public static function RegisterProduct($hash) {
		if (get_option("vikupdater_registration_checks") < 3) {
			$storedProducts = json_decode(get_option("vikupdater_products"), true);
			if (!empty($storedProducts) && array_key_exists($hash, $storedProducts)) {
				VikUpdaterHelper::ReportMessage(__('Product Code Already Present! Please insert a product you have not registered already.', 'vikupdater'));
				return false;
			}
			$explodedHash = explode('-', $hash);
			$post = array(
				"body" => array(
					"ordnum" => $explodedHash[0],
					"ordkey" => $explodedHash[1],
					"sku"	 => $explodedHash[2]
				),
				"sslverify" => false
			);

			$postResult = wp_remote_post(sprintf(self::$baseUrl, self::$validateTask), $post);
			if (is_wp_error($postResult)) {
				foreach ($postResult->get_error_messages() as $error) {
					VikUpdaterHelper::ReportMessage($error);
					return false;
				}
			} else {
				//Checking if the post response is valid
				if ($postResult['response']['code'] == 200) {
					$postObject = json_decode($postResult['body'], true);
					$postObject['lastCheck'] = time();
					VikUpdaterHelper::CheckCurrentVersion($postObject, $explodedHash[2]);

					/**
					 *
					 * @since 1.3
					 *
					 *	Product is installed, so I must enable the "installed" param.
					 *
					 *
					 */

					$postObject['installed'] = true;
					$storedProducts[$hash] = json_encode($postObject);
					update_option("vikupdater_products", json_encode($storedProducts));
					return true;
				} else {
					update_option("vikupdater_registration_checks", get_option("vikupdater_registration_checks") + 1);
					update_option("vikupdater_last_registration_failed_check", time());
					VikUpdaterHelper::ReportMessage(sprintf(__('Validation Request Failed with an Error: %s'), $postResult['body']));
					return false;
				}
			}
		} else {
			VikUpdaterHelper::ReportMessage(__('Too many requests! Please wait a bit before trying to check updates for a product again.', 'vikupdater'));
		}
	}
	public static function CheckSelfVersion() {
		$product = array();
		$post = array(
			"body" => array(
				"sku" => "vup"
			), 
			"sslverify" => false
		);
		$postResult = wp_remote_post(sprintf(self::$baseUrl, self::$updateTask), $post);
		if (is_wp_error($postResult)) {
			foreach ($postResult->get_error_messages() as $error) {
				VikUpdaterHelper::ReportMessage($error);
			}
		} else {
			//Checking if the post response is valid
			if ($postResult['response']['code'] == 200) {
				$product['lastCheck'] = time();
				$product['version'] = json_decode($postResult['body'], true);
				/**
				 *
				 * @since 1.3
				 *
				 *	Replaced ">" with version_compare: was causing an error. (case: 1.0.7 was greater than 1.0.10)
				 *
				 *
				 */

				if (version_compare($product['version'], VIKUPDATER_VERSION, '>')) {
					return $product['version'];
				} else  {
					return 'latest';
				}
			} else {
				$error = true;
				VikUpdaterHelper::ReportMessage(sprintf(__('Check Request Failed with an Error: %s'), $postResult['body']));
			}
		}

	}
	
	public static function SelfUpdate() {
		$post = array(
			"body" => array(
				"sku"	 => "vup"
			),		
			"sslverify" => false
			
		);
		WP_Filesystem();
		$download_path = VIKUPDATER_DOWNLOADROOT . "vup" . ".zip";
		$plugin_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
		$data = wp_remote_post(sprintf(self::$baseUrl, self::$freeDownload), $post);
		if(is_wp_error($data)) {
			foreach ($data->get_error_messages() as $error) {
				VikUpdaterHelper::ReportMessage($error);
			}
		}
		else {
			if (file_put_contents($download_path, $data['body'])) {
				$unzipfile = unzip_file($download_path, $plugin_path);
				if (!is_wp_error($unzipfile)) {
					unlink($download_path);
					update_option('vikupdater_update_lastcheck', time());
		            return true;				    
			    } else {
			    	unlink($download_path);
			    	VikUpdaterHelper::ReportMessage(__("VikUpdater unzip has failed!"));
			    	foreach ($unzipfile->get_error_messages() as $error) {
						VikUpdaterHelper::ReportMessage($error);
					}
					return false;
			    }
	       	} else {
	       		VikUpdaterHelper::ReportMessage(__("VikUpdater download has failed! Please try again!"));
				return false;
			}
		}
		
		
	}
	public static function CheckLatestVersion($autocheck = 0) {
		$listofproducts = array();
		if (get_option("vikupdater_version_checks") < 3) {
			$storedProducts = json_decode(get_option("vikupdater_products"), true);
			$error = false;
			if (count($storedProducts)) {
				foreach ($storedProducts as $hash => $jsonProduct) {
					$product = json_decode($jsonProduct, true);
					$explodedHash = explode('-', $hash);
					$post = array(
						"body" => array(
							"ordnum" => $explodedHash[0],
							"ordkey" => $explodedHash[1],
							"sku"	 => $explodedHash[2],
							"version" => VikUpdaterHelper::GetInstalledVersion($explodedHash[2])
						),
						"sslverify" => false
					);

					$postResult = wp_remote_post(sprintf(self::$baseUrl, self::$updateTask), $post);

					if (is_wp_error($postResult)) {
						foreach ($postResult->get_error_messages() as $error) {
							VikUpdaterHelper::ReportMessage($error);
						}
					} else {
						//Checking if the post response is valid
						if ($postResult['response']['code'] == 200) {
							
							$product['lastCheck'] = time();
							$product = array_merge($product, json_decode($postResult['body'], true));
							VikUpdaterHelper::CheckCurrentVersion($product, $explodedHash[2]);
							$storedProducts[$hash] = json_encode($product);
							if ($autocheck == 1) {
								$listofproducts[] = $hash;
							}
						} else {
							$error = true;
							VikUpdaterHelper::ReportMessage(sprintf(__('Check Request Failed with an Error: %s'), $postResult['body']));
						}
					}
				}
				update_option("vikupdater_products", json_encode($storedProducts));
				update_option("vikupdater_version_checks", get_option("vikupdater_version_checks") + 1);
				update_option("vikupdater_last_version_failed_check", time());
				if ($autocheck == 1) { 
					return $listofproducts;	
				}
				return !$error;
			} else {
				VikUpdaterHelper::ReportMessage(__('The update request has been aborted due to no plugin registered.', 'vikupdater'));
			}			
		} else {
			VikUpdaterHelper::ReportMessage(__('Too many requests! Please wait a bit before trying to check updates for a product again.', 'vikupdater'));
		}
	}

	public static function DownloadAndInstallProduct($hash) {
		$storedProducts = json_decode(get_option("vikupdater_products"), true);
		WP_Filesystem();
		$explodedHash = explode('-', $hash);
		$post = array(
			"body" => array(
				"ordnum" => $explodedHash[0],
				"ordkey" => $explodedHash[1],
				"sku"	 => $explodedHash[2],
			),
			"sslverify" => false	
		);
		$download_path = VIKUPDATER_DOWNLOADROOT . $explodedHash[2] . ".zip";
		$plugin_path = VikUpdaterHelper::GetInstalledPath($explodedHash[2]);
		if (!isset($storedProducts[$hash])) {
			VikUpdaterHelper::ReportMessage(sprintf(__("Product %s is not registered! Please make sure you have registered the product before you try updating it!"), $explodedHash[2]));
			return false;
		} else if (VikUpdaterHelper::GetInstalledVersion($explodedHash[2]) == "") {
			$product = json_decode($storedProducts[$hash], true);
			VikUpdaterHelper::SetProductUninstalled($product);
			$storedProducts[$hash] = json_encode($product);
			VikUpdaterHelper::ReportMessage(sprintf(__("Product %s is not installed or not active! Please make sure you have installed/activated the product before you try updating it!"), $explodedHash[2]));
			return false;
		} else {
			$data = wp_remote_post(sprintf(self::$baseUrl, self::$downloadTask), $post);
			if (is_wp_error($data)) {
				foreach ($data->get_error_messages() as $error) {
					VikUpdaterHelper::ReportMessage($error);
				}
			} else {
				if (file_put_contents($download_path, $data['body'])) {
					$unzipfile = unzip_file($download_path, $plugin_path);
					if (!is_wp_error($unzipfile)) {
						unlink($download_path);
						self::InstallOverrides($explodedHash[2]);
						$product = json_decode($storedProducts[$hash], true);
						$product['latest'] = true;

						/**
						 *
						 * @since 1.3
						 *
						 *	Product is installed, so I must enable the "installed" param.
						 *
						 *
						 */
						
						$product['installed'] = true;
						$product['installedVersion'] = $product['version'];
						$product['lastCheck'] = time();
						$storedProducts[$hash] = json_encode($product);
						update_option("vikupdater_products", json_encode($storedProducts));
			            return true;				    
				    } else {
				    	unlink($download_path);
				    	VikUpdaterHelper::ReportMessage(__("Product unzip has failed!"));
				    	foreach ($unzipfile->get_error_messages() as $error) {
							VikUpdaterHelper::ReportMessage($error);
						}
						return false;
				    }
	           	} else {
	           		VikUpdaterHelper::ReportMessage(__("Product download has failed! Please try again!"));
					return false;
				}
			}
		}
	}

	public static function InstallOverrides($productName){
		if (!class_exists('JLoader')) {
		// Any of the Vik Plugins are installed
			return false;
		}

		// get the array information of the upload dir
		$upload_dir = wp_upload_dir();
		if (!is_array($upload_dir) || empty($upload_dir['basedir'])) {
			return false;
		}

		// load dependencies
		JLoader::import('adapter.filesystem.folder');

		$mainProduct = apply_filters('vikwp_vikupdater_' . $productName . '_mainplugin','' . $productName . '_mainplugin');
		$theme_dir = apply_filters('vikwp_vikupdater_' . $productName . '_directory','' . $productName . '_dir');
		
		if (!$theme_dir) {
			//this product is not a theme
			return false;	
		}
		// read the content of the overrides folder in the Theme's root dir
		$folders = JFolder::folders($theme_dir . DIRECTORY_SEPARATOR . 'overrides', $filter = '.', $recurse = false, $full = true);
		
		if ($folders !== false) {
			if (!$mainProduct) {

				if ($productName == 'plaza' || $productName == 'seasons') {
					$mainProduct = 'vikbooking';
				} else if ($productName == 'adventures') {
					$mainProduct = 'vikrentcar';
				} else if ($productName == 'medicenter') {
					$mainProduct = 'vikappointments';
				} else {
					//this product is not a theme
					return false;
				}
			}
			$base_dest = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . $mainProduct . DIRECTORY_SEPARATOR . 'overrides' . DIRECTORY_SEPARATOR;

			foreach ($folders as $override_folder) {
				$res = JFolder::copy($override_folder, $base_dest . basename($override_folder), '', true);
				
				if (!$res) {
					VikUpdaterHelper::ReportMessage(__("It was not possible to copy the overrides!"));

				}
			}
		}
		
	}
}
