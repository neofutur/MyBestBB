<?php

	// Check if it's PhpBB or PhpNuke
	$result = $fdb->query('SELECT count(*) FROM '.$_SESSION['php'].'bbforums');
	if( $fdb->result($result, 0) == null )
		$_SESSION['phpnuke'] = '';
	else
		$_SESSION['phpnuke'] = 'bb';
	
?>