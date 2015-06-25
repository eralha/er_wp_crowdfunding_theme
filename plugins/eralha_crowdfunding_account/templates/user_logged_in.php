<?php 
//print_r($_POST["data"]);
function handlerMinorErrors(){
}

set_error_handler('handlerMinorErrors', E_NOTICE | E_STRICT);

$metaData = $_POST["data"]["metaData"];
$uinfo = $_POST["data"];
?>

<!-- REGISTER FORM COMPLETE -->
<div class="alert alert-danger {hidde_error}">{error_message}</div>

<form name="registerForm" id="registerForm" action="{REQUEST_URI}" method="post">
	<div class="form-group">
		<label for="first_name">Primeiro Nome: </label>
		<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $metaData["first_name"][0];?>" size="32" tabindex="10" placeholder="O seu primeiro Nome" required/>
	</div>
	<div class="form-group">
		<label for="last_name">Apelido: </label>
		<input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $metaData["last_name"][0];?>" size="32" tabindex="10" placeholder="O seu ultimo Nome" required/>
	</div>
	<div class="form-group">
		<label for="nickname">Nickname(<small>Nome que os outros utilizadores irão ver.</small>): </label>
		<input type="text" class="form-control" name="nickname" id="nickname" value="<?php echo $metaData["nickname"][0];?>" size="20" tabindex="10" placeholder="Nome Que os outros utilizadores vão ver" required/>
	</div>
	<div class="form-group">
		<label for="user_email">Email: </label>
		<input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $uinfo["user_email"];?>" size="32" tabindex="10" placeholder="O seu email" required/>
	</div>
	<div class="form-group">
		<label for="adress">Morada: </label>
		<input type="text" class="form-control" name="adress" id="adress" value="<?php echo $metaData["adress"][0];?>" size="32" tabindex="10" placeholder="Morada" required/>
	</div>
	<div class="form-group">
		<label for="localidade">Localidade: </label>
		<input type="text" class="form-control" name="localidade" id="localidade" value="<?php echo $metaData["localidade"][0];?>" size="32" tabindex="10" placeholder="Localidade" required/>
	</div>
	<div class="form-group">
		<label for="codPostal">Código Postal: </label>
		<input type="text" class="form-control" name="codPostal" id="codPostal" value="<?php echo $metaData["codPostal"][0];?>" size="32" tabindex="10" placeholder="Código postal" required/>
	</div>
	
	<input type="submit" name="wp-submit-update" id="wp-submit-update" class="btn btn-default" value="Actualizar" tabindex="100" />
</form>
<!-- END REGISTER FORM COMPLETE -->