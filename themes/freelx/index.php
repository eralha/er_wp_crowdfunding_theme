<?php get_template_part('header');?>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row card-loop card-loop-home">
      	<h1 class="col-md-12 page-title page-title--center">Projectos mais recentes</h1>
      </div>
      
      <?php get_template_part('uc-home__recentes');?>

	  <div class="center-block list-bottom-link">
		<a class="btn btn-primary" href="/projecto/"><i class="glyphicon glyphicon-plus"></i>Veja aqui mais projectos</a>
	  </div>


    </div> <!-- /container -->



<?php get_footer(); ?>