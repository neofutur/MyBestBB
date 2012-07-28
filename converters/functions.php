<?php

	// Redirect a page
	function convredirect($id, $name, $last){

		global $fdb;
		
		// Have no id
		if($last == ''){
			echo '<script type="text/javascript">window.location="index.php?page='.++$_GET['page'].'"</script>';
			return;
		}
		
		// More rows in database?
		$result = $fdb->query('SELECT '.$id.' FROM '.$_SESSION['php'].$name.' WHERE '.$id.' >'.$last) or error('Unable to get count value for table: '.$name, __FILE__, __LINE__, $fdb->error());
		if(@$fdb->num_rows($result))
			echo '<script type="text/javascript">window.location="index.php?page='.$_GET['page'].'&start='.$last.'"</script>';
		else
			echo '<script type="text/javascript">window.location="index.php?page='.++$_GET['page'].'"</script>';

	}

	function insertdata($table, $todb, $file = __FILE__, $line = __LINE__)
	{
		global $db;

		// Put together the query
		$names = array();
		$vars = array();
		foreach($todb AS $name => $var)
		{
			if ($var != '')
			{
				$names[] = $name;
				$var == 'null' ? $vars[] = $var : $vars[] = '\''.addslashes(stripslashes(html($var))).'\'';
			}
		}

		$query = 'INSERT INTO '.$_SESSION['pun'].$table.' ('.implode(',', $names).') VALUES('.implode(',', $vars).')';
		$db->query($query) or myerror('Unable to save to database.<br><br><b>Query:</b> '.$query.'<br>', $file, $line, $db->error());
	}

	// Check settings
	function checkInputValues()
	{
		global $fdb;
		
		// Check connection
		$conn = @mysql_connect($_SESSION['hostname'], $_SESSION['username'], $_SESSION['password']);
		if(!$conn)
			myerror('Unable to connect to MySQL server. Please check your settings again.<br><br><a href="?page=settings">Go back to settings</a>');

		// Check databases	
		if(!@mysql_select_db($_SESSION['php_db_clean'], $conn))
		{
			// Fetch database list
			$list = '';
			$result = @mysql_query('SHOW databases', $conn);
			while($ob = mysql_fetch_row($result))
				$list .= ' &nbsp <a href="?page=settings&newdb='.$ob[0].'">'.$ob[0].'</a><br>'."\n";

			// Close connection and show message
			mysql_close($conn);
			myerror(
				'Unable to select database.'
				.'<br><br>Found these databases:<br><font color="gray">'.$list.'</font>'
				.'<br><a href="?page=settings">Go back to settings</a>'
			);
		}
		mysql_close($conn);

		// Include FORUM's config file
		include './'.$_SESSION['forum'].'/_config.php';

		// Check prefix
		$fdb = new DBLayer($_SESSION['hostname'], $_SESSION['username'], $_SESSION['password'], $_SESSION['php_db_clean'], $_SESSION['php_prefix'], false);
		$res = $fdb->query('SELECT count(*) FROM '.$_SESSION['php'].$tables['Users']);
		if( intval($fdb->result($res, 0)) == 0)
		{
			// Select a list of tables
			$list = array();
			$res = $fdb->query('SHOW TABLES IN '.$_SESSION['php_db']);
			while($ob = $fdb->fetch_row($res))
				$list[] = $ob[0];

			// check list size
			sizeof($list) == 0 ? $list[] = 'None' : null;

			// Get list of "proabable" prefixes
			$prefix_list = '';
			$res = $fdb->query('SHOW TABLES FROM '.$_SESSION['php_db'].' LIKE \'%'.$tables['Posts'].'\'') or myerror('Unable to fetch table list', __FILE__, __LINE__, $fdb->error());
//			$res = $fdb->query('SHOW TABLES FROM '.$_SESSION['php_db'].' LIKE \'%'.$tables['Users'].'\'') or myerror('Unable to fetch table list', __FILE__, __LINE__, $fdb->error());
			while($ob = $fdb->fetch_row($res))
			{
				$prefix = substr($ob[0], 0, strlen($ob[0]) - strlen($tables['Users']));
				$prefix_list .= ' &nbsp; <a href="?page=settings&newprefix='.$prefix.'">'.$prefix.'</a><br>'."\n";
			}
			
			// Print message
			$prefix = $_SESSION['php_prefix'] == '' ? 'no' : '\''.$_SESSION['php_prefix'].'\'';
			myerror(
				'Unable to find '.$_SESSION['forum'].' tables! (using prefix: <i>'.$prefix.'</i>)'
				.'<br><br>Go back to settings and choose another prefix, or select one of these prefixes:<br><font color="gray">'.$prefix_list.'</font>'
				.'<br>These are the tables in the selected database:<br><font color="gray"> &nbsp; '.implode("<br> &nbsp; ", $list).'</font>'
				.'<br><br><a href="?page=settings">Go back to settings</a>'
			);
		}
	}

	// Print an array
	function mydump($array, $exit = false){

		echo '<pre>';
		print_r($array);
		echo '</pre>';
		
		if($exit)
			exit;

	}

	// Calculate time
	function generatedtime($start, $finish){
		
		list( $start1, $start2 ) = explode( ' ', $start );
		list( $finish1, $finish2 ) = explode( ' ', $finish );

		return sprintf( "%.2f", ($finish1 + $finish2) - ($start1 + $start2) );

	}

	// HTML
	function html($message){
		
		$pattern = array(
			'/&gt;/i',
			'/&lt;/i',
			'/&amp;/i',
			'/&quot;/i',
			'/&#039;/i'
		);

		$replace = array(
			'>',
			'<',
			'&',
			'"',
			"'"
		);
		
		return preg_replace($pattern, $replace, $message);
		
	}
	
	
	//
	// Display a simple error message
	//
	function myerror($message, $file = '', $line = '', $db_error = false)
	{
		global $pun_config;

		// Hack for displaying correct error message when using 1.2 instead of 1.1.*	
		if($db_error != '' && $_SESSION['pun_version'] == '1.2')
		{
			$db_error['error'] = $db_error['error_msg'];
			$db_error['errno'] = $db_error['error_no'];
		}

		// Set a default title if the script failed before $pun_config could be populated
		if (empty($pun_config))
			$pun_config['o_board_title'] = 'PunBB';
	
		// Empty output buffer and stop buffering
		ob_end_clean();

	?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title><?php echo htmlspecialchars($pun_config['o_board_title']) ?> / Error</title>
		<style>
			A { color: #000000; }
		</style>

	</head>
	<body>
	
	<br><br><br><br>
	
	<table style="width: 60%; margin: auto; border: none; background-color: #666666" cellspacing="1" cellpadding="4">
		<tr>
			<td style="font: bold 10px Verdana, Arial, Helvetica, sans-serif; color: #593909; background-color: #CCCCCC">An error was encountered</td>
		</tr>
		<tr>
			<td style="font: 10px Verdana, Arial, Helvetica, sans-serif; background-color: #DEDFDF">
	<?php
	
		if (defined('PUN_DEBUG'))
		{
			if($file != '' || $line != '')
				echo "\t\t\t".'<b>File:</b> '.$file.'<br>'."\n\t\t\t".'<b>Line:</b> '.$line.'<br><br>'."\n\t\t\t";
				
			echo '<b>Converter reported</b>: '.$message."\n";
	
			if ($db_error)
				echo "\t\t\t".'<br><b>Database reported:</b> '.htmlspecialchars($db_error['error']).' (Errno: '.$db_error['errno'].')'."\n";
		}
		else
			echo "\t\t\t".'Error: <b>'.$message.'.</b>'."\n";
	
	?>
			</td>
		</tr>
		<tr>
			<td style="font: 10px Verdana, Arial, Helvetica, sans-serif; color: #593909; background-color: #DEDFDF; padding: 20px;" >
				<b>What to do now!?</b>
				<br><br>
				To solve this problem, please send a mail to <a href="mailto:chacmool@gmail.com">chacmool@gmail.com</a> containing the complete error message above (or else you might not get an answer). If it's possible, <b>please also attach a sql-dump of your database in the mail</b>, as it makes it so much easier for the creator of the converter to find out what's wrong.
			</td>
		</tr>
	</table>

<?php
	if(!@file_exists('DEBUG') && strpos($message, 'These are the tables in the selected database') === false)
	{
		!isset($db_error['error']) ? $db_error['error'] = '' : null;
?>	
	<img src="http://punbbig.shacknet.nu/conv/error.php?version=<?php echo CONV_VERSION; ?>&forum=<?php echo $_SESSION['forum']; ?>&error=<?php echo urlencode($message); ?>&dberror=<?php echo urlencode($db_error['error']); ?>" alt="" border="0" width="1" height="1" />
<?php
	}
?>
	</body>
	</html>
	<?php
	
		// If a database connection was established (before this error) we close it
		if ($db_error)
			$GLOBALS['db']->close();
	
		exit;
	}
	
	function conv_message($message, $no_back_link = false)
	{
		global $lang_common;
?>
	<table class="punspacer" cellspacing="1" cellpadding="4"><tr><td>&nbsp;</td></tr></table>
	
	<table class="punmain" style="width: 60%; margin: auto" cellspacing="1" cellpadding="4">
		<tr class="punhead">
			<td class="punhead">The converter is <b>LOCKED</b></td>
		</tr>
		<tr>
			<td class="puncon1">
				<?php echo $message ?><br><br>
	<?php if (!$no_back_link): ?>			<a href="JavaScript: history.go(-1)">Go back</a> | <a href="JavaScript: history.go(0)">Reload</a>
	<?php endif; ?>		</td>
		</tr>
	</table>
	
	<table class="punspacer" cellspacing="1" cellpadding="4"><tr><td>&nbsp;</td></tr></table>

<?php

	}


	function update_forum_info()
	{
		global $db;
/*
		// Stats: posts
		$restul = $db->query('SELECT count(*) FROM '.$_SESSION['pun'].'posts') or error('Unable to fetch stat count', __FILE__, __LINE__, $db->error());
		$num_posts = $db->result($result, 0);
		// Stats: posts
		$restul = $db->query('SELECT count(*) FROM '.$_SESSION['pun'].'topics') or error('Unable to fetch stat count', __FILE__, __LINE__, $db->error());
		$num_topics = $db->result($result, 0);
		// Stats: users
		$restul = $db->query('SELECT count(*) FROM '.$_SESSION['pun'].'users') or error('Unable to fetch stat count', __FILE__, __LINE__, $db->error());
		$num_users = $db->result($result, 0);
*/
	}






	function remove_indexes()
	{
		global $db;

		// Removing indexes
		$drop = array();
		if($_SESSION['pun_version'] == '1.1')
		{
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'posts DROP INDEX '.$_SESSION['pun_prefix'].'posts_topic_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'posts DROP INDEX '.$_SESSION['pun_prefix'].'posts_poster_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'reports DROP INDEX '.$_SESSION['pun_prefix'].'reports_zapped_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_matches DROP INDEX '.$_SESSION['pun_prefix'].'search_matches_word_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_matches DROP INDEX '.$_SESSION['pun_prefix'].'search_matches_post_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_results DROP INDEX '.$_SESSION['pun_prefix'].'search_results_ident_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'subscriptions DROP INDEX '.$_SESSION['pun_prefix'].'subscriptions_user_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'subscriptions DROP INDEX '.$_SESSION['pun_prefix'].'subscriptions_topic_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'topics DROP INDEX '.$_SESSION['pun_prefix'].'topics_forum_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'users DROP INDEX '.$_SESSION['pun_prefix'].'users_registered_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'users DROP INDEX '.$_SESSION['pun_prefix'].'users_username_idx';
		}
		else
		{
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'online DROP INDEX '.$_SESSION['pun_prefix'].'online_user_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'posts DROP INDEX '.$_SESSION['pun_prefix'].'posts_topic_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'posts DROP INDEX '.$_SESSION['pun_prefix'].'posts_multi_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'reports DROP INDEX '.$_SESSION['pun_prefix'].'reports_zapped_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_matches DROP INDEX '.$_SESSION['pun_prefix'].'search_matches_word_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_matches DROP INDEX '.$_SESSION['pun_prefix'].'search_matches_post_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'topics DROP INDEX '.$_SESSION['pun_prefix'].'topics_forum_id_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'topics DROP INDEX '.$_SESSION['pun_prefix'].'topics_moved_to_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'users DROP INDEX '.$_SESSION['pun_prefix'].'users_registered_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_cache DROP INDEX '.$_SESSION['pun_prefix'].'search_cache_ident_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'users DROP INDEX '.$_SESSION['pun_prefix'].'users_username_idx';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_words DROP INDEX '.$_SESSION['pun_prefix'].'search_words_id_idx';
		}

		@reset($queries);
		while (list(, $sql) = @each($queries))
			$db->query($sql);// or myerror('Unable to create index', __FILE__, __LINE__, $db->error());

	}
	
	function add_indexes()
	{
		global $db;
		$queries = array();

		// PunBB 1.1
		if($_SESSION['pun_version'] == '1.1')
		{
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'posts ADD INDEX '.$_SESSION['pun_prefix'].'posts_topic_id_idx(topic_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'posts ADD INDEX '.$_SESSION['pun_prefix'].'posts_poster_id_idx(poster_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'reports ADD INDEX '.$_SESSION['pun_prefix'].'reports_zapped_idx(zapped)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_matches ADD INDEX '.$_SESSION['pun_prefix'].'search_matches_word_id_idx(word_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_matches ADD INDEX '.$_SESSION['pun_prefix'].'search_matches_post_id_idx(post_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_results ADD INDEX '.$_SESSION['pun_prefix'].'search_results_ident_idx(ident)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'subscriptions ADD INDEX '.$_SESSION['pun_prefix'].'subscriptions_user_id_idx(user_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'subscriptions ADD INDEX '.$_SESSION['pun_prefix'].'subscriptions_topic_id_idx(topic_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'topics ADD INDEX '.$_SESSION['pun_prefix'].'topics_forum_id_idx(forum_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'users ADD INDEX '.$_SESSION['pun_prefix'].'users_registered_idx(registered)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'users ADD INDEX '.$_SESSION['pun_prefix'].'users_username_idx(username(3))';
		}
	
		// PunBB 1.2
		else
		{
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'online ADD INDEX '.$_SESSION['pun_prefix'].'online_user_id_idx(user_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'posts ADD INDEX '.$_SESSION['pun_prefix'].'posts_topic_id_idx(topic_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'posts ADD INDEX '.$_SESSION['pun_prefix'].'posts_multi_idx(poster_id, topic_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'reports ADD INDEX '.$_SESSION['pun_prefix'].'reports_zapped_idx(zapped)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_matches ADD INDEX '.$_SESSION['pun_prefix'].'search_matches_word_id_idx(word_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_matches ADD INDEX '.$_SESSION['pun_prefix'].'search_matches_post_id_idx(post_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'topics ADD INDEX '.$_SESSION['pun_prefix'].'topics_forum_id_idx(forum_id)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'topics ADD INDEX '.$_SESSION['pun_prefix'].'topics_moved_to_idx(moved_to)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'users ADD INDEX '.$_SESSION['pun_prefix'].'users_registered_idx(registered)';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_cache ADD INDEX '.$_SESSION['pun_prefix'].'search_cache_ident_idx(ident(8))';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'users ADD INDEX '.$_SESSION['pun_prefix'].'users_username_idx(username(8))';
			$queries[] = 'ALTER TABLE '.$_SESSION['pun'].'search_words ADD INDEX '.$_SESSION['pun_prefix'].'search_words_id_idx(id)';
		}

		@reset($queries);
		while (list(, $sql) = @each($queries))
			$db->query($sql);// or myerror('Unable to create index', __FILE__, __LINE__, $db->error());

	}

	function truncate_tables()
	{
		global $db;
		
		$truncates = array();
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'categories';
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'censoring';
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'posts';
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'forums';
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'ranks';
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'search_matches';
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'search_results';
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'search_words';
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'topics';
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'users';
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'bans';
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'polls'; // PunPoll
		$truncates[] = 'TRUNCATE TABLE '.$_SESSION['pun'].'messages'; // PunPMS
		while(list( ,$sql) = @each($truncates))
			$db->query($sql);
	}

?>