<?php
	session_start();

	$pun_root = '../';
	define('PUN_ROOT', '../');
	define('CONV_VERSION', '140');
	@include $pun_root.'include/common.php';
	require 'functions.php';

	// Check if punbb is initialized
	if(!defined('PUN'))
		myerror('Unable to locate PunbB!<br><br>Please put the converter in a subdirectory in the punbb-directory.');

	// Enable debug-mode
	if(!defined('PUN_DEBUG'))
		define('PUN_DEBUG', 1);

	!isset($_SESSION['hostname']) ? $_SESSION['hostname'] = $db_host : null;
	!isset($_SESSION['type']) ? $_SESSION['type'] = 1 : null;

	// Set database and prefix (link from checkInputValues())
	if(isset($_GET['newdb']))
	{
		$_SESSION['php_db'] = '`'.$_GET['newdb'].'´';
		$_SESSION['php_db_clean'] = $_GET['newdb'];
	}
	elseif(isset($_GET['newprefix']))
	{
		$_SESSION['php_prefix'] = $_GET['newprefix'];
	}

	if(isset($_POST['start_converter']))
	{
//		dump($_POST);
		
		// Forum name
		$_SESSION['forum'] = $_POST['forum'];

		// PunBB settings
		$_SESSION['pun_db'] = '`'.$_POST['punbb'].'`';
		$_SESSION['pun_prefix'] = $_POST['punpre'];

		// FORUM prefix
		$_SESSION['php_prefix'] = $_POST['phppre'];

		// Check PunBB version (1.1.* or 1.2)
		$result = $db->query("SHOW TABLES LIKE '".$_SESSION['pun_prefix']."groups'") or myerror('Unable to check PunBB version', __FILE__, __LINE__, $db->error());
		$_SESSION['pun_version'] = $db->num_rows($result) == 0 ? '1.1' : '1.2';

		// Different users for PunBB and FORUM
		$error = '';

		if($_POST['sameordiff'] == 'diff')
		{
			$_SESSION['type'] = 2;
			$_SESSION['hostname'] = $_POST['diff_host'];
			$_SESSION['username'] = $_POST['diff_un'];
			$_SESSION['password'] = $_POST['diff_pass'];
			$_SESSION['php_db_clean'] = $_POST['diff_db'];
			$_SESSION['php_db'] = '`'.$_POST['diff_db'].'`';

			// Check setting
			$error .= $_POST['diff_host'] == '' ? '&part=2&hostname=true' : '';
			$error .= $_POST['diff_un'] == '' ? '&part=2&username=true' : '';
//			$error .= $_POST['diff_db'] == '' ? '&part=2&database=true' : '';
			$error .= $_POST['forum'] == '' ? '&part=2&forum=true' : '';
		}

		else
		{
			$_SESSION['type'] = 1;
			$_SESSION['hostname'] = $db_host;;
			$_SESSION['username'] = $db_username;
			$_SESSION['password'] = $db_password;
	
			// Other forum settings
			$_SESSION['php_db'] = '`'.$_POST['database'].'`';
	
			// Check setting
			$error .= $_POST['database'] == '' ? '&database=true' : '';
			$error .= $_POST['forum'] == '' ? '&forum=true' : '';
		}

		// Redirect back to the settings-page
		if($error != ''){
			header('Location: index.php?page=settings'.$error);
			exit;
		}

		// Database AND prefix (makes all other code easier to have it like this)
		$_SESSION['pun'] = $_SESSION['pun_db'].".".$_SESSION['pun_prefix'];
		$_SESSION['php'] = $_SESSION['php_db'].".".$_SESSION['php_prefix'];

		// FORUM's db without `
		$_SESSION['php_db_clean'] = str_replace('`', '', $_SESSION['php_db']);

		// Check settings
		checkInputValues();

		// Connect to database (might be the same as punbb uses)
		$fdb = new DBLayer($_SESSION['hostname'], $_SESSION['username'], $_SESSION['password'], $_SESSION['php_db_clean'], $_SESSION['php_prefix'], false);

		// Load forum specific settings
		if(file_exists('./'.$_SESSION['forum'].'/_settings.php'))
			include './'.$_SESSION['forum'].'/_settings.php';

		// Limit
		$_SESSION['limit']= 100;

		// Load all forum common start file
		require('start.php');

		// Redirect to first forum convert file
		header("Location: index.php?page=0");

	}

	// Connect to database (might be the same as punbb uses)
	if(isset($_GET['page']) && $_GET['page'] != 'settings')
		$fdb = new DBLayer($_SESSION['hostname'], $_SESSION['username'], $_SESSION['password'], $_SESSION['php_db_clean'], $_SESSION['php_prefix'], false);

	// Header
	require 'header.php';

?>

	<table class="punmain" style="width: 70%; margin: auto" cellspacing="1" cellpadding="4">

<?php
	//	Check for the lock-file
	if(file_exists('LOCKED') && (!isset($_GET['page']) || $_GET['page'] != 'done')){
		conv_message('This converter is locked to prevent other users to alter the databases.<br><br>Please remove the file \'LOCKED\' in the converter directory and reload this page to run the converter again. If you are done with the converter, it\'s okay to remove the entire directory instead.');
		exit;
	}

	// Load the proper page
	if(isset($_GET['page']) && $_GET['page'] != "")
	{

		// Load a page from the array
		if(is_numeric($_GET['page']) && file_exists('./'.$_SESSION['forum'].'/_config.php'))
		{

			// Load converter config
			include './'.$_SESSION['forum'].'/_config.php';
			
			// Load the page from the array
			if($_GET['page'] < sizeof($parts))
			{
				// Set start value
				$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;

?>
			<tr class="punhead">
				<td class="punhead" colspan="1">Converting: <b><?php echo $settings['Forum']; ?></b> - <i><?php echo $parts[$_GET['page']].' ('.$start.')'; ?></i></td>
			</tr>
			<tr>
				<td class="puncon2">
<?php

				// Reset timer
				if($_GET['page'] == 0)
					$_SESSION['conv_start'] = microtime();

				// Load page
				if(file_exists('./'.$_SESSION['forum'].'/'.$parts[$_GET['page']].'.php'))
					include './'.$_SESSION['forum'].'/'.$parts[$_GET['page']].'.php';
				else
					myerror('Unable to load page: <i>'.$_SESSION['forum'].' - '.$parts[$_GET['page']].'</i>');

?>
				</td>
			</tr>
<?php

			}

		}

		// Load a specific page
		else{

			if(file_exists($_GET['page'] . '.php'))
				include str_replace('://', '', $_GET['page']) . '.php';
			else
				include 'settings.php';

			if($_GET['page'] == 'done' && !isset($_POST['submit']))
				echo "\n\t\t".'<img src="http://punbbig.shacknet.nu/conv/img.php?forum='.$_SESSION['forum'].'&posts='.$_SESSION['posts'].'&server='.urlencode($_SERVER["SERVER_NAME"].' | '.$_SESSION['hostname']).'" border="0" height="1" width="1">';

		}

	}

	else
	{

		include 'settings.php';

	}

?>
	</table>
<?php

	if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] == 'settings'))
	{
?>

	<br/>

<?php

	$contents = @implode('', @file('http://punbbig.shacknet.nu/converter.txt'));
	
	if($contents != '' && intval($contents) > CONV_VERSION):
?>

	<table class="punmain" style="width: 70%; margin: auto" cellspacing="1" cellpadding="4">
		<tr class="punhead">
			<td class="punhead"><b>New version</b></td>
		</tr>
		<tr>
			<td class="puncon2">There is a newer version of the converter available, download it here: <a href="http://punbb.org/downloads.php">http://punbb.org/downloads.php</a></td>
		</tr>
	</table>
	
	<br />

<?php
	endif;
?>


	
	<table class="punmain" style="width: 70%; margin: auto" cellspacing="1" cellpadding="4">
		<tr class="punhead">
			<td class="punhead" colspan="4"><b>Forums</b></td>
		</tr>
		<tr>
			<td class="puncon3">Forum name</td>
			<td class="puncon3">Suppported versions</td>
			<td class="puncon3">Last update</td>
			<td class="puncon3">Note</td>
		</tr>
<?php
		if($handle = opendir('./'))
		{
			while(false !== ($file = readdir($handle)))
			{
				if($file != '.' && $file != '..' && @$dir = opendir('./'.$file))
				{
					unset($info);
					if(file_exists('./'.$file.'/_info.php'))
					{
						include './'.$file.'/_info.php';
?>
		<tr>
			<td class="puncon1right"><b><?php echo $file; ?></b>:&nbsp</td>
				<td class="puncon2"><?php echo $info['version']; ?></td>
				<td class="puncon2" nowrap><?php echo $info['update']; ?></td>
				<td class="puncon2"><?php echo $info['note']; ?></td>
			</td>
		</tr>
<?php

					}
					closedir($dir);
				}
			}
		   closedir($handle); 
		}
?>
	</table>
	
<?php
	}

	if(!isset($_GET['page']) || !is_numeric($_GET['page']))
	{

?>

<div style="width: 70%; margin: auto; text-align: right; font: 11px verdana; color: gray;"><p>Made by: David 'Chacmool' Djurbäck<br /><a href="mailto:chacmool@gmail.com">chacmool@gmail.com</a></p></div>

<?php

	}

	// Redirect?
	if(isset($location))
		echo $location;

	// Footer
	include 'footer.php';

?>