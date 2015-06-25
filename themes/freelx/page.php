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
	        <div class="col-md-4">
	          

	          <div class="panel panel-default">
				  <div class="panel-heading clearfix">
				    <h3 class="panel-title pull-left">Card Title</h3>
				      <a class="btn btn-default pull-right" href="#">
				        <i class="fa fa-check"></i>
				        Button
				      </a>
				  </div>
				  <div class="panel-body">
				    <p>Card content...</p>
				  </div>
				  <div class="panel-footer">
				    <small>Card footer...</small>
				  </div>
				</div>


	        </div>
	      </div>

	    </div> <!-- /container -->


<?php get_footer(); ?>