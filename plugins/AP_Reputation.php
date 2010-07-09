<?php
/******************************************************************************************************
		Reputation Plugin for PunBB
		----------------------------
-- Version 2.2.0
-- Created by hcs on 25-04-2006  hcs@mail.ru

-- GPL:
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
******************************************************************************************************/
// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
    exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);
define('PLUGIN_VERSION', '2.2.0');
require_once PUN_ROOT.'lang/'.$pun_user['language'].'/reputation.php';


if (isset($_GET['edit_group']) && !isset($_POST['permissions']) ) {
	$edit_group=intval($_GET['edit_group']);
	// Display the admin navigation menu
	generate_admin_menu($plugin);
	$result = $db->query('SELECT g_id, g_title, g_rep_minus_min, g_rep_plus_min, g_rep_enable FROM '.$db->prefix.'groups WHERE g_id='.$edit_group.' ORDER BY g_id') or error('Unable to fetch user group list', __FILE__, __LINE__, $db->error());
	if (!$db->num_rows($result))
		message($lang_common['Bad request']);
				
	$cur_group = $db->fetch_assoc($result);
	if ($edit_group == 3) {
		?>
		
	<div class="block">
		<h2><span><?php echo $lang_reputation['Reputation mod']." - ".PLUGIN_VERSION ?></span></h2>
		<div class="box">
			<div class="inbox">
				<p><?php echo $lang_reputation['Plugin description'] ?></p>
			</div>
		</div>
	</div>
	<div class="blockform">
		<h2 class="block2"><span>Permission to Reputation for <?php echo $cur_group['g_title'] ?> group</span></h2>
		<div class="box">
			<form method="post" action="admin_loader.php?plugin=AP_Reputation.php&amp;edit_group=<?php echo $edit_group; ?>">
				<div class="inform">
					<input type="hidden" name="permissions" value="1" />
					<fieldset>
						<legend>Group Permission for <?php echo $cur_group['g_title'] ?></legend>
						<div class="infldset">
							<table class="aligntop" cellspacing="0">
								<tr>
									<th scope="row">Enable to view reputation</th>
									<td>
										<input type="radio" name="rep_enable" value="1"<?php if ($cur_group['g_rep_enable'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Yes</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="rep_enable" value="0"<?php if ($cur_group['g_rep_enable'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>No</strong>
										<span>Allow this group to view Reputation registered users.</span><br />
									</td>
								</tr>
							</table>
						</div>
					</fieldset>
				</div>
				<p class="submitend"><input type="submit" name="save" value="Save changes" /> <a href="javascript:history.go(-1)">Go back</a></p>	
			</form>
		</div>
	</div>
<?php		
	}
	else {
?>
	<div class="block">
		<h2><span><?php echo $lang_reputation['Reputation mod']." - ".PLUGIN_VERSION ?></span></h2>
		<div class="box">
			<div class="inbox">
				<p><?php echo $lang_reputation['Plugin description'] ?></p>
			</div>
		</div>
	</div>
	<div class="blockform">
		<h2 class="block2"><span>Permission to Reputation for <?php echo $cur_group['g_title'] ?> group</span></h2>
		<div class="box">
			<form method="post" action="admin_loader.php?plugin=AP_Reputation.php&amp;edit_group=<?php echo $edit_group; ?>">
				<div class="inform">
					<input type="hidden" name="permissions" value="1" />
					<fieldset>
						<legend>Group Permission for <?php echo $cur_group['g_title'] ?></legend>
						<div class="infldset">
							<table class="aligntop" cellspacing="0">
								<tr>
									<th scope="row">Enable reputation</th>
									<td>
										<input type="radio" name="rep_enable" value="1"<?php if ($cur_group['g_rep_enable'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Yes</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="rep_enable" value="0"<?php if ($cur_group['g_rep_enable'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>No</strong>
										<span>Allow this group to use Reputation.</span><br />
									</td>
								</tr>
								<tr>
									<th scope="row">Minimum messages to minus:</th>
									<td>
										<input type="text" name="rep_minus_min" size="20" maxlength="10" value="<?php echo $cur_group['g_rep_minus_min'] ?>" />
										<span>The minimum quantity of messages necessary that users of this group could change reputation in a minus to other users.</span><br />
									</td>
								</tr>
								<tr>
									<th scope="row">Minimum messages to plus:</th>
									<td>
										<input type="text" name="rep_plus_min" size="20" maxlength="10" value="<?php echo $cur_group['g_rep_plus_min'] ?>" />
										<span>The minimum quantity of messages necessary that users of this group could change reputation in a plus to other users.</span>
									</td>
								</tr>															
							</table>
						</div>
					</fieldset>
				</div>
				<p class="submitend"><input type="submit" name="save" value="Save changes" /> <a href="javascript:history.go(-1)">Go back</a></p>	
			</form>
		</div>
	</div>
						
<?php		
	}	
}
elseif (isset($_GET['edit_group']) && isset($_POST['permissions'])) {


	// Lazy referer check (in case base_url isn't correct)
	if (!preg_match('#/admin_loader\.php#i', $_SERVER['HTTP_REFERER']))
		message($lang_common['Bad referrer']);

	$edit_group=intval($_GET['edit_group']);
	if (isset($_POST['rep_enable'])) {
		$rep_enable = intval($_POST['rep_enable']);
		($rep_enable<0 || $rep_enable>1) ? $rep_enable=0 : NULL;
	}
	else {
		message($lang_common['Bad request']);
	}
		
	if ($edit_group == 3) {
		$db->query('UPDATE '.$db->prefix.'groups SET g_rep_enable='.$rep_enable.'  WHERE g_id='.$edit_group) or error('Unable to update group config', __FILE__, __LINE__, $db->error());
	}
	else {	
		$rep_minus_min = isset($_POST['rep_minus_min']) ? intval($_POST['rep_minus_min']) : message($lang_common['Bad request']);
		$rep_plus_min = isset($_POST['rep_plus_min']) ? intval($_POST['rep_plus_min']) : message($lang_common['Bad request']);
		($rep_minus_min<0) ? $rep_minus_min=0 :NULL;
		($rep_plus_min<0) ? $rep_plus_min=0 :NULL;
		$db->query('UPDATE '.$db->prefix.'groups SET g_rep_enable='.$rep_enable.', g_rep_minus_min='.$rep_minus_min.', g_rep_plus_min='.$rep_plus_min.'  WHERE g_id='.$edit_group) or error('Unable to update group config', __FILE__, __LINE__, $db->error());
	}
	redirect('admin_loader.php?plugin=AP_Reputation.php&edit_group='.$edit_group, 'Options updated. Redirecting &hellip;');
}

elseif (isset($_POST['individual'])) {
	
	if (!isset($_POST['user'])) 
		message($lang_common['Bad request']);
	$user_name=pun_htmlspecialchars($_POST['user']);
	$result = $db->query('SELECT id, reputation_enable_adm FROM '.$db->prefix.'users WHERE username=\''.$user_name.'\'') or error('Unable to get user id', __FILE__, __LINE__, $db->error());
	if (!$db->num_rows($result))
		message('Unknown username - '.$user_name);
	$user = $db->fetch_assoc($result);
	
	if (!isset($_POST['change_user_rep'])) {
		// Display the admin navigation menu
		generate_admin_menu($plugin);
		?>
	<div class="block">
		<h2><span><?php echo $lang_reputation['Reputation mod']." - ".PLUGIN_VERSION ?></span></h2>
		<div class="box">
			<div class="inbox">
				<p><?php echo $lang_reputation['Plugin description'] ?></p>
			</div>
		</div>
	</div>		
	<div class="blockform">
		<h2 class="block2"><span>Enable\disable for <?php echo $user_name;?></span></h2>
		<div class="box">
			<form method="post" action="admin_loader.php?plugin=AP_Reputation.php">
				<div class="inform">
					<input type="hidden" name="change_user_rep" value="1" />
					<input type="hidden" name="user" value="<?php echo $user_name;?>" />
					<input type="hidden" name="individual" value="1" />
					<fieldset>
						<legend>Manage reputation for <?php echo $user_name;?></legend>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<tr>
								<th scope="row">User <?php echo $user_name;?></th>
								<td>
									<input type="radio" name="reputation" value="1"<?php if ($user['reputation_enable_adm'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Yes</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="reputation" value="0"<?php if ($user['reputation_enable_adm'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>No</strong>
									<span>Allow reputation for this user</span>
								</td>
							</tr>
						</table>
						</div>
						<p class="submitend"><input type="submit" name="save" value="Save changes" /> <a href="javascript:history.go(-1)">Go back</a></p>
					</fieldset>
				</div>
			</form>	
		</div>
	</div>	
		
	<?php 
	}
	else {
		if (!isset($_POST['reputation'])) 
			message($lang_common['Bad request']);

		$reputation = intval($_POST['reputation']);
		if ($reputation !=1 )
			$reputation=0;

		$db->query('UPDATE '.$db->prefix.'users SET reputation_enable_adm='.$reputation.' WHERE id='.$user["id"]) or error('Unable to update individual permissions for reputation', __FILE__, __LINE__, $db->error());
		redirect('admin_loader.php?plugin=AP_Reputation.php', 'Options updated. Redirecting &hellip;');
	}
}

elseif (isset($_POST['globals']))
{
	// Lazy referer check (in case base_url isn't correct)
	if (!preg_match('#/admin_loader\.php#i', $_SERVER['HTTP_REFERER']))
		message($lang_common['Bad referrer']);

	$form = array_map('trim', $_POST['form']);
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
	// Regenerate the config cache
	require_once PUN_ROOT.'include/cache.php';
	generate_config_cache();

	redirect('admin_loader.php?plugin=AP_Reputation.php', 'Options updated. Redirecting &hellip;');
}
elseif (!isset($_POST['globals']) && !isset($_POST['globals']) && !isset($_POST['individual']))
{
	// Display the admin navigation menu
	generate_admin_menu($plugin);
?>
	<div class="block">
		<h2><span><?php echo $lang_reputation['Reputation mod']." - ".PLUGIN_VERSION ?></span></h2>
		<div class="box">
			<div class="inbox">
				<p><?php echo $lang_reputation['Plugin description'] ?></p>
			</div>
		</div>
	</div>
	<div class="blockform">
		<h2 class="block2"><span>Options</span></h2>
		<div class="box">
			<form method="post" action="admin_loader.php?plugin=AP_Reputation.php">
				<div class="inform">
					<input type="hidden" name="globals" value="1" />
					<fieldset>
						<legend>Global Settings</legend>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<tr>
								<th scope="row">Enable reputation</th>
								<td>
									<input type="radio" name="form[reputation_enabled]" value="1"<?php if ($pun_config['o_reputation_enabled'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Yes</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="form[reputation_enabled]" value="0"<?php if ($pun_config['o_reputation_enabled'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>No</strong>
									<span>Allow users to give reputation points to other users.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Reputation timeout</th>
								<td>
									<input type="text" name="form[reputation_timeout]" size="5" maxlength="5" value="<?php echo $pun_config['o_reputation_timeout'] ?>" />
									<span>Revoting time in minuts</span>
								</td>
							</tr>
						</table>
						</div>
						<p class="submitend"><input type="submit" name="save" value="Save changes" /></p>
					</fieldset>
				</div>
			</form>
			<form method="post" action="admin_loader.php?plugin=AP_Reputation.php">
				<div class="inform">
					<fieldset>
						<legend>Group Permissions</legend>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<?php
							
							//$result = $db->query('SELECT g_id, g_title, g_rep_minus_min, g_rep_plus_min, g_rep_enable, g_rep_group_limit FROM '.$db->prefix.'groups ORDER BY g_id') or error('Unable to fetch user group list', __FILE__, __LINE__, $db->error());
							$result = $db->query('SELECT g_id, g_title  FROM '.$db->prefix.'groups ORDER BY g_id') or error('Unable to fetch user group list', __FILE__, __LINE__, $db->error());
							while ($cur_group = $db->fetch_assoc($result))
							{
							?>
							<tr> 
								<th scope="row"><?php echo $cur_group['g_title'] ?></th>
								<td>
									<a href="<?php echo $_SERVER['REQUEST_URI'] ?>&amp;edit_group=<?php echo $cur_group['g_id'] ?>">Edit</a>
								</td>
							</tr>
							<?
							}
							?>
							
						</table>
						</div>
					</fieldset>
				</div>
			</form>
			<script type="text/javascript">
			<!--
			function Validate() {
			Length = document.username.user.value.length;
			if ( Length <2)  {
				alert("Usernames must be at least 2 characters long. Please choose another (longer) username. ");
			return false;
			} else {
			document.username.go.disabled = true;
				return true;
			}
			}
			// -->
			</script>
			<form method="post" action="admin_loader.php?plugin=AP_Reputation.php" onsubmit="return Validate()">
				<div class="inform">
				<input type="hidden" name="individual" value="1" />
					<fieldset>
						<legend>Individual manage reputation </legend>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<tr> 
								<th scope="row">UserName </th>
								<td>
									<input type="text" name="user" size="30" maxlength="200" />
									<span>Input user name for personal manage reputation</span>
								</td>
							</tr>
	
						</table>
						</div>
						<p class="submitend"><input type="submit" name="save" value="Search" /></p>
					</fieldset>
				</div>
			</form>
		</div>
	</div>

<?php
}

?>