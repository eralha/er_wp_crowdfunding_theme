<?php get_header(); ?>

<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
		
		<?php 
			$postMeta = get_post_meta(get_the_ID());
			$angariadoPercent = calcPercent($postMeta);
			$closeIn = daysUntil($postMeta["proj_data_fecho"][0]);

		  $date1 = new DateTime($postMeta["proj_data_fecho"][0]);
		  $date2 = new DateTime(date('Y-m-d h:m:s'));

		  $diff = $date1->diff($date2);

		  $hours = $diff->format('%hh %im');
		?>

		<div class="container container-ficha">
			<div class="row">
				<div class="col-md-12">
					<h1 class="container-ficha-title"><?php the_title(); ?></h1>
					<div class="pull-right">
						<a class="btn btn-social-icon btn-twitter">
						  <i class="fa fa-twitter"></i>
						</a>
						<a class="btn btn-social-icon btn-facebook">
						  <i class="fa fa-facebook"></i>
						</a>
						<a class="btn btn-social-icon btn-linkedin">
						  <i class="fa fa-linkedin"></i>
						</a>
					</div>
					<ul class="nav nav-tabs" style="margin-bottom:20px;">
					  <li role="presentation" class="active"><a href="?view=info">Detalhe do projecto</a></li>
					  <li role="presentation" class=""><a href="?view=info">Apoiantes</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="container container-ficha">
	      <!-- Example row of columns -->
	      <div class="row">
	        <div class="col-md-8">

				<div class="projecto-descricao">
					<div class="projecto-video">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/bp2Q6bnPGQk" frameborder="0" allowfullscreen></iframe>
					</div>
					<div class="projecto-editor">
						<?php the_content(); ?>
					</div>
				</div>

	        </div><!-- CONTENT PRINCIPAL -->
	        <div class="col-md-4 card-ficha card-loop">
	          
	          <article class="panel panel-primary">
				  <header class="panel-heading clearfix">
				    <h1><?php echo $postMeta["proj_total_angariado"][0];?>€</h1>
				    <p>ANGARIADO</p>
				  </header>


				  <div class="panel-body panel-content">

				  	<div class="clearfix card-ficha-info">
				  		<div class="pull-left">
				  			<div class="glyphicon glyphicon-info glyphicon-stats"></div>
				  		</div>
				  		<div class="pull-left">
				  			<p><b><?php echo $angariadoPercent;?>%</b> do objectivo de <b><?php echo $postMeta["proj_total_angariar"][0];?>€</b></p>
				  			<p><b>152</b> Apoiantes</p>
				  			<p>
				  				<?php if($closeIn > 0) : ?>
						    		<span class="glyphicon glyphicon-time"></span><?php echo $closeIn;?> dias para terminar
						    	<?php endif; ?>

						      <?php if($closeIn == 0) : ?>
						        <span class="text-danger"><span class="glyphicon glyphicon-time"></span><?php echo $hours;?> para terminar</span>
						      <?php endif; ?>

						      <?php if($closeIn < 0) : ?>
						    		Terminado
						      <?php endif;?>
				  			</p>
				  			<p class="mt_10">
				  				<span class="fa fa-map-marker"></span> <?php echo $postMeta["proj_localizacao"][0];?>
				  			</p>
				  			<p>
				  				<a href="<?php echo $postMeta["proj_facebook"][0];?>" target="_blank"><span class="fa fa-facebook-square"></span> Facebook</a>
				  			</p>
				  		</div>
				  	</div><!--/PROJ INFO-->

				  </div>

				  <footer class="panel-footer">

				    <div class="btn-group btn-group-justified">
				      <div class="btn-group">
					    <a class="btn btn-success">
					      <i class="glyphicon glyphicon-euro"></i>
					      Apoiar</a>
					  </div>
					</div><!--/goup container -->

				  </footer>
			  </article><!-- end card -->

			  <div class="bootcards-list card-ficha-recompensas">
				  <div class="panel panel-default">
				    <div class="list-group">

				      <div class="list-group-item">
				        <div class="clearfix card-ficha-rec-valor">
				        	<a class="btn btn-success pull-left">Apoie com 25€</a><h4 class="list-group-item-heading">ou mais e receba</h4>
				        </div>
				        <h4 class="list-group-item-heading">Agradecimento, Estreia e Cartaz assinado</h4>
				        <p class="list-group-item-text">Um obrigado na página de facebook da marca!</p>
				      </div><!-- END groupitem -->
				      <div class="list-group-item">
				        <div class="clearfix card-ficha-rec-valor">
				        	<a class="btn btn-success pull-left">Apoie com 25€</a><h4 class="list-group-item-heading">ou mais e receba</h4>
				        </div>
				        <h4 class="list-group-item-heading">Agradecimento, Estreia e Cartaz assinado</h4>
				        <p class="list-group-item-text">O mesmo que o anterior, mas receberá o cartaz oficial do filme assinado pelos atores principais e pelo realizador (a levantar no dia e local das estreias oficiais do filme). Uma lembrança para recordar o projeto que ajudou a montar.</p>
				      </div><!-- END groupitem -->
				      <div class="list-group-item">
				        <div class="clearfix card-ficha-rec-valor">
				        	<a class="btn btn-success pull-left">Apoie com 25€</a><h4 class="list-group-item-heading">ou mais e receba</h4>
				        </div>
				        <h4 class="list-group-item-heading">Agradecimento, Estreia e Cartaz assinado</h4>
				        <p class="list-group-item-text">Um obrigado na página de facebook da marca!</p>
				      </div><!-- END groupitem -->
				      <div class="list-group-item">
				        <div class="clearfix card-ficha-rec-valor">
				        	<a class="btn btn-success pull-left">Apoie com 25€</a><h4 class="list-group-item-heading">ou mais e receba</h4>
				        </div>
				        <h4 class="list-group-item-heading">Agradecimento, Estreia e Cartaz assinado</h4>
				        <p class="list-group-item-text">Um obrigado na página de facebook da marca!</p>
				      </div><!-- END groupitem -->
				      <div class="list-group-item">
				        <div class="clearfix card-ficha-rec-valor">
				        	<a class="btn btn-success pull-left">Apoie com 25€</a><h4 class="list-group-item-heading">ou mais e receba</h4>
				        </div>
				        <h4 class="list-group-item-heading">Agradecimento, Estreia e Cartaz assinado</h4>
				        <p class="list-group-item-text">Um obrigado na página de facebook da marca!</p>
				      </div><!-- END groupitem -->

				    </div>
				  </div>
				</div>

	        </div><!-- CONTENT LATERAL -->

	      </div>

	    </div> <!-- /container -->
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>