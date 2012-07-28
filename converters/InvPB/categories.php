<?php

	// Check if ver is 1.3 or not
	if($_SESSION['ver'] == "13")
	{
		// Fetch category info
		$result = $fdb->query('SELECT * FROM '.$_SESSION['php'].'categories WHERE id > 0') or myerror('Unable to fetch categories', __FILE__, __LINE__, $fdb->error());
		while($ob = $fdb->fetch_assoc($result)){
	
			echo $ob['name'].' ('.$ob['id'].")<br>\n"; flush();

			// Dataarray
			$todb = array(
				'id'					=>		$ob['id'],
				'cat_name'			=>		$ob['name'],
				'disp_position'	=>		$ob['position'],
			);
		
			// Save data
			insertdata('categories', $todb, __FILE__, __LINE__);
		}
	}

	// Redirect, don't check for more categories
	echo '<script type="text/javascript">window.location="index.php?page='.++$_GET['page'].'"</script>';

?>