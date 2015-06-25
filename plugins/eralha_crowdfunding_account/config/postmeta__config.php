<?php

/*************************************
      ADDING CUSTOM META BOXES
**************************************/

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'prod_precos_setup' );
add_action( 'load-post-new.php', 'prod_precos_setup' );

/* Meta box setup function. */
function prod_precos_setup() {

    /* Add meta boxes on the 'add_meta_boxes' hook. */
    add_action( 'add_meta_boxes', 'proj_info' );

    /* Save post meta on the 'save_post' hook. */
    add_action( 'save_post', 'save_proj_info', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function proj_info() {
    add_meta_box(
        'informacao_promotor',         // Unique ID
        esc_html__( 'Informação Promotor', 'informacao_promotor' ),       // Title
        'informacao_promotor',        // Callback function
        'projeto',                 // Admin page (or post type)
        'normal',                   // Context
        'default'                   // Priority
    );
    add_meta_box(
        'informacao_projeto',         // Unique ID
        esc_html__( 'Informação Projecto', 'informacao_projeto' ),       // Title
        'informacao_projeto',        // Callback function
        'projeto',                 // Admin page (or post type)
        'normal',                   // Context
        'default'                   // Priority
    );
}

?>
<style>
    .field-block { margin-bottom: 10px; }
    .field-block .field-full{ width:100%; }
</style>
<?php

function getFieldConfig(){
    $curr_include_path = get_include_path();

    $pluginDir = str_replace("", "", plugin_dir_url(__FILE__));
    set_include_path($pluginDir);

    include "meta__fields.php";

    set_include_path($curr_include_path);

    return $metaBoxes;
}

function generateField($fieldConfig, $object){ 
    $fieldConfig = $fieldConfig["fields"];

    for($i = 0; $i < count($fieldConfig); $i++){
        $meta_value = get_post_meta($object->ID, $fieldConfig[$i][1], true );
    ?>

    <div class="field-block">
        <label for=""><?php echo $fieldConfig[$i][0];?>:</label>
        <input type="text" id="<?php echo $fieldConfig[$i][1];?>" name="<?php echo $fieldConfig[$i][1];?>" class="field-full" value="<?php echo $meta_value;?>" />
    </div>

    <?php };
};

/* Display the post meta box. */
function informacao_promotor( $object, $box ) { 
    wp_nonce_field( basename( __FILE__ ), 'smashing_flautist_access_nonce' );

    $fieldConfig = getFieldConfig()["informacao_promotor"];
    generateField($fieldConfig, $object);
}
function informacao_projeto( $object, $box ) { 
    wp_nonce_field( basename( __FILE__ ), 'smashing_flautist_access_nonce' );

    $fieldConfig = getFieldConfig()["informacao_projecto"];
    generateField($fieldConfig, $object);
}

/* Save the meta box's post metadata. */
function save_proj_info($post_id, $post){
    
    /* Make all $wpdb references within this function refer to this variable */
        global $wpdb;

    /* Verify the nonce before proceeding. */
        if ( !isset( $_POST['smashing_flautist_access_nonce'] ) || !wp_verify_nonce( $_POST['smashing_flautist_access_nonce'], basename( __FILE__ ) ) )
            return $post_id;

    /* Get the post type object. */
        $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
        if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
            return $post_id;

    /*PROCESS PROD DATA FROM HERE*/
    $groups = getFieldConfig();

    foreach($groups as $g){
        $g = $g["fields"];
        for($i = 0; $i < count($g); $i++){
            $curr_meta_value = get_post_meta($post_id, $g[$i][1], true );
            $new_meta_value = (isset( $_POST[$g[$i][1]] ) ? $_POST[$g[$i][1]] : '');

            parseMetaValue($post_id, $g[$i][1], $curr_meta_value, $new_meta_value);
        }
    }
    /*END PROCESS PROD DATA*/
}

function parseMetaValue($post_id, $meta_key, $meta_value, $new_meta_value){
    $new_meta_value = str_replace("€", "", $new_meta_value);
    $new_meta_value = str_replace(",", ".", $new_meta_value);

    /* If a new meta value was added and there was no previous value, add it. */
    if($new_meta_value && '' == $meta_value){
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );
    }
    /* If the new meta value does not match the old value, update it. */
    elseif(isset($new_meta_value) && $new_meta_value != $meta_value){
        update_post_meta( $post_id, $meta_key, $new_meta_value );
    }
    /* If there is no new meta value but an old value exists, delete it. */
    elseif('' == $new_meta_value && $meta_value){
        delete_post_meta( $post_id, $meta_key, $meta_value );
    }
}
/*************************************
               END
      ADDING CUSTOM META BOXES
**************************************/

?>