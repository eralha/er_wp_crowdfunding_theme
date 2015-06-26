<?php get_template_part('header');?>

	<div class="container">
		<div class="row">

		<h1 class="col-md-12 page-title"><span class="glyphicon glyphicon-search"></span>Pesquisar Projectos</h1>
			
		<form name="filterForm" id="filterForm" action="" method="POST" class="clearfix form-filtros">
			<div class="form-group col-md-2">
				<label class="">Titulo:</label>
				<input type="text" class="form-control" />
			</div>
			<div class="form-group col-md-2">
				<label class="">Categoria:</label>
				<select name="" id="" class="form-control">
					<option value="">Tudo</option>
					<option value="">Categorias</option>
				</select>
			</div>
			<div class="form-group col-md-2">
				<label class="">Ordenar por:</label>
				<select name="" id="" class="form-control">
					<option value="">Tudo</option>
					<option value="">Categorias</option>
				</select>
			</div>
		</form>

		</div>
	</div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row card-loop card-loop-home">
	      <?php 
			// get tax terms to get tax post
	      	$args = array(
			    'fields' => 'ids'
			); 
			$terms = get_terms('categoria_projecto', $args);

	      	$args = array(
				'post_type' => 'projeto',
				'posts_per_page' => 3,
				'tax_query' => array(
					array(
						'taxonomy' => 'categoria_projecto',
						'field'    => 'id',
						'terms'    => $terms
					),
				),
			);

			$the_query = new WP_Query( $args ); ?>

			<?php if ( $the_query->have_posts() ) : ?>

				<!-- pagination here -->
				
				<!-- the loop -->
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="col-md-4">
						<?php get_template_part('uc-post__card');?>
					</div>
				<?php endwhile; ?>
				<!-- end of the loop -->

				<!-- pagination here -->

				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
		</div>

		<div class="center-block list-bottom-link">
			<button class="btn btn-primary" ><i class="glyphicon glyphicon-plus"></i>Carregar mais projectos</button>
		</div>


    </div> <!-- /container -->



<?php get_footer(); ?>