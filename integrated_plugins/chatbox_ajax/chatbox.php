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
require PUN_ROOT.'include/parser.php';

if (!$pun_config['cb_pbb_version'])
	message('Poki BB Chatbox is not installed correctly. Please make sure you have launched install_mod.php');

if ($pun_user['g_read_board'] == '0')
	message($lang_common['No view']);

// Load the chatbox.php and post.php language file
require PUN_ROOT.'lang/'.$pun_user['language'].'/chatbox.php';
require PUN_ROOT.'lang/'.$pun_user['language'].'/post.php';


// ADDED: function to delete posts in the chatbox
if (isset($_GET['del']))
{
	if ($pun_user['g_id'] > PUN_MOD)
		message($lang_common['No permission']);

	// If not using Ajax, we'll need to check the referrer when trying to delete a post
	if(!isset($_POST['ajax']))
		confirm_referrer('chatbox.php');

	// Delete the message, and update the chatbox post count
	$db->query('DELETE FROM '.$db->prefix.'chatbox_msg WHERE id='.intval($_GET['del']).' LIMIT 1') or error('Unable to delete message from chatbox', __FILE__, __LINE__, $db->error());

	if(isset($_GET['usr']) && intval($_GET['usr'] > 1)) {
		$low_prio = ($db_type == 'mysql') ? 'LOW_PRIORITY ' : '';
		$db->query('UPDATE '.$low_prio.$db->prefix.'users SET num_posts_chatbox=num_posts_chatbox-1 WHERE id='.intval($_GET['usr'])) or error('Unable to update total message count', __FILE__, __LINE__, $db->error());
	}

	// If not using Ajax, we'll do a regular PunBB redirect here
	if(!isset($_POST['ajax']))
		redirect(PUN_ROOT.'chatbox.php', 'Message successfully deleted. Redirecting you back to the chatbox');
}


// This particular function doesn't require forum-based moderator access. It can be used
// by all moderators and admins. Some small modifications to make it work better with Ajax
if (isset($_GET['get_host']))
{
	if ($pun_user['g_id'] > PUN_MOD)
		message($lang_common['No permission']);

	// Is get_host an IP address or a post ID?
	if (preg_match('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/', $_GET['get_host']))
		$ip = $_GET['get_host'];
	else
	{
		$get_host = intval($_GET['get_host']);
		if ($get_host < 1)
			message($lang_common['Bad request']);

		$result = $db->query('SELECT poster_ip FROM '.$db->prefix.'chatbox_msg WHERE id='.$get_host) or error('Unable to fetch post IP address', __FILE__, __LINE__, $db->error());
		if (!$db->num_rows($result))
			message($lang_common['Bad request']);

		$ip = $db->result($result);
	}

	if(!isset($_POST['ajax']))
		message('The IP address is: '.$ip.'<br />The host name is: '.@gethostbyaddr($ip).'<br /><br /><a href="admin_users.php?show_users='.$ip.'">Show more users for this IP</a>');
	else
		exit('<p>The IP address is: '.$ip.'<br />The host name is: '.@gethostbyaddr($ip).'<br /><br /><a href="admin_users.php?show_users='.$ip.'">Show more users for this IP</a></p>');

}

$page_title = pun_htmlspecialchars($lang_chatbox['Page_title']);
define('PUN_ALLOW_INDEX', 1);

// Only include the header if we're not using Ajax
if(!isset($_POST['ajax'])) require PUN_ROOT.'header.php';

if ($pun_user['g_read_chatbox'] != '1') message($lang_chatbox['No Read Permission']);

// Did someone just hit "Submit"?
if (isset($_POST['form_sent']))
{

	// Make sure form_user is correct
	if (($pun_user['is_guest'] && $_POST['form_user'] != 'Guest') || (!$pun_user['is_guest'] && $_POST['form_user'] != $pun_user['username']))
		message($lang_common['Bad request']);

  // Do we have permission to post?
  if ($pun_user['g_post_chatbox'] != '1')
    message($lang_chatbox['No Post Permission']);

  // Start with a clean slate
  $errors = array();

	// Flood protection
	if (!$pun_user['is_guest'] && $pun_user['last_post_chatbox'] != '' && (time() - $pun_user['last_post_chatbox']) < $pun_user['g_post_flood_chatbox'])
		$errors[] = $lang_post['Flood start'].' '.$pun_user['g_post_flood_chatbox'].' '.$lang_post['flood end'];

  if ($pun_user['is_guest'])
  {
    $result = $db->query('SELECT id, poster_ip, posted FROM '.$db->prefix.'chatbox_msg WHERE poster_ip=\''.get_remote_address().'\' ORDER BY posted DESC LIMIT 1') or error('Unable to fetch messages for flood protection', __FILE__, __LINE__, $db->error());
    $cur_post = $db->fetch_assoc($result);

    if ((time() - $cur_post['posted']) < $pun_user['g_post_flood_chatbox'])
  		$errors[] = $lang_post['Flood start'].' '.$pun_user['g_post_flood_chatbox'].' '.$lang_post['flood end'];
  }

  // If the user is logged in we get the username and e-mail from $pun_user
	if (!$pun_user['is_guest'])
	{
		$username = $pun_user['username'];
		$email = $pun_user['email'];
	}

	// Otherwise it should be in $_POST
	else
	{
		$username = trim($_POST['req_username']);
		$email = strtolower(trim(($pun_config['p_force_guest_email'] == '1') ? $_POST['req_email'] : $_POST['email']));

		// Load the register.php/profile.php language files
		require PUN_ROOT.'lang/'.$pun_user['language'].'/prof_reg.php';
		require PUN_ROOT.'lang/'.$pun_user['language'].'/register.php';

		// It's a guest, so we have to validate the username
		if (strlen($username) < 2)
			$errors[] = $lang_prof_reg['Username too short'];
		else if (!strcasecmp($username, 'Guest') || !strcasecmp($username, $lang_common['Guest']))
			$errors[] = $lang_prof_reg['Username guest'];
		else if (preg_match('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/', $username))
			$errors[] = $lang_prof_reg['Username IP'];

		if ((strpos($username, '[') !== false || strpos($username, ']') !== false) && strpos($username, '\'') !== false && strpos($username, '"') !== false)
			$errors[] = $lang_prof_reg['Username reserved chars'];
		if (preg_match('#\[b\]|\[/b\]|\[u\]|\[/u\]|\[i\]|\[/i\]|\[color|\[/color\]|\[quote\]|\[quote=|\[/quote\]|\[code\]|\[/code\]|\[img\]|\[/img\]|\[url|\[/url\]|\[email|\[/email\]#i', $username))
			$errors[] = $lang_prof_reg['Username BBCode'];

		// Check username for any censored words
		$temp = censor_words($username);
		if ($temp != $username)
			$errors[] = $lang_register['Username censor'];

		// Check that the username (or a too similar username) is not already registered
		$result = $db->query('SELECT username FROM '.$db->prefix.'users WHERE username=\''.$db->escape($username).'\' OR username=\''.$db->escape(preg_replace('/[^\w]/', '', $username)).'\'') or error('Unable to fetch user info', __FILE__, __LINE__, $db->error());
		if ($db->num_rows($result))
		{
			$busy = $db->result($result);
			$errors[] = $lang_register['Username dupe 1'].' '.pun_htmlspecialchars($busy).'. '.$lang_register['Username dupe 2'];
		}

		if ($pun_config['p_force_guest_email'] == '1' || $email != '')
		{
			require PUN_ROOT.'include/email.php';
			if (!is_valid_email($email))
				$errors[] = $lang_common['Invalid e-mail'];
		}
	}

	// Clean up message from POST
	$message = pun_linebreaks(pun_trim($_POST['req_message']));

	if ($message == '')
		$errors[] = $lang_chatbox['Error No message'];
	else if (strlen($message) > $pun_config['cb_msg_maxlength'])
		$errors[] = $lang_chatbox['Error Too long message'];
	else if ($pun_config['p_message_all_caps'] == '0' && strtoupper($message) == $message && $pun_user['g_id'] > PUN_MOD)
		$message = ucwords(strtolower($message));

	// Validate BBCode syntax
	if ($pun_config['p_message_bbcode'] == '1' && strpos($message, '[') !== false && strpos($message, ']') !== false)
	{
		$message = preparse_bbcode($message, $errors);
	}

	// AJAX: If errors were encountered, we'll displayed them & exit.
	if(!empty($errors) && isset($_POST['ajax'])) {
			echo '<div id="posterror"><h3><strong>'.$lang_post['Post errors'].'</strong></h3><p>'.$lang_post['Post errors info'].'</p><ul>';
				while (list(, $cur_error) = each($errors)) {
					echo "\t\t\t\t".'<li><strong>'.$cur_error.'</strong></li>'."\n";
				}
			exit('</ul></div>');
	}

	// Did everything go according to plan?
	if (empty($errors))
	{
    $now = time();

		if (!$pun_user['is_guest'])
		{
			// Insert message
			$db->query('INSERT INTO '.$db->prefix.'chatbox_msg (poster, poster_id, poster_ip, message, posted) VALUES(\''.$db->escape($username).'\', '.$pun_user['id'].', \''.get_remote_address().'\', \''.$db->escape($message).'\', '.$now.')') or error('Unable to post message', __FILE__, __LINE__, $db->error());

  		// Increment his/her chatbox post count
  			$low_prio = ($db_type == 'mysql') ? 'LOW_PRIORITY ' : '';
  			$db->query('UPDATE '.$low_prio.$db->prefix.'users SET num_posts_chatbox=num_posts_chatbox+1, last_post_chatbox='.$now.' WHERE id='.$pun_user['id']) or error('Unable to update user', __FILE__, __LINE__, $db->error());

		}
		else
		{
			// Insert message
			$email_sql = ($pun_config['p_force_guest_email'] == '1' || $email != '') ? '\''.$email.'\'' : 'NULL';
			$db->query('INSERT INTO '.$db->prefix.'chatbox_msg (poster, poster_id, poster_ip, poster_email, message, posted) VALUES(\''.$db->escape($username).'\', '.$pun_user['id'].', \''.get_remote_address().'\', '.$email_sql.', \''.$db->escape($message).'\', '.$now.')') or error('Unable to post message', __FILE__, __LINE__, $db->error());
		}

    $count = $db->query('SELECT COUNT(id) FROM '.$db->prefix.'chatbox_msg') or error('Unable to fetch chatbox post count', __FILE__, __LINE__, $db->error());
    $num_post = $db->result($count);

    $limit = ($num_post-$pun_config['cb_max_msg'] <= 0) ? 0 : $num_post-$pun_config['cb_max_msg'];


    $result = $db->query('SELECT id,posted FROM '.$db->prefix.'chatbox_msg ORDER BY posted ASC LIMIT '.$limit) or error('Unable to select post to delete', __FILE__, __LINE__, $db->error());
    while ($del_msg = $db->fetch_assoc($result))
    {
      $db->query('DELETE FROM '.$db->prefix.'chatbox_msg WHERE id = '.$del_msg['id'].' LIMIT 1') or error('Unable to delete post', __FILE__, __LINE__, $db->error());
    }

      $_POST['req_message'] = NULL;
  }

}


/////////////////////////////////////////////////
// Function to display messages in the chatbox //
/////////////////////////////////////////////////

function list_chatbox_msg($ajax = false)
{
	global $db, $lang_chatbox, $pun_config, $pun_user, $lang_common;


if($ajax) @header("Content-type: text/html; charset=utf-8"); // Needed, as we won't be sending out the PunBB header as usual

// Print the messages
$cur_msg_txt = '';
$count_id = array();

$result = $db->query('SELECT u.id, u.group_id, u.num_posts_chatbox, m.id AS m_id, m.poster_id, m.poster, m.poster_ip, m.poster_email, m.message, m.posted, g.g_id, g.g_title_chatbox FROM '.$db->prefix.'chatbox_msg AS m INNER JOIN '.$db->prefix.'users AS u ON u.id=m.poster_id INNER JOIN '.$db->prefix.'groups AS g ON g.g_id=u.group_id ORDER BY m.posted DESC LIMIT '.$pun_config['cb_max_msg']) or error('Unable to fetch messages', __FILE__, __LINE__, $db->error());
while ($cur_msg = $db->fetch_assoc($result))
  {
    $cur_msg_txt .= $cur_msg['g_title_chatbox'].$pun_config['cb_disposition'];

		if ($cur_msg['g_id'] != PUN_GUEST)
      $cur_msg_txt = str_replace('<pun_username>', '<a href="profile.php?id='.$cur_msg['id'].'">'.pun_htmlspecialchars($cur_msg['poster']).'</a>', $cur_msg_txt);
    else
      $cur_msg_txt = str_replace('<pun_username>', pun_htmlspecialchars($cur_msg['poster']), $cur_msg_txt);

    $cur_msg_txt = str_replace('<pun_date>', format_time($cur_msg['posted']), $cur_msg_txt);

		if ($cur_msg['g_id'] != PUN_GUEST)
      $cur_msg_txt = str_replace('<pun_nbpost>', $cur_msg['num_posts_chatbox'], $cur_msg_txt);
    else
    {

      if (!isset($count_id[$cur_msg['poster']]))
      {
        $like_command = ($db_type == 'pgsql') ? 'ILIKE' : 'LIKE';

        $count = $db->query('SELECT COUNT(id) FROM '.$db->prefix.'chatbox_msg WHERE poster '.$like_command.' \''.$db->escape(str_replace('*', '%', $cur_msg['poster'])).'\'') or error('Unable to fetch user chatbox post count', __FILE__, __LINE__, $db->error());
        $num_post = $db->result($count);
        $count_id[$cur_msg['poster']] = $num_post;
      }
      else
        $num_post = $count_id[$cur_msg['poster']];

      $cur_msg_txt = str_replace('<pun_nbpost>', $num_post, $cur_msg_txt);
    }

    $cur_msg_txt = str_replace('<pun_nbpost_txt>', $lang_chatbox['Posts'], $cur_msg_txt);

		if ($pun_user['g_id'] < PUN_GUEST)
	  {
      $cur_msg_admin = ' [ <a href="chatbox.php?get_host='.$cur_msg['m_id'].'" onclick="getHost('.$cur_msg['m_id'].'); return false;">'.$cur_msg['poster_ip'].'</a>';
      if ($cur_msg['poster_email'])
  			$cur_msg_admin .= ' | <a href="mailto:'.$cur_msg['poster_email'].'">'.$lang_common['E-mail'].'</a> ] [&#160;<a id="del'.$cur_msg['m_id'].'" href="'.PUN_ROOT.'chatbox.php?del='.$cur_msg['m_id'].'" onclick="deleteMsg('.$cur_msg['m_id'].'); return false;">delete</a>&#160;]';
  		else
  		  $cur_msg_admin .= ' ] [ <a id="del'.$cur_msg['m_id'].'" href="'.PUN_ROOT.'chatbox.php?del='.$cur_msg['m_id'].'&amp;usr='.intval($cur_msg['id']).'" onclick="deleteMsg('.$cur_msg['m_id'].','.$cur_msg['id'].'); return false;">delete</a> ]';
		}
    else
      $cur_msg_admin = '';

      $cur_msg_txt = str_replace('<pun_admin>', $cur_msg_admin, $cur_msg_txt);
      $cur_msg_txt = str_replace('<pun_message>', parse_message($cur_msg['message'], 0), $cur_msg_txt);
      $cur_msg_txt .= "\n\n";

  }
if (!$cur_msg_txt)
  echo $lang_chatbox['No Message'];
else
  echo $cur_msg_txt;

if($ajax) exit; // Exit if we're using Ajax
}

// Display messages used for the Ajax version. The script will end here if the $_POST variable ajax is set
if(isset($_POST['ajax'])) list_chatbox_msg(true);

// If there are errors, we display them. This function will only run if you're not using Ajax
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

?>
<div id="chatbox" class="block">
  <h2>
    <span><?php echo $lang_chatbox['Chatbox'] ?></span>
  </h2>
	<div class="box">
		<div class="inbox">
		<div id="scrollbox" style="overflow:auto;height:<?php echo $pun_config['cb_height'] ?>px;">
<?php list_chatbox_msg(false) ?>
    </div>
<script type="text/javascript" src="include/js/ajax_chat.js"></script>
<?php
if ($pun_user['g_post_chatbox'] == '1')
  {
    $cur_index = 1;
  ?>
      <form id="chatboxcontrols" method="post" action="chatbox.php" onsubmit="sendRequestPost(form_sent.value, form_user.value, req_message.value); return false;">
      	<p>
         <input type="hidden" id="form_sent" name="form_sent" value="1" />
         <input type="hidden" id="form_user" name="form_user" value="<?php echo (!$pun_user['is_guest']) ? pun_htmlspecialchars($pun_user['username']) : 'Guest'; ?>" />
<?php

if ($pun_user['is_guest'])
{
	$email_label = ($pun_config['p_force_guest_email'] == '1') ? '<strong>'.$lang_common['E-mail'].':</strong>' : $lang_common['E-mail'];
	$email_form_name = ($pun_config['p_force_guest_email'] == '1') ? 'req_email' : 'email';

?>
          <strong><?php echo $lang_post['Guest name'] ?>:</strong> <input type="text" id="req_username" name="req_username" value="<?php if (isset($_POST['req_username'])) echo pun_htmlspecialchars($username); ?>" size="20" maxlength="25" tabindex="<?php echo $cur_index++ ?>" />
          <?php echo $email_label ?> <input id="req_email" type="text" name="<?php echo $email_form_name ?>" value="<?php if (isset($_POST[$email_form_name])) echo pun_htmlspecialchars($email); ?>" size="20" maxlength="50" tabindex="<?php echo $cur_index++ ?>" />
<?php

}

?>
         <label for="req_message"><?php echo $lang_chatbox['Message'] ?>:</label><input id="req_message" name="req_message" value="<?php if (isset($_POST['req_message'])) echo pun_htmlspecialchars($message); ?>" size="55" maxlength="<?php echo $pun_config['cb_msg_maxlength'] ?>"  tabindex="<?php echo $cur_index++ ?>" />
         <input id="sendbtn" type="submit" name="submit" value="<?php echo $lang_chatbox['Btn Send'] ?>" accesskey="s" tabindex="<?php echo $cur_index++ ?>" />
         <script type="text/javascript">
         	<!--
         	// This button is utterly useless, unless we have javascript enabled. As such, we won't display it until then.
         document.write('<input id="refreshbtn" type="button" value="<?php echo $lang_chatbox['Btn Refresh'] ?>" onclick="refreshBox(); return false;"  tabindex="<?php echo $cur_index++ ?>" /> ');
         // -->
         </script>
        </p>
      </form>
  <?php
  }
else
  echo $lang_chatbox['No Post Permission'];
?>

		</div>
	</div>
</div>
<?php

require PUN_ROOT.'footer.php';