<?php
	// get tax terms to get tax post
  	$args = array(
	    'fields' => 'ids'
	); 
	$terms = get_terms('categoria_projecto', $args);
	$cboTerms = get_terms('categoria_projecto');

  	$args = array(
        'post_type' => 'projeto',
        'posts_per_page' => 3,
        'meta_query' => array (
          array(
            'key' => 'proj_data_fecho',
            'value' => date('Y-m-d', strtotime("today")),
            'type' => 'DATE',
            'compare' => '>'
          )
        ),
        'tax_query' => array(
          array(
            'taxonomy' => 'categoria_projecto',
            'field'    => 'id',
            'terms'    => $terms
          )
        ),
      );

	if(isset($_GET["page"])){
		$args["paged"] = $_GET["page"];
	}
?>
<?php get_template_part('header');?>

	<div class="container">
		<div class="row">

		<h1 class="col-md-12 page-title"><span class="glyphicon glyphicon-search"></span>Pesquisar Projectos</h1>
			
			<form name="filterForm" id="filterForm" action="" method="POST" class="clearfix form-filtros">
				<div class="form-group col-md-2">
					<label class="">Titulo:</label>
					<input type="text" id="filterByTitle" name="filterByTitle" class="form-control" />
				</div>
				<div class="form-group col-md-2">
					<label class="">Categoria:</label>
					<select name="filterByTerm" id="filterByTerm" class="form-control">
						<option value="">Tudo</option>
						<?php foreach ($cboTerms as $term){ ?>
							<option value="<?php echo $term->term_id;?>"><?php echo $term->name;?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-2">
					<label class="">Ordenar por:</label>
					<select name="orderBy" id="orderBy" class="form-control">
						<option value=""></option>
						<option value="">Categorias</option>
					</select>
				</div>
			</form>

		</div>
	</div>
    <div class="container project-list-container">
    	<?php $the_query = new WP_Query( $args ); ?>

		<div data-maxNumPages="<?php echo $the_query->max_num_pages?>" data-foundPosts="<?php echo $the_query->found_posts?>"></div>

		<?php if ( $the_query->have_posts() ) : ?>

			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="col-md-4">
					<?php get_template_part('uc-post__card');?>
				</div>
			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<?php if ( !$the_query->have_posts() &&  $_GET["page"] >= $the_query->max_num_pages ) : ?>
			<div class="no-data">Não existem projectos para mostrar</div>
		<?php endif; ?>

    </div> <!-- /container -->

    <div class="container">
    	<div class="center-block list-bottom-link">
			<button class="btn btn-primary loadMoreProjectos" ><i class="glyphicon glyphicon-plus"></i>Carregar mais projectos</button>
		</div>
    </div>

    <script>projectListPage();</script>



<?php get_footer(); ?>