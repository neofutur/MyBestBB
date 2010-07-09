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

if (!$pun_config['cb_pbb_version'])
	message('Poki BB Chatbox is not installed correctly. Please make sure you have launch install_mod.php');

if (isset($_POST['form_sent']))
{
	// Lazy referer check (in case base_url isn't correct)
	if (!preg_match('#/admin_loader\.php#i', $_SERVER['HTTP_REFERER']))
		message($lang_common['Bad referrer']);

	$form = array_map('trim', $_POST['form']);

	while (list($key, $input) = @each($form))
	{
		// Only update values that have changed
		if ((isset($pun_config['cb_'.$key])) || ($pun_config['cb_'.$key] == NULL)) {
			if ($pun_config['cb_'.$key] != $input)
			{
				if ($input != '' || is_int($input))
					$value = '\''.$db->escape($input).'\'';
				else
					$value = 'NULL';
	
				$db->query('UPDATE '.$db->prefix.'config SET conf_value='.$value.' WHERE conf_name=\'cb_'.$key.'\'') or error('Unable to update board config', __FILE__, __LINE__, $db->error());
			}
		}
	}

	// Regenerate the config cache
	require_once PUN_ROOT.'include/cache.php';
	generate_config_cache();

	redirect('admin_loader.php?plugin=AP_ChatBox.php', 'Options updated. Redirecting &hellip;');
}

// Edit a group (stage 1)
if (isset($_GET['edit_group']))
{
	$group_id = intval($_GET['edit_group']);
	if ($group_id < 1)
		message($lang_common['Bad request']);

	$result = $db->query('SELECT g_id, g_title, g_read_chatbox,g_post_chatbox, g_title_chatbox, g_post_flood_chatbox FROM '.$db->prefix.'groups WHERE g_id='.$group_id) or error('Unable to fetch user group info', __FILE__, __LINE__, $db->error());
	if (!$db->num_rows($result))
    message($lang_common['Bad request']);
    
  $group = $db->fetch_assoc($result);

  generate_admin_menu($plugin);

?>
	<div class="blockform">
		<h2><span>Group settings</span></h2>
		<div class="box">
			<form id="groups2" method="post" action="admin_loader.php?plugin=AP_ChatBox.php">
				<p class="submittop"><input type="submit" name="add_edit_group" value=" Save " /></p>
				<div class="inform">
        <input type="hidden" name="group_id" value="<?php echo $group_id ?>" />
					<fieldset>
						<legend>Setup group options and permissions</legend>
						<div class="infldset">
							<p>Below options and permissions are the default permissions for the user group.</p>
							<table class="aligntop" cellspacing="0">
								<tr>
									<th scope="row">Group title</th>
									<td>
										<?php echo pun_htmlspecialchars($group['g_title']); ?>
									</td>
								</tr>
								<tr>
									<th scope="row">ChatBox title (HTML)</th>
									<td>
										<input type="text" name="title_chatbox" size="50" value="<?php echo pun_htmlspecialchars($group['g_title_chatbox']) ?>" tabindex="2" />
										<span>Leave blank to use no title.</span>
									</td>
								</tr>
<?php if ($group['g_id'] != PUN_ADMIN): ?>								<tr>
									<th scope="row">Read ChatBox</th>
									<td>
										<input type="radio" name="read_chatbox" value="1"<?php if ($group['g_read_chatbox'] == '1') echo ' checked="checked"' ?> tabindex="3" />&nbsp;<strong>Yes</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="read_chatbox" value="0"<?php if ($group['g_read_chatbox'] == '0') echo ' checked="checked"' ?> tabindex="4" />&nbsp;<strong>No</strong>
										<span>Allow users in this group to view the ChatBox.</span>
									</td>
								</tr>
								<tr>
									<th scope="row">Post ChatBox</th>
									<td>
										<input type="radio" name="post_chatbox" value="1"<?php if ($group['g_post_chatbox'] == '1') echo ' checked="checked"' ?> tabindex="5" />&nbsp;<strong>Yes</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="post_chatbox" value="0"<?php if ($group['g_post_chatbox'] == '0') echo ' checked="checked"' ?> tabindex="6" />&nbsp;<strong>No</strong>
										<span>Allow users in this group to post messages in ChatBox.</span>
									</td>
								</tr>
<?php if ($group['g_id'] != PUN_MOD): ?>								<tr>
									<th scope="row">Post flood interval</th>
									<td>
										<input type="text" name="post_flood_chatbox" size="5" maxlength="4" value="<?php echo $group['g_post_flood_chatbox'] ?>" tabindex="24" />
										<span>Number of seconds that users in this group have to wait between posts. Set to 0 to disable.</span>
									</td>
								</tr>
<?php endif; ?><?php endif; ?>							</table>
						</div>
					</fieldset>
				</div>
				<p class="submitend"><input type="submit" name="add_edit_group" value=" Save " tabindex="26" /></p>
			</form>
		</div>
	</div>
<?php



}
// Edit a group (stage 2)
else if (isset($_POST['add_edit_group']))
{

	// Lazy referer check (in case base_url isn't correct)
	if (!preg_match('#/admin_loader\.php#i', $_SERVER['HTTP_REFERER']))
		message($lang_common['Bad referrer']);

	// Is this the admin group? (special rules apply)
	$is_admin_group = (isset($_POST['group_id']) && $_POST['group_id'] == PUN_ADMIN) ? true : false;

	$title_chatbox = trim($_POST['title_chatbox']);
  $read_chatbox = isset($_POST['read_chatbox']) ? intval($_POST['read_chatbox']) : '1';
  $post_chatbox = isset($_POST['post_chatbox']) ? intval($_POST['post_chatbox']) : '1';
	$post_flood_chatbox = isset($_POST['post_flood_chatbox']) ? intval($_POST['post_flood_chatbox']) : '0';

	$title_chatbox = ($title_chatbox != '') ? '\''.$db->escape($title_chatbox).'\'' : 'NULL';

  $result = $db->query('SELECT 1 FROM '.$db->prefix.'groups WHERE g_id!='.$_POST['group_id']) or error('Unable to check group title collision', __FILE__, __LINE__, $db->error());
    
  $db->query('UPDATE '.$db->prefix.'groups SET g_title_chatbox='.$title_chatbox.', g_read_chatbox='.$read_chatbox.', g_post_chatbox='.$post_chatbox.', g_post_flood_chatbox='.$post_flood_chatbox.' WHERE g_id='.$_POST['group_id']) or error('Unable to update group', __FILE__, __LINE__, $db->error());

	// Regenerate the quickjump cache
	require_once PUN_ROOT.'include/cache.php';
	generate_quickjump_cache();

	redirect('admin_loader.php?plugin=AP_ChatBox.php', 'Group edited. Redirecting &hellip;');

}
else
{

generate_admin_menu($plugin);

?>
	<div class="block">
		<h2><span>Poki BB ChatBox <?php echo ' - v'.$pun_config['cb_pbb_version'] ?> - by <a href="mailto:pokemonjojo@mibhouse.org">Pokemon_JOJO</a></span></h2>
		<div class="box">
			<div class="inbox">
				<p>This plugin allows you to change the chatbox settings.</p>
			</div>
		</div>
	</div>
	<div class="blockform">
		<h2 class="block2"><span>Options</span></h2>
		<div class="box">
			<form method="post" action="admin_loader.php?plugin=AP_ChatBox.php">
				<div class="inform">
					<input type="hidden" name="form_sent" value="1" />
					<fieldset>
						<legend>Settings</legend>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<tr>
								<th scope="row">ChatBox Height</th>
								<td>
									<input type="text" name="form[height]" size="50" maxlength="255" value="<?php echo $pun_config['cb_height'] ?>" />
									<span>The Height in pixel of your ChatBox.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Max Length of Messages</th>
								<td>
									<input type="text" name="form[msg_maxlength]" size="50" maxlength="255" value="<?php echo $pun_config['cb_msg_maxlength'] ?>" />
									<span>The max length of messages.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Max Messages in ChatBox</th>
								<td>
									<input type="text" name="form[max_msg]" size="50" maxlength="255" value="<?php echo $pun_config['cb_max_msg'] ?>" />
									<span>Number of maximum messages.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Messages display (Parsing)</th>
								<td>
									<textarea name="form[disposition]" rows="5" cols="50"><?php echo $pun_config['cb_disposition'] ?></textarea>
									<span>How display the messages in your ChatBox. You can use HTML. <strong>Default exemple:</strong>
                  <textarea rows="5" cols="50"><strong><pun_username></strong> - <pun_date> - [ <pun_nbpost><pun_nbpost_txt> ] <pun_admin><br /><pun_message><br /><br /></textarea>
                  </span>
								</td>
							</tr>
						</table>
						</div>
					</fieldset>
					<fieldset>
						<legend>Groups setting</legend>
						<div class="infldset">
							<p>You can configure some chatbox options and permissions for each group (Read/Post permission, ChatBox title, Post flood interval). Please note though, that in some groups, some options are unavailable. (e.g. the Read/Post permission for admin)</p>
							<table cellspacing="0">
<?php

$result = $db->query('SELECT g_id, g_title FROM '.$db->prefix.'groups ORDER BY g_id') or error('Unable to fetch user group list', __FILE__, __LINE__, $db->error());

while ($cur_group = $db->fetch_assoc($result))
	echo "\t\t\t\t\t\t\t\t".'<tr><th scope="row"><a href="admin_loader.php?plugin=AP_ChatBox.php&amp;edit_group='.$cur_group['g_id'].'">Edit Setting</a></th><td>'.pun_htmlspecialchars($cur_group['g_title']).'</td></tr>'."\n";

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
