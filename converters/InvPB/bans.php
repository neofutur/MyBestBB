<?php

	// v1.3 - Don't convert bans.
	if($_SESSION['ver'] == "13") {
		echo '<script type="text/javascript">window.location="index.php?page='.++$_GET['page'].'"</script>';
	}
	else
	{
		$result = $fdb->query('SELECT * FROM '.$_SESSION['php'].'banfilters WHERE ban_id>'.$start.' ORDER BY ban_id LIMIT '.$_SESSION['limit']) or myerror("Unable to get ban list", __FILE__, __LINE__, $fdb->error());
		$last_id = -1;
		while($ob = $fdb->fetch_assoc($result)){
		
			$last_id = $ob['ban_id'];
		
			// Change ban_type from name to username
			$ob['ban_type'] == 'name' ? $ob['ban_type'] = 'username' : null;

			// Save to database
			$db->query('INSERT INTO '.$_SESSION['pun'].'bans (id,'.$ob['ban_type'].') VALUES('.$ob['ban_id'].', \''.$ob['ban_content'].'\')') or myerror("PunBB: Unable to add ban info<br>", __FILE__, __LINE__, $db->error());
		}
		
		convredirect('ban_id', 'banfilters', $last_id);
	}

?>