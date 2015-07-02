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
        'config_projeto',         // Unique ID
        esc_html__( 'Configuração Projecto', 'config_projeto' ),       // Title
        'config_projeto',        // Callback function
        'projeto',                 // Admin page (or post type)
        'normal',                   // Context
        'default'                   // Priority
    );
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
    
        if($fieldConfig[$i][2] === "text"){
            ?><div class="field-block">
                <label for=""><?php echo $fieldConfig[$i][0];?>:</label>
                <input type="text" id="<?php echo $fieldConfig[$i][1];?>" name="<?php echo $fieldConfig[$i][1];?>" class="field-full" value="<?php echo $meta_value;?>" />
            </div><?php
        }
        if($fieldConfig[$i][2] === "textarea"){
            ?><div class="field-block editor-spacer">
                <label for=""><?php echo $fieldConfig[$i][0];?>:</label><?php
                wp_editor( $meta_value, $fieldConfig[$i][1], $settings = array() );
            ?></div><?php
        }
        if($fieldConfig[$i][2] === "select"){
            ?><div class="field-block editor-spacer">
                <label for=""><?php echo $fieldConfig[$i][0];?>:</label>
                <select name="<?php echo $fieldConfig[$i][1];?>" id="<?php echo $fieldConfig[$i][1];?>" value="<?php echo $option;?>"><?php
                foreach ($fieldConfig[$i]["options"] as $option ) {
                    ?><option value="<?php echo $option;?>" <?php echo ($meta_value == $option) ? "selected" : "";?>><?php echo $option;?></option><?php
                }
            ?></div></select><?php
        }
        if($fieldConfig[$i][2] === "group") : ?>
            <div class="field-block editor-spacer">
                <label for="proj_recompensas">Níveis / Recompensas: </label>
                <input type="hidden" name="<?php echo $fieldConfig[$i][1];?>" id="<?php echo $fieldConfig[$i][1];?>" value='<?php echo $meta_value;?>'/>
                <div class="recompenssas-list">
                    
                </div>
                <div class="btn btn-primary add-nivel">Adicionar nível</div>
            </div>
            <script>
                (function($){
                    $(document).ready(function(){
                      var niveis = JSON.parse($('#<?php echo $fieldConfig[$i][1];?>').val());
                      var template = $('#tmplNivel').html();

                      function inputChange(){
                        $('.recompenssas-list').find('input').on('input', function() {
                            var index = $(this).parent().parent().parent().index();
                            var prop = $(this).attr('id');
                            niveis[index][prop] = $(this).val();
                            $('#<?php echo $fieldConfig[$i][1];?>').val(JSON.stringify(niveis));
                            console.log(JSON.stringify(niveis));
                        });
                      }

                      function renderFields(){
                        var output = '';
                          for(i in niveis){
                            var temp = template;
                                temp = replaceKeys(temp, '${titulo}', niveis[i].titulo);
                                temp = replaceKeys(temp, '${valor}', niveis[i].valor);
                                temp = replaceKeys(temp, '${descricao}', niveis[i].descricao);
                                temp = replaceKeys(temp, '${index}', niveis[i].index);
                            output += temp;
                          }

                          $('.recompenssas-list').html(output);
                          inputChange();
                      }
                      
                      //first render
                      renderFields();
                    });
                })(jQuery);
            </script>
        <?php endif;
    };

};

/* Display the post meta box. */
function config_projeto( $object, $box ) { 
    wp_nonce_field( basename( __FILE__ ), 'smashing_flautist_access_nonce' );

    $fieldConfig = getFieldConfig()["config_projeto"];
    generateField($fieldConfig, $object);
}
function informacao_promotor( $object, $box ) { 
    wp_nonce_field( basename( __FILE__ ), 'smashing_flautist_access_nonce' );

    $fieldConfig = getFieldConfig()["informacao_promotor"];
    generateField($fieldConfig, $object);
}
function informacao_projeto( $object, $box ) { 
    wp_nonce_field( basename( __FILE__ ), 'smashing_flautist_access_nonce' );

    $fieldConfig = getFieldConfig()["informacao_projecto"];
    generateField($fieldConfig, $object);
?>
<style>
    .recompenssas-list .clearfix { margin-bottom: 10px; }
    .recompenssas-list-item { 
      margin-left: 10px; 
    }
    .recompenssas-list-item .size-half { width: 70%; }
    .recompenssas-list-item ._label {
      width: 100px;
      margin-top: 5px;
      padding-right: 10px;
      text-align: right;
    }
    .field-block { 
        position: relative;
        margin-bottom: 10px; 
    }
    .editor-spacer { margin-bottom: 30px; }
    .field-block label { font-weight: bold; }
    .field-block textarea {
        height: 150px;
    }
    .field-block .field-full{ width:100%; }
</style>
<div id="tmplNivel" class="hidden" type="text/x-jquery-tmpl">
    <div class="recompenssas-list-item">
        <label for="">Nível ${index}</label>
        <div class="clearfix">
            <div class="pull-left _label">Titulo:</div>
            <div class="pull-left size-half"><input type="text" class="form-control" id="titulo" value="${titulo}" /></div>
        </div>
        <div class="clearfix">
            <div class="pull-left _label">Valor:</div>
            <div class="pull-left size-half"><input type="text" class="form-control" id="valor" value="${valor}" /></div>
        </div>
        <div class="clearfix">
            <div class="pull-left _label">Descricao:</div>
            <div class="pull-left size-half"><input type="text" class="form-control" id="descricao" value="${descricao}" /></div>
        </div>
    </div>
</div>
<?php
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