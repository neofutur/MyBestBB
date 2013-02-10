<?php

	// Dataarray
	$todb = array(
		'id'					=>		'1',
		'cat_name'			=>		'Forums',
		'disp_position'	=> 	'0',
	);

	// Save data
	insertdata('categories', $todb, __FILE__, __LINE__);

	// Redirect, don't check for more categories
	echo '<script type="text/javascript">window.location="index.php?page='.++$_GET['page'].'"</script>';

?>