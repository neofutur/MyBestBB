<?php

// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
	exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);
define('CURRENT_VERSION', 'SI1.1');

// Display the admin navigation menu
generate_admin_menu($plugin);

if(isset($_POST['install']))
{

	$file['size'] = $_FILES['style_package']['size'];
	$file['error'] = $_FILES['style_package']['error'];
	$file['name'] = $_FILES['style_package']['name'];
	$file['tmp_name'] = $_FILES['style_package']['tmp_name'];

		// If the file is a php file, make it phps. Only if it's not a PunMod release
		if(substr($file['name'], -4) == '.php' && $cur_project['punmod'] == 0)
			$file['name'] .= 's';

		// Make sure the upload went smooth
		switch ($file['error'])
		{
			case 1:
			case 2:
				$errors[] = $file['name'].': Too large ini';
				break;
			case 3:
				$errors[] = $file['name'].': Partial upload';
				break;
		}

		if($file['size'] > 0 && empty($errors))
		{
			// INSTALL THE STYLE
			// This piece of code is very much inspired by Josh Bargers <joshb@npt.com> TAR class
			$filename = $file['tmp_name'];
			$fp = fopen($filename,"rb");
			$tar_file = fread($fp,filesize($filename));
			fclose($fp);

			$tar_length = strlen($tar_file);
			$main_offset = 0;
			$outbuffer = '';
			$error = 0;
			$lastdir = '';
			while($main_offset < $tar_length) {
				if(substr($tar_file,$main_offset,512) == str_repeat(chr(0),512))
					break;

				$position		= strpos(substr($tar_file,$main_offset,100),chr(0));
				$filename		= substr(substr($tar_file,$main_offset,100),0,$position);
				$filesize		= octdec(substr($tar_file,$main_offset + 124,12));
				$filecontents	= substr($tar_file,$main_offset + 512,$filesize);

				if($filesize > 0) {
					if(is_file($filename))
					{
						$outbuffer .= "\t\t\t\t\t".'<li><strong>File already existed:</strong> '.$filename.' - Not unpacked</li>'."\n";
						$error = 1;
					} else
					{
						$f = fopen($filename, 'w');
						fwrite($f, $filecontents);
						fclose($f);
						$outbuffer .= "\t\t\t\t\t".'<li>Unpacked file: '.$filename.'</li>'."\n";
					}
				} else {
					// Directory
					// Attempt to create the directories
					$dirs = explode('/', $filename);
					foreach($dirs as $dir)
					{
						$cdir = $lastdir.$dir;
						if(@mkdir($cdir))
						{
							$outbuffer .= "\t\t\t\t\t".'<li>Created directory: '.$filename.'</li>'."\n";
							// Create the index.html file
							$f = fopen($filename.'/index.html', 'w');
							fwrite($f, "<html>\n<head>\n<title>.</title>\n</head>\n<body>\n.\n</body>\n</html>");
							fclose($f);
						}
						$lastdir = $cdir.'/';
					}
					$lastdir = '';
				}

				$main_offset += 512 + (ceil($filesize / 512) * 512);
			}

?>
	<div id="posterror" class="block">
		<h2><span>Installation log</span></h2>
		<div class="box">
			<div class="inbox">
				<ul>
<?php echo $outbuffer ?>
				</ul>
				<p><?php echo ($error == 0?'The style was installed without errors':'<strong>There was errors during the installation</strong>') ?></p>
			</div>
		</div>
	</div>
	<br />
<?php
		}
}
if (!empty($errors))
{
?>
<div id="posterror" class="block">
		<h2><span>Errors</span></h2>
		<div class="box">
			<div class="inbox">
				<p>The following errors were encountered:</p>
				<ul>
<?php
	while (list(, $cur_error) = each($errors))
		echo "\t\t\t\t\t".'<li><strong>'.$cur_error.'</strong></li>'."\n";
?>
				</ul>
			</div>
		</div>
	</div>
	<br />
<?php
}

// Check if there is any newer version around
// gets plugin version from http://www.punres.org/installer_1.2
//echo substr($pun_config['o_cur_version'],0,3);
$preversion = substr($pun_config['o_cur_version'],0,3);
$filename  = 'http://www.punres.org/installer_'.$preversion;
//echo $filename;

$install = @file_get_contents($filename);
@list($installer_version, $installer_name) = explode('|', $install, 2);
//var_dump( $installer_version );

if(CURRENT_VERSION != $installer_version)
{
?>
	<div class="block">
		<h2><span>New version</span></h2>
		<div class="box">
			<div class="inbox">
				<p><strong>You don't have the latest version of this plugin.</strong></p>
				<p><a href="http://www.punres.org/<?php echo $installer_name ?>.zip">Click here to get the latest version</a></p>
			</div>
		</div>
	</div>
	<br />
<?php
}

?>

	<div class="block">
		<h2><span>Style installer</span></h2>
		<div class="box">
			<div class="inbox">
				<p>This plugin installs styles from <a href="http://www.punres.org/">PunBB resource</a></p>
			</div>
		</div>
	</div>

<?php
// Check write permission

if(!is_writable('style/'))
	$perm[] = '<strong>style/</strong> is not writeable! You will not be able to install styles!';
if(!is_writable('img/'))
	$perm[] = '<strong>img/</strong> is not writeable! You will not be able to install styles that uses images!';
if(!is_writable('include/template/'))
	$perm[] = '<strong>include/template/</strong> is not writeable! You will not be able to install styles that uses templates!';

if(!empty($perm))
{
?>
	<br />
	<div class="block">
		<h2><span>Warning!</span></h2>
		<div class="box">
			<div class="inbox">
				<ul>
<?php
foreach($perm as $error)
	echo "\t\t\t\t\t".'<li>'.$error.'</li>'."\n";
?>
				</ul>
			</div>
		</div>
	</div>
<?php
}

if(!defined('PUNRES_STYLE_COMPATIBLE'))
{

?>
	<br />
	<div class="block">
		<h2><span>Not compatible yet</span></h2>
		<div class="box">
			<div class="inbox">
				<p>Your PunBB version is not completely compatible with PunRes styles yet!</p>
				<p>You need to do the following changes:</p>
				<div class="codebox">
					<div class="incqbox">
						<div class="scrollbox" style="height: 35em">
							<pre>#
#---------[ 1. OPEN ]---------------------------------------------------------
#

header.php


#
#---------[ 2. FIND (line: 37) ]---------------------------------------------
#

// Load the template
if (defined('PUN_ADMIN_CONSOLE'))
	$tpl_main = file_get_contents(PUN_ROOT.'include/template/admin.tpl');
else if (defined('PUN_HELP'))
	$tpl_main = file_get_contents(PUN_ROOT.'include/template/help.tpl');
else
	$tpl_main = file_get_contents(PUN_ROOT.'include/template/main.tpl');


#
#---------[ 3. REPLACE WITH ]------------------------------------------------
#

// Load the template
if (defined('PUN_ADMIN_CONSOLE'))
{
	if(is_file(PUN_ROOT.'include/template/'.$pun_user['style'].'/admin.tpl'))
		$tpl_main = file_get_contents(PUN_ROOT.'include/template/'.$pun_user['style'].'/admin.tpl');
	else
		$tpl_main = file_get_contents(PUN_ROOT.'include/template/admin.tpl');
}else if (defined('PUN_HELP'))
{
	if(is_file(PUN_ROOT.'include/template/'.$pun_user['style'].'/help.tpl'))
		$tpl_main = file_get_contents(PUN_ROOT.'include/template/'.$pun_user['style'].'/help.tpl');
	else
		$tpl_main = file_get_contents(PUN_ROOT.'include/template/help.tpl');
}else
{
	if(is_file(PUN_ROOT.'include/template/'.$pun_user['style'].'/main.tpl'))
		$tpl_main = file_get_contents(PUN_ROOT.'include/template/'.$pun_user['style'].'/main.tpl');
	else
		$tpl_main = file_get_contents(PUN_ROOT.'include/template/main.tpl');
}
define('PUNRES_STYLE_COMPATIBLE', 1);


#
#---------[ 4. OPEN ]---------------------------------------------------------
#

include/functions.php


#
#---------[ 5. FIND (line: 763) ]---------------------------------------------
#

	// Load the maintenance template
	$tpl_maint = trim(file_get_contents(PUN_ROOT.'include/template/maintenance.tpl'));


#
#---------[ 6. REPLACE WITH ]------------------------------------------------
#

	// Load the maintenance template
	global $style;
	if(is_file(PUN_ROOT.'include/template/'.$style.'/maintenance.tpl'))
		$tpl_maint = trim(file_get_contents(PUN_ROOT.'include/template/'.$style.'/maintenance.tpl'));
	else
		$tpl_maint = trim(file_get_contents(PUN_ROOT.'include/template/maintenance.tpl'));


#
#---------[ 7. FIND (line: 843) ]---------------------------------------------
#

	// Load the redirect template
	$tpl_redir = trim(file_get_contents(PUN_ROOT.'include/template/redirect.tpl'));


#
#---------[ 8. REPLACE WITH ]------------------------------------------------
#

	// Load the redirect template
	global $style;
	if(is_file(PUN_ROOT.'include/template/'.$style.'/redirect.tpl'))
		$tpl_redir = trim(file_get_contents(PUN_ROOT.'include/template/'.$style.'/redirect.tpl'));
	else
		$tpl_redir = trim(file_get_contents(PUN_ROOT.'include/template/redirect.tpl'));


#
#---------[ 9. SAVE/UPLOAD ]-------------------------------------------------
#</pre>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php

} else
{
?>
	<div class="blockform">
		<h2 class="block2"><span>Install</span></h2>
		<div class="box">
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
				<div class="inform">
					<fieldset>
						<legend>Input your style package and hit "Install"!</legend>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<tr>
								<th scope="row">Style package<div><input type="submit" name="install" value="Install" tabindex="2" /></div></th>
								<td>
									<input type="file" name="style_package" size="25" tabindex="1" />
								</td>
							</tr>
						</table>
						</div>
					</fieldset>
				</div>
			</form>
		</div>
	</div>
<?php
}

