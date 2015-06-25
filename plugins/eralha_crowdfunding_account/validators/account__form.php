<?php
	if(!isset($_POST["wp-submit-register"]) && !isset($_POST["wp-submit-update"])){
		return;
	}

	if(is_user_logged_in()){ 
		$uinfo = get_userdata(get_current_user_id());

		if(email_exists($_POST["user_email"]) && $uinfo->data->user_email != $_POST["user_email"]){
			$errorMSG .= "» O Email que escolheu já existe<br />";
			$errCount ++;
		}
	}else{
		if(email_exists($_POST["user_email"])){
			$errorMSG .= "» O Email que escolheu já existe<br />";
			$errCount ++;
		}
	}

	if($_POST["first_name"] == ""){
		$errorMSG .= "» Primeiro Nome<br />";
		$errCount ++;
	}
	if($_POST["last_name"] == ""){
		$errorMSG .= "» Ultimo Nome<br />";
		$errCount ++;
	}
	if($_POST["nickname"] == ""){
		$errorMSG .= "» Nickname<br />";
		$errCount ++;
	}
	if($_POST["user_email"] == ""){
		$errorMSG .= "» Email<br />";
		$errCount ++;
	}
	if($_POST["adress"] == ""){
		$errorMSG .= "» Morada<br />";
		$errCount ++;
	}
	if($_POST["localidade"] == ""){
		$errorMSG .= "» Localidade<br />";
		$errCount ++;
	}
	if($_POST["codPostal"] == ""){
		$errorMSG .= "» Código Postal<br />";
		$errCount ++;
	}

	if(!is_user_logged_in()){ 
		if($_POST["user_login_register"] == ""){
			$errorMSG .= "» Username<br />";
			$errCount ++;
		}
		if($_POST["user_pass_register"] == ""){
			$errorMSG .= "» Password<br />";
			$errCount ++;
		}
	}
?>