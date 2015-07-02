<?php
	$postObj = (object) [ 
		'postData' => $_POST
	];

	global $current_user;

	$query = array(
	    'post_type' => 'projeto',
	    'author' => $current_user->ID,
	    'post_status' => array('publish', 'pending', 'private'),
	    'orderby'  => 'ID',
	    'order'    => 'DESC',
	    'posts_per_page' => -1
	);
	$query = new WP_Query($query);

	//this will add all posts and post meta data to an object
	$postObj->user_projs = array();
	foreach ($query->posts as $post) {
	  $postObj->user_projs[$post->ID] = $post;
	  $postObj->user_projs[$post->ID]->meta_data = get_post_meta($post->ID);
	}

	$context = $this->createContext($postObj);

	//PARSE VIEW
	$responseHTML = file_get_contents($pluginDir."templates/frontend/proj__list.php", false, $context);

?>