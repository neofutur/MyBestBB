<?php
/***********************************************************************/

// Some info about your mod.
$mod_title      = 'Easy Poll';
$mod_version    = '1.1.3';
$release_date   = '07-13-05';
$author         = 'Caleb Champlin (Mediator)';
$author_email   = 'med_mediator@hotmail.com';

// One or more versions of PunBB that this mod works on. The version names must match exactly!
// 1.2.12 Fix
$punbb_versions	= array('1.2.3', '1.2.4', '1.2.5', '1.2.6', '1.2.7', '1.2.8', '1.2.9', '1.2.10', '1.2.11', '1.2.12', '1.2.13', '1.2.14', '1.2.15', '1.2.16', '1.2.17','1.2.18','1.2.19','1.2.20','1.2.21','1.2.22','1.2.23' );

// Set this to false if you haven't implemented the restore function (see below)
$mod_restore	= false;


// This following function will be called when the user presses the "Install" button.
function install()
{
	global $db, $db_type, $pun_config;
	$db->query("ALTER TABLE ".$db->prefix."topics ADD `question` VARCHAR(255) NOT NULL, ADD `yes` VARCHAR(30) NOT NULL, ADD `no` VARCHAR(30) NOT NULL") or error('Unable to add columns to table', __FILE__, __LINE__, $db->error());

	switch ($db_type)
	{
		case 'mysql':
		case 'mysqli':
			$sql = 'CREATE TABLE '.$db->prefix."polls (
					id INT(11) NOT NULL AUTO_INCREMENT,
					pollid INT(11) NOT NULL default '0',
					options LONGTEXT NOT NULL,
					voters LONGTEXT NOT NULL,
					ptype tinyint(4) NOT NULL default '0',
					votes LONGTEXT NOT NULL,
					PRIMARY KEY (id)
					) ENGINE=MyISAM;";
			break;

		case 'pgsql':
			$sql = 'CREATE TABLE '.$db->prefix."polls (
					id SERIAL,
					pollid INTEGER NOT NULL default 0,
					options TEXT NOT NULL,
					voters TEXT NOT NULL,
					ptype SMALLINT NOT NULL default 0,
					votes TEXT NOT NULL,
					PRIMARY KEY (id)
					)";
			break;

		case 'sqlite':
			$sql = 'CREATE TABLE '.$db->prefix."polls (
					id INTEGER NOT NULL,
					pollid INTEGER NOT NULL default 0,
					options TEXT NOT NULL,
					voters TEXT NOT NULL,
					ptype INTEGER NOT NULL default 0,
					votes TEXT NOT NULL,
					PRIMARY KEY (id)
					)";
			break;
	}
	$db->query($sql) or error('Unable to create table '.$db->prefix.'polls.',  __FILE__, __LINE__, $db->error());
	
	
	$db->query('INSERT INTO '.$db->prefix."config (conf_name, conf_value) VALUES('poll_max_fields', '10')")	or error('Unable to insert into table '.$db->prefix.'config. Please check your configuration and try again. <a href="JavaScript:history.go(-1)">Go back</a>.', __FILE__, __LINE__, $db->error());


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
