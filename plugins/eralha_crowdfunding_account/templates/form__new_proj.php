<?php
	function handlerMinorErrors(){
	}
	set_error_handler('handlerMinorErrors', E_NOTICE | E_STRICT);

	$postData = $_POST["postData"];
?>
<!-- REGISTER FORM -->
	
	<div class="alert alert-success {hidde_success}">
		<b>Projecto inserido com sucesso</b>
		<p>O seu projecto irá agora ser avaliado por a nossa equipa, será contactado por nós caso surga algum problema.</p>
	</div>
	<div class="alert alert-danger {hidde_error}">{error_message}</div>
	
	<?php if(!isset($_POST["hiddeForm"])){ ?>
	<form name="registerForm" id="registerForm" action="{REQUEST_URI}" method="post" class="{hidde_form}">
		<p>
			Para instruções e dicas sobre a melhor forma de submeter uma boa candidatura, por favor consulte o nosso manual para promotores.
		</p>
		<fieldset>
			<legend>Promotor</legend>
			<div class="form-group">
				<label for="proj_resp_nome">* Nome: </label>
				<input type="text" class="form-control" name="proj_resp_nome" id="proj_resp_nome" value="<?php echo $postData["proj_resp_nome"];?>" required/>
				<p class="help-block">Nome do promotor. Pode ser diferente do utilizador.</p>
			</div>
			<div class="form-group">
				<label for="proj_resp_telf">* Telefone: </label>
				<input type="text" class="form-control" name="proj_resp_telf" id="proj_resp_telf" value="<?php echo $postData["proj_resp_telf"];?>" required/>
				<p class="help-block">Telefone para contacto do PPL. Não será divulgado.</p>
			</div>
		</fieldset>
		<fieldset>
			<legend>O Projecto</legend>
			<div class="form-group">
				<label for="proj_title">* Titulo: </label>
				<input type="text" class="form-control" name="proj_title" id="proj_title" value="<?php echo $postData["proj_title"];?>" required/>
				<p class="help-block">Título do projecto. Escolha um texto claro e sucinto.</p>
			</div>
			<div class="form-group">
				<label for="proj_objectivo">* Objectivo: </label>
				<input type="number" class="form-control size-theird" name="proj_objectivo" id="proj_objectivo" placeholder="valor.€" value="<?php echo $postData["proj_objectivo"];?>" required/>
				<p class="help-block">Montante mínimo de angariação. Se for atingido ou ultrapassado dentro do prazo de angariação, os fundos serão entregues ao promotor. Caso contrário, serão devolvidos aos apoiantes. Recomendamos que defina este valor consoante as recompensas que pensa oferecer. Pode utilizar este simples simulador em excel.</p>
			</div>
			<div class="form-group">
				<label for="proj_categoria">* Categoria: </label>
				<select class="form-control size-theird" name="proj_categoria" id="proj_categoria" value="<?php echo $postData["proj_categoria"];?>" >
					<option value="">Selecione</option>
					<?php foreach ( $_POST["terms"] as $term ) { ?>
							<option value="<?php echo $term["term_id"];?>"><?php echo $term["name"];?></option>
					<?php } ?>
				</select>
				<p class="help-block">Indique a categoria que melhor descreve este projecto</p>
			</div>
			<div class="form-group">
				<label for="proj_video_url">Video URL: </label>
				<input type="text" class="form-control size-half" name="proj_video_url" id="proj_video_url" value="<?php echo $postData["proj_video_url"];?>" required/>
				<p class="help-block">Endereço do vídeo Youtube ou Vimeo. Exs..: http://www.youtube.com/watch?v=YczoM7E3SKY, http://youtu.be/YczoM7E3SKY ou http://vimeo.com/32463695 Para apoio na produção do vídeo, poderá consultar os nossos parceiros da área do audio-visual. Este campo não é obrigatório na fase inicial de submissão (rascunho).</p>
			</div>
			<div class="form-group">
				<label for="proj_resumo">* Resumo: </label>
				<textarea class="form-control " name="proj_resumo" id="proj_resumo"><?php echo $postData["proj_resumo"];?></textarea>
				<p class="help-block">Montante mínimo de angariação. Se for atingido ou ultrapassado dentro do prazo de angariação, os fundos serão entregues ao promotor. Caso contrário, serão devolvidos aos apoiantes. Recomendamos que defina este valor consoante as recompensas que pensa oferecer. Pode utilizar este simples simulador em excel.</p>
			</div>
		</fieldset>
		<input type="submit" name="wp-submit-project" id="wp-submit-register" class="btn btn-default" value="Criar novo projecto" tabindex="100" />
	</form>

	<script>
		(function($){
		    $(document).ready(function(){
		    	
		    	$('textarea').summernote({
				  height: 100,                 // set editor height

				  minHeight: null,             // set minimum height of editor
				  maxHeight: null,             // set maximum height of editor
				});

		    });
		})(jQuery);
	</script>
	<?php }; ?>

<!-- END REGISTER FORM -->