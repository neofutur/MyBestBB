<?php
/***********************************************************************

  Copyright (C) 2005  Connor Dunn (Connorhd@mypunbb.com)

  This software is free software; you can redistribute it and/or modify it
  under the terms of the GNU General Public License as published
  by the Free Software Foundation; either version 2 of the License,
  or (at your option) any later version.

  This software is distributed in the hope that it will be useful, but
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
define('PLUGIN_VERSION', '1.1.2');
define('PLUGIN_URL', 'admin_loader.php?plugin=AP_Private_messaging.php');

if (isset($_POST['form_sent']))
{
	// Lazy referer check (in case base_url isn't correct)
	if (!preg_match('#/admin_loader\.php#i', $_SERVER['HTTP_REFERER']))
		message($lang_common['Bad referrer']);

	$form = array_map('trim', $_POST['form']);
	$allow = array_map('trim', $_POST['allow']);
	$limit = array_map('trim', $_POST['limit']);

	while (list($key, $input) = @each($form))
	{
		// Only update values that have changed
		if ((isset($pun_config['o_'.$key])) || ($pun_config['o_'.$key] == NULL)) {
			if ($pun_config['o_'.$key] != $input)
			{
				if ($input != '' || is_int($input))
					$value = '\''.$db->escape($input).'\'';
				else
					$value = 'NULL';
	
				$db->query('UPDATE '.$db->prefix.'config SET conf_value='.$value.' WHERE conf_name=\'o_'.$key.'\'') or error('Unable to update board config', __FILE__, __LINE__, $db->error());
			}
		}
	}

	while (list($id, $set) = @each($allow))
	{
		$db->query('UPDATE '.$db->prefix.'groups SET g_pm='.$set.' WHERE g_id=\''.$id.'\'') or error('Unable to change permissions.', __FILE__, __LINE__, $db->error());
	}
	
	while (list($id, $set) = @each($limit))
	{
		$db->query('UPDATE '.$db->prefix.'groups SET g_pm_limit='.intval($set).' WHERE g_id=\''.$id.'\'') or error('Unable to change permissions.', __FILE__, __LINE__, $db->error());
	}
	
	// Regenerate the config cache
	require_once PUN_ROOT.'include/cache.php';
	generate_config_cache();

	redirect(PLUGIN_URL, 'Options updated. Redirecting ...');
}
else
{
	// Display the admin navigation menu
	generate_admin_menu($plugin);
?>
	<div class="block">
		<h2><span>Private Messaging - v<?php echo PLUGIN_VERSION ?></span></h2>
		<div class="box">
			<div class="inbox">
				<p>This plugin is used to control the settings and permissions for the private messaging mod.</p>
			</div>
		</div>
	</div>
	<div class="blockform">
		<h2 class="block2"><span>Options</span></h2>
		<div class="box">
			<form method="post" action="admin_loader.php?plugin=AP_Private_messaging.php">
				<div class="inform">
					<input type="hidden" name="form_sent" value="1" />
					<fieldset>
						<legend>Settings</legend>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<tr>
								<th scope="row">Enable private messaging</th>
								<td>
									<input type="radio" name="form[pms_enabled]" value="1"<?php if ($pun_config['o_pms_enabled'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Yes</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="form[pms_enabled]" value="0"<?php if ($pun_config['o_pms_enabled'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>No</strong>
									<span>If no all private messaging functions will be disabled.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Allow notification</th>
								<td>
									<input type="radio" name="form[pms_notification]" value="1"<?php if ($pun_config['o_pms_notification'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Oui</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="form[pms_notification]" value="0"<?php if ($pun_config['o_pms_notification'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>Non</strong>
									<span>Allows to authorize or not the users has to use the notification by email of new private messages.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Enable popup notification</th>
								<td>
									<input type="radio" name="form[pms_popup]" value="1"<?php if ($pun_config['o_pms_popup'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Yes</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="form[pms_popup]" value="0"<?php if ($pun_config['o_pms_popup'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>No</strong>
									<span>Allow to enable the popup notification of new private message on board.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Messages per page</th>
								<td>
									<input type="text" name="form[pms_mess_per_page]" size="50" maxlength="255" value="<?php echo $pun_config['o_pms_mess_per_page'] ?>" />
									<span>This is the number of messages that will be displayed per page in private messaging views.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Receiver number</th>
								<td>
									<input type="text" name="form[pms_max_receiver]" size="5" maxlength="5" value="<?php echo $pun_config['o_pms_max_receiver'] ?>" />
									<span>The maximum number of receiver by private message.</span>
								</td>
							</tr>
						</table>
						</div>
					</fieldset>
				</div>
				<div class="inform">
					<fieldset>
						<legend>Permissions</legend>
						<p>Administrators and the moderators do not have operational limit of the private messages. Contrary, the guests do not have any right. Lastly, you can regulate the permissions of the other groups below.</p>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<?php
							$result = $db->query('SELECT g_id, g_title, g_pm, g_pm_limit FROM '.$db->prefix.'groups WHERE g_id> g_id != 1 ORDER BY g_id') or error('Impossible de trouver la liste des groupes d\'utilisateur', __FILE__, __LINE__, $db->error());
							while ($cur_group = $db->fetch_assoc($result))
							{
								if ($cur_group['g_id'] > PUN_GUEST) {
							?>
							<tr> 
								<th scope="row"><?php echo $cur_group['g_title'] ?></th>
								<td>
									<input type="radio" name="allow[<?php echo $cur_group['g_id'] ?>]" value="1"<?php if ($cur_group['g_pm'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Yes</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="allow[<?php echo $cur_group['g_id'] ?>]" value="0"<?php if ($cur_group['g_pm'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>No</strong>
									<span>Allow this group to use private messaging.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">&nbsp;</th>
								<td>
									Messages limit: <input type="text" name="limit[<?php echo $cur_group['g_id'] ?>]" size="20" maxlength="10" value="<?php echo $cur_group['g_pm_limit'] ?>" />
									<span>This is the number of messages each user is allowed in their inbox.</span>
								</td>
							</tr>
							<?
								}
							}
							?>
							
						</table>
						</div>
					</fieldset>
				</div>
			<p class="submitend"><input type="submit" name="save" value="Save changes" /></p>
			</form>
		</div>
	</div>

<?php
}
?>