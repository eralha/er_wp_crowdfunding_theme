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
		var $dbVersion = "0.2";
		var $path = "/account/"; //path to account pages

		function eralha_crowdfunding_account(){
			
		}

		function init(){
			//Do plugin loaded actions
			include "config/post__config.php";
			include "config/postmeta__config.php";

			$this->metaBoxes = getFieldConfig();

			//wp_enqueue_script( 'theme-plugins', get_template_directory_uri() . '/js/plugins.js');
			wp_enqueue_script( 'theme-functions', get_template_directory_uri() . '/js/main.js');

			wp_register_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' );
    		wp_enqueue_style( 'bootstrap' );
		}
		function activationHandler(){
			global $wpdb;
			$tabea_ficheiros = $wpdb->prefix.$this->optionsName."_ficheiros";
			$table_doacoes = $wpdb->prefix.$this->optionsName."_doacoes";

			$sqlTblFicheiros = "CREATE TABLE ".$tabea_ficheiros." 
			(
				`iIdFicheiro` int(8) NOT NULL auto_increment, 
				`iData` int(32) NOT NULL, 
				`iUserId` int(32) NOT NULL, 
				`iPostId` int(32) NOT NULL, 
				`vchTipo` varchar(255) NOT NULL, 
				`vchPathFicheiro` varchar(255) NOT NULL,
				`vchNomeFicheiro` varchar(255) NOT NULL,
				PRIMARY KEY  (`iIdFicheiro`)
			);";
			
			$sqlTblDoacoes = "CREATE TABLE ".$table_doacoes." 
			(
				`iIdDoacao` int(8) NOT NULL auto_increment, 
				`iData` int(32) NOT NULL, 
				`iUserId` int(32) NOT NULL, 
				`iProjecto` int(32) NOT NULL, 
				`iTotal` int(32) NOT NULL, 
				`iValorDoacao` int(32) NOT NULL, 
				`iDoacaoGarantida` int(32) NOT NULL, 
				`vchMetodoPagamento` varchar(32) NOT NULL, 
				`vchEstadoPagamento` varchar(32) NOT NULL, 
				`vchMensagem` varchar(700) NOT NULL, 
				`vchMensagemPrivada` varchar(700) NOT NULL, 
				`vchTelefoneContacto` varchar(700) NOT NULL, 
				PRIMARY KEY  (`idEncomenda`)
			);";

			require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
			dbDelta($sqlTblFicheiros);
			dbDelta($sqlTblDoacoes);

			add_option($this->optionsName."_db_version", $this->dbVersion);
		}
		function deactivationHandler(){
			global $wpdb;

			$tabea_ficheiros = $wpdb->prefix.$this->optionsName."_ficheiros";

			//$wpdb->query("DROP TABLE IF EXISTS ". $tabea_ficheiros);
		}

		function reArrayFiles($file_post) {
		    $file_ary = array();
		    $file_count = count($file_post['name']);
		    $file_keys = array_keys($file_post);

		    for ($i=0; $i<$file_count; $i++) {
		        foreach ($file_keys as $key) {
		            $file_ary[$i][$key] = $file_post[$key][$i];
		        }
		    }
		    return $file_ary;
		}

		function printAdminPage(){
			echo "lorem askdjf kfjd asdkfj jds fj adsfjh <br >j jds fj adsfjh <br >j jds fj adsfjh <br >j jds fj adsfjh <br >j jds fj adsfjh <br >";
		}

		function addPostFiles($fieldName, $post_id){
			//$fileInfo = $this->reArrayFiles($_FILES[$fieldName]);
			global $wpdb;
			$pluginDir = str_replace("", "", plugin_dir_url(__FILE__));

			for($i=0; $i<count($_FILES[$fieldName]['name']); $i++) {
			  //Get the temp file path
			  $tmpFilePath = $_FILES[$fieldName]['tmp_name'][$i];

			  //Make sure we have a filepath
			  if ($tmpFilePath != ""){
			    //Setup our new file path
			    $newFilePath = $pluginDir. "/uploads/" . $_FILES[$fieldName]['name'][$i];

			    $uploadPath = str_replace("http://".$_SERVER['HTTP_HOST']."/", "", $pluginDir);
			    $uploadPath = $uploadPath."uploads/";
			    $fileName = "user_".get_current_user_id()."_".$post_id."_".$_FILES[$fieldName]['name'][$i];

				$up = move_uploaded_file($tmpFilePath, $uploadPath.$fileName);

			    //Upload the file into the temp dir
			    if($up) {
			    	$tabea_ficheiros = $wpdb->prefix.$this->optionsName."_ficheiros";
			    	$wpdb->insert($tabea_ficheiros, 
						array(
						'iData'=>time(), 
						'iUserId'=> get_current_user_id(), 
						'iPostId'=> $post_id, 
						'vchTipo'=> $fieldName, 
						'vchPathFicheiro'=> $uploadPath, 
						'vchNomeFicheiro'=> $fileName
					));
			    }
			  }
			}
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
					include "modules/frontend/account__nav.php";

					switch ($view) {
					    case "info":
					        include "modules/frontend/account__info.php";
					        break;
					    case "new_proj":
					        include "modules/frontend/account__new_proj.php";
					        break;
					    case "proj_list":
					        include "modules/frontend/account__proj_list.php";
					        break;
					    default:
					    	$responseHTML = "";
					}
				}else{
					include "modules/frontend/account__register.php";
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
	global $$_account;
	$_account = $eralha_crowdfunding_account_obj;
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

		add_action('admin_menu', 'eralha_crowdfunding_account_init');

	//Filters
		//Search the content for galery matches
		add_filter('the_content', array($eralha_crowdfunding_account_obj, 'addContent'));

	//scripts
}

//Initialize the admin panel
if (!function_exists("eralha_crowdfunding_account_init")) {
	function eralha_crowdfunding_account_init() {
		global $eralha_crowdfunding_account_obj;
		if (!isset($eralha_crowdfunding_account_obj)) {
			return;
		}
		if ( function_exists('add_submenu_page') ){
			//ADDS A LINK TO TO A SPECIFIC ADMIN PAGE
			add_menu_page('Doações', 'Doações', 'publish_posts', 'enc-screen', array($eralha_crowdfunding_account_obj, 'printAdminPage'));
			/*
				add_submenu_page('enc-screen', 'Gallery List', 'Gallery List', 'publish_posts', 'enc-screen', array($eralha_basket_obj, 'printAdminPage'));
				add_submenu_page('enc-screen', 'Create Gallery', 'Create Gallery', 'publish_posts', 'enc-screen', array($eralha_basket_obj, 'printAdminPage'));
			*/
		}
	}
}
?>