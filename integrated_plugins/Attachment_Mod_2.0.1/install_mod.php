<?php
/***********************************************************************/

// Some info about your mod.
$mod_title      = 'Attachment Mod';
$mod_version    = '2.0.1';
$release_date   = '2005-04-28';
$author         = 'Frank Hagstrom';
$author_email   = 'frank.hagstrom+punbb@gmail.com';

// One or more versions of PunBB that this mod works on. The version names must match exactly!
$punbb_versions	= array('1.2', '1.2.1', '1.2.3', '1.2.4', '1.2.5');

// Set this to false if you haven't implemented the restore function (see below)
$mod_restore	= false;


// This following function will be called when the user presses the "Install" button.
function install($basepath='')
{
	global $db, $db_type, $pun_config;
	//include PUN_ROOT.'include/attach/attach_incl.php';

	//first check so that the path seems reasonable
	if(!((substr($basepath,0,1) == '/' || substr($basepath,1,1) == ':') && substr($basepath,-1) == '/'))
		error('The pathname specified doesn\'t comply with the rules set. Go back and make sure that it\'s the complete path, and that it ends with a slash and that it either start with a slash (example: "/home/username/attachments/", on *nix servers (unix, linux, bsd, solaris etc.)) or a driveletter (example: "C:/webpages/attachments/" on windows servers)');

	// create the neccessary tables	
		// create the files table
		$db->query("CREATE TABLE IF NOT EXISTS `".$db->prefix."attach_2_files` (
		`id` int(10) unsigned NOT NULL auto_increment,
		`owner` int(10) unsigned NOT NULL default '0',
  		`post_id` int(10) unsigned NOT NULL default '0',
  		`filename` varchar(255) NOT NULL default 'error.file',
  		`extension` varchar(64) NOT NULL default 'error.file',
  		`mime` varchar(64) NOT NULL default '',
  		`location` text NOT NULL,
  		`size` int(10) unsigned NOT NULL default '0',
  		`downloads` int(10) unsigned NOT NULL default '0',
  		UNIQUE KEY `id` (`id`))") or error('Unable to add table "attach_2_files" to database', __FILE__, __LINE__, $db->error());

		
		
		
		// create the rules table
		$db->query("CREATE TABLE IF NOT EXISTS `".$db->prefix."attach_2_rules` (
  		`id` int(10) unsigned NOT NULL auto_increment,
  		`forum_id` int(10) unsigned NOT NULL default '0',
  		`group_id` int(10) unsigned NOT NULL default '0',
  		`rules` int(10) unsigned NOT NULL default '0',
  		`size` int(10) unsigned NOT NULL default '0',
  		`per_post` tinyint(4) NOT NULL default '1',
  		`file_ext` text NOT NULL,
  		UNIQUE KEY `id` (`id`))") or error('Unable to add table "attach_2_rules" to database', __FILE__, __LINE__, $db->error());

	//ok path could be correct, try to make a subfolder :D
	$newname = attach_generate_pathname($basepath);
	if(!attach_create_subfolder($newname,$basepath))
		error('Unable to create new subfolder with name "'.$newname.'", make sure php has write access to that folder!',__FILE__,__LINE__);
	
		
	// ok, add the stuff needed in the config cache
	$attach_config = array(	'attach_always_deny'	=>	'html"htm"php"php3"php4"exe"com"bat',
							'attach_basefolder'		=>	$basepath,
							'attach_create_orphans'	=>	'1',
							'attach_cur_version'	=>	'2.0.1',
							'attach_icon_folder'	=>	'img/attach/',
							'attach_icon_extension'	=>	'txt"doc"pdf"wav"mp3"ogg"avi"mpg"mpeg"png"jpg"jpeg"gif',
							'attach_icon_name'		=>	'text.png"doc.png"doc.png"audio.png"audio.png"audio.png"video.png"video.png"video.png"image.png"image.png"image.png"image.png',
							'attach_max_size'		=>	'2000',
							'attach_subfolder'		=>	$newname,
							'attach_use_icon'		=>	'1');
	
	foreach($attach_config AS $key => $value)
	{
		$db->query("INSERT INTO ".$db->prefix."config (conf_name, conf_value) VALUES ('$key', '".$db->escape($value)."')") or error('Unable to add column "'.$key.'" to config table', __FILE__, __LINE__, $db->error());
	}

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

function attach_create_subfolder($newfolder='',$basepath){
		
	// check to see if that folder is there already, then just update the config ...
	if(!is_dir($basepath.$newfolder)){
		// if the folder doesn't excist, try to create it
		if(!mkdir($basepath.$newfolder,0750))
			error('Unable to create new subfolder with name \''.$basepath.$newfolder.'\' with mode 0750',__FILE__,__LINE__);
		// create a .htaccess and index.html file in the new subfolder
		if(!copy($basepath.'.htaccess', $basepath.$newfolder.'/.htaccess'))
			error('Unable to copy .htaccess file to new subfolder with name \''.$basepath.$newfolder.'\'',__FILE__,__LINE__);
		if(!copy($basepath.'index.html', $basepath.$newfolder.'/index.html'))
			error('Unable to copy index.html file to new subfolder with name \''.$basepath.$newfolder.'\'',__FILE__,__LINE__);
		// if the folder was created continue
	}
	// return true if everything has gone as planned, return false if the new folder could not be created (rights etc?)
	return true;
}

function attach_generate_pathname($storagepath=''){
	if(strlen($storagepath)!=0){
		//we have to check so that path doesn't exist already...
		$not_unique=true;
		while($not_unique){
			$newdir = attach_generate_pathname();
			if(!is_dir($storagepath.$newdir))return $newdir;
		}
	}else
		return substr(md5(time().'54£7 k3yw0rd, r3pl4ce |f U w4nt t0'),0,32);
}



function attach_generate_filename($storagepath, $messagelenght=0, $filesize=0){
	$not_unique=true;
	while($not_unique){
		$newfile = md5(attach_generate_pathname().$messagelenght.$filesize.'Some more salt keyworbs, change if you want to').'.attach';
		if(!is_file($storagepath.$newfile))return $newfile;
	}	
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
require $pun_root.'include/common.php';

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
		install($_POST['full_basename']);

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
				<p><strong>Important instructions:</strong> Before pressing the install button, create a folder where you want your attachments to be stored on disk. (Read step 1 in readme.txt) It's crucial that PHP has writepermissions there, and that it's not browseable! (Examples: "/home/username/attachments/" or "D:/homepages/attachments/", note, use only /, not \)<br />Enter the <strong>full</strong> pathname in the box below<br /><input type="text" name="full_basename" size="80" value="<?php echo dirname($_SERVER['SCRIPT_FILENAME']); ?>/attachments/"></p>
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