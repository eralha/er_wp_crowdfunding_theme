<?php get_header(); ?>
	<div class="main">
		
		<?php get_template_part( 'loop', 'menu' ); ?>

		<div class="navshadow"></div>

		<?php get_template_part( 'loop', 'destaques' ); ?>


		<div class="conteudos">
			<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>
					<div class="editor">
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<?php get_template_part( 'loop', 'bottom' ); ?>


	</div>
<?php get_footer(); ?>