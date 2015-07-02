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

  $the_query = new WP_Query( $args ); ?>

  <?php if ( $the_query->have_posts() ) : ?>

    <!-- pagination here -->
    
    <!-- the loop -->
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <?php get_template_part('uc-post__card');?>
    <?php endwhile; ?>
    <!-- end of the loop -->

    <!-- pagination here -->

    <?php wp_reset_postdata(); ?>

  <?php else : ?>
    
  <?php endif; ?>
</div>