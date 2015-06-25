<?php
	//PARSE VIEW
	$navInfo = (object) [ 'nav_'.$view => $view ];
	$context = $this->createContext($navInfo);
	$responseHTML = file_get_contents($pluginDir."templates/account__nav.php", false, $context);
	$content = str_replace("[er-crowd-account]", $responseHTML."[er-crowd-account]", $content);
?>