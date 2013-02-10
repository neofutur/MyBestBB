<?php

	// Settings
	$info = array();
	$result = $db->query('SELECT * FROM '.$_SESSION['php'].'settings');
	while($ob = $db->fetch_assoc($result))
		$info[$ob['name']] = $ob['data'];

	// Dataarray
	$conf = array(
		'o_board_title'		=>	$info['title'],
		'o_server_timezone'	=>	$info['tz_offset'],
	);

	// Save settings
	foreach($conf AS $var => $value)
		$db->query('UPDATE '.$_SESSION['pun'].'config SET conf_value=\''.$value.'\' WHERE conf_name=\''.$var.'\'') or myerror('Unable to update config', __FILE__, __LINE__, $db->error());

	// Load gloval 'end' file
	require './end.php';

	// Redirect
	$location = '<script type="text/javascript">window.location="index.php?page=done"</script>';

?>