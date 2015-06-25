<?php get_header(); ?>
	<div class="main">
		
		<?php get_template_part( 'loop', 'menu' ); ?>

		<div class="navshadow"></div>

		<?php get_template_part( 'loop', 'destaques' ); ?>


		<div class="conteudos">
			<div class="editor">

				<?php if ( have_posts() ) : ?>
					<h1>Resultados para "<?php echo get_search_query(); ?>":</h1>
					<?php while ( have_posts() ) : the_post(); ?>

						<p>
							<a href="<?php the_permalink() ?>"><b><?php the_title(); ?> »</a>
						</p>

					<?php endwhile; ?>
				<?php else : ?>
					<h1>Não foram encontrados resultados</h1>
						Tente novamente.
				<?php endif; ?>

			</div>
		</div>

		<?php get_template_part( 'loop', 'bottom' ); ?>


	</div>
<?php get_footer(); ?>