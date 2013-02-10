<?php
/***********************************************************************/

// Some info about your mod.
$mod_title      = 'Reputation System';
$mod_version    = '2.2.0';
$release_date   = '06-04-24';
$author         = 'hcs';
$author_email   = 'hcs@mail.ru';

///Mysql error
///Error: 1062 SQLSTATE: 23000 (ER_DUP_ENTRY) 
///Message: Duplicate entry '%s' for key %d

///Error: 1054 SQLSTATE: 42S22 (ER_BAD_FIELD_ERROR) 
///Message: Unknown column '%s' in '%s'

///Error: 1146 SQLSTATE: 42S02 (ER_NO_SUCH_TABLE) 
///Message: Table '%s.%s' doesn't exist

///Error: 1060 SQLSTATE: 42S21 (ER_DUP_FIELDNAME) 
///Message: Duplicate column name '%s'

///Error: 1050 SQLSTATE: 42S01 (ER_TABLE_EXISTS_ERROR) 
///Message: Table '%s' already exists

///Error: 1061 SQLSTATE: 42000 (ER_DUP_KEYNAME) 
///Message: Duplicate key name '%s'

// One or more versions of PunBB that this mod works on. The version names must match exactly!
$punbb_versions	= array('1.2.10', '1.2.11', '1.2.12', '1.2.13', '1.2.14', '1.2.15', '1.2.16', '1.2.17','1.2.18','1.2.19','1.2.20','1.2.21','1.2.22','1.2.23' );

// Set this to false if you haven't implemented the restore function (see below)
$mod_restore	= false;


// This following function will be called when the user presses the "Install" button.
function install()
{
	global $db, $db_type, $pun_config;
	
	switch ($db_type)
	{
		case 'mysql':
		case 'mysqli':

		///Try to drop 	last_reputation_voice column from version 1.0.1	
		$result = $db->query('SELECT last_reputation_voice FROM '.$db->prefix.'users LIMIT 0, 1');
		$xxx = $db->error();
		if ($xxx['error_no'] == '0' ) {
		///Column Exists, drop them
			$result = $db->query('ALTER TABLE '.$db->prefix.'users DROP COLUMN last_reputation_voice') or error('Unable to DROP COLUMN last_reputation_voice in  table '.$db->prefix.'users.',  __FILE__, __LINE__, $db->error());
		}
		elseif ($xxx['error_no'] != '1054' ) {
			error('Unable to check last_reputation_voice table '.$db->prefix.'users.',  __FILE__, __LINE__, $db->error());
		}
		
		
		///Try to add into users table reputation data
		$result = $db->query('ALTER TABLE '.$db->prefix.'users ADD COLUMN reputation_minus INT(11) UNSIGNED DEFAULT 0');
		$xxx = $db->error();			
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1060') {
			error('Unable to add column eputation_minus into table '.$db->prefix.'users.',  __FILE__, __LINE__, $db->error());
		}
		$result = $db->query('ALTER TABLE '.$db->prefix.'users ADD COLUMN reputation_plus INT(11) UNSIGNED DEFAULT 0');
		$xxx = $db->error();			
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1060') {
			error('Unable to add column  reputation_plus into table '.$db->prefix.'users.',  __FILE__, __LINE__, $db->error());
		}		
		
		$result = $db->query('ALTER TABLE '.$db->prefix.'users ADD COLUMN reputation_enable SMALLINT DEFAULT 1');
		$xxx = $db->error();			
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1060') {
			error('Unable to add column reputation_enable into table '.$db->prefix.'users.',  __FILE__, __LINE__, $db->error());
		}		
		
		
		///Try to create reputation table
		$result = $db->query('CREATE TABLE '.$db->prefix.'reputation (id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, user_id INT(10) UNSIGNED NOT NULL DEFAULT 0,	from_user_id INT(10) UNSIGNED NOT NULL DEFAULT 0, time INT(10) UNSIGNED NOT NULL DEFAULT 0,	post_id INT(10) UNSIGNED NOT NULL DEFAULT 0, reason TEXT NOT NULL, rep_plus TINYINT(1) UNSIGNED NOT NULL DEFAULT 0, rep_minus TINYINT(1) UNSIGNED NOT NULL  DEFAULT 0, topics_id INT(10) UNSIGNED NOT NULL DEFAULT 0, PRIMARY KEY (id) )ENGINE=MyISAM;');
		$xxx = $db->error();
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1050') {
			error('Unable to create table '.$db->prefix.'reputation.',  __FILE__, __LINE__, $db->error());
		}
		elseif ($xxx['error_no'] == '1050')
		{
			$result = $db->query('ALTER TABLE '.$db->prefix.'reputation ADD COLUMN rep_plus TINYINT(1) UNSIGNED NOT NULL DEFAULT 0');
			$xxx = $db->error();
					if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1060') {
						error('Unable to add column rep_plus into table '.$db->prefix.'users.',  __FILE__, __LINE__, $db->error());
					}
			$result = $db->query('ALTER TABLE '.$db->prefix.'reputation ADD COLUMN rep_minus TINYINT(1) UNSIGNED NOT NULL  DEFAULT 0');
			$xxx = $db->error();
					if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1060') {
						error('Unable to add column  rep_minus into table '.$db->prefix.'users.',  __FILE__, __LINE__, $db->error());
					}					
		}
		
		
		///Try to create indexes
		$db->query('ALTER TABLE '.$db->prefix.'reputation ADD INDEX rep_post_id_idx(post_id);');
		$xxx = $db->error();
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1061') {
			error('Unable to create INDEX rep_post_id_idx in '.$db->prefix.'reputation.',  __FILE__, __LINE__, $db->error());
		}		
		$db->query('ALTER TABLE '.$db->prefix.'reputation ADD INDEX rep_multi_user_id_idx(topics_id, from_user_id);');
		$xxx = $db->error();
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1061') {
			error('Unable to create INDEX rep_multi_user_id_idx '.$db->prefix.'reputation.',  __FILE__, __LINE__, $db->error());
		}		
	
		
		////////«десь мы пытаемс€ сконвертировать существующие данные доставшиес€ от проЎлых версий
		$db->query('UPDATE '.$db->prefix.'reputation SET rep_plus=1 WHERE  method=1');
		$xxx = $db->error();
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1054') {		
		 	error('Unable to set rep_plus', __FILE__, __LINE__, $db->error());
		}
		
 		$db->query('UPDATE '.$db->prefix.'reputation SET rep_minus=1 WHERE  method=2');
 		$xxx = $db->error();
 		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1054') {		
		 	error('Unable to set rep_minus', __FILE__, __LINE__, $db->error());
		}
		
		$result = $db->query('SELECT u.id, u.reputation_plus, u.reputation_minus, SUM(r.rep_plus) AS count_rep_plus, SUM(r.rep_minus) AS count_rep_minus  FROM '.$db->prefix.'users AS u  LEFT JOIN '.$db->prefix.'reputation as r ON (r.user_id=u.id) WHERE (u.reputation_plus>0 OR u.reputation_minus>0) GROUP BY u.id ORDER BY u.id') or error('Unable to get reputation data to convert table users', __FILE__, __LINE__, $db->error()); 		
		//if ($db->num_rows($result))
		while ($cur_rep = $db->fetch_assoc($result))
		{
			$rep_plus=$cur_rep['reputation_plus']-$cur_rep['count_rep_plus'];
			$rep_minus=$cur_rep['reputation_minus']-$cur_rep['count_rep_minus'];
			if ($rep_plus>0)
			{
				for ($i = 1; $i <= $rep_plus; $i++) {
					$db->query("INSERT INTO ".$db->prefix."reputation (user_id, from_user_id, time, post_id, reason, topics_id, rep_plus) Values ('". $cur_rep['id'] . "', '0' , '1110000000', '0', 'Removed or deleted', '0', '1' )") or error('Unable to add reputation info', __FILE__, __LINE__, $db->error());
				}	
			}
			if ($rep_minus>0)
			{
				for ($i = 1; $i <= $rep_minus; $i++) {				
					$db->query("INSERT INTO ".$db->prefix."reputation (user_id, from_user_id, time, post_id, reason, topics_id, rep_minus) Values ('". $cur_rep['id'] . "', '0' , '1110000000', '0', 'Removed or deleted', '0', '1' )") or error('Unable to add reputation info', __FILE__, __LINE__, $db->error());
				}
			}
		}
		/// теперь можно удалить ставшие ненужными столбцы из users и столбец method из репы
		$result = $db->query('ALTER TABLE '.$db->prefix.'reputation DROP COLUMN method');
		$xxx = $db->error();
 		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1091') {
			 error('Unable to DROP COLUMN method in  table reputation',  __FILE__, __LINE__, $db->error());
 		}
		$result = $db->query('ALTER TABLE '.$db->prefix.'users DROP COLUMN reputation_plus');
		$xxx = $db->error();		
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1091') {
			  error('Unable to DROP COLUMN reputation_plus in  table users.',  __FILE__, __LINE__, $db->error());
 		}
		$result = $db->query('ALTER TABLE '.$db->prefix.'users DROP COLUMN reputation_minus');
		$xxx = $db->error();		
 		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1091') {
			 error('Unable to DROP COLUMN reputation_minus in  table users.',  __FILE__, __LINE__, $db->error());
 		}
 			
 		
 		/// Try update to version 2.2 //////////////////////////////////////////////////////////////////
 		///	Try to add reputation_enable_adm
 		$result = $db->query('ALTER TABLE '.$db->prefix.'users ADD COLUMN reputation_enable_adm TINYINT(1) UNSIGNED DEFAULT 1');
 		$xxx = $db->error();			
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1060') {
			error('Unable to add column reputation_enable_adm into table '.$db->prefix.'users.',  __FILE__, __LINE__, $db->error());
		}
 		///	Try to add g_rep_minus_mi
 		$result = $db->query('ALTER TABLE '.$db->prefix.'groups ADD COLUMN g_rep_minus_min INT(10) UNSIGNED DEFAULT 0');
 		$xxx = $db->error();			
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1060') {
			error('Unable to add column g_rep_minus_min into table '.$db->prefix.'groups.',  __FILE__, __LINE__, $db->error());
		} 		
 		
 		///	Try to add g_rep_plus_min 
		$result = $db->query('ALTER TABLE '.$db->prefix.'groups ADD COLUMN g_rep_plus_min INT(10) UNSIGNED DEFAULT 0');
 		$xxx = $db->error();			
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1060') {
			error('Unable to add column g_rep_plus_min into table '.$db->prefix.'groups.',  __FILE__, __LINE__, $db->error());
		}
				
		///	Try to add g_rep_enable
		$result = $db->query('ALTER TABLE '.$db->prefix.'groups ADD COLUMN g_rep_enable SMALLINT DEFAULT 1');
 		$xxx = $db->error();			
		if ($xxx['error_no'] != '0' && $xxx['error_no'] != '1060') {
			error('Unable to add column g_rep_enable into table '.$db->prefix.'groups.',  __FILE__, __LINE__, $db->error());
		} 	
		/////////////////////////////////////////////////////////////////////////////////////////////// 	
 					
		///Try to add config value
		$config = array(
		'o_reputation_enabled'			=> '1',
		'o_reputation_timeout'			=> '300',
		);
		while (list($conf_name, $conf_value) = @each($config)){
			$db->query('INSERT INTO '.$db->prefix."config (conf_name, conf_value) VALUES('$conf_name', $conf_value)");
				$xxx = $db->error();
				if ($xxx['error_no'] != '1062' && $xxx['error_no'] != '0') {
						error('Unable to insert config value into table '.$db->prefix.'config. ',  __FILE__, __LINE__, $db->error());
				}
		}		
			break;

	}
	
	
	$d = dir(PUN_ROOT.'cache');
	while (($entry = $d->read()) !== false)
	{
		if (substr($entry, strlen($entry)-4) == '.php')
			@unlink(PUN_ROOT.'cache/'.$entry);
	}


	$db->close();
}

// This following function will be called when the user presses the "Restore" button (only if $mod_uninstall is true (see above))
function restore()
{
	global $db, $db_type, $pun_config;
}

/***********************************************************************/

// DO NOT EDIT ANYTHING BELOW THIS LINE!


// Circumvent maintenance mode
define('PUN_TURN_OFF_MAINT', 1);
define('PUN_ROOT', './');
require PUN_ROOT.'include/common.php';

// We want the complete error message if the script fails
if (!defined('PUN_DEBUG'))
	define('PUN_DEBUG', 1);

// Make sure we are running a PunBB version that this mod works with
if(!in_array($pun_config['o_cur_version'], $punbb_versions))
	exit('You are running a version of PunBB ('.$pun_config['o_cur_version'].') that this mod does not support. This mod supports PunBB versions: '.implode(', ', $punbb_versions));

$style = (isset($cur_user)) ? $cur_user['style'] : $pun_config['o_default_style'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $mod_title ?> installation</title>
<link rel="stylesheet" type="text/css" href="style/<?php echo $pun_config['o_default_style'].'.css' ?>" />
</head>
<body>

<div id="punwrap">
<div id="puninstall" class="pun" style="margin: 10% 20% auto 20%">

<?php

if (isset($_POST['form_sent']))
{
	if (isset($_POST['install']))
	{
		// Run the install function (defined above)
		install();

?>
<div class="block">
	<h2><span>Installation successful</span></h2>
	<div class="box">
		<div class="inbox">
			<p>Your database has been successfully prepared for <?php echo pun_htmlspecialchars($mod_title) ?>. See readme.txt for further instructions.</p>
		</div>
	</div>
</div>
<?php

	}
	else
	{
		// Run the restore function (defined above)
		restore();

?>
<div class="block">
	<h2><span>Restore successful</span></h2>
	<div class="box">
		<div class="inbox">
			<p>Your database has been successfully restored.</p>
		</div>
	</div>
</div>
<?php

	}
}
else
{

?>
<div class="blockform">
	<h2><span>Mod installation</span></h2>
	<div class="box">
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?foo=bar">
			<div><input type="hidden" name="form_sent" value="1" /></div>
			<div class="inform">
				<p>This script will update your database to work with the following modification:</p>
				<p><strong>Mod title:</strong> <?php echo pun_htmlspecialchars($mod_title).' '.$mod_version ?></p>
				<p><strong>Author:</strong> <?php echo pun_htmlspecialchars($author) ?> (<a href="mailto:<?php echo pun_htmlspecialchars($author_email) ?>"><?php echo pun_htmlspecialchars($author_email) ?></a>)</p>
				<p><strong>Disclaimer:</strong> Mods are not officially supported by PunBB. Mods generally can't be uninstalled without running SQL queries manually against the database. Make backups of all data you deem necessary before installing.</p>
<?php if ($mod_restore): ?>				<p>If you've previously installed this mod and would like to uninstall it, you can click the restore button below to restore the database.</p>
<?php endif; ?>			</div>
			<p><input type="submit" name="install" value="Install" /><?php if ($mod_restore): ?><input type="submit" name="restore" value="Restore" /><?php endif; ?></p>
		</form>
	</div>
</div>
<?php

}

?>

</div>
</div>

</body>
</html>
