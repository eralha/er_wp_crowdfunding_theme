<?php
	$inserted = false;

	if(isset($_POST["wp-submit-register"])){
		$vResult = $this->validate("account__form");
		$errCount = $vResult[1];

		if($errCount == 0){
			$userID = wp_insert_user( 
				array (
					'first_name' => $_POST["first_name"],
					'last_name' => $_POST["last_name"],
					'nickname' => $_POST["nickname"],
					'user_email' => $_POST["user_email"],
					'user_login' => $_POST["user_login_register"],
					'user_pass' => $_POST["user_pass_register"]
			));
			$inserted = true;

			/*
				Add a custom capability to the user
					$user = new WP_User($userID);
					$user->add_cap("edit_posts");
					$user->add_cap("delete_posts");
			*/

			//Add USER INFO
				add_user_meta($userID, "adress", $_POST["adress"], true);
				add_user_meta($userID, "localidade", $_POST["localidade"], true);
				add_user_meta($userID, "codPostal", $_POST["codPostal"], true);
		}
	}

	$vResult = $this->validate("account__form");

	if($inserted === false){
		$context = $this->createContext($_POST);
		$responseHTML = file_get_contents($pluginDir."templates/frontend/register_form.php", false, $context);
		$errorMSG = $vResult[0];
	}

	if($inserted === true){
		$responseHTML = file_get_contents($pluginDir."templates/register_form_response.php");
		$responseHTML = str_replace("{user_login}", $_POST["user_login_register"], $responseHTML);
		$responseHTML = str_replace("{password}", $_POST["user_pass_register"], $responseHTML);
	}
?>