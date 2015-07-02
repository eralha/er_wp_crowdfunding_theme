<?php get_template_part('header');?>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row card-loop card-loop-home">
      	<h1 class="col-md-12 page-title page-title--center">Projectos mais recentes</h1>
      </div>
      
      <?php get_template_part('uc-home__recentes');?>

	  <div class="center-block list-bottom-link">
		<a class="btn btn-primary" href="/projectos/"><i class="glyphicon glyphicon-plus"></i>Veja aqui mais projectos</a>
	  </div>


	  <div class="row row-home-ints-title">
      	<h1 class="col-md-12 page-title page-title--center text-primary">Quer ajudar? É fácil!</h1>
      </div>
      <div class="row row-home-ints">
      	<div class="col-md-4">
      		<div class="glyphicon glyphicon-user text-primary"></div>
      		<h1>1º Crie a sua conta</h1>
      		<p>Aceda à area criar conta no topo da página</p>
      	</div>
      	<div class="col-md-4">
      		<div class="glyphicon glyphicon-search text-primary"></div>
      		<h1>2º Procure um projecto</h1>
      		<p>Na página projectos tem uma listagem de todos os projectos.</p>
      	</div>
      	<div class="col-md-4">
      		<div class="glyphicon glyphicon-euro text-primary"></div>
      		<h1>3º Ajude!</h1>
      		<p>Doe o valor que desejar e veja o projector a ter sucesso.</p>
      	</div>
      </div>
      <div class="center-block list-bottom-link" style="width:142px;">
		<a class="btn btn-primary" href="/projectos/"><i class="glyphicon glyphicon-euro"></i>Apoiar Projecto</a>
	  </div>
      <!-- END QUER AJUDAR -->

	  <div class="row row-home-ints-title">
      	<h1 class="col-md-12 page-title page-title--center text-primary">Precisa de ajuda?</h1>
      </div>
      <div class="row row-home-ints">
      	<div class="col-md-3">
      		<div class="glyphicon glyphicon-user text-primary"></div>
      		<h1>1º Crie a sua conta</h1>
      		<p>Aceda à area criar conta no topo da página</p>
      	</div>
      	<div class="col-md-3">
      		<div class="glyphicon glyphicon-inbox text-primary"></div>
      		<h1>2º Submeta um projecto</h1>
      		<p>Na página projectos tem uma listagem de todos os projectos.</p>
      	</div>
      	<div class="col-md-3">
      		<div class="glyphicon glyphicon-bullhorn text-primary"></div>
      		<h1>3º Divulgue</h1>
      		<p>Doe o valor que desejar e veja o projector a ter sucesso.</p>
      	</div>
      	<div class="col-md-3">
      		<div class="glyphicon glyphicon-euro text-primary"></div>
      		<h1>4º Receba as doações</h1>
      		<p>Doe o valor que desejar e veja o projector a ter sucesso.</p>
      	</div>
      </div>
      <div class="center-block list-bottom-link" style="width:142px;">
		<a class="btn btn-primary" href="<?php echo $_account->path;?>"><i class="glyphicon glyphicon-user"></i>Criar Conta</a>
	  </div><!-- END QUER AJUDAR -->


    </div> <!-- /container -->



<?php get_footer(); ?>