<?php

// Enable post thumbnails
add_theme_support('post-thumbnails');
set_post_thumbnail_size(300, 250, true);

register_nav_menus( array(
    'primary-menu' => __( 'Topo Menu', '' ),
    'bottom-menu' => __( 'Menu Bottom', '' )
) );

function calcPercent($postMeta){
    $angariado = (int) $postMeta["proj_total_angariado"][0];
    $angariar = (int) $postMeta["proj_total_angariar"][0];
    $angariadoPercent = ceil(($angariado * 100) / $angariar);

    return $angariadoPercent;
}

function get_image_url(){
    /*
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id, 'large');
    $image_url = $image_url[0];
    */

    $pID = get_the_ID();
    $meta = get_post_meta($pID);

    echo '/wp-content/files_mf/'.$meta["imagem_listagem"][0];
} 


function getMainTerm($term){
    while($term->parent != 0){
        $term = get_term_by("id", $term->parent, "categoria_projecto");
    }
    return $term;
}


// Define what post types to search
function searchAll( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_type', array( 'post', 'page', 'feed', 'evento', 'produto'));
    }
    return $query;
}

// The hook needed to search ALL content
add_filter( 'the_search_query', 'searchAll' );


?>