<?php
	/*
		Plugin Name: Crowdfunging User Account
		Plugin URI: 
		Description: It Enables an account for a wordpress template used in crowdfunding websites, add user, edit user info, add projects, edit projects
		Version: 0.0.1
		Author: Emanuel Ralha
		Author URI: 
	*/

// No direct access to this file
defined('ABSPATH') or die('Restricted access');

if (!class_exists("eralha_crowdfunding_account")){
	class eralha_crowdfunding_account{

		var $optionsName = "eralha_crowdfunding_account";
		var $dbVersion = "0.1";

		function eralha_crowdfunding_account(){
			
		}

		function init(){
			//Do plugin loaded actions
			include "config/post__config.php";
			include "config/postmeta__config.php";

			$this->metaBoxes = getFieldConfig();
		}
		function activationHandler(){
			//Do activation stuff here
		}
		function deactivationHandler(){
			//Do deactivation stuff here.
		}

		function validate($form){
			$errorMSG = "";
			$errCount = 0;

			include "validators/$form.php";

			$errorMSG = ($errCount > 0)? "<b>Existem erros nos seguintes campos:</b><p>".$errorMSG."</p>" : "";

			return array($errorMSG, $errCount);
		}

		function createContext($data){
			$params = array(
		      'http' => array(
		          'method' => 'POST',
		          'content' => http_build_query($data)
			   ));
			   $context = stream_context_create($params);
			return $context;
		}

		function addContent($content=''){
			global $wpdb;
			$pluginDir = str_replace("", "", plugin_dir_url(__FILE__));
			set_include_path($pluginDir);

			$successMSG = "";
			$errorMSG = "";

			if(strpos($content, "[er-crowd-account]") !== false){
				if(is_user_logged_in()){
					$view = (isset($_GET["view"]))? $_GET["view"] : "info";
					include "modules/account__nav.php";

					switch ($view) {
					    case "info":
					        include "modules/account__info.php";
					        break;
					    case "new_proj":
					        include "modules/account__new_proj.php";
					        break;
					    default:
					    	$responseHTML = "";
					}
				}else{
					include "modules/account__register.php";
				}
			}

			$responseHTML = str_replace("{REQUEST_URI}", $_SERVER['REQUEST_URI'], $responseHTML);
			//Success Message
			$responseHTML = str_replace("{hidde_success}", ($successMSG != "")? "" : "hidden", $responseHTML);
			$responseHTML = str_replace("{success_message}", $successMSG, $responseHTML);
			//Error message
			$responseHTML = str_replace("{hidde_error}", ($errorMSG != "")? "" : "hidden", $responseHTML);
			$responseHTML = str_replace("{error_message}", $errorMSG, $responseHTML);

			$content = str_replace("[er-crowd-account]", $responseHTML, $content);

			return $content;
		}
	}
}
if (class_exists("eralha_crowdfunding_account")) {
	$eralha_crowdfunding_account_obj = new eralha_crowdfunding_account();
}

//Actions and Filters
if (isset($eralha_crowdfunding_account_obj)) {
	//VARS
		$plugindir = plugin_dir_url( __FILE__ );

	//Actions
		register_activation_hook(__FILE__, array($eralha_crowdfunding_account_obj, 'activationHandler'));
		register_deactivation_hook(__FILE__, array($eralha_crowdfunding_account_obj, 'deactivationHandler'));
		add_action('init', array($eralha_crowdfunding_account_obj, 'init'));
		//add_action('plugins_loaded', array($eralha_crowdfunding_account_obj, 'init'));

	//Filters
		//Search the content for galery matches
		add_filter('the_content', array($eralha_crowdfunding_account_obj, 'addContent'));

}
?>