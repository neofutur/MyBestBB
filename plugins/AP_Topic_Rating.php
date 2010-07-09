<?php
/***********************************************************************

  Copyright (C) 2002-2005  El Bekko (elbekko@gmail.com)

  This file is not part of PunBB.

  PunBB is free software; you can redistribute it and/or modify it
  under the terms of the GNU General Public License as published
  by the Free Software Foundation; either version 2 of the License,
  or (at your option) any later version.

  PunBB is distributed in the hope that it will be useful, but
  WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston,
  MA  02111-1307  USA

************************************************************************/

// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
	exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);

// Load the viewtopic.php language file
require PUN_ROOT.'lang/'.$pun_user['language'].'/topic_rating.php';

// Update config when needed
if(isset($_POST['rating_timeout']))
{
	$rt = intval($_POST['rating_timeout']);
	$db->query("UPDATE ".$db->prefix."config SET conf_value = '".$rt."' WHERE conf_name = 'o_rating_timeout'") or error('Unable to update config', __FILE__, __LINE__, $db->error());
	// Delete config cache
	unlink(PUN_ROOT.'cache/cache_config.php');
	redirect("admin_loader.php?plugin=".$plugin, $lang_topic_rating['Config updated']);
}

// Display the admin navigation menu
generate_admin_menu($plugin);
?>
<div class="blockform">
	<h2><span>Topic Rating</span></h2>
	<div class="box">
		<form id="form1" method="post" action="<?php echo "admin_loader.php?plugin=".$plugin; ?>">
			<p class="submittop"><input type="submit" name="Submit" value="Submit" /></p>
			<fieldset>
				<legend><?php echo $lang_topic_rating['Mod essentials']; ?></legend>
				<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<tr>
								<th scope="row"><?php echo $lang_topic_rating['Rating timeout']; ?></th>
								<td>
									<input type="text" name="rating_timeout" size="50" maxlength="255" value="<?php echo $pun_config['o_rating_timeout']; ?>" />
									<span><?php echo $lang_topic_rating['Timeout description']; ?></span>
								</td>
							</tr>
						</table>
					</div>
			</fieldset>
			<p class="submitend"><input type="submit" name="Submit" value="Submit" /></p>
		</form>
	</div>
</div>