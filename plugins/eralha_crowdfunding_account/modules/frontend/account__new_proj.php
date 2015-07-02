<?php
	$postObj = (object) [ 
		'postData' => $_POST
	];

	//new project is submited
	if(isset($_POST["wp-submit-project"])){

		$my_post = array(
		    'post_title' => $_POST["proj_title"],
		    'post_date' => date('Y-m-d H:i:s'),
		    'post_status' => 'pending',
		    'post_type' => 'projeto',
		    /*
		    'tax_input' => array(
		    	'categoria_projecto' => array_map('intval', (array) $_POST['proj_categoria']),
		    )
		    */
		);
		//Show wp error detail
		//$the_post_id = wp_insert_post( $my_post, true );
		$the_post_id = wp_insert_post( $my_post );

		//post successfully inserted
		if($the_post_id !== 0){
			wp_set_object_terms( $the_post_id, array_map('intval', (array) $_POST['proj_categoria']), 'categoria_projecto' );
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

		    //add status to project
		    add_post_meta( $the_post_id, "proj_estado", "Em análise");

		    $this->addPostFiles("proj_imgs", $the_post_id);
		    $this->addPostFiles("proj_docs", $the_post_id);
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
	$responseHTML = file_get_contents($pluginDir."templates/frontend/form__new_proj.php", false, $context);


	/*
	if ($_FILES['file']['name']) {
        if (!$_FILES['file']['error']) {
            $name = md5(rand(100, 200));
            $ext = explode('.', $_FILES['file']['name']);
            $filename = $name . '.' . $ext[1];
            $destination = '/assets/images/' . $filename; //change this directory
            $location = $_FILES["file"]["tmp_name"];
            move_uploaded_file($location, $destination);
            echo 'http://test.yourdomain.al/images/' . $filename;//change this URL
        }
        else
        {
          echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
        }
    }
	*/
?>