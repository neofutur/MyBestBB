<?php

	// Add a "main" category
	echo 'Adding main category'; flush();
	$db->query('INSERT INTO '.$_SESSION['pun']."categories (cat_name, disp_position) VALUES('Forums', 1)")
		or exit('Unable to insert into table '.$db_prefix.'categories. Please check your configuration and try again. <a href="JavaScript: history.go(-1)">Go back</a>.');

	$location = '<script type="text/javascript">window.location="index.php?page='.++$_GET['page'].'"</script>';

?>