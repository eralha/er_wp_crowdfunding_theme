<?php
	$postObj = (object) [ 
		'postData' => $_POST
	];

	//new project is submited
	if(isset($_POST["wp-submit-project"])){

		$my_post = array(
		    'post_title' => $_POST["proj_title"],
		    'post_date' => date('Y-m-d'),
		    'post_content' => $_POST["proj_resumo"],
		    'post_status' => 'pending',
		    'post_type' => 'projeto',
		);
		//Show wp error detail
		//$the_post_id = wp_insert_post( $my_post, true );
		$the_post_id = wp_insert_post( $my_post );

		$successMSG = ($the_post_id !== 0)? "inserted" : "" ;
		$postObj->hiddeForm = ($the_post_id !== 0)? true : false ;

		//Add all configured meta fields to post meta data
		$groups = $this->metaBoxes;
	    foreach($groups as $g){
	    	$g = $g["fields"];
	        for($i = 0; $i < count($g); $i++){
	        	if(isset($_POST[$g[$i][1]])){
	        		add_post_meta( $the_post_id, $g[$i][1], $_POST[$g[$i][1]] );
	        	}
	        }
	    }
	}

	$taxonomies = array( 'categoria_projecto' );
	$args = array(
	    'orderby'           => 'name', 
	    'order'             => 'ASC',
	    'hide_empty'        => false
	); 

	$terms = get_terms($taxonomies, $args);
	$postObj->terms = $terms;
	$context = $this->createContext($postObj);

	//PARSE VIEW
	$responseHTML = file_get_contents($pluginDir."templates/form__new_proj.php", false, $context);
?>