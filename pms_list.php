<?php
/***********************************************************************

  Copyright (C) 2002-2005  Rickard Andersson (rickard@punbb.org)

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

// Load the additionals language files
require PUN_ROOT.'lang/'.$pun_user['language'].'/topic.php';
$user_id = $pun_user['id'];

// Inbox or outbox ?
$box = isset($_REQUEST['box']) ? intval($_REQUEST['box']) : 0;
$box = (($box != 1) ? 0 : 1);
$name = (($box == 0) ? $lang_pms['Inbox'] : $lang_pms['Outbox']);

// Page ?
$p = (!isset($_REQUEST['p']) || $_REQUEST['p'] <= 1) ? 1 : $_REQUEST['p'];

// Are we reading a message ?
$mid = isset($_REQUEST['mid']) ? intval($_REQUEST['mid']) : 0;

// Action ?
$action = ((isset($_REQUEST['action']) && ($_REQUEST['action'] == 'markall' || $_REQUEST['action'] == 'delete_multiple' || $_REQUEST['action'] == 'delete' || $_REQUEST['action'] == 'markread' || $_REQUEST['action'] == 'markunread')) ? $_REQUEST['action'] : '');


if ($action != '')
{
	// Mark all messages as read
	if ($action == 'markall')
	{
		$db->query('UPDATE '.$db->prefix.'messages SET showed=1 WHERE owner='.$pun_user['id']) or error('Impossible de mettre à jour le statut du message', __FILE__, __LINE__, $db->error());
		redirect('pms_list.php?box='.$box.'&p='.$p, $lang_pms['Read all redirect']);
	}
	// Mark as read multiple posts
	elseif ($action == 'markread')
	{
		$idlist = $_POST['selected_messages'];
		
		if (empty($idlist))
			message($lang_pms['Must select']);
			
		$idlist = implode(',', array_values($idlist));
		
		$db->query('UPDATE '.$db->prefix.'messages SET showed=1 WHERE id IN('.$idlist.') AND owner=\''.$pun_user['id'].'\'') or error('Impossible de mettre à jour le statut des messages', __FILE__, __LINE__, $db->error());
		redirect('pms_list.php?box='.$box.'&p='.$p, $lang_pms['Read redirect']);
	}
	// Mark as unread multiple posts
	elseif ($action == 'markunread')
	{
		$idlist = $_POST['selected_messages'];
		
		if (empty($idlist))
			message($lang_pms['Must select']);
			
		$idlist = implode(',', array_values($idlist));
		
		$db->query('UPDATE '.$db->prefix.'messages SET showed=0 WHERE id IN('.$idlist.') AND owner=\''.$pun_user['id'].'\'') or error('Impossible de mettre à jour le statut des messages', __FILE__, __LINE__, $db->error());
		redirect('pms_list.php?box='.$box.'&p='.$p, $lang_pms['Unread redirect']);
	}
	// Delete multiple posts
	elseif ($action == 'delete_multiple')
	{
		if (isset($_POST['delete_multiple_comply']) )
		{
			$db->query('DELETE FROM '.$db->prefix.'messages WHERE id IN('.$_POST['messages'].') AND owner=\''.$pun_user['id'].'\'') or error('Impossible de supprimer les messages.', __FILE__, __LINE__, $db->error());
			
			switch ($db_type)
			{
				case 'mysql':
				case 'mysqli':
					$db->query('OPTIMIZE TABLE '.$db->prefix.'messages') or error('Impossible d\'optimiser la table messages.', __FILE__, __LINE__, $db->error());
					break;
				
				case 'pgsql':
				case 'sqlite':
					$db->query('VACUUM '.$db->prefix.'messages') or error('Impossible d\'optimiser la table messages.', __FILE__, __LINE__, $db->error());
					break;
			}
			
			redirect('pms_list.php?box='.$box, $lang_pms['Deleted redirect']);
		}
		else {
			$idlist = $_POST['selected_messages'];
			
			if (empty($idlist))
				message($lang_pms['Must select']);
			
			$idlist = implode(',', array_values($idlist));
			
			$page_title = $lang_pms['Multidelete'].' / '.$lang_pms['Private Messages'].' / '.pun_htmlspecialchars($pun_config['o_board_title']);
			require PUN_ROOT.'header.php';
	?>
	<div class="blockform">
		<h2><span><?php echo $lang_pms['Multidelete'] ?></span></h2>
		<div class="box">
			<form method="post" action="pms_list.php">
				<input type="hidden" name="action" value="delete_multiple" />
				<input type="hidden" name="messages" value="<?php echo $idlist ?>" />
				<input type="hidden" name="box" value="<?php echo $box; ?>" />
				<input type="hidden" name="delete_multiple_comply" value="1" />
				<div class="inform">
					<fieldset>
						<legend><?php echo $lang_pms['Please confirm'] ?></legend>
						<div class="infldset">
							<p class="warntext"><?php echo $lang_pms['Delete messages comply'] ?></p>
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
	// Delete single message
	elseif ($action == 'delete')
	{
		if (isset($_POST['delete_comply']))
		{
			$db->query('DELETE FROM '.$db->prefix.'messages WHERE id='.$mid) or error('Impossible de supprimer le message', __FILE__, __LINE__, $db->error());
			
			// Redirect
			redirect('pms_list.php?box='.$box.'&p='.$p, $lang_pms['Del redirect']);
		}
		else
		{
			$page_title = pun_htmlspecialchars($pun_config['o_board_title']).' / '.$lang_pms['Delete message'];
			
			require PUN_ROOT.'header.php';
		?>
		<div class="blockform">
			<h2><span><?php echo $lang_pms['Delete message'] ?></span></h2>
			<div class="box">
				<form action="pms_list.php" method="post">
					<input type="hidden" name="action" value="delete" />
					<input type="hidden" name="mid" value="<?php echo $mid ?>" />
					<input type="hidden" name="box" value="<?php echo $box; ?>" />
					<input type="hidden" name="p" value="<?php echo $p; ?>" />
					<input type="hidden" name="delete_comply" value="1" />
					<div class="inform">
						<fieldset>
							<legend><?php echo $lang_pms['Please confirm'] ?></legend>
							<div class="infldset">
								<p class="warntext"><?php echo $lang_pms['Delete message comply'] ?></p>
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

// Get message count for this box
$result = $db->query('SELECT count(*) FROM '.$db->prefix.'messages WHERE status='.$box.' AND owner='.$pun_user['id']) or error('Impossible de compter les messages.', __FILE__, __LINE__, $db->error());
list($num_messages) = $db->fetch_row($result);

// What page are we on ?
$num_pages = ceil($num_messages/$pun_config['o_pms_mess_per_page']);
if ($p > $num_pages) $p = 1;
$start_from = intval($pun_config['o_pms_mess_per_page'])*($p-1);
$limit = $start_from.','.$pun_config['o_pms_mess_per_page'];


// Start building page
$page_title = $name.' / '.$lang_pms['Private Messages'].' / '.pun_htmlspecialchars($pun_config['o_board_title']);

require PUN_ROOT.'header.php';
?>

<div class="block">
	<h2><span><?php echo $lang_pms['Private Messages'] ?></span></h2>
	<div class="box">
		<div class="inbox">
		<?php $libelle_inbox=($box == 0 ? '<strong>'.$lang_pms['Inbox'].'</strong>' : $lang_pms['Inbox']);
		      $libelle_outbox=($box == 1 ? '<strong>'. $lang_pms['Outbox'].'</strong>' : $lang_pms['Outbox']);
                ?>
				<a href="pms_list.php?box=0"><?php echo $libelle_inbox;            ?></a>&nbsp;&nbsp;
				<a href="pms_list.php?box=1"><?php echo $libelle_outbox;           ?></a>&nbsp;&nbsp;
				<a href="pms_contacts.php"><?php echo $lang_pms['Contacts'];           ?></a>&nbsp;&nbsp;
				<a href="profile.php?section=privacy&id=<?php echo $user_id; ?>"><?php echo $lang_pms['Settings'];?></a>&nbsp;&nbsp;
<!--
				<a href="pms_list.php?box=0"><?php echo ($box == 0 ? '<strong>'.$lang_pms['Inbox'].'</strong>' : $lang_pms['Inbox']); ?></a>
				<a href="pms_list.php?box=1"><?php echo ($box == 1 ? '<strong>'. $lang_pms['Outbox'].'</strong>' : $lang_pms['Outbox']); ?></a>
				<a href="pms_contacts.php"><?php echo $lang_pms['Contacts']; ?></a>
-->
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
		<p class="pagelink conl"><?php echo $lang_common['Pages'].': '.paginate($num_pages, $p, 'pms_list.php?box='.$box) ?></p>
		<p class="postlink conr"><a href="pms_send.php"><?php echo $lang_pms['Write message']; ?></a></p>
		<ul><li><a href="pms_list.php"><?php echo $lang_pms['Private Messages'] ?></a>&nbsp;</li><li>&raquo;&nbsp;<?php echo $name ?></li></ul>
		<div class="clearer"></div>
	</div>
</div>

<?php
// Are we viewing a message ?
if ($mid > 0)
{
	$result = $db->query('SELECT status,owner FROM '.$db->prefix.'messages WHERE id='.$mid) or error('Unable to get message status', __FILE__, __LINE__, $db->error());
	list($status, $owner) = $db->fetch_row($result);
	
	if ($owner != $pun_user['id'])
		message($lang_common['No permission']);
	
	$where = ($status == 0) ? 'u.id=m.sender_id' : 'u.id=m.owner';

	$result = $db->query('SELECT m.id AS mid, m.subject, m.sender_ip, m.message, m.smileys, m.posted, m.showed, u.id, u.group_id as g_id, g.g_user_title, u.username, u.registered, u.email, u.title, u.url, u.icq, u.msn, u.aim, u.yahoo, u.location, u.use_avatar, u.email_setting, u.num_posts, u.admin_note, u.signature, o.user_id AS is_online FROM '.$db->prefix.'messages AS m,'.$db->prefix.'users AS u LEFT JOIN '.$db->prefix.'online AS o ON (o.user_id=u.id AND o.idle=0) LEFT JOIN '.$db->prefix.'groups AS g ON (u.group_id = g.g_id) WHERE '.$where.' AND m.id='.$mid.' GROUP BY m.id') or error('Impossible de trouver le message et les informations de l\'utilisateur', __FILE__, __LINE__, $db->error());
	$cur_post = $db->fetch_assoc($result);
		
	if ($cur_post['showed'] == 0)
		$db->query('UPDATE '.$db->prefix.'messages SET showed=1 WHERE id='.$mid) or error('Impossible de mettre à jour le statut du message', __FILE__, __LINE__, $db->error());

	if ($cur_post['id'] > 0)
	{
		$username = '<a href="profile.php?id='.$cur_post['id'].'">'.pun_htmlspecialchars($cur_post['username']).'</a>';
		$user_title = get_title($cur_post);
		
		if ($pun_config['o_censoring'] == '1')
			$user_title = censor_words($user_title);
		
		// Format the online indicator
		$is_online = ($cur_post['is_online'] == $cur_post['id']) ? '<strong>'.$lang_topic['Online'].'</strong>' : $lang_topic['Offline'];

		if ($pun_config['o_avatars'] == '1' && $cur_post['use_avatar'] == '1' && $pun_user['show_avatars'] != '0')
		{
			if ($img_size = @getimagesize($pun_config['o_avatars_dir'].'/'.$cur_post['id'].'.gif'))
				$user_avatar = '<img src="'.$pun_config['o_avatars_dir'].'/'.$cur_post['id'].'.gif" '.$img_size[3].' alt="" />';
			elseif ($img_size = @getimagesize($pun_config['o_avatars_dir'].'/'.$cur_post['id'].'.jpg'))
				$user_avatar = '<img src="'.$pun_config['o_avatars_dir'].'/'.$cur_post['id'].'.jpg" '.$img_size[3].' alt="" />';
			elseif ($img_size = @getimagesize($pun_config['o_avatars_dir'].'/'.$cur_post['id'].'.png'))
				$user_avatar = '<img src="'.$pun_config['o_avatars_dir'].'/'.$cur_post['id'].'.png" '.$img_size[3].' alt="" />';
		}
		else
			$user_avatar = '';

		// We only show location, register date, post count and the contact links if "Show user info" is enabled
		if ($pun_config['o_show_user_info'] == '1')
		{
			if ($cur_post['location'] != '')
			{
				if ($pun_config['o_censoring'] == '1')
					$cur_post['location'] = censor_words($cur_post['location']);

				$user_info[] = '<dd>'.$lang_topic['From'].': '.pun_htmlspecialchars($cur_post['location']);
			}

			$user_info[] = '<dd>'.$lang_common['Registered'].': '.format_time($cur_post['registered'],true);

			if ($pun_config['o_show_post_count'] == '1' || $pun_user['g_id'] < PUN_GUEST)
				$user_info[] = '<dd>'.$lang_common['Posts'].': '.$cur_post['num_posts'];

			// Now let's deal with the contact links (E-mail and URL)
			if (($cur_post['email_setting'] == '0' && !$pun_user['is_guest']) || $pun_user['g_id'] < PUN_GUEST)
				$user_contacts[] = '<a href="mailto:'.$cur_post['email'].'">'.$lang_common['E-mail'].'</a>';
			else if ($cur_post['email_setting'] == '1' && !$pun_user['is_guest'])
				$user_contacts[] = '<a href="misc.php?email='.$cur_post['id'].'">'.$lang_common['E-mail'].'</a>';
				
			if ($pun_config['o_pms_enabled'] && !$pun_user['is_guest'] && $pun_user['g_pm'] == 1)
			{
				$pid = isset($cur_post['poster_id']) ? $cur_post['poster_id'] : $cur_post['id'];
				$user_contacts[] = '<a href="pms_send.php?uid='.$pid.'&tid='.$mid.'">'.$lang_pms['PM'].'</a>';
			}
			
			if ($cur_post['url'] != '')
				$user_contacts[] = '<a href="'.pun_htmlspecialchars($cur_post['url']).'">'.$lang_topic['Website'].'</a>';
		}
		
		// Moderator and Admin stuff
		if ($pun_user['g_id'] < PUN_GUEST)
		{
			$user_info[] = '<dd>IP: <a href="moderate.php?get_host='.$cur_post['id'].'">'.$cur_post['sender_ip'].'</a>';

			if ($cur_post['admin_note'] != '')
				$user_info[] = '<dd>'.$lang_topic['Note'].': <strong>'.pun_htmlspecialchars($cur_post['admin_note']).'</strong>';
		}
		// Generation post action array (reply, delete etc.)
		$post_actions[] = '<li class="postdelete"><a href="pms_list.php?action=delete&amp;mid='.$cur_post['mid'].'&amp;box='.$box.'&amp;p='.$p.'">'.$lang_pms['Delete'].'</a>';
	
		if (!$status)
		{
			$post_actions[] = '<li class="mpreply"><a href="pms_send.php?uid='.$cur_post['id'].'&amp;reply='.$cur_post['mid'].'">'.$lang_pms['Reply'].'</a>';
			$post_actions[] = '<li class="postquote"><a href="pms_send.php?uid='.$cur_post['id'].'&amp;quote='.$cur_post['mid'].'">'.$lang_pms['Quote'].'</a>';
		}

	}
	// If the sender has been deleted
	else {
		$result = $db->query('SELECT id,sender,message,posted FROM '.$db->prefix.'messages WHERE id='.$mid) or error('Impossible de trouver le message et les informations de l\'utilisateur', __FILE__, __LINE__, $db->error());
		$cur_post = $db->fetch_assoc($result);

		$username = pun_htmlspecialchars($cur_post['sender']);
		$user_title = $lang_pms['Deleted User'];

		$post_actions[] = '<li class="postdelete"><a href="pms_list.php?action=delete&amp;mid='.$cur_post['id'].'&amp;box='.$box.'&amp;p='.$p.'">'.$lang_pms['Delete'].'</a>';
		
		$is_online = $lang_topic['Offline'];
	}
	
	// Perform the main parsing of the message (BBCode, smilies, censor words etc)
	require PUN_ROOT.'include/parser.php';
	$cur_post['smileys'] = isset($cur_post['smileys']) ? $cur_post['smileys'] : $pun_user['show_smilies'];
	$cur_post['message'] = parse_message($cur_post['message'], (int)(!$cur_post['smileys']));
	
	// Do signature parsing/caching
	if (isset($cur_post['signature']) && $pun_user['show_sig'] != '0')
		$signature = parse_signature($cur_post['signature']);	
?>

	<div id="message" class="blockpost row_odd firstpost">
		<h2><span><?php echo format_time($cur_post['posted']) ?></span></h2>
		<div class="box">
			<div class="inbox">
				<div class="postleft">
					<dl>
						<dt><strong><?php echo $username ?></strong></dt>
						<dd class="usertitle"><strong><?php echo $user_title ?></strong></dd>
	<?php if (!empty($user_avatar)) echo "\t\t\t\t\t".'<dd class="postavatar">'.$user_avatar.'</dd>'; ?>
	<?php if (count($user_info)) echo "\t\t\t\t\t".implode('</dd>'."\n\t\t\t\t\t", $user_info).'</dd>'."\n"; ?>
	<?php if (count($user_contacts)) echo "\t\t\t\t\t".'<dd class="usercontacts">'.implode('&nbsp;&nbsp;', $user_contacts).'</dd>'."\n"; ?>
					</dl>
				</div>
				<div class="postright">
					<div class="postmsg">
						<?php echo $cur_post['message']."\n" ?>
					</div>
	<?php if (isset($signature)) echo "\t\t\t\t".'<div class="postsignature"><hr />'.$signature.'</div>'."\n"; ?>
				</div>
				<div class="clearer"></div>
				<div class="postfootleft"><?php if ($cur_post['id'] > 1) echo '<p>'.$is_online.'</p>'; ?></div>
				<div class="postfootright"><?php echo (count($post_actions)) ? '<ul>'.implode($lang_topic['Link separator'].'</li>', $post_actions).'</li></ul></div>'."\n" : '<div>&nbsp;</div></div>'."\n" ?>
			</div>
		</div>
	</div>
	<div class="clearer"></div>
<?php	
}
?>

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
<form method="post" action="pms_list.php">
<div class="blocktable">
	<h2><span><?php echo $name ?></span></h2>
	<div class="box">
		<div class="inbox">
			<input type="hidden" name="box" value="<?php echo $box; ?>" />
			<table cellspacing="0">
			<thead>
				<tr>
					<th class="tcl"><?php echo $lang_pms['Subject'] ?></th>
					<th class="tc2"><?php echo (($box == 0) ? $lang_pms['Sender'] : $lang_pms['Receiver']); ?></th>
					<th class="tcr"><?php echo $lang_pms['Date'] ?></th>
					<th class="tcmod"><label style="display: inline; white-space: nowrap;"><?php echo $lang_pms['Select'] ?>&nbsp;<input type="checkbox" id="checkAllButon" value="1" onclick="javascript:checkAll('selected_messages[]','checkAllButon');" /></label></th>
				</tr>
			</thead>
			<tbody>
<?php
// Fetch messages
$result = $db->query('SELECT * FROM '.$db->prefix.'messages WHERE owner='.$pun_user['id'].' AND status='.$box.' ORDER BY posted DESC LIMIT '.$limit) or error('Impossible de trouver la liste des messages privés', __FILE__, __LINE__, $db->error());

// If there are messages in this folder.
if ($db->num_rows($result))
{
	while ($cur_mess = $db->fetch_assoc($result))
	{
		$icon_text = $lang_common['Normal icon'];
		$icon_type = 'icon';
		if ($cur_mess['showed'] == 0)
		{
			$icon_text .= ' '.$lang_common['New icon'];
			$icon_type = 'icon inew';
		}
			
		$subject = '<a href="pms_list.php?mid='.$cur_mess['id'].'&amp;box='.$box.'&amp;p='.$p.'#message">'.
					(($cur_mess['id'] == $mid) ? 
					'<strong>'.pun_htmlspecialchars($cur_mess['subject']).'</strong>' : 
					pun_htmlspecialchars($cur_mess['subject'])).
					'</a>';
?>
	<tr>
		<td class="tcl">
			<div class="intd">
				<div class="<?php echo $icon_type ?>"><div class="nosize"><?php echo $icon_text ?></div></div>
				<div class="tclcon"><?php echo $subject; ?></div>
			</div>
		</td>
		<td class="tc2"><a href="profile.php?id=<?php echo $cur_mess['sender_id']; ?>"><?php echo pun_htmlspecialchars($cur_mess['sender']); ?></a></td>
		<td class="tcr"><?php echo format_time($cur_mess['posted']) ?></td>
		<td class="tcmod"><input type="checkbox" name="selected_messages[]" value="<?php echo $cur_mess['id']; ?>" /></td>
	</tr>
<?php
	}
}
else
	echo "\t".'<tr><td class="puncon1" colspan="4">'.$lang_pms['No messages'].'</td></tr>'."\n";
?>
			</tbody>
			</table>
		</div>
	</div>
</div>

<div class="linksb">
	<div class="inbox">
		<p class="pagelink conl"><?php echo $lang_common['Pages'].': '.paginate($num_pages, $p, 'pms_list.php?box='.$box) ?></p>
		<p class="conr" style="width:auto"><label style="display:inline"><?php echo $lang_pms['For select'] ?>&nbsp;
		<select name="action">
			<option value="markread"><?php echo $lang_pms['Mark as read select'] ?></option>
			<option value="markunread"><?php echo $lang_pms['Mark as unread select'] ?></option>
			<option value="delete_multiple"><?php echo $lang_pms['Delete'] ?></option>
		</select></label>&nbsp;<input type="submit" value="OK" /></p>
		<div class="clearer"></div>
	</div>
</div>
</form>

<?php
if ($mid > 0)
	$forum_id = $mid;

$footer_style = 'pms_list';
require PUN_ROOT.'footer.php';
?>
