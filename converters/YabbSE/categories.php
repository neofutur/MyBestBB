<?php

	// Fetch forum info
	$result = $fdb->query('SELECT * FROM '.$_SESSION['php'].'categories') or myerror('Unable to fetch categories', __FILE__, __LINE__, $fdb->error());
	while($ob = $fdb->fetch_assoc($result))
	{
		echo $ob['name'].' ('.$ob['ID_CAT'].")<br>\n"; flush();

		// Dataarray
		$todb = array(
			'id'					=>		$ob['ID_CAT'],
			'cat_name'			=>		$ob['name'],	
			'disp_position'	=> 	$ob['catOrder'],
		);

		// Save data
		insertdata('categories', $todb, __FILE__, __LINE__);
	}

	// Redirect, don't check for more categories
	echo '<script type="text/javascript">window.location="index.php?page='.++$_GET['page'].'"</script>';

?>