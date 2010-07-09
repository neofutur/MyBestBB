<?php
/***********************************************************************/

// Informations à propos de votre mod.
$mod_title      = 'Message privé de bienvenue';
$mod_version    = '1.1';
$release_date   = '19/03/2007';
$author         = 'Thierry';
$author_email   = 'thiery.thiery01@free.fr';

// Sur une base de :
// Meesage de Bienvenue
// $author         = 'Vincent Garnier';
// $author_email   = 'vin100@forx.fr';

// Une ou plusieurs versions de PunBB pour lesquelles votre mod est conçue. Ces numero de version doivent parfaitement correspondre !
$punbb_versions	= array('1.2', '1.2.1', '1.2.2', '1.2.3', '1.2.4', '1.2.5', '1.2.6', '1.2.7', '1.2.8', '1.2.9', '1.2.10', '1.2.11', '1.2.12', '1.2.13','1.2.14','1.2.15','1.2.16','1.2.17','1.2.18','1.2.19','1.2.20','1.2.21','1.2.22');

// Reglez cela à FALSE si vous n'avez pas implémenté une fonction de restauration (voir plus bas)
$mod_restore	= false;


// Cette fonction est appellée quand l'utilisateur clique sur le bouton "Installer".
function install()
{
	global $db;

	$db->query('INSERT INTO '.$db->prefix.'config (conf_name, conf_value) VALUES (\'o_welcome_mp\', \'0\'), (\'o_welcome_message_mp\', \'Bienvenue %user%\');') or error('Unable to alter DB structure.', __FILE__, __LINE__, $db->error());
	
	// Regenerate the config cache
	require_once PUN_ROOT.'include/cache.php';
	generate_config_cache();	
}

// Enfin, voici la fonction qui est appellée quand l'utilisateur clique sur le bouton "Restaurer" (seulement si $mod_uninstall est à true)
function restore()
{
	global $db;

	$db->query('DELETE FROM '.$db->prefix.'config WHERE conf_name = \'o_welcome_mp\' LIMIT 1;') or error('Unable to alter DB structure.', __FILE__, __LINE__, $db->error());
	
	$db->query('DELETE FROM '.$db->prefix.'config WHERE conf_name = \'o_welcome_message_mp\' LIMIT 1;') or error('Unable to alter DB structure.', __FILE__, __LINE__, $db->error());
	
	// Regenerate the config cache
	require_once PUN_ROOT.'include/cache.php';
	generate_config_cache();	
}

/***********************************************************************/

// NE MODIFIEZ RIEN CI-DESSOUS !


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
<title>Installation <?php echo $mod_title ?></title>
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
	<h2><span>Installation réussie</span></h2>
	<div class="box">
		<div class="inbox">
			<p>Votre base de donnée a été correctement préparé pour <?php echo pun_htmlspecialchars($mod_title) ?>. Voir le lisez_moi.txt pour les instructions complémentaires.</p>
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
	<h2><span>Restauration réussie</span></h2>
	<div class="box">
		<div class="inbox">
			<p>Votre base de données à été correctement restaurée.</p>
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
	<h2><span>Installation Mod</span></h2>
	<div class="box">
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?foo=bar">
			<div><input type="hidden" name="form_sent" value="1" /></div>
			<div class="inform">
				<p>Ce script va mettre à jour votre base de données afin qu'elle puisse fonctionner avec la modification suivante :</p>
				<p><strong>Titre mod :</strong> <?php echo pun_htmlspecialchars($mod_title).' '.$mod_version ?></p>
				<p><strong>Auteur:</strong> <?php echo pun_htmlspecialchars($author) ?> (<a href="mailto:<?php echo pun_htmlspecialchars($author_email) ?>"><?php echo pun_htmlspecialchars($author_email) ?></a>)</p>
				<p><strong>Disclaimer:</strong> Veuillez noter que ces mods ne sont pas officiellement supportés par PunBB. Vous ne pouvez généralement pas désinstaller complètement les mods sans lancer manuellement des requêtes à la base de données. N'oubliez pas de sauvegarder la base de données et les fichiers affectés avant de procéder à l'installation.</p>
<?php if ($mod_restore): ?>				<p>Si vous avez précédemment installé cette mod et voulez la désinstaller, vous pouvez cliquer sur le bouton de restauration ci-dessous afin de restaurer la base de données.</p>
<?php endif; ?>			</div>
			<p><input type="submit" name="install" value="Installation" /><?php if ($mod_restore): ?><input type="submit" name="restore" value="Restauration" /><?php endif; ?></p>
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
