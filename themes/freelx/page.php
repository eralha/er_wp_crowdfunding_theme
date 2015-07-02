<?php get_header(); ?>

		<div class="container">
	      <!-- Example row of columns -->
	      <div class="row">
	        <div class="col-md-8">
	          
				<?php if(have_posts()) : ?>
					<?php while(have_posts()) : the_post(); ?>
						<div class="editor">
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

	        </div>
	        <div class="col-md-4 card-lateral">
	          

	          <?php get_template_part('uc-lateral__projectos');?>


	        </div>
	      </div>

	    </div> <!-- /container -->

<?php get_footer(); ?>