<?php get_header(); ?>


		<?php
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ));

			$termMain = getMainTerm($term);
			$logoMarca = get_stylesheet_directory_uri()."/images/tax_logo_".$termMain->slug.".png";
		?>

		<div class="catLogo"><img src="<?php echo $logoMarca;?>" /></div>

		<?php if($term->parent == 0){?>
		<div class="listaCategoria clearfix">
			<?php

				$termchildren = get_term_children($term->term_id, get_query_var( 'taxonomy' ));

				foreach ($termchildren as $child ) {
					$term_ = get_term_by( 'id', $child, get_query_var( 'taxonomy' ));
					$cat = str_replace("-".$termMain->slug, "", $term_->slug);
					$link = get_term_link($term_, get_query_var( 'taxonomy' ));
					$img = get_stylesheet_directory_uri()."/images/".$termMain->slug."/img_".$cat.".png";
					?>

					<div class="item">
						<div class="img"><a href="<?php echo $link;?>"><img src="<?php echo $img;?>" /></a></div>
						<h1><?php echo $term_->name;?></h1>
					</div>

				<?php }
			?>
		</div>
		<?php };?>

		<?php if($term->parent != 0){?>

			<?php //we make here the query by and in order to add the filters we need
				$taxQueryArr = array(
					'relation' => 'AND',
					array(
			            'taxonomy' => get_query_var('taxonomy'),
			            'field' => 'slug',
        				'terms' => get_query_var('term')
			        ),
			        array(
						'taxonomy' => 'promocoes',
						'field' => 'slug',
						'terms' => array('nsbikes-2', 'octane'),
						'operator' => 'NOT IN'
					)
				);

				$args = array(
				    'post_type' => 'produto',
				    'orderby' => 'ID', 
        			'order' => 'ASC',
				    'tax_query' => $taxQueryArr
				    );
				$query = new WP_Query($args);
			?>

			<!-- POST CONTENT -->
			<?php if($query->have_posts()) : ?>

				<div class="listaProdutos clearfix">
					<?php while($query->have_posts()) : $query->the_post(); ?>
						<?php get_template_part('uc-loop_produtos');?>
					<?php endwhile; ?>
				</div>
				
			<?php endif; ?>
			<!-- END POST CONTENT -->
		<?php };?>

		<script>
		    (function($) {
		        $(document).ready(function() {
		            
		            parseGrid(".listaCategoria .item", 3);
		            parseGrid2(".listaProdutos .item", 4);

		        });
		    })(jQuery);
		</script>

		<?php get_template_part('uc-bottom');?>


<?php get_footer(); ?>