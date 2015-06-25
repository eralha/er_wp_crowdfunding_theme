<?php

/*************Projectos*****************/
$labels = array(
    'name' => _x( 'Categorias', 'taxonomy general name' ),
    'singular_name' => _x( 'Categoria Projecto', 'taxonomy singular name' ),
    'search_items' =>  __( 'Procurar Categorias' ),
    'all_items' => __( 'Todos as Categorias' ),
    'parent_item' => __( 'Categorias Anteriores' ),
    'parent_item_colon' => __( 'Categorias Anteriores:' ),
    'edit_item' => __( 'Editar Categorias' ), 
    'update_item' => __( 'Actualizar Categoria' ),
    'add_new_item' => __( 'Adicionar nova Categoria' ),
    'new_item_name' => __( 'Nova Categorias' ),
    'menu_name' => __( 'Categorias' ),
); 

register_taxonomy('categoria_projecto', 'projeto', array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'categoria_projecto' ),
));
//REGISTER ITEM POST TYPE
register_post_type( 'projeto',
    array(
        'labels' => array(
            'name' => __( 'Projectos' ),
            'singular_name' => __( 'Projecto' ),
            'add_new' => __( 'Novo Projecto' )
        ),
    'public' => true,
    'has_archive' => true,
    'taxonomies' => array('categoria_projecto')
    )
);
add_post_type_support( 'projeto', array('thumbnail' ) );

/*************END Projectos*****************/

/*************************************
            ADMIN FILTERS
**************************************/

add_action( 'restrict_manage_posts', 'marca_filtro' );
function marca_filtro() {
    $screen = get_current_screen();
    global $wp_query;
    if ($screen->post_type == 'projeto') {
        wp_dropdown_categories( array(
            'show_option_all' => 'Todas as categorias',
            'taxonomy' => 'categoria_projecto',
            'name' => 'Categoria',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['categoria_projecto'] ) ? $wp_query->query['categoria_projecto'] : '' ),
            'hierarchical' => true,
            'depth' => 3,
            'show_count' => false,
            'hide_empty' => true,
        ) );
    }
}

add_filter( 'parse_query', 'perform_filtering' );
function perform_filtering( $query ) {
    $qv = &$query->query_vars;
    if ( ( $qv['Categoria'] ) && is_numeric( $qv['Categoria'] ) ) {
        $term = get_term_by( 'id', $qv['Categoria'], 'Categoria' );
        $qv['Categoria'] = $term->slug;
    }
}

?>