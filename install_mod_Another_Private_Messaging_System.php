<?php

// Informations a propos de votre mod.
$mod_title      = 'Another Private Messaging System';
$mod_version    = '1.2';
$release_date   = '17/06/2006';
$author         = 'Vincent Garnier ; original Private Messaging System 1.2.x version by Connorhd and original Private Messaging System 1.1.x version by David \'Chacmool\' Djurbäck';
$author_email   = 'vin100@forx.fr';

// Reglez cela a FALSE si vous n'avez pas implemente une fonction de restauration (voir plus bas)
$mod_restore	= true;


/***********************************************************************\
 The install function 
\***********************************************************************/

function install()
{
	global $lang, $db, $db_type;
	
	// test prior releases
	$result1 = $db->query('SELECT count(*) FROM '.$db->prefix.'config WHERE conf_name=\'o_pms_enabled\'') or error($lang['err_1'], __FILE__, __LINE__, $db->error());
	$test_11x = ($db->result($result1) == 0) ? false : true;

	$result2 = $db->query('SELECT g_pm, g_pm_limit FROM '.$db->prefix.'groups');
	$test_12x = ($result2) ? true : false;
	
	$result3 = $db->query('SELECT count(*) FROM '.$db->prefix.'config WHERE conf_name=\'o_pms_popup\'') or error($lang['err_1'], __FILE__, __LINE__, $db->error());
	$test_3 = ($db->result($result3) == 0) ? false : true;
	
	$result4 = $db->query('SELECT count(*) FROM '.$db->prefix.'config WHERE conf_name=\'o_pms_max_receiver\'') or error($lang['err_1'], __FILE__, __LINE__, $db->error());
	$test_4 = ($db->result($result4) == 0) ? false : true;
	
	
	// New Install
	if (!$test_11x)
	{
		switch ($db_type)
		{
			case 'mysql':
			case 'mysqli':
				$sql = 'CREATE TABLE '.$db->prefix."messages (
				id INT(10) NOT NULL AUTO_INCREMENT,
				owner int(10) NOT NULL DEFAULT 0,
				subject VARCHAR(255) NOT NULL DEFAULT '',
				message TEXT NOT NULL DEFAULT '',
				sender VARCHAR(200) NOT NULL DEFAULT '',
				sender_id INT(10) NOT NULL DEFAULT 0,
				posted INT(10) NOT NULL DEFAULT 0,
				sender_ip VARCHAR(15),
				smileys TINYINT(1) DEFAULT 1,
				status TINYINT(1) DEFAULT 0,
				showed TINYINT(1) DEFAULT 0,
				PRIMARY KEY (id)
				) TYPE=MyISAM;";
				break;
			
			case 'pgsql':
				$sql = 'CREATE TABLE '.$db->prefix."messages (
				id serial,
				owner INT NOT NULL DEFAULT 0,
				subject VARCHAR(255) NOT NULL DEFAULT 0,
				message TEXT NOT NULL DEFAULT '',
				sender VARCHAR(200) NOT NULL DEFAULT '',
				sender_id INT NOT NULL DEFAULT 0,
				posted INT NOT NULL DEFAULT 0,
				sender_ip VARCHAR(15),
				smileys SMALLINT DEFAULT 1,
				status SMALLINT DEFAULT 0,
				showed SMALLINT DEFAULT 0,
				PRIMARY KEY (id)
				) ";
				break;
			
			case 'sqlite':
				$sql = 'CREATE TABLE '.$db->prefix."messages (
				id INTEGER,
				owner INTEGER NOT NULL DEFAULT 0,
				subject VARCHAR(255) NOT NULL DEFAULT 0,
				message TEXT NOT NULL DEFAULT '',
				sender VARCHAR(200) NOT NULL DEFAULT '',
				sender_id INTEGER NOT NULL DEFAULT 0,
				posted INTEGER NOT NULL DEFAULT 0,
				sender_ip VARCHAR(15),
				smileys INTEGER DEFAULT 1,
				status INTEGER DEFAULT 0,
				showed INTEGER DEFAULT 0,
				PRIMARY KEY (id)
				) ";
				break;
		}
		
		$db->query($sql) or error(sprintf($lang['err_2'], $db->prefix.'messages'), __FILE__, __LINE__, $db->error());
		
		$config = array('o_pms_enabled' => '1', 'o_pms_mess_per_page' => '10');
		while (list($conf_name, $conf_value) = @each($config))
		{
			$db->query('INSERT INTO '.$db->prefix."config (conf_name, conf_value) VALUES('$conf_name', $conf_value)") or error(sprintf($lang['err_3'], $db->prefix.'config'), __FILE__, __LINE__, $db->error());
		}
	}
	
	// upgrade fron 1.2.x
	if (!$test_12x)
	{
		switch ($db_type)
		{
			case 'mysql':
			case 'mysqli':
				$sql = 'ALTER TABLE '.$db->prefix.'groups '.
				'ADD g_pm TINYINT(1) NOT NULL DEFAULT 1, '.
				'ADD g_pm_limit INT NOT NULL DEFAULT 20 ';
				break;
			
			case 'pgsql':
				$sql = 'ALTER TABLE '.$db->prefix.'groups '.
				'ADD g_pm SMALLINT NOT NULL DEFAULT 1, '.
				'ADD g_pm_limit INT NOT NULL DEFAULT 20 ';
				break;
			
			case 'sqlite':
				$sql = 'ALTER TABLE '.$db->prefix.'groups '.
				'ADD g_pm INTEGER NOT NULL DEFAULT 1, '.
				'ADD g_pm_limit INTEGER NOT NULL DEFAULT 20 ';
				break;
		}

		$db->query($sql) or error(sprintf($lang['err_3'], $db->prefix.'groups'), __FILE__, __LINE__, $db->error());
	}
		
	// APMS 1.2
	if (!$test_3)
	{
		# add 'use_pm' in users
		switch ($db_type)
		{
			case 'mysql':
			case 'mysqli':
				$sql = 'ALTER TABLE '.$db->prefix.'users '.
				'ADD use_pm TINYINT(1) NOT NULL DEFAULT 1';
				break;
			
			case 'pgsql':
				$sql = 'ALTER TABLE '.$db->prefix.'users '.
				'ADD use_pm SMALLINT NOT NULL DEFAULT 1';
				break;
			
			case 'sqlite':
				$sql = 'ALTER TABLE '.$db->prefix.'users '.
				'ADD use_pm INTEGER NOT NULL DEFAULT 1';
				break;
		}
		$db->query($sql) or error(sprintf($lang['err_3'], $db->prefix.'users'), __FILE__, __LINE__, $db->error());
		
		# add 'popup_pm' in users
		switch ($db_type)
		{
			case 'mysql':
			case 'mysqli':
				$sql = 'ALTER TABLE '.$db->prefix.'users '.
				'ADD popup_pm TINYINT(1) NOT NULL DEFAULT 1';
				break;
			
			case 'pgsql':
				$sql = 'ALTER TABLE '.$db->prefix.'users '.
				'ADD popup_pm SMALLINT NOT NULL DEFAULT 1';
				break;
			
			case 'sqlite':
				$sql = 'ALTER TABLE '.$db->prefix.'users '.
				'ADD popup_pm INTEGER NOT NULL DEFAULT 1';
				break;
		}
		$db->query($sql) or error(sprintf($lang['err_3'], $db->prefix.'users'), __FILE__, __LINE__, $db->error());
		
		# add o_pms_popup config field
		$config = array('o_pms_popup' => '0');
		while (list($conf_name, $conf_value) = @each($config))
		{
			$db->query('INSERT INTO '.$db->prefix."config (conf_name, conf_value) VALUES('$conf_name', $conf_value)") or error(sprintf($lang['err_3'], $db->prefix.'config'), __FILE__, __LINE__, $db->error());
		}
	}
		
	// finish install, add contacts table and additionals config settings
	if (!$test_4)
	{
		# add contacts table
		switch ($db_type)
		{
			case 'mysql':
			case 'mysqli':
				$sql = 'CREATE TABLE '.$db->prefix."contacts (
				id INT(10) NOT NULL AUTO_INCREMENT,
				user_id INT(10) NOT NULL DEFAULT 0,
				contact_id INT(10) NOT NULL DEFAULT 0,
				contact_name VARCHAR(200) NOT NULL DEFAULT '',
				allow_msg TINYINT(1) NOT NULL DEFAULT 1,
				PRIMARY KEY (id)
				) TYPE=MyISAM;";
				break;
			
			case 'pgsql':
				$sql = 'CREATE TABLE '.$db->prefix."contacts (
				id serial,
				user_id INT(10) NOT NULL DEFAULT 0,
				contact_id INT(10) NOT NULL DEFAULT 0,
				contact_name VARCHAR(200) NOT NULL DEFAULT '',
				allow_msg SMALLINT NOT NULL DEFAULT 1,
				PRIMARY KEY (id)
				) ";
				break;
			
			case 'sqlite':
				$sql = 'CREATE TABLE '.$db->prefix."contacts (
				id INTEGER,
				user_id INTEGER NOT NULL DEFAULT 0,
				contact_id INTEGER NOT NULL DEFAULT 0,
				contact_name VARCHAR(200) NOT NULL DEFAULT '',
				allow_msg INTEGER NOT NULL DEFAULT 1,
				PRIMARY KEY (id)
				) ";
				break;
		}
		
		$db->query($sql) or error(sprintf($lang['err_2'], $db->prefix.'contacts'), __FILE__, __LINE__, $db->error());
		
		# add 'o_pms_max_receiver' and 'o_pms_notification' config fields
		$config = array('o_pms_max_receiver' => '5', 'o_pms_notification' => '1');
		while (list($conf_name, $conf_value) = @each($config))
		{
			$db->query('INSERT INTO '.$db->prefix."config (conf_name, conf_value) VALUES('$conf_name', $conf_value)") or error(sprintf($lang['err_3'], $db->prefix.'config'), __FILE__, __LINE__, $db->error());
		}
		
		# add 'notify_mp' in users
		switch ($db_type)
		{
			case 'mysql':
			case 'mysqli':
				$sql = 'ALTER TABLE '.$db->prefix.'users '.
				'ADD notify_mp TINYINT(1) NOT NULL DEFAULT 1';
				break;
			
			case 'pgsql':
				$sql = 'ALTER TABLE '.$db->prefix.'users '.
				'ADD notify_mp SMALLINT NOT NULL DEFAULT 1';
				break;
			
			case 'sqlite':
				$sql = 'ALTER TABLE '.$db->prefix.'users '.
				'ADD notify_mp INTEGER NOT NULL DEFAULT 1';
				break;
		}
		$db->query($sql) or error(sprintf($lang['err_3'], $db->prefix.'users'), __FILE__, __LINE__, $db->error());
	}
	
	// delete everything in the cache since we messed with some stuff
	$d = dir(PUN_ROOT.'cache');
	while (($entry = $d->read()) !== false)
	{
		if (substr($entry, strlen($entry)-4) == '.php')
			@unlink(PUN_ROOT.'cache/'.$entry);
	}
	$d->close();	
}


/***********************************************************************\
 The restore function 
\***********************************************************************/

function restore()
{
	global $lang, $db, $db_type;
	
	$errors = array();
	
	if (!$db->query('DELETE FROM '.$db->prefix.'config WHERE conf_name = \'o_pms_enabled\' LIMIT 1;'))
		$errors[] = sprintf($lang['err_5'], $db->prefix.'config =&gt; o_pms_enabled');
		
	if (!$db->query('DELETE FROM '.$db->prefix.'config WHERE conf_name = \'o_pms_mess_per_page\' LIMIT 1;'))
		$errors[] = sprintf($lang['err_5'], $db->prefix.'config =&gt; o_pms_mess_per_page');
		
	if (!$db->query('DELETE FROM '.$db->prefix.'config WHERE conf_name = \'o_pms_max_receiver\' LIMIT 1;'))
		$errors[] = sprintf($lang['err_5'], $db->prefix.'config =&gt; o_pms_max_receiver');
		
	if (!$db->query('DELETE FROM '.$db->prefix.'config WHERE conf_name = \'o_pms_notification\' LIMIT 1;'))
		$errors[] = sprintf($lang['err_5'], $db->prefix.'config =&gt; o_pms_notification');
		
	if (!$db->query('DELETE FROM '.$db->prefix.'config WHERE conf_name = \'o_pms_popup\' LIMIT 1;'))
		$errors[] = sprintf($lang['err_5'], $db->prefix.'config =&gt; o_pms_popup');
	
	if (!$db->query('ALTER TABLE '.$db->prefix.'groups DROP g_pm, DROP g_pm_limit ;'))
		$errors[] = sprintf($lang['err_5'], $db->prefix.'groups =&gt; g_pm / '.$db->prefix.'groups =&gt; g_pm_limit');
	
	if (!$db->query('ALTER TABLE '.$db->prefix.'users DROP notify_mp ;'))
		$errors[] = sprintf($lang['err_5'], $db->prefix.'users =&gt; notify_mp');
	
	if (!$db->query('ALTER TABLE '.$db->prefix.'users DROP use_pm ;'))
		$errors[] = sprintf($lang['err_5'], $db->prefix.'users =&gt; use_pm');
	
	if (!$db->query('ALTER TABLE '.$db->prefix.'users DROP popup_pm ;'))
		$errors[] = sprintf($lang['err_5'], $db->prefix.'users =&gt; popup_pm');

	if (!$db->query('DROP TABLE '.$db->prefix.'messages ;'))
		$errors[] = sprintf($lang['err_5'], $db->prefix.'messages');
	
	if (!$db->query('DROP TABLE '.$db->prefix.'contacts ;'))
		$errors[] = sprintf($lang['err_5'], $db->prefix.'contacts');
			
	// delete everything in the cache since we messed with some stuff
	$d = dir(PUN_ROOT.'cache');
	while (($entry = $d->read()) !== false)
	{
		if (substr($entry, strlen($entry)-4) == '.php')
			@unlink(PUN_ROOT.'cache/'.$entry);
	}
	$d->close();	
	
	if (!empty($errors))
		error('<ul><li>'.implode('</li><li>',$errors).'</li></ul>', '', '');
}


/***********************************************************************\
 Languages definitions
\***********************************************************************/

$english_array = array(
'err_1' => 'Unable to access to the configuration',
'err_2' => 'Unable to create table %s',
'err_3' => 'Unable to insert in table %s',
'err_4' => 'Unable to add column to the table %s',
'err_5' => 'Unable to delete %s ; please remove manually',
'err_6' => 'You are running a version of PunBB (%s) that this mod does not support. This mod supports PunBB versions: %s',

'install_mod_x' => '%s installation',
'install_mod' => 'Mod installation',

'mod_title' => 'Mod title:',
'mod_author' => 'Author:',
'disclaimer' => 'Disclaimer:',

'install_mod_p1' => 'This script will update your database to work with the following modification:',
'install_mod_p2' => 'Mods are not officially supported by PunBB. Mods generally can\'t be uninstalled without running SQL queries manually against the database. Make backups of all data you deem necessary before installing.',
'install_mod_p3' => 'If you\'ve previously installed this mod and would like to uninstall it, you can click the restore button below to restore the database.',

'install' => 'Install',
'restore' => 'Restore',

'install_success' => 'Installation successful',
'install_success_info' => 'Your database has been successfully prepared for %s. See readme.txt for further instructions.',

'restore_success' => 'Restore successful',
'restore_success_info' => 'Your database has been successfully restored.',

);

$french_array = array(
'err_1' => 'Impossible d\'accéder à la configuration',
'err_2' => 'Impossible de créer la table %s',
'err_3' => 'Impossible d\'insérer dans la table %s',
'err_4' => 'Impossible d\'ajouter des colonnes à la table %s',
'err_5' => 'Impossible de supprimer %s ; veuillez supprimer manuellement.',
'err_6' => 'Vous utilisez une version de PunBB (%s) que cette mod ne prend pas en charge. Cette mod supporte les versions %s de PunBB',

'install_mod_x' => 'Installation %s',
'install_mod' => 'Installation mod',

'mod_title' => 'Titre mod&nbsp;:',
'mod_author' => 'Auteur&nbsp;:',
'disclaimer' => 'Disclaimer&nbsp;:',

'install_mod_p1' => 'Ce script va mettre à jour votre base de données afin qu\'elle puisse fonctionner avec la modification suivante&nbsp;:',
'install_mod_p2' => 'Veuillez noter que les mods ne sont pas officiellement supportées par PunBB. Vous ne pouvez généralement pas désinstaller complètement les mods sans lancer manuellement des requêtes à la base de données. N\'oubliez pas de sauvegarder la base de données et les fichiers affectés avant de procéder à l\'installation. Vous êtes le seul et unique responsable des éventuels domages que pourrait engendrer l\'installation de la mod. Vous effectuez cette modification à vos risques et périls.',
'install_mod_p3' => 'Si vous avez précédemment installé cette mod et voulez la désinstaller, vous pouvez cliquer sur le bouton de restauration ci-dessous afin de restaurer la base de données.',

'install' => 'Installation',
'restore' => 'Restauration',

'install_success' => 'Installation réussie',
'install_success_info' => 'Votre base de donnée a été correctement préparé pour %s. Veuillez consulter le lisez_moi.txt pour les instructions complémentaires.',

'restore_success' => 'Restauration réussie',
'restore_success_info' => 'Votre base de données à été correctement restaurée.',

);


/***********************************************************************\
 Running and displaying 
\***********************************************************************/

// Circumvent maintenance mode
define('PUN_TURN_OFF_MAINT', 1);
define('PUN_ROOT', './');
require PUN_ROOT.'include/common.php';

// We want the complete error message if the script fails
if (!defined('PUN_DEBUG'))
	define('PUN_DEBUG', 1);

// Set language
if ($pun_config['o_default_lang'] == 'English')
	$lang = $english_array;
elseif ($pun_config['o_default_lang'] == 'French')
	$lang = $french_array;
else
	$lang = $english_array;

// Make sure we are running a PunBB version that this mod works with
$version = explode(".", $pun_config['o_cur_version']);
if ($version[0] != 1 || $version[1] != 2)
{
	$err_str = sprintf($lang['err_6'],$pun_config['o_cur_version'], '1.2.x');
	exit($err_str);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php printf($lang['install_mod_x'], $mod_title); ?></title>
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
	<h2><span><?php echo $lang['install_success']; ?></span></h2>
	<div class="box">
		<div class="inbox">
			<p><?php printf($lang['install_success_info'],pun_htmlspecialchars($mod_title) ); ?></p>
		</div>
	</div>
</div>
<?php

	}
	else {
		// Run the restore function (defined above)
		restore();
?>
<div class="block">
	<h2><span><?php echo $lang['restore_success']; ?></span></h2>
	<div class="box">
		<div class="inbox">
			<p><?php echo $lang['restore_success_info']; ?></p>
		</div>
	</div>
</div>
<?php
	}
}
else {
?>
<div class="blockform">
	<h2><span><?php echo $lang['install_mod']; ?></span></h2>
	<div class="box">
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?foo=bar">
			<div><input type="hidden" name="form_sent" value="1" /></div>
			<div class="inform">
				<p><?php echo $lang['install_mod_p1']; ?></p>
				<p><strong><?php echo $lang['mod_title']; ?></strong> <?php echo pun_htmlspecialchars($mod_title).' '.$mod_version ?></p>
				<p><strong><?php echo $lang['mod_author']; ?></strong> <?php echo pun_htmlspecialchars($author) ?> (<a href="mailto:<?php echo pun_htmlspecialchars($author_email) ?>"><?php echo pun_htmlspecialchars($author_email) ?></a>)</p>
				<p><strong><?php echo $lang['disclaimer']; ?></strong> <?php echo $lang['install_mod_p2']; ?></p>
<?php if ($mod_restore): ?>				<p><?php echo $lang['install_mod_p3']; ?></p>
<?php endif; ?>			</div>
			<p><input type="submit" name="install" value="<?php echo $lang['install']; ?>" /><?php if ($mod_restore): ?><input type="submit" name="restore" value="<?php echo $lang['restore']; ?>" /><?php endif; ?></p>
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
