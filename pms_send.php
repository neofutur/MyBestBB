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
if (!$pun_config['o_pms_enabled'] == '1' || $pun_user['g_pm'] == 0)
	message($lang_common['No permission']);

// Load the additionals language files
require PUN_ROOT.'lang/'.$pun_user['language'].'/post.php';

$p_destinataire = '';
$p_contact = '';
$p_subject = '';
$p_message = '';

$smilies = 1;
$save = 1;

$r = (isset($_REQUEST['reply']) ? intval($_REQUEST['reply']) : 0);
$q = (isset($_REQUEST['quote']) ? intval($_REQUEST['quote']) : 0);

$from_profile = isset($_REQUEST['from_profile']) ? intval($_REQUEST['from_profile']) : '';
$tid = isset($_REQUEST['tid']) ? intval($_REQUEST['tid']) : '';

$errors = array();
$user_id = $pun_user['id'];

if (isset($_POST['form_sent']))
{
	// Make sure form_user is correct
	if ($_POST['form_user'] != $pun_user['username'])
		message($lang_common['Bad request']);
			
	// Smileys
	$smilies = isset($_POST['hide_smilies']) ? 0 : 1;
	$save = isset($_POST['savemessage']) ? 1 : 0;

	// Flood protection
	if ($pun_user['g_id'] > PUN_GUEST)
	{
		$result = $db->query('SELECT posted FROM '.$db->prefix.'messages ORDER BY id DESC LIMIT 1') or error('Impossible de trouver la durée de protection contre le flood', __FILE__, __LINE__, $db->error());
		$last = $db->result($result);
		
		if ((time() - $last) < $pun_user['g_post_flood'])
			$errors[] = sprintf($lang_pms['Flood'],$pun_user['g_post_flood']);
	}
		
	// Check users boxes
	if ($pun_user['g_pm_limit'] != 0 && $pun_user['g_id'] > PUN_GUEST && $pun_user['total_pm'] >= $pun_user['g_pm_limit'] && $save)
		$errors[] = $lang_pms['Sender full'];
	
	// Build receivers list
	$p_destinataire = pun_trim($_POST['p_username']);
	$p_contact = isset($_POST['p_contact']) ? pun_trim($_POST['p_contact']) : '';
    $dest_list = explode(',', $p_destinataire);
	
	if ($p_contact != '0')
		$dest_list[] = $p_contact;
	
	$dest_list = array_map('pun_trim', $dest_list);
	$dest_list = array_unique($dest_list);
	
	foreach ($dest_list as $k=>$v)
	{
		if ($v == '') unset($dest_list[$k]);
	}

    if (count($dest_list) < 1)
		$errors[] = $lang_pms['Must receiver'];
    elseif (count($dest_list) > $pun_config['o_pms_max_receiver'])
		$errors[] = sprintf($lang_pms['Too many receiver'], $pun_config['o_pms_max_receiver']);

	$destinataires = array(); $i = 0;
	foreach ($dest_list as $destinataire)
	{
		// Get receiver infos
		$result = $db->query('SELECT u.id, u.username, u.email, u.notify_mp, u.use_pm, g.g_id, g.g_pm_limit, COUNT(pm.id) AS total_pm, c.allow_msg FROM '.$db->prefix.'users AS u INNER JOIN '.$db->prefix.'groups AS g ON u.group_id=g.g_id LEFT JOIN '.$db->prefix.'messages AS pm ON pm.owner=u.id LEFT JOIN '.$db->prefix.'contacts AS c ON (c.user_id=u.id AND c.contact_id='.$pun_user['id'].') WHERE u.id!=1 AND u.username=\''.$db->escape($destinataire).'\' GROUP BY u.username') or error('Impossible de récupérer l\'identifiant de l\'utilisateur.', __FILE__, __LINE__, $db->error());
		// List users infos
		if ($destinataires[$i] = $db->fetch_assoc($result))
		{
			// Receivers enable PM ?
			if (!$destinataires[$i]['use_pm'] == '1')
				$errors[] = sprintf($lang_pms['User disable PM'], pun_htmlspecialchars($destinataire));			
			// Check receivers boxes
			elseif ($destinataires[$i]['g_id'] > PUN_GUEST && $destinataires[$i]['g_pm_limit'] != 0 && $destinataires[$i]['total_pm'] >= $destinataires[$i]['g_pm_limit'])
				$errors[] = sprintf($lang_pms['Dest full'], pun_htmlspecialchars($destinataire));
			// Are we authorized?
			elseif ($pun_user['g_id'] > PUN_GUEST && $destinataires[$i]['allow_msg'] !== null && $destinataires[$i]['allow_msg'] == 0)
				$errors[] = sprintf($lang_pms['User blocked'], pun_htmlspecialchars($destinataire));				
		}
		else
			$errors[] = sprintf($lang_pms['No user'], pun_htmlspecialchars($destinataire));
			
		$i++;
	}
	
	// Check subject
	$p_subject = pun_trim($_POST['req_subject']);
	
	if ($p_subject == '')
		$errors[] = $lang_post['No subject'];
	elseif (pun_strlen($p_subject) > 70)
		$errors[] = $lang_post['Too long subject'];
	elseif ($pun_config['p_subject_all_caps'] == '0' && strtoupper($p_subject) == $p_subject && $pun_user['g_id'] > PUN_GUEST)
		$p_subject = ucwords(strtolower($p_subject));

	// Clean up message from POST
	$p_message = pun_linebreaks(pun_trim($_POST['req_message']));

	// Check message
	if ($p_message == '')
		$errors[] = $lang_post['No message'];
	else if (strlen($p_message) > 65535)
		$errors[] = $lang_post['Too long message'];
	else if ($pun_config['p_message_all_caps'] == '0' && strtoupper($p_message) == $p_message && $pun_user['g_id'] > PUN_GUEST)
		$p_message = ucwords(strtolower($p_message));

	// Validate BBCode syntax
	if ($pun_config['p_message_bbcode'] == '1' && strpos($p_message, '[') !== false && strpos($p_message, ']') !== false)
	{
		require PUN_ROOT.'include/parser.php';
		$p_message = preparse_bbcode($p_message, $errors);
	}
	
	// Send message(s)	
	if (empty($errors) && !isset($_POST['preview']))
	{
		if ($pun_config['o_pms_notification'] == '1')
		{
			require_once PUN_ROOT.'include/email.php';
			
			// Load the "new_pm" template
			$mail_tpl = trim(file_get_contents(PUN_ROOT.'lang/'.$pun_user['language'].'/mail_templates/new_pm.tpl'));
	
			// The first row contains the subject
			$first_crlf = strpos($mail_tpl, "\n");
			$mail_subject = trim(substr($mail_tpl, 8, $first_crlf-8));
			$mail_message = trim(substr($mail_tpl, $first_crlf));
	
			$mail_subject = str_replace('<board_title>', $pun_config['o_board_title'], $mail_subject);
			$mail_message = str_replace('<sender>', $pun_user['username'], $mail_message);
			$mail_message = str_replace('<board_mailer>', $pun_config['o_board_title'].' '.$lang_common['Mailer'], $mail_message);
		}
		
		foreach ($destinataires as $dest)
		{
			$db->query('INSERT INTO '.$db->prefix.'messages (owner, subject, message, sender, sender_id, sender_ip, smileys, showed, status, posted) VALUES(\''.$dest['id'].'\', \''.$db->escape($p_subject).'\', \''.$db->escape($p_message).'\', \''.$db->escape($pun_user['username']).'\', \''.$pun_user['id'].'\', \''.get_remote_address().'\', \''.$smilies.'\', \'0\', \'0\', \''.time().'\' )') or error('Impossible d\'envoyer le message.', __FILE__, __LINE__, $db->error());
			
			$new_mp = $db->insert_id();
			
			// Save an own copy of the message
			if ($save == 1)
			{
				$db->query('INSERT INTO '.$db->prefix.'messages (owner, subject, message, sender, sender_id, sender_ip, smileys, showed, status, posted) VALUES(\''.$pun_user['id'].'\', \''.$db->escape($p_subject).'\', \''.$db->escape($p_message).'\', \''.$db->escape($dest['username']).'\', \''.$dest['id'].'\', \''.get_remote_address().'\', \''.$smilies.'\', \'1\', \'1\', \''.time().'\' )') or error('Impossible de sauvegarder le message dans le dossier des messages envoyés', __FILE__, __LINE__, $db->error());
			}
			
			// E-mail notification
			if ($pun_config['o_pms_notification'] == '1' && $dest['notify_mp'] == 1)
			{
				$mail_message = str_replace('<pm_url>', $pun_config['o_base_url'].'/pms_list.php?mid='.$new_mp, $mail_message);
				pun_mail($dest['email'], $mail_subject, $mail_message);
			}
		}

		if ($from_profile != '')
			redirect('profile.php?id='.$from_profile, $lang_pms['Sent redirect']);
		elseif ($tid != '')
			redirect('viewtopic.php?id='.$tid, $lang_pms['Sent redirect']);
		else
			redirect('pms_list.php', $lang_pms['Sent redirect']);
	}
}
else {
	// To user(s)
	if (isset($_GET['uid']))
	{
		$users_id = explode('-', $_GET['uid']);
		$users_id = array_map('intval', $users_id);
		foreach ($users_id as $k=>$v)
			if ($v <= 0) unset($users_id[$k]);
		
		$arry_dests = array();
		foreach ($users_id as $user_id)
		{
			$result = $db->query('SELECT username FROM '.$db->prefix.'users WHERE id='.$user_id) or error('Impossible de trouver les informations du message', __FILE__, __LINE__, $db->error());
			
			if (!$db->num_rows($result))
				message($lang_common['Bad request']);
			
			$arry_dests[] = $db->result($result);
		}
			
		$p_destinataire = implode(',', $arry_dests);
	}
	
	// Reply or quote ?
	if ($r != 0 || $q != 0)
	{	
		// Get message info
		$mid = ($r<1 ? $q : $r);
		$result = $db->query('SELECT * FROM '.$db->prefix.'messages WHERE id='.$mid.' AND owner='.$pun_user['id']) or error('Impossible de trouver les informations du message', __FILE__, __LINE__, $db->error());
		
		if (!$db->num_rows($result))
			message($lang_common['Bad request']);
		
		$re_message = $db->fetch_assoc($result);
	
		// Quote the message
		if ($q > 0)
			$p_message = '[quote='.$re_message['sender'].']'.$re_message['message'].'[/quote]';
	
	   // Add subject
		$p_subject = ((strpos($re_message['subject'], 'RE:') !== false) ? $re_message['subject'] : 'RE: '.$re_message['subject']);
	}
}

$page_title = $lang_pms['Send a message'].' / '.$lang_pms['Private Messages'].' / '.pun_htmlspecialchars($pun_config['o_board_title']);

$required_fields = array('req_message' => $lang_common['Message']);
$focus_element = array('post');
$focus_element[] = 'req_message';

if ($r == 0 && $q == 0)
{
	$required_fields['req_subject'] = $lang_common['Subject'];
	$focus_element[] = 'req_subject';
}

require PUN_ROOT.'header.php';
?>

<div class="block">
	<h2><span><?php echo $lang_pms['Private Messages'] ?></span></h2>
	<div class="box">
		<div class="inbox">
				<a href="pms_list.php?box=0"><?php echo $lang_pms['Inbox'];            ?></a>&nbsp;&nbsp;
				<a href="pms_list.php?box=1"><?php echo $lang_pms['Outbox'];           ?></a>&nbsp;&nbsp;
				<a href="pms_contacts.php"><?php echo $lang_pms['Contacts'];           ?></a>&nbsp;&nbsp;
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
		<ul><li><a href="pms_list.php"><?php echo $lang_pms['Private Messages'] ?></a>&nbsp;</li><li>&raquo;&nbsp;<?php echo $lang_pms['Send a message'] ?></li></ul>
		<div class="clearer"></div>
	</div>
</div>

<?php
// If there are errors, we display them
if (!empty($errors))
{
?>
<div id="posterror" class="block">
	<h2><span><?php echo $lang_post['Post errors'] ?></span></h2>
	<div class="box">
		<div class="inbox">
			<p><?php echo $lang_post['Post errors info'] ?></p>
			<ul>
<?php
	while (list(, $cur_error) = each($errors))
		echo "\t\t\t\t".'<li><strong>'.$cur_error.'</strong></li>'."\n";
?>
			</ul>
		</div>
	</div>
</div>

<?php

}
else if (isset($_POST['preview']))
{
	require_once PUN_ROOT.'include/parser.php';
	$preview_message = parse_message($p_message, !$smilies);

?>
<div id="postpreview" class="blockpost">
	<h2><span><?php echo $lang_post['Post preview'] ?></span></h2>
	<div class="box">
		<div class="inbox">
			<div class="postright">
				<div class="postmsg">
					<?php echo $preview_message."\n" ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

}

$cur_index = 1;

?>
<div class="blockform">
	<h2><span><?php echo $lang_pms['Send a message'] ?></span></h2>
	<div class="box">
	<form method="post" id="post" action="pms_send.php" onsubmit="return process_form(this)">
		<div class="inform">
		<fieldset>
			<legend><?php echo $lang_common['Write message legend'] ?></legend>
			<div class="infldset txtarea">
				<input type="hidden" name="form_sent" value="1" />
				<input type="hidden" name="form_user" value="<?php echo pun_htmlspecialchars($pun_user['username']) ?>" />
				<?php echo (($r != 0) ? '<input type="hidden" name="reply" value="1" />' : '') ?>
				<?php echo (($q != 0) ? '<input type="hidden" name="quote" value="1" />' : '') ?>
				<?php echo (($tid != '') ? '<input type="hidden" name="tid" value="'.$tid.'" />' : '') ?>
				<?php echo (($from_profile != '') ? '<input type="hidden" name="from_profile" value="'.$from_profile.'" />' : '') ?>
				<?php if ($r == 0 && $q == 0) : ?>
				<div class="conl">
				<label><strong><?php echo $lang_pms['Send to'] ?></strong><br />
				<input type="text" name="p_username" size="30" value="<?php echo pun_htmlspecialchars($p_destinataire); ?>" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
				</div>
				<div class="conr">
<?php
// Fetch contacts
$result = $db->query('SELECT contact_name FROM '.$db->prefix.'contacts WHERE user_id='.$pun_user['id'].' ORDER BY contact_name ASC') or error('Impossible de trouver la liste des contacts', __FILE__, __LINE__, $db->error());

if ($db->num_rows($result))
{
?>

				<label><?php echo $lang_pms['Contacts'] ?><br />
				<select name="p_contact">
					<option value="0">Autres</option>
<?php
	while ($cur_contact = $db->fetch_assoc($result))
		echo "\t\t\t\t\t".'<option value="'.$cur_contact['contact_name'].'"'.($p_contact == $cur_contact['contact_name'] ? ' selected="selected"' : '').'>'.pun_htmlspecialchars($cur_contact['contact_name']).'</option>'."\n";
?>
				</select>
				<br /></label>
<?php
}
else
	echo '<p>'.$lang_pms['No contacts'].'</p>';
?>
				</div>
				<div class="clearer"></div>
				<p><?php echo $lang_pms['Send multiple'] ?></p>
				<label><strong><?php echo $lang_common['Subject'] ?></strong><br />
				<!--mod modern_bbcode -->
				<?php //$modern_bbcode_enabled = ($pun_config['p_message_bbcode'] == '1') ? true : false; ?>
				<?php require(PUN_ROOT.'mod_modern_bbcode.php'); ?>
				<!--End mod modern_bbcode -->
				<input class="longinput" type="text" name="req_subject" value="<?php echo ($p_subject != '' ? pun_htmlspecialchars($p_subject) : ''); ?>" size="80" maxlength="255" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
				<?php else : ?>
				<input type="hidden" name="p_username" value="<?php echo pun_htmlspecialchars($p_destinataire) ?>" />
				<input type="hidden" name="req_subject" value="<?php echo $p_subject ?>" />
        		<?php endif; ?>
				<label for="req_message"><strong><?php echo $lang_common['Message'] ?></strong></label>
				<textarea name="req_message" id="req_message" rows="20" cols="95" tabindex="<?php echo $cur_index++ ?>"><?php echo ($p_message != '' ? pun_htmlspecialchars($p_message) : ''); ?></textarea>
				<?php 
				/* Si vous utilisez la PunToolbar, décomentez la ligne suivante : */
				//require PUN_ROOT.'include/puntoolbar.php'; 
				?>
				<ul class="bblinks">
					<li><a href="help.php#bbcode" onclick="window.open(this.href); return false;"><?php echo $lang_common['BBCode'] ?></a>: <?php echo ($pun_config['p_message_bbcode'] == '1') ? $lang_common['on'] : $lang_common['off']; ?></li>
					<li><a href="help.php#img" onclick="window.open(this.href); return false;"><?php echo $lang_common['img tag'] ?></a>: <?php echo ($pun_config['p_message_img_tag'] == '1') ? $lang_common['on'] : $lang_common['off']; ?></li>
					<li><a href="help.php#smilies" onclick="window.open(this.href); return false;"><?php echo $lang_common['Smilies'] ?></a>: <?php echo ($pun_config['o_smilies'] == '1') ? $lang_common['on'] : $lang_common['off']; ?></li>
				</ul>
			</div>
		</fieldset>
<?php
	$checkboxes = array();

	if ($pun_config['o_smilies'] == '1')
		$checkboxes[] = '<label><input type="checkbox" name="hide_smilies" value="1" tabindex="'.$cur_index++.'"'.($smilies == 0 ? ' checked="checked"' : '').' />'.$lang_post['Hide smilies'];

	$checkboxes[] = '<label><input type="checkbox" name="savemessage" value="1" tabindex="'.$cur_index++.'"'.($save == 1 ? ' checked="checked"' : '').' />'.$lang_pms['Save message'];

	if (!empty($checkboxes))
	{
?>
			</div>
			<div class="inform">
				<fieldset>
					<legend><?php echo $lang_common['Options'] ?></legend>
					<div class="infldset">
						<div class="rbox">
							<?php echo implode('<br /></label>'."\n\t\t\t\t", $checkboxes).'<br /></label>'."\n" ?>
						</div>
					</div>
				</fieldset>
<?php
	}
?>
			</div>
			<p><input type="submit" name="submit" value="<?php echo $lang_pms['Send'] ?>" tabindex="<?php echo $cur_index++ ?>" accesskey="s" /><input type="submit" name="preview" value="<?php echo $lang_post['Preview'] ?>" tabindex="<?php echo $cur_index++ ?>" accesskey="p" /><a href="javascript:history.go(-1)"><?php echo $lang_common['Go back'] ?></a></p>
		</form>
	</div>
</div>
<?php
	require PUN_ROOT.'footer.php';
?>
