<?php

	$vResult = $this->validate("account__form");

	if(isset($_POST["wp-submit-update"])){
		//IF WE ARE HERE USER TRY TO UPDATE USER INFO

		if($vResult[1] == 0){
			//IF EVERY THING IS VALIDATED, UPDATE USER INFO IN TABLE USERS
				wp_update_user(array(
					'ID' => get_current_user_id(), 
					'first_name' => $_POST["first_name"],
					'last_name' => $_POST["last_name"],
					'nickname' => $_POST["nickname"],
					'user_email' => $_POST["user_email"]
				));

			//UPDATE USER META INFO
				update_user_meta(get_current_user_id(), "adress", $_POST["adress"]);
				update_user_meta(get_current_user_id(), "localidade", $_POST["localidade"]);
				update_user_meta(get_current_user_id(), "codPostal", $_POST["codPostal"]);

			$errorMSG = "<strong>Dados actualizados!</strong>";
		}else{
			$errorMSG = $vResult[0];
		}
	}

	//include "templates/user_logged_in.php";

	//PARSE VIEW
	$uinfo = get_userdata(get_current_user_id());
	$uinfo->metaData = get_user_meta(get_current_user_id());
	$context = $this->createContext($uinfo);
	$responseHTML = file_get_contents($pluginDir."templates/user_logged_in.php", false, $context);
?>