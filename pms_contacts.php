<?php
/***********************************************************************

  Copyright (C) 2002, 2003, 2004  Rickard Andersson (rickard@punbb.org)

  This file is part of PunBB.

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

define('PUN_ROOT', './');
require PUN_ROOT.'include/common.php';

// No guest here !
if ($pun_user['is_guest'])
	redirect('login.php', $lang_pms['Login required']);
	
// User enable PM ?
if (!$pun_user['use_pm'] == '1')
	redirect('profile.php?section=privacy&amp;id='.$pun_user['id'], $lang_pms['Disabled PM']);

// Are we allowed to use this ?
if (!$pun_config['o_pms_enabled'] =='1' || $pun_user['g_pm'] == 0)
	message($lang_common['No permission']);
$user_id = $pun_user['id'];

// Action ?
$action = ((isset($_REQUEST['action']) && ($_REQUEST['action'] == 'send' || $_REQUEST['action'] == 'authorize' || $_REQUEST['action'] == 'refuse' || $_REQUEST['action'] == 'delete_multiple')) ? $_REQUEST['action'] : '');


if ($action != '')
{
	// send a message
	if ($action == 'send')
	{
		$idlist = $_POST['selected_contacts'];
		$idlist = array_map('trim', $idlist);
		
		if (empty($idlist))
			message($lang_pms['Must select contacts']);
		
		$idlist = array_map('intval', $idlist);
		$idlist = implode(',', array_values($idlist));
			
		// Fetch contacts
$result = $db->query('SELECT contact_id FROM '.$db->prefix.'contacts WHERE id IN('.$idlist.') AND user_id='.$pun_user['id']) or error('Impossible de trouver la liste des contacts', __FILE__, __LINE__, $db->error());
		
		if (!$db->num_rows($result))
			message($lang_common['Bad request']);
			
		$idlist = array();
		while ($cur_contact = $db->fetch_assoc($result))
			$idlist[] = $cur_contact['contact_id'];
			
		header('Location: pms_send.php?uid='.implode('-', $idlist));
	}
	// authorize multiple contacts
	elseif ($action == 'authorize')
	{
		$idlist = $_POST['selected_contacts'];
		$idlist = array_map('trim', $idlist);
		
		if (empty($idlist))
			message($lang_pms['Must select contacts']);
			
		$idlist = array_map('intval', $idlist);
		$idlist = implode(',', array_values($idlist));
		
		$db->query('UPDATE '.$db->prefix.'contacts SET allow_msg=1 WHERE id IN('.$idlist.') AND user_id=\''.$pun_user['id'].'\'') or error('Impossible de mettre à jour le statut des contacts', __FILE__, __LINE__, $db->error());
		
		redirect('pms_contacts.php', $lang_pms['Multiples status redirect']);
	}
	// refuse multiple contacts
	elseif ($action == 'refuse')
	{
		$idlist = $_POST['selected_contacts'];
		$idlist = array_map('trim', $idlist);
		
		if (empty($idlist))
			message($lang_pms['Must select contacts']);
			
		$idlist = array_map('intval', $idlist);
		$idlist = implode(',', array_values($idlist));
		
		$db->query('UPDATE '.$db->prefix.'contacts SET allow_msg=0 WHERE id IN('.$idlist.') AND user_id=\''.$pun_user['id'].'\'') or error('Impossible de mettre à jour le statut des contacts', __FILE__, __LINE__, $db->error());
		
		redirect('pms_contacts.php', $lang_pms['Multiples status redirect']);
	}
	// delete multiple contacts
	elseif ($action == 'delete_multiple')
	{
		if (isset($_POST['delete_multiple_comply']) )
		{
			$db->query('DELETE FROM '.$db->prefix.'contacts WHERE id IN('.$_POST['contacts'].') AND user_id=\''.$pun_user['id'].'\'') or error('Impossible de supprimer les contacts.', __FILE__, __LINE__, $db->error());
			
			switch ($db_type)
			{
				case 'mysql':
				case 'mysqli':
					$db->query('OPTIMIZE TABLE '.$db->prefix.'contacts') or error('Impossible d\'optimiser la table contacts.', __FILE__, __LINE__, $db->error());
					break;
				
				case 'pgsql':
				case 'sqlite':
					$db->query('VACUUM '.$db->prefix.'contacts') or error('Impossible d\'optimiser la table contacts.', __FILE__, __LINE__, $db->error());
					break;
			}
			
			redirect('pms_contacts.php', $lang_pms['Deleted contacts redirect']);
		}
		else {
			$idlist = $_POST['selected_contacts'];
			$idlist = array_map('trim', $idlist);
			
			if (empty($idlist))
				message($lang_pms['Must select contacts']);
			
			$idlist = array_map('intval', $idlist);
			$idlist = implode(',', array_values($idlist));
			
			$page_title = $lang_pms['Multidelete contacts'].' / '.$lang_pms['Contacts'].' / '.$lang_pms['Private Messages'].' / '.pun_htmlspecialchars($pun_config['o_board_title']);
			require PUN_ROOT.'header.php';
	?>
	<div class="blockform">
		<h2><span><?php echo $lang_pms['Multidelete contacts'] ?></span></h2>
		<div class="box">
			<form method="post" action="pms_contacts.php">
				<input type="hidden" name="action" value="delete_multiple" />
				<input type="hidden" name="contacts" value="<?php echo $idlist ?>" />
				<input type="hidden" name="delete_multiple_comply" value="1" />
				<div class="inform">
					<fieldset>
						<legend><?php echo $lang_pms['Please confirm'] ?></legend>
						<div class="infldset">
							<p class="warntext"><?php echo $lang_pms['Delete contacts comply'] ?></p>
						</div>
					</fieldset>
				</div>
				<p><input type="submit" value="<?php echo $lang_pms['Delete'] ?>" /><a href="javascript:history.go(-1)"><?php echo $lang_common['Go back'] ?></a></p>
			</form>
		</div>
	</div>
	<?php
			require PUN_ROOT.'footer.php';
		}
	}
}

// Add a contact
if (isset($_REQUEST['add']))
{
	if (isset($_POST['req_username']))
	{
		$sql_where = 'u.username=\''.$db->escape($_POST['req_username']).'\'';
		$redirect = 'pms_contacts.php';
		$authorized = (isset($_POST['req_refuse']) && intval($_POST['req_refuse']) == 1)  ? 0 : 1;
	}
	else {
		$sql_where = 'u.id='.intval($_REQUEST['add']);
		$redirect = 'profile.php?id='.$_REQUEST['add'];
		$authorized = 1;
	}
	
	$result = $db->query('SELECT u.id, u.username, g.g_id, g.g_pm, COUNT(c.id) AS allready FROM '.$db->prefix.'users AS u INNER JOIN '.$db->prefix.'groups AS g ON u.group_id=g.g_id LEFT JOIN '.$db->prefix.'contacts AS c ON (c.contact_id=u.id AND c.user_id='.$pun_user['id'].') WHERE u.id!=1 AND '.$sql_where.' GROUP BY u.id') or error('Impossible de récupérer les informations de l\'utilisateur.', __FILE__, __LINE__, $db->error());
	
	if ($contact = $db->fetch_assoc($result))
	{		
		if (!$contact['allready'])
		{
			if ($contact['g_pm'] == 1)
			{
				$result = $db->query('INSERT INTO '.$db->prefix.'contacts (user_id, contact_id, contact_name, allow_msg) VALUES ('.$pun_user['id'].', '.$contact['id'].', \''.$db->escape($contact['username']).'\', '.$authorized.')') or error('Impossible d\'ajouter le contact', __FILE__, __LINE__, $db->error());
				
				redirect($redirect,$lang_pms['Added contact redirect']);
			}
			else
				message($lang_pms['Authorize user']);
		}
		else
			message($lang_pms['User already contact']);
	}
	else
		message($lang_pms['User not exists']);
}

// Delete a contact
if (isset($_GET['delete']))
{
	$id = intval($_GET['delete']);
	
	$result = $db->query('SELECT user_id FROM '.$db->prefix.'contacts WHERE id='.$id) or error('Impossible de trouver le contact', __FILE__, __LINE__, $db->error());
	
	if ($db->result($result) != $pun_user['id'])
		message($lang_common['Bad request']);

	$result = $db->query('DELETE FROM '.$db->prefix.'contacts WHERE id = '.$id) or error('Impossible de supprimer le contact', __FILE__, __LINE__, $db->error());
	
	redirect('pms_contacts.php',$lang_pms['Deleted contact redirect']);
}

// Switch contact status
if (isset($_GET['switch']))
{
	$id = intval($_GET['switch']);
	
	$result = $db->query('SELECT user_id FROM '.$db->prefix.'contacts WHERE id='.$id) or error('Impossible de trouver le contact', __FILE__, __LINE__, $db->error());
	
	if ($db->result($result) != $pun_user['id'])
		message($lang_common['Bad request']);

	$result = $db->query('UPDATE '.$db->prefix.'contacts SET allow_msg = 1-allow_msg WHERE id = '.$id) or error('Impossible de modifier le statut du contact', __FILE__, __LINE__, $db->error());
	
	redirect('pms_contacts.php',$lang_pms['Status redirect']);
}

// Build page
$page_title = $lang_pms['Contacts'].' / '.$lang_pms['Private Messages'].' / '.pun_htmlspecialchars($pun_config['o_board_title']);

require PUN_ROOT.'header.php';
?>

<div class="block">
	<h2><span><?php echo $lang_pms['Private Messages'] ?></span></h2>
	<div class="box">
		<div class="inbox">
		<?php $libelle_inbox=($box == 0 ? '<strong>'.$lang_pms['Inbox'].'</strong>' : $lang_pms['Inbox']);
		      $libelle_outbox=($box == 1 ? '<strong>'. $lang_pms['Outbox'].'</strong>' : $lang_pms['Outbox']);
		      $libelle_inbox=$lang_pms['Inbox'];
                ?>
				<a href="pms_list.php?box=0"><?php echo $libelle_inbox;            ?></a>&nbsp;&nbsp;
				<a href="pms_list.php?box=1"><?php echo $libelle_outbox;           ?></a>&nbsp;&nbsp;
				<a href="pms_contacts.php"><strong><?php echo $lang_pms['Contacts'];           ?></strong></a>&nbsp;&nbsp;
				<a href="profile.php?section=privacy&id=<?php echo $user_id; ?>"><?php echo $lang_pms['Settings'];?></a>&nbsp;&nbsp;

<?php
// Boxes status
if ($pun_user['g_pm_limit'] != 0 && $pun_user['g_id'] > PUN_GUEST)
{	
	if ($mp_boxes_empty)
		echo '<p class="conr">'.$lang_pms['Empty boxes'].'</p>';
	elseif ($mp_boxes_full)
		echo '<p class="conr"><strong>'.$lang_pms['Full boxes'].'</strong></p>';
	else
		echo '<p class="conr">'.sprintf($lang_pms['Full to'],$per_cent_box.'%').'</p>'.
			 '<div id="mp_bar_ext" class="conr"><div id="mp_bar_int" style="width:'.$per_cent_box.'px;"><!-- --></div></div>';
}
?>
			<div class="clearer"></div>
		</div>
	</div>
</div>

<div class="linkst">
	<div class="inbox">
		<p class="postlink conr"><a href="pms_send.php"><?php echo $lang_pms['Write message']; ?></a></p>
		<ul><li><a href="pms_list.php"><?php echo $lang_pms['Private Messages'] ?></a>&nbsp;</li><li>&raquo;&nbsp;<?php echo $lang_pms['Contacts'] ?></li></ul>
	</div>
</div>

<script type="text/javascript">
<!--
function checkAll(checkWhat,command){
	var inputs = document.getElementsByTagName('input');
	
	for(index = 0; index < inputs.length; index++){
		if(inputs[index].name == checkWhat){
			inputs[index].checked=document.getElementById(command).checked;
		}
	}
}
// -->
</script>
<form method="post" action="pms_contacts.php">
<div class="blocktable">
	<h2><span><?php echo $lang_pms['Contacts list'] ?></span></h2>
	<div class="box">
		<div class="inbox">
			<table cellspacing="0">
			<thead>
				<tr>
					<th><?php echo $lang_pms['Contact name'] ?></th>
					<th><?php echo $lang_pms['Rights contact'] ?></th>
					<th><?php echo $lang_pms['Delete'] ?></th>
					<th><?php echo $lang_pms['Quick message'] ?></th>
					<th class="tcmod"><label style="display: inline; white-space: nowrap;"><?php echo $lang_pms['Select'] ?>&nbsp;<input type="checkbox" id="checkAllButon" value="1" onclick="javascript:checkAll('selected_contacts[]','checkAllButon');" /></label></th>
				</tr>
			</thead>
			<tbody>
<?php
// Fetch contacts
$result = $db->query('SELECT * FROM '.$db->prefix.'contacts WHERE user_id='.$pun_user['id'].' ORDER BY allow_msg DESC, contact_name ASC') or error('Impossible de trouver la liste des contacts', __FILE__, __LINE__, $db->error());

if ($db->num_rows($result))
{
	while ($cur_contact = $db->fetch_assoc($result))
	{
		// authorized or refused
		if ($cur_contact['allow_msg'])
		{
			$status_text = $lang_pms['Authorized messages'].' - <a href="pms_contacts.php?switch='.$cur_contact['id'].'" title="'.sprintf($lang_pms['Refuse from'], pun_htmlspecialchars($cur_contact['contact_name'])).'">'.$lang_pms['Refuse'].'</a>';
			$status_class = '';
		}
		else {
			$status_text = $lang_pms['Refused messages'].' - <a href="pms_contacts.php?switch='.$cur_contact['id'].'" title="'.sprintf($lang_pms['Authorize from'], pun_htmlspecialchars($cur_contact['contact_name'])).'">'.$lang_pms['Authorize'].'</a>';
			$status_class =  ' class="iclosed"';
		}
?>
	<tr<?php echo $status_class ?>>
		<td><a href="profile.php?id=<?php echo $cur_contact['contact_id']?>"><strong><?php echo pun_htmlspecialchars($cur_contact['contact_name']); ?></strong></a></td>
		<td><?php echo $status_text; ?></td>
		<td><a href="pms_contacts.php?delete=<?php echo $cur_contact['id']?>" title="<?php printf($lang_pms['Delete x'], pun_htmlspecialchars($cur_contact['contact_name'])) ?>" onclick="return window.confirm('<?php echo str_replace("'", "\'",$lang_pms['Delete contact confirm']); ?>')"><?php echo $lang_pms['Delete'] ?></a></td>
		<td><a href="pms_send.php?uid=<?php echo $cur_contact['contact_id']?>" title="<?php printf($lang_pms['Quick message x'], pun_htmlspecialchars($cur_contact['contact_name'])) ?>"><?php echo $lang_pms['Quick message'] ?></a></td>
		<td class="tcmod"><input type="checkbox" name="selected_contacts[]" value="<?php echo $cur_contact['id']; ?>" /></td>
	</tr>
<?php
	}
}
else
	echo "\t".'<tr><td class="puncon1" colspan="5">'.$lang_pms['No contacts'].'</td></tr>'."\n";
?>
			</tbody>
			</table>
		</div>
	</div>
</div>

<div class="linksb">
	<div class="inbox">
		<p class="conr" style="width:auto"><label style="display:inline"><?php echo $lang_pms['For select'] ?>&nbsp;
		<select name="action">
			<option value="send"><?php echo $lang_pms['Quick message'] ?></option>
			<option value="authorize"><?php echo $lang_pms['Authorize'] ?></option>
			<option value="refuse"><?php echo $lang_pms['Refuse'] ?></option>
			<option value="delete_multiple"><?php echo $lang_pms['Delete'] ?></option>
		</select></label>&nbsp;<input type="submit" value="OK" /></p>
		<div class="clearer"></div>
	</div>
</div>
</form>

<div class="blockform">
	<h2><span><?php echo $lang_pms['Add contact'] ?></span></h2>
	<div class="box">
		<form action="pms_contacts.php" method="post">
		<div class="inform">
			<fieldset>
				<legend><?php echo $lang_pms['Add contact'] ?></legend>
				<div class="infldset">
					<label><strong><?php echo $lang_pms['Contact name'] ?></strong><br />
					<input type="text" name="req_username" size="25" maxlength="120" tabindex="1" /><br /></label>
					<div class="rbox">
						<label><input type="checkbox" name="req_refuse" value="1" tabindex="2" /><?php echo $lang_pms['Refuse user'] ?></label>
					</div>
				</div>
			</fieldset>
		</div>
		<p><input type="submit" name="add" value="<?php echo $lang_pms['Add'] ?>" tabindex="3" /></p>
		</form>
	</div>
</div>

<div class="postlinksb">
	<div class="inbox">
		<p class="postlink conr"><a href="pms_send.php"><?php echo $lang_pms['Write message']; ?></a></p>
		<ul><li><a href="pms_list.php"><?php echo $lang_pms['Private Messages'] ?></a>&nbsp;</li><li>&raquo;&nbsp;<?php echo $lang_pms['Contacts'] ?></li></ul>
	</div>
</div>

<?php
	require PUN_ROOT.'footer.php';
?>
