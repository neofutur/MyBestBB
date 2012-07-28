<?php

	// Clear punbb database
	truncate_tables();

	// Remove all indexes
	remove_indexes();

	// Add guest account
	if($_SESSION['pun_version'] == '1.1')
		$db->query('INSERT INTO '.$_SESSION['pun']."users (username, password, email) VALUES('Guest', 'Guest', 'Guest')") or myerror('Unable to add guest user', __FILE__, __LINE__, $db->error());
	else
		$db->query('INSERT INTO '.$_SESSION['pun']."users (group_id, username, password, email) VALUES(3, 'Guest', 'Guest', 'Guest')") or myerror('Unable to add guest user', __FILE__, __LINE__, $db->error());

?>