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
	<form name="registerForm" id="registerForm" action="{REQUEST_URI}" method="post" class="{hidde_form}" enctype="multipart/form-data">
		<p>
			Para instruções e dicas sobre a melhor forma de submeter uma boa candidatura, por favor consulte o nosso manual para promotores.
		</p>
		<fieldset>
			<legend>Promotor</legend>
			<div class="form-group">
				<label for="proj_nome_promotor">* Nome: </label>
				<input type="text" class="form-control" name="proj_nome_promotor" id="proj_nome_promotor" value="<?php echo $postData["proj_nome_promotor"];?>" required/>
				<p class="help-block">Nome do promotor. Pode ser diferente do utilizador.</p>
			</div>
			<div class="form-group">
				<label for="proj_telf_promotor">* Telefone: </label>
				<input type="text" class="form-control size-half" name="proj_telf_promotor" id="proj_telf_promotor" value="<?php echo $postData["proj_telf_promotor"];?>" required/>
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
				<select class="form-control size-theird" name="proj_categoria" id="proj_categoria" value="<?php echo $postData["proj_categoria"];?>" required>
					<option value="">Selecione</option>
					<?php foreach ( $_POST["terms"] as $term ) { ?>
							<option value="<?php echo $term["term_id"];?>"><?php echo $term["name"];?></option>
					<?php } ?>
				</select>
				<p class="help-block">Indique a categoria que melhor descreve este projecto</p>
			</div>
			<div class="form-group">
				<label for="proj_localizacao">* Localizacao: </label>
				<input type="text" class="form-control size-half" name="proj_localizacao" id="proj_localizacao" value="<?php echo $postData["proj_localizacao"];?>" required/>
				<p class="help-block">Localização geográfica do projecto.</p>
			</div>
			<div class="form-group">
				<label for="proj_video_url">Video URL: </label>
				<input type="text" class="form-control size-half" name="proj_video_url" id="proj_video_url" value="<?php echo $postData["proj_video_url"];?>" />
				<p class="help-block">Endereço do vídeo Youtube ou Vimeo. Exs..: http://www.youtube.com/watch?v=YczoM7E3SKY, http://youtu.be/YczoM7E3SKY ou http://vimeo.com/32463695 Para apoio na produção do vídeo, poderá consultar os nossos parceiros da área do audio-visual. Este campo não é obrigatório na fase inicial de submissão (rascunho).</p>
			</div>
			<div class="form-group">
				<label for="proj_facebook">Facebook: </label>
				<input type="text" class="form-control size-half" name="proj_facebook" id="proj_facebook" value="<?php echo $postData["proj_facebook"];?>"/>
				<p class="help-block">Página de facebook do projecto, se existir. Ex.: <a href="http://www.facebook.com/" target="_blank"></a></p>
			</div>
			<div class="form-group">
				<label for="proj_resumo">Resumo: </label>
				<textarea class="form-control " name="proj_resumo" id="proj_resumo"><?php echo $postData["proj_resumo"];?></textarea>
				<p class="help-block">Deixe em branco para usar a versão reduzida do texto completo como sumário.</p>
			</div>
			<div class="form-group">
				<label for="proj_sobre">* Sobre o projecto: </label>
				<textarea class="form-control " name="proj_sobre" id="proj_sobre" max-length="3000"><?php echo $postData["proj_sobre"];?></textarea>
				<p class="help-block">Descrição sucinta, clara e concreta do projecto. (Mínimo 500 caracteres, Máximo 3000).<br />Recomendamos que adicione também o sumário, uma descrição resumida que é mostrada na caixa do projecto em listagens.</p>
			</div>
			<div class="form-group">
				<label for="proj_sobre_promotor">* Sobre o promotor: </label>
				<textarea class="form-control " name="proj_sobre_promotor" id="proj_sobre_promotor" max-length="3000"><?php echo $postData["proj_sobre_promotor"];?></textarea>
				<p class="help-block">Quem são os membros que compõem a equipa. Indicar pequena biografia/CV e motivação. (Mínimo 500 caracteres, Máximo 3000)</p>
			</div>
			<div class="form-group">
				<label for="proj_orcamento">* Orçamento e prazos: </label>
				<textarea class="form-control " name="proj_orcamento" id="proj_orcamento" max-length="3000"><?php echo $postData["proj_orcamento"];?></textarea>
				<p class="help-block">
					Transparência e confiança são fundamentais. Por essa razão, esta informação será tornada pública.<br />
					Explicar principais despesas e porque necessita do apoio. Ex.: edição de livros, impressão, divulgação, contabilidade, etc.<br />
					Referir também principais metas e prazos. Ex.: Conto ter uma maquete dentro de dois meses e as primeiras vendas um mês depois.
				</p>
			</div>
			<div class="form-group">
				<label for="proj_plano_divulgacao">* Plano de divulgação: </label>
				<textarea class="form-control " name="proj_plano_divulgacao" id="proj_plano_divulgacao" max-length="3000"><?php echo $postData["proj_plano_divulgacao"];?></textarea>
				<p class="help-block">
					Que iniciativas pensa utilizar para divulgar, além de email e facebook? E quando? Tem uma estratégia definida? Tem eventos planeados?<br />
					Quantas pessoas próximas (família, amigos, colegas, clientes, etc.) estima conseguir atrair inicialmente e com que montantes? Como vai transmitir a mensagem?<br />
					Esta informação não será tornada pública; serve apenas para análise pela nossa equipa.
				</p>
			</div>
			<!--
			<div class="form-group">
				<label for="proj_recompensas">* Níveis / Recompensas: </label>
				<textarea class="form-control " name="proj_recompensas" id="proj_recompensas" max-length="3000"><?php echo $postData["proj_recompensas"];?></textarea>
				<p class="help-block">
					Nivel de recompensas e respectiva descrição que os doadores irão ter, após apoiar com o valor definido, por exp:<br />
					Titulo: Agradecimento <br />
					Valor: 1€ <br />
					Descrição: Ter o nome na página de agradecimentos.<br />
				</p>
			</div>
			-->
			<div id="tmplNivel" class="hidden" type="text/x-jquery-tmpl">
				<div class="recompenssas-list-item">
					<label for="">Nível ${index}</label>
					<div class="clearfix">
						<div class="pull-left _label">* Titulo:</div>
						<div class="pull-left size-half"><input type="text" class="form-control" id="titulo" value="${titulo}" /></div>
					</div>
					<div class="clearfix">
						<div class="pull-left _label">* Valor:</div>
						<div class="pull-left size-half"><input type="text" class="form-control" id="valor" value="${valor}" /></div>
					</div>
					<div class="clearfix">
						<div class="pull-left _label">* Descricao:</div>
						<div class="pull-left size-half"><input type="text" class="form-control" id="descricao" value="${descricao}" /></div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="proj_recompensas">* Níveis / Recompensas: </label>
				<p class="help-block">
					Nivel de recompensas e respectiva descrição que os doadores irão ter, após apoiar com o valor definido, por exp:<br />
					Titulo: Agradecimento <br />
					Valor: 1€ <br />
					Descrição: Ter o nome na página de agradecimentos.<br />
				</p>
				<input type="hidden" name="proj_recompensas" id="proj_recompensas" value="<?php echo $postData["proj_recompensas"];?>" required/>
				<div class="recompenssas-list"></div>
				<div class="btn btn-primary add-nivel">Adicionar nível</div>
			</div>
			<script>
				(function($){
				    $(document).ready(function(){
				      //start plugin
					  var niveisM = new nivesController();
					  	  niveisM.init();

				      $('.add-nivel').click($.proxy(niveisM.addNivel, niveisM));
				    });
				})(jQuery);
			</script>
			<div class="form-group">
				<label for="proj_imgs">Imagem de Perfil Projecto: </label>
				<input type="file" class="form-control size-half" name="proj_imgs[]" id="proj_imgs[]" accept="image/*" multiple=""/>
				<p class="help-block">
					Imagens adicionais sobre o projecto e/ou equipa<br />
					A dimensão dos ficheiros deve ser inferior a 20 MB.<br />
					Tipos de ficheiros permitidos: png gif jpg jpeg.
				</p>
			</div>
			<div class="form-group">
				<label for="proj_docs">Documentos: </label>
				<input type="file" class="form-control size-half" name="proj_docs[]" id="proj_docs[]" multiple=""/>
				<p class="help-block">
					Poderá anexar documentos que considere importantes para descrever o projecto e/ou a equipa.<br />
					A dimensão dos ficheiros deve ser inferior a 20 MB.<br />
					Tipos de ficheiros permitidos: txt pdf doc docx xls xlsx ppt pptx rtf zip mp3.</p>
			</div>
		</fieldset>
		<input type="submit" name="wp-submit-project" id="wp-submit-register" class="btn btn-primary" value="Criar novo projecto" tabindex="100" />
	</form>

	<script>
		(function($){
		    $(document).ready(function(){

		    	$('input[type=file]').change(function(e){
				  var names = [];
				    for (var i = 0; i < $(this).get(0).files.length; ++i) {
				        names.push($(this).get(0).files[i]);
				    }
				    console.log(names);
				});

		    	function sendFile(file,editor,welEditable) {
				    data = new FormData();
				    data.append("file", file);
				    $.ajax({
				        data: data,
				        type: "POST",
				        url: "/ajax/saveimage",
				        cache: false,
				        contentType: false,
				        processData: false,
				        success: function(url) {
				           editor.insertImage(welEditable, url);
				        }
				    });
				}
		    	
		    	$('textarea').summernote({
				  height: 100,                 // set editor height

				  minHeight: null,             // set minimum height of editor
				  maxHeight: null,             
				  onImageUpload: function(files, editor, welEditable) {
			        //sendFile(files[0],editor,welEditable);
			      }
				});

		    });
		})(jQuery);
	</script>
	<?php }; ?>

<!-- END REGISTER FORM -->