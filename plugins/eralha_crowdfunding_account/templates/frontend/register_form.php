<?php
	function handlerMinorErrors(){
	}

	set_error_handler('handlerMinorErrors', E_NOTICE | E_STRICT);
?>
<!-- REGISTER FORM -->
	
	<div class="alert alert-danger {hidde_error}">{error_message}</div>
	

	<form name="registerForm" id="registerForm" action="{REQUEST_URI}" method="post">
		<fieldset>
			<legend>Informação Pessoal</legend>
			<div class="form-group">
				<label for="first_name">Primeiro Nome: </label>
				<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $_POST["first_name"];?>" size="32" tabindex="10" placeholder="O seu primeiro Nome" required/>
			</div>
			<div class="form-group">
				<label for="last_name">Apelido: </label>
				<input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $_POST["last_name"];?>" size="32" tabindex="10" placeholder="O seu ultimo Nome" required/>
			</div>
			<div class="form-group">
				<label for="nickname">Nickname(<small>Nome que os outros utilizadores irão ver.</small>): </label>
				<input type="text" class="form-control" name="nickname" id="nickname" value="<?php echo $_POST["nickname"];?>" size="20" tabindex="10" placeholder="Nome Que os outros utilizadores vão ver" required/>
			</div>
			<div class="form-group">
				<label for="user_email">Email: </label>
				<input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $_POST["user_email"];?>" size="32" tabindex="10" placeholder="O seu email" required/>
			</div>
			<div class="form-group">
				<label for="adress">Morada: </label>
				<input type="text" class="form-control" name="adress" id="adress" value="<?php echo $_POST["adress"];?>" size="32" tabindex="10" placeholder="Morada" required/>
			</div>
			<div class="form-group">
				<label for="localidade">Localidade: </label>
				<input type="text" class="form-control" name="localidade" id="localidade" value="<?php echo $_POST["localidade"];?>" size="32" tabindex="10" placeholder="Localidade" required/>
			</div>
			<div class="form-group">
				<label for="codPostal">Código Postal: </label>
				<input type="text" class="form-control" name="codPostal" id="codPostal" value="<?php echo $_POST["codPostal"];?>" size="32" tabindex="10" placeholder="Código postal" required/>
			</div>
		</fieldset>
		<fieldset>
			<legend>Informação de Login</legend>
			<div class="form-group">
				<label for="user_login_register">Username: </label>
				<input type="text" class="form-control" name="user_login_register" id="user_login_register" value="<?php echo $_POST["user_login_register"];?>" size="20" tabindex="10" required/>
			</div>
			<div class="form-group">
				<label for="user_pass_register">Password: </label>
				<input type="password" class="form-control" name="user_pass_register" id="user_pass_register" value="<?php echo $_POST["user_pass_register"];?>" size="20" tabindex="10" required/>
			</div>
		</fieldset>
		<input type="submit" name="wp-submit-register" id="wp-submit-register" class="btn btn-default" value="Registar" tabindex="100" />
	</form>

<!-- END REGISTER FORM -->