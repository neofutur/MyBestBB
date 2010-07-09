<?php
/***********************************************************************/

// Some info about your mod.
$mod_title      = 'Poki BB ChatBox';
$mod_version    = '1.0';
$release_date   = '05-07-20';
$author         = 'Pokemon_JOJO';
$author_email   = 'pokemonjojo@mibhouse.org';

// One or more versions of PunBB that this mod works on. The version names must match exactly!
$punbb_versions	= array('1.2', '1.2.1', '1.2.2', '1.2.3', '1.2.4', '1.2.5', '1.2.6', '1.2.7', '1.2.8', '1.2.9', '1.2.10', '1.2.11', '1.2.12', '1.2.13', '1.2.14', '1.2.15', '1.2.16', '1.2.17','1.2.18','1.2.19','1.2.20','1.2.21','1.2.22' );

// Set this to false if you haven't implemented the restore function (see below)
$mod_restore	= false;


// This following function will be called when the user presses the "Install" button.
function install()
{
	global $db, $db_type, $pun_config;

  $sql1 = 'CREATE TABLE '.$db->prefix."chatbox_msg (
    id int(10) NOT NULL AUTO_INCREMENT,
    poster VARCHAR(200) default NULL,
    poster_id INT(10) NOT NULL DEFAULT '1',
    poster_ip VARCHAR(15) default NULL,
    poster_email VARCHAR(50) default NULL,
    message TEXT,
    posted INT(10) NOT NULL default '0',
    PRIMARY KEY  (id)
    ) TYPE=MyISAM;";
    $db->query($sql1) or error('Unable to create table '.$db->prefix.'chatbox_msg.',  __FILE__, __LINE__, $db->error());

$sql2 = 'ALTER TABLE '.$db->prefix."groups
    ADD g_read_chatbox TINYINT(1) default '1' NOT NULL ,
    ADD g_post_chatbox TINYINT(1) default '1' NOT NULL ,
    ADD g_title_chatbox TEXT default NULL,
    ADD g_post_flood_chatbox SMALLINT(6) default '5' NOT NULL";
    $db->query($sql2) or error('Unable to add column to groups table.',  __FILE__, __LINE__, $db->error());

$sql3 = 'ALTER TABLE '.$db->prefix."users
    ADD num_posts_chatbox INT(10) NOT NULL default '0',
    ADD last_post_chatbox INT(10) default NULL";
    $db->query($sql3) or error('Unable to add column to users table.',  __FILE__, __LINE__, $db->error());

	$chatbox_config = array(
    'cb_height'		=> '800',
    'cb_msg_maxlength'	=> '300',
    'cb_max_msg'	=> '100',
    'cb_disposition'	=> '<strong><pun_username></strong> - <pun_date> - [ <pun_nbpost><pun_nbpost_txt> ] <pun_admin><br /><pun_message><br /><br />',
    'cb_pbb_version'	=> '1.1'
	);
	foreach($chatbox_config AS $key => $value)
	{
		$db->query("INSERT INTO ".$db->prefix."config (conf_name, conf_value) VALUES ('$key', '".$db->escape($value)."')") or error('Unable to add column "'.$key.'" to config table', __FILE__, __LINE__, $db->error());
	}

  $db->query('UPDATE '.$db->prefix.'groups SET g_title_chatbox=\'<strong>[Admin]</strong>&nbsp;-&nbsp;\', g_read_chatbox=1, g_post_chatbox=1, g_post_flood_chatbox=0 WHERE g_id=1') or error('Unable to update group', __FILE__, __LINE__, $db->error());
  $db->query('UPDATE '.$db->prefix.'groups SET g_title_chatbox=\'<strong>[Modo]</strong>&nbsp;-&nbsp;\', g_read_chatbox=1, g_post_chatbox=1, g_post_flood_chatbox=0 WHERE g_id=2') or error('Unable to update group', __FILE__, __LINE__, $db->error());
  $db->query('UPDATE '.$db->prefix.'groups SET g_read_chatbox=1, g_post_chatbox=0, g_post_flood_chatbox=10 WHERE g_id=3') or error('Unable to update group', __FILE__, __LINE__, $db->error());
  $db->query('UPDATE '.$db->prefix.'groups SET g_read_chatbox=1, g_post_chatbox=1, g_post_flood_chatbox=5 WHERE g_id=4') or error('Unable to update group', __FILE__, __LINE__, $db->error());

	// and now, update the cache...
	require_once PUN_ROOT.'include/cache.php';
	generate_config_cache();	
	
  /*
  	DO MOD INSTALLATION HERE
  
  	Here's an example showing how to run different queries depending on $db_type.
  	NOTE: This is just an example! Replace it with whatever queries your mod needs to run.
  
  	switch ($db_type)
  	{
  		case 'mysql':
  		case 'mysqli':
  			$db->query("ALTER TABLE ".$db->prefix."some_table ADD some_column TINYINT(1) NOT NULL DEFAULT 1") or error('Unable to add column "some_column" to table "some_table"', __FILE__, __LINE__, $db->error());
  			break;
  
  		default:
  			$db->query('ALTER TABLE ".$db->prefix."some_table ADD some_column INT(10) NOT NULL DEFAULT 1') or error('Unable to add column "some_column" to table "some_table"', __FILE__, __LINE__, $db->error());
  			break;
  	}
  */
}

// This following function will be called when the user presses the "Restore" button (only if $mod_uninstall is true (see above))
function restore()
{
	global $db, $db_type, $pun_config;

/*
	DO DATABASE RESTORE HERE

	switch ($db_type)
	{
		default:
			$db->query("ALTER TABLE ".$db->prefix."some_table DROP some_column") or error('Unable to drop column "some_column" from table "some_table"', __FILE__, __LINE__, $db->error());
			break;
	}
*/
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
