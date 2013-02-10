<?php

	$result = $fdb->query('SELECT * FROM '.$_SESSION['php'].'banned') or myerror("Unable to get posts", __FILE__, __LINE__, $fdb->error());
	while($ob = $fdb->fetch_assoc($result))
	{
		echo '<br>'.$ob['type'].' - '.$ob['value']."\n"; flush();
		
		$todb = array(
			$ob['type']	=>	$ob['value']
		);			
			
		// Save data
		insertdata('bans', $todb, __FILE__, __LINE__);
	}

	// Redirect
	echo '<script type="text/javascript">window.location="index.php?page='.++$_GET['page'].'"</script>';

?>