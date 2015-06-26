<?php
	function handlerMinorErrors(){
	}
	set_error_handler('handlerMinorErrors', E_NOTICE | E_STRICT);

	$postData = $_POST["postData"];
?>
<!-- REGISTER FORM -->
	
	<div class="bootcards-list">
	  <div class="panel panel-default">
	    <div class="list-group">
		  
		  <?php if(isset($_POST["user_projs"])){ ?>

		  
			  <?php foreach ( $_POST["user_projs"] as $proj ) { ?>

		  		  <?php if($proj["post_status"] !== "pending"){ ?>
			  		<a class="list-group-item" href="<?php echo $proj["guid"];?>">
			  	  <?php }else{ ?>
			  	  	<div class="list-group-item">
			  	  <?php };?>
			        <h4 class="list-group-item-heading"><?php echo $proj["post_title"];?></h4>
			        <p class="list-group-item-text">
			        	<span>Objectivo: <?php echo $proj["meta_data"]["proj_objectivo"][0];?>€</span>
			        	<span>Angariado: <?php echo ($proj["meta_data"]["proj_angariado"][0])? $proj["meta_data"]["proj_angariado"][0] : '0';?>€</span>
			        	<span>Promotor: <?php echo $proj["meta_data"]["proj_nome_promotor"][0];?></span>
			        	<span>Estado: <?php echo $proj["meta_data"]["proj_estado"][0];?></span>
			        </p>
			      <?php if($proj["post_status"] !== "pending"){ ?>
			  		</a>
			  	  <?php }else{ ?>
			  	  	</div>
			  	  <?php };?>
			      
			  <?php }//foreach ?>


			  <?php }else{ ?>
			  	<div class="list-group-item">
			        <h4 class="list-group-item-heading">Não existem projectos em curso</h4>
			        <p class="list-group-item-text">
			        	Neste momento não tem nenhum projecto em curso.
			        </p>
			  	 </div>
			  <?php }//if ?>

	    </div>
	  </div>
	</div>

<!-- END REGISTER FORM -->