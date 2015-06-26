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