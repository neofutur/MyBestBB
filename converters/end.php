<?php

	// Add indexes
	echo "Adding database indexes...<br>\n"; flush();
	add_indexes();

	// Regenerate the cache files
	echo "Regenerating caches files...<br>\n"; flush();
	$old_prefix = $db->prefix;
	$db->prefix = $_SESSION['pun'];
	require_once PUN_ROOT.'include/cache.php';
	generate_bans_cache();
	generate_quickjump_cache();
	generate_config_cache();
	generate_ranks_cache();
	$db->prefix = $old_prefix;

	// End the timer
	$_SESSION['conv_end'] = microtime();

	// Create lock file
	echo "Closing the converter...<br>\n"; flush();
	if( !@file_exists('DEBUG') )
		@touch('LOCKED');

?>