<?php
/***********************************************************************

  Caleb Champlin (med_mediator@hotmail.com)

  This file is is a modification of a file from of PunBB.

************************************************************************/

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
require PUN_ROOT . 'include/common.php';

if ($pun_user['g_read_board'] == '0')
    message($lang_common['No view']);

$tid = isset($_GET['tid']) ? intval($_GET['tid']) : 0;
$ptype = isset($_POST['ptype']) ? intval($_POST['ptype']) : 0;
$fid = isset($_GET['fid']) ? intval($_GET['fid']) : 0;
if ($tid < 1 && $fid < 1)
	message($lang_common['Bad request']);

// Fetch some info about the topic and/or the forum
if ($tid)
	$result = $db->query('SELECT f.id, f.forum_name, f.moderators, f.redirect_url, fp.post_replies, fp.post_topics, t.subject, t.closed, t.question FROM '.$db->prefix.'topics AS t INNER JOIN '.$db->prefix.'forums AS f ON f.id=t.forum_id LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id='.$pun_user['g_id'].') WHERE (fp.read_forum IS NULL OR fp.read_forum=1) AND t.id='.$tid) or error('Unable to fetch forum info', __FILE__, __LINE__, $db->error());
else
	$result = $db->query('SELECT f.id, f.forum_name, f.moderators, f.redirect_url, fp.post_replies, fp.post_topics FROM ' . $db->prefix . 'forums AS f LEFT JOIN ' . $db->prefix . 'forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id=' . $pun_user['g_id'] . ') WHERE (fp.read_forum IS NULL OR fp.read_forum=1) AND f.id=' . $fid) or error('Unable to fetch forum info', __FILE__, __LINE__, $db->error());

if (!$db->num_rows($result))
    message($lang_common['Bad request']);

$cur_posting = $db->fetch_assoc($result);

if ($cur_posting['redirect_url'] != '')
    message($lang_common['Bad request']);
// Get Mods/Admin etc etc
$mods_array = ($cur_posting['moderators'] != '') ? unserialize($cur_posting['moderators']) : array();
$is_admmod = ($pun_user['g_id'] == PUN_ADMIN || ($pun_user['g_id'] == PUN_MOD && array_key_exists($pun_user['username'], $mods_array))) ? true : false;
// Verify Permissions
// Do we have permission to post?
if ((($tid && (($cur_posting['post_replies'] == '' && $pun_user['g_post_replies'] == '0') || $cur_posting['post_replies'] == '0')) ||
	($fid && (($cur_posting['post_topics'] == '' && $pun_user['g_post_topics'] == '0') || $cur_posting['post_topics'] == '0')) ||
	(isset($cur_posting['closed']) && $cur_posting['closed'] == '1')) &&
	!$is_admmod)
    message($lang_common['No permission']);
// Load the language files
require PUN_ROOT . 'lang/' . $pun_user['language'] . '/post.php';
require PUN_ROOT . 'lang/' . $pun_user['language'] . '/polls.php';
// Create empty errors array
$errors = array();

if (isset($_POST['form_sent'])) {
    // Make sure form_user is correct
    if (($pun_user['is_guest'] && $_POST['form_user'] != 'Guest') || (!$pun_user['is_guest'] && $_POST['form_user'] != $pun_user['username']))
        message($lang_common['Bad request']);

    
        // Flood protection
        if (!$pun_user['is_guest'] && !isset($_POST['preview']) && $pun_user['last_post'] != '' && (time() - $pun_user['last_post']) < $pun_user['g_post_flood'])
            $errors[] = $lang_post['Flood start'] . ' ' . $pun_user['g_post_flood'] . ' ' . $lang_post['flood end']; 
        // It's a new topic
	// If it's a new topic
	if ($fid)
	{
	if (!empty($_POST['create_poll'])) {
        $subject = pun_trim($_POST['req_subject']);

        if ($subject == '')
            $errors[] = $lang_post['No subject'];
        else if (pun_strlen($subject) > 70)
            $errors[] = $lang_post['Too long subject'];
        else if ($pun_config['p_subject_all_caps'] == '0' && strtoupper($subject) == $subject && ($pun_user['g_id'] > PUN_MOD && !$pun_user['g_global_moderation']))
            $subject = ucwords(strtolower($subject)); 
        // Get the question
        $question = pun_trim($_POST['req_question']);
        if ($question == '')
            $errors[] = $lang_polls['No question'];
        else if (pun_strlen($question) > 70)
            $errors[] = $lang_polls['Too long question'];
        else if ($pun_config['p_subject_all_caps'] == '0' && strtoupper($question) == $question && ($pun_user['g_id'] > PUN_MOD && !$pun_user['g_global_moderation']))
            $question = ucwords(strtolower($question)); 
        // If its a multislect yes/no poll then we need to make sure they have the right values
        if ($ptype == 3) {
            $yesval = pun_trim($_POST['poll_yes']);

            if ($yesval == '')
                $errors[] = $lang_polls['No yes'];
            else if (pun_strlen($yesval) > 35)
                $errors[] = $lang_polls['Too long yes'];
            else if ($pun_config['p_subject_all_caps'] == '0' && strtoupper($yesval) == $yesval && ($pun_user['g_id'] > PUN_MOD && !$pun_user['g_global_moderation']))
                $yesval = ucwords(strtolower($yesval));

            $noval = pun_trim($_POST['poll_no']);

            if ($noval == '')
                $errors[] = $lang_polls['No no'];
            else if (pun_strlen($noval) > 35)
                $errors[] = $lang_polls['Too long no'];
            else if ($pun_config['p_subject_all_caps'] == '0' && strtoupper($noval) == $noval && ($pun_user['g_id'] > PUN_MOD && !$pun_user['g_global_moderation']))
                $noval = ucwords(strtolower($noval));
        } 
        // This isn't exactly a good way todo it, but it works. I may rethink this code later
        $option = array();
        $lastoption = "null";
        while (list($key, $value) = each($_POST['poll_option'])) {
	    $value = pun_trim($value);
            if ($value != "") {
                if ($lastoption == '')
                    $errors[] = $lang_polls['Empty option'];
                else {
                    $option[$key] = pun_trim($value);
                    if (pun_strlen($option[$key]) > 55)
                        $errors[] = $lang_polls['Too long option'];
		    else if ($key > $pun_config['poll_max_fields'])
			message($lang_common['Bad request']);
                    else if ($pun_config['p_subject_all_caps'] == '0' && strtoupper($option[$key]) == $option[$key] && ($pun_user['g_id'] > PUN_MOD && !$pun_user['g_global_moderation']))
                        $option[$key] = ucwords(strtolower($option[$key]));
                } 
            } 
            $lastoption = pun_trim($value);
        } 

	  // People are naughty
	  if (empty($option))
		$errors[] = $lang_polls['No options'];

	  if (!array_key_exists(2,$option))
		$errors[] = $lang_polls['Low options'];
	 }
	}
        // If the user is logged in we get the username and e-mail from $pun_user
        if (!$pun_user['is_guest']) {
            $username = $pun_user['username'];
            $email = $pun_user['email'];
        } 
        // Otherwise it should be in $_POST
        else {
            $username = trim($_POST['req_username']);
            $email = strtolower(trim(($pun_config['p_force_guest_email'] == '1') ? $_POST['req_email'] : $_POST['email'])); 
            // Load the register.php/profile.php language files
            require PUN_ROOT . 'lang/' . $pun_user['language'] . '/prof_reg.php';
            require PUN_ROOT . 'lang/' . $pun_user['language'] . '/register.php'; 
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
            $result = $db->query('SELECT username FROM ' . $db->prefix . 'users WHERE username=\'' . $db->escape($username) . '\' OR username=\'' . $db->escape(preg_replace('/[^\w]/', '', $username)) . '\'') or error('Unable to fetch user info', __FILE__, __LINE__, $db->error());
            if ($db->num_rows($result)) {
                $busy = $db->result($result);
                $errors[] = $lang_register['Username dupe 1'] . ' ' . pun_htmlspecialchars($busy) . '. ' . $lang_register['Username dupe 2'];
            } 

            if ($pun_config['p_force_guest_email'] == '1' || $email != '') {
                require PUN_ROOT . 'include/email.php';
                if (!is_valid_email($email))
                    $errors[] = $lang_common['Invalid e-mail'];
            } 
        } 
        // Clean up message from POST
        $message = pun_linebreaks(pun_trim($_POST['req_message'])); 
        if ($message == '')
        	$errors[] = $lang_post['No message'];
        else if (strlen($message) > 65535)
            $errors[] = $lang_post['Too long message'];
        else if ($pun_config['p_message_all_caps'] == '0' && strtoupper($message) == $message && ($pun_user['g_id'] > PUN_MOD && !$pun_user['g_global_moderation']))
            $message = ucwords(strtolower($message)); 
        // Validate BBCode syntax
        if ($pun_config['p_message_bbcode'] == '1' && strpos($message, '[') !== false && strpos($message, ']') !== false) {
            require PUN_ROOT . 'include/parser.php';
            $message = preparse_bbcode($message, $errors);
        } 

        require PUN_ROOT . 'include/search_idx.php';

        $hide_smilies = isset($_POST['hide_smilies']) ? 1 : 0;
        $subscribe = isset($_POST['subscribe']) ? 1 : 0;

        $now = time(); 
        // Did everything go according to plan?
        if (empty($errors) && !isset($_POST['preview'])) {
	// If it's a reply
		if ($tid)
		{
			if (!$pun_user['is_guest'])
			{
				// Insert the new post
				$db->query('INSERT INTO '.$db->prefix.'posts (poster, poster_id, poster_ip, message, hide_smilies, posted, topic_id) VALUES(\''.$db->escape($username).'\', '.$pun_user['id'].', \''.get_remote_address().'\', \''.$db->escape($message).'\', \''.$hide_smilies.'\', '.$now.', '.$tid.')') or error('Unable to create post', __FILE__, __LINE__, $db->error());
				$new_pid = $db->insert_id();

			}
			else
			{
				// It's a guest. Insert the new post
				$email_sql = ($pun_config['p_force_guest_email'] == '1' || $email != '') ? '\''.$email.'\'' : 'NULL';
				$db->query('INSERT INTO '.$db->prefix.'posts (poster, poster_ip, poster_email, message, hide_smilies, posted, topic_id) VALUES(\''.$db->escape($username).'\', \''.get_remote_address().'\', '.$email_sql.', \''.$db->escape($message).'\', \''.$hide_smilies.'\', '.$now.', '.$tid.')') or error('Unable to create post', __FILE__, __LINE__, $db->error());
				$new_pid = $db->insert_id();
			}

			// Count number of replies in the topic
			$result = $db->query('SELECT COUNT(id) FROM '.$db->prefix.'posts WHERE topic_id='.$tid) or error('Unable to fetch post count for topic', __FILE__, __LINE__, $db->error());
			$num_replies = $db->result($result, 0) - 1;

			// Update topic
			$db->query('UPDATE '.$db->prefix.'topics SET num_replies='.$num_replies.', last_post='.$now.', last_post_id='.$new_pid.', last_poster=\''.$db->escape($username).'\' WHERE id='.$tid) or error('Unable to update topic', __FILE__, __LINE__, $db->error());

			update_search_index('post', $new_pid, $message);

			update_forum($cur_posting['id']);

			// Should we send out notifications?
			if ($pun_config['o_subscriptions'] == '1')
			{

			// Get the post time for the previous post in this topic
			$result = $db->query('SELECT posted FROM '.$db->prefix.'posts WHERE topic_id='.$tid.' ORDER BY id DESC LIMIT 1, 1') or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());
			$previous_post_time = $db->result($result);

			}
		}
		// If it's a new topic
		else if ($fid)
		{
            // Create the topic
            if ($ptype == 3) {
                $db->query('INSERT INTO ' . $db->prefix . 'topics (poster, subject, posted, last_post, last_poster, forum_id, question, yes, no) VALUES(\'' . $db->escape($username) . '\', \'' . $db->escape($subject) . '\', ' . $now . ', ' . $now . ', \'' . $db->escape($username) . '\', ' . $fid . ', \'' . $db->escape($question) . '\', \'' . $db->escape($yesval) . '\', \'' . $db->escape($noval) . '\')') or error('Unable to create topic', __FILE__, __LINE__, $db->error());
            } else {
                $db->query('INSERT INTO ' . $db->prefix . 'topics (poster, subject, posted, last_post, last_poster, forum_id, question) VALUES(\'' . $db->escape($username) . '\', \'' . $db->escape($subject) . '\', ' . $now . ', ' . $now . ', \'' . $db->escape($username) . '\', ' . $fid . ', \'' . $db->escape($question) . '\')') or error('Unable to create topic', __FILE__, __LINE__, $db->error());
            } 
            $new_tid = $db->insert_id();
            $db->query('INSERT INTO ' . $db->prefix . 'polls (pollid, options, ptype) VALUES(' . $new_tid . ', \'' . $db->escape(serialize($option)) . '\', ' . $ptype . ')') or error('Unable to create poll', __FILE__, __LINE__, $db->error());

	    if (!$pun_user['is_guest']) {
				// Create the post ("topic post")
				$db->query('INSERT INTO ' . $db->prefix . 'posts (poster, poster_id, poster_ip, message, hide_smilies, posted, topic_id) VALUES(\'' . $db->escape($username) . '\', ' . $pun_user['id'] . ', \'' . get_remote_address() . '\', \'' . $db->escape($message) . '\', \'' . $hide_smilies . '\', ' . $now . ', ' . $new_tid . ')') or error('Unable to create post', __FILE__, __LINE__, $db->error());
			} else {
				// Create the post ("topic post")
				$email_sql = ($pun_config['p_force_guest_email'] == '1' || $email != '') ? '\'' . $email . '\'' : 'NULL';
				$db->query('INSERT INTO ' . $db->prefix . 'posts (poster, poster_ip, poster_email, message, hide_smilies, posted, topic_id) VALUES(\'' . $db->escape($username) . '\', \'' . get_remote_address() . '\', ' . $email_sql . ', \'' . $db->escape($message) . '\', \'' . $hide_smilies . '\', ' . $now . ', ' . $new_tid . ')') or error('Unable to create post', __FILE__, __LINE__, $db->error());
			} 

			$new_pid = $db->insert_id(); 
			// Update the topic with last_post_id
			$db->query('UPDATE ' . $db->prefix . 'topics SET last_post_id=' . $new_pid . ' WHERE id=' . $new_tid) or error('Unable to update topic', __FILE__, __LINE__, $db->error());

			update_search_index('post', $new_pid, $message, $subject);

			update_forum($fid); 
			// If the posting user is logged in, increment his/her post count
		} 
		if (!$pun_user['is_guest']) {
			$low_prio = ($db_type == 'mysql') ? 'LOW_PRIORITY ' : '';
			$db->query('UPDATE ' . $low_prio . $db->prefix . 'users SET num_posts=num_posts+1, last_post=' . $now . ' WHERE id=' . $pun_user['id']) or error('Unable to update user', __FILE__, __LINE__, $db->error());
		} 
		redirect('viewpoll.php?pid=' . $new_pid . '#p' . $new_pid, $lang_post['Post redirect']);
	} 
} 
// If a topic id was specified in the url (it's a reply).
if ($tid)
{
	$action = $lang_post['Post a reply'];
	$form = '<form id="post" method="post" action="poll.php?action=post&amp;tid='.$tid.'" onsubmit="this.submit.disabled=true;if(process_form(this)){return true;}else{this.submit.disabled=false;return false;}">';

	// If a quote-id was specified in the url.
	if (isset($_GET['qid']))
	{
		$qid = intval($_GET['qid']);
		if ($qid < 1)
			message($lang_common['Bad request']);

		$result = $db->query('SELECT poster, message FROM '.$db->prefix.'posts WHERE id='.$qid) or error('Unable to fetch quote info', __FILE__, __LINE__, $db->error());
		if (!$db->num_rows($result))
			message($lang_common['Bad request']);

		list($q_poster, $q_message) = $db->fetch_row($result);

		$q_message = str_replace('[img]', '[url]', $q_message);
		$q_message = str_replace('[/img]', '[/url]', $q_message);
		$q_message = pun_htmlspecialchars($q_message);

		if ($pun_config['p_message_bbcode'] == '1')
		{
			// If username contains a square bracket, we add "" or '' around it (so we know when it starts and ends)
			if (strpos($q_poster, '[') !== false || strpos($q_poster, ']') !== false)
			{
				if (strpos($q_poster, '\'') !== false)
					$q_poster = '"'.$q_poster.'"';
				else
					$q_poster = '\''.$q_poster.'\'';
			}
			else
			{
				// Get the characters at the start and end of $q_poster
				$ends = substr($q_poster, 0, 1).substr($q_poster, -1, 1);

				// Deal with quoting "Username" or 'Username' (becomes '"Username"' or "'Username'")
				if ($ends == '\'\'')
					$q_poster = '"'.$q_poster.'"';
				else if ($ends == '""')
					$q_poster = '\''.$q_poster.'\'';
			}

			$quote = '[quote='.$q_poster.']'.$q_message.'[/quote]'."\n";
		}
		else
			$quote = '> '.$q_poster.' '.$lang_common['wrote'].':'."\n\n".'> '.$q_message."\n";
	}

	$forum_name = '<a href="viewforum.php?id='.$cur_posting['id'].'">'.pun_htmlspecialchars($cur_posting['forum_name']).'</a>';
}
// If a forum_id was specified in the url (new topic).
else if ($fid)
{
    $form = '<form id="post" method="post" action="poll.php?action=post&amp;fid=' . $fid . '" onsubmit="return process_form(this)">';
    $action = $lang_polls['Create new poll'];
    $forum_name = pun_htmlspecialchars($cur_posting['forum_name']);
} else
    message($lang_common['Bad request']);

$page_title = pun_htmlspecialchars($pun_config['o_board_title']) . ' / ' . $action;
$cur_index = 1; 
if ($fid)
{
if ($ptype == 0) {
    $form = '<form id="post" method="post" action="poll.php?&amp;fid=' . $fid . '">';

    require PUN_ROOT . 'header.php';

    ?>
<div class="blockform">
	<h2><span><?php echo $action ?></span></h2>
	<div class="box">
		<?php echo $form . "\n" ?>
		<div class="inform">
				<fieldset>
					<legend><?php echo $lang_polls['Poll select'] ?></legend>
					<div class="infldset">
					<center><select tabindex="<?php echo $cur_index++ ?>" name="ptype">
					<option value="1"><?php echo $lang_polls['Regular'] ?>
					<option value="2"><?php echo $lang_polls['Multiselect'] ?>
					<option value="3"><?php echo $lang_polls['Yesno'] ?>
					</select></center>
					</div>
				</fieldset>
			</div>
			<p><center><input type="submit" name="submit" value="<?php echo $lang_common['Submit'] ?>" tabindex="<?php echo $cur_index++ ?>" accesskey="s" />&nbsp;<a href="javascript:history.go(-1)"><?php echo $lang_common['Go back'] ?></a></center></p>
		</form>
	</div>
</div>

<?php
} elseif ($ptype == 1 || $ptype == 2 || $ptype == 3) {
    
    $required_fields = array('req_email' => $lang_common['E-mail'], 'req_question' => $lang_polls['Question'], 'req_subject' => $lang_common['Subject'], 'req_message' => $lang_common['Message']);
    $focus_element = array('post');

    if (!$pun_user['is_guest'])
        $focus_element[] = 'req_question';
    else {
        $required_fields['req_username'] = $lang_post['Guest name'];
        $focus_element[] = 'req_question';
    } 

    require PUN_ROOT . 'header.php';

    ?>
<div class="linkst">
	<div class="inbox">
		<ul><li><a href="index.php">
		<?php echo $lang_common['Index'] ?>
		</a></li><li>&nbsp;&raquo;&nbsp;
		<?php echo $forum_name ?>
		</li></ul>
	</div>
</div>

<?php 
    // If there are errors, we display them
    if (!empty($errors)) {

        ?>
<div id="posterror" class="block">
	<h2><span><?php echo $lang_post['Post errors'] ?></span></h2>
	<div class="box">
		<div class="inbox">
			<p><?php echo $lang_post['Post errors info'] ?></p>
			<ul>
<?php

        while (list(, $cur_error) = each($errors))
        echo "\t\t\t\t" . '<li><strong>' . $cur_error . '</strong></li>' . "\n";

        ?>
			</ul>
		</div>
	</div>
</div>

<?php

    } else if (isset($_POST['preview'])) {
        require_once PUN_ROOT . 'include/parser.php';
        $message = parse_message(trim($_POST['req_message']), $hide_smilies);

        ?>
		<div id="postpreview" class="blockpost">
	<h2><span><?php echo $lang_polls['Poll preview'] ?></span></h2>
	<div class="box">
		<div class="inbox">
			<div class="postright">
				<div class="postmsg">
				<?php
        if ($ptype == 1) {

            ?><strong>
					<?php echo pun_htmlspecialchars($question);

            ?>
				</strong>	<br /><br />
					<form action="" method="POST">
					<?php
            while (list($key, $value) = each($option)) {
                if (!empty($value)) {

                    ?>
					<input type="radio"> <?php echo pun_htmlspecialchars($value);

                    ?> <br />
					<?php
                } 
            } 

            ?>
			</form>
			<?php
        } elseif ($ptype == 2) {

            ?><strong>
					<?php echo pun_htmlspecialchars($question);

            ?>
					</strong><br /><br />
					<form action="" method="POST">
					<?php
            while (list($key, $value) = each($option)) {
                if (!empty($value)) {

                    ?>
					<input type="checkbox"> <?php echo pun_htmlspecialchars($value);

                    ?> <br />
					<?php
                } 
            } 

            ?>
			</form>
			<?php
        } elseif ($ptype == 3) {

            ?><strong>
					<?php echo pun_htmlspecialchars($question);

            ?></strong>
					<br /><br />
					<form action="" method="POST">
					<?php
            while (list($key, $value) = each($option)) {
                if (!empty($value)) {

                    ?>
<strong>
					<?php echo pun_htmlspecialchars($value);

                    ?></strong><br /><input type="radio"> <?php echo pun_htmlspecialchars($yesval);

                    ?><input type="radio"> <?php echo pun_htmlspecialchars($noval);

                    ?><br />
					<?php
                } 
            } 

            ?>
			</form>
			<?php
        } 

        ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="postpreview" class="blockpost">
	<h2><span><?php echo $lang_post['Post preview'] ?></span></h2>
	<div class="box">
		<div class="inbox">
			<div class="postright">
				<div class="postmsg">
					<?php echo $message . "\n" ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

    } 

    // Regular Poll Type
    if ($ptype == 1) {

        ?>
	<div class="blockform">
	<h2><span><?php echo $action ?></span></h2>
	<div class="box">
		<?php echo $form . "\n" ?>
			<div class="inform">
				<fieldset>
				<legend><?php echo $lang_polls['New poll legend'] ?></legend>
				<div class="infldset">
				<input type="hidden" name="ptype" value="1" />
					<label><strong><?php echo $lang_polls['Question'] ?></strong><br /><input type="text" name="req_question" value="<?php if (isset($_POST['req_question'])) echo pun_htmlspecialchars($question);

        ?>" size="80" maxlength="70" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
						<?php
        for ($x = 1; $x <= $pun_config['poll_max_fields'] ;$x++) {

            ?>
						<label><strong><?php echo $lang_polls['Option'] ?></strong><br /> <input type="text" name="poll_option[<?php echo $x;

            ?>]" value="<?php if (isset($_POST['poll_option'][$x])) echo pun_htmlspecialchars($option[$x]);

            ?>" size="60" maxlength="55" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
						<?php
        } 

        ?> </div> </fieldset> </div> <?php 
        // Multiselect poll type
    } elseif ($ptype == 2) {

        ?>
	
	
		<div class="blockform">
	<h2><span><?php echo $action ?></span></h2>
	<div class="box">
		<?php echo $form . "\n" ?>
			<div class="inform">
				<fieldset>
				<legend><?php echo $lang_polls['New poll legend multiselect'] ?></legend>
				<div class="infldset">
				<input type="hidden" name="ptype" value="2" />
					<label><strong><?php echo $lang_polls['Question'] ?></strong><br /><input type="text" name="req_question" value="<?php if (isset($_POST['req_question'])) echo pun_htmlspecialchars($question);

        ?>" size="80" maxlength="70" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
						<?php
        for ($x = 1;
            $x <= $pun_config['poll_max_fields']; $x++) {

            ?>
						<label><strong><?php echo $lang_polls['Option'] ?></strong><br /> <input type="text" name="poll_option[<?php echo $x;

            ?>]" value="<?php if (isset($_POST['poll_option'][$x])) echo pun_htmlspecialchars($option[$x]);

            ?>" size="60" maxlength="55" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
						<?php
        } 

        ?> </div> </fieldset> </div> <?php 
        // Multiselect Yes/No poll type
    } elseif ($ptype == 3) {

        ?>
		
		
		<div class="blockform">
	<h2><span><?php echo $action ?></span></h2>
	<div class="box">
		<?php echo $form . "\n" ?>
			<div class="inform">
				<fieldset>
				<legend><?php echo $lang_polls['New poll legend yesno'] ?></legend>
				<div class="infldset">
				<input type="hidden" name="ptype" value="3" />
					<label><strong><?php echo $lang_polls['Question'] ?></strong><br /><input type="text" name="req_question" value="<?php if (isset($_POST['req_question'])) echo pun_htmlspecialchars($question);

        ?>" size="80" maxlength="70" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
						<label><strong><?php echo $lang_polls['Yes'] ?></strong><br /> <input type="text" name="poll_yes" value="<?php if (isset($_POST['poll_yes'])) echo pun_htmlspecialchars($yesval);

        ?>" size="40" maxlength="35" tabindex="<?php echo $cur_index++ ?>" /></label>
						<label><strong><?php echo $lang_polls['No'] ?></strong><br /> <input type="text" name="poll_no" value="<?php if (isset($_POST['poll_no'])) echo pun_htmlspecialchars($noval);

        ?>" size="40" maxlength="35" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
						<?php
        for ($x = 1; $x <= $pun_config['poll_max_fields']; $x++) {

            ?>
						<label><strong><?php echo $lang_polls['Option'] ?></strong><br /> <input type="text" name="poll_option[<?php echo $x;

            ?>]" value="<?php if (isset($_POST['poll_option'][$x])) echo pun_htmlspecialchars($option[$x]);

            ?>" size="60" maxlength="55" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
						<?php
        } 

        ?> </div> </fieldset> </div> <?php
    } else
        message($lang_common['Bad request']);


	} else
    message($lang_common['Bad request']);
} else {
$page_title = pun_htmlspecialchars($pun_config['o_board_title']).' / '.$action;
$required_fields = array('req_email' => $lang_common['E-mail'], 'req_question' => $lang_polls['Question'], 'req_subject' => $lang_common['Subject'], 'req_message' => $lang_common['Message']);
$focus_element = array('post');

if (!$pun_user['is_guest'])
	$focus_element[] = ($fid) ? 'req_subject' : 'req_message';
else
{
	$required_fields['req_username'] = $lang_post['Guest name'];
	$focus_element[] = 'req_username';
}

require PUN_ROOT.'header.php';

?>
<div class="linkst">
	<div class="inbox">
		<ul><li><a href="index.php"><?php echo $lang_common['Index'] ?></a></li><li>&nbsp;&raquo;&nbsp;<?php echo $forum_name ?><?php if (isset($cur_posting['subject'])) echo '</li><li>&nbsp;&raquo;&nbsp;'.pun_htmlspecialchars($cur_posting['subject']) ?></li></ul>
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
	$message = parse_message($message, $hide_smilies);

?>
<div id="postpreview" class="blockpost">
	<h2><span><?php echo $lang_post['Post preview'] ?></span></h2>
	<div class="box">
		<div class="inbox">
			<div class="postright">
				<div class="postmsg">
					<?php echo $message."\n" ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } 


}


?>

<?php


if (($tid) || ($ptype != 0)) {




    ?>
<?php if ($tid): 
$cur_index = 1; ?> <div class="blockform">
	<h2><span><?php echo $action ?></span></h2>
	<div class="box">
		<?php echo $form . "\n" ?> <?php endif; ?>
			<div class="inform">
				<fieldset>
					<legend><?php echo $lang_common['Write message legend'] ?></legend>
					<div class="infldset txtarea">
					<?php if ($fid): ?>	<input type="hidden" name="create_poll" value="1" /> <?php endif; ?>
					<input type="hidden" name="form_sent" value="1" />
						<input type="hidden" name="form_user" value="<?php echo (!$pun_user['is_guest']) ? pun_htmlspecialchars($pun_user['username']) : 'Guest';

    ?>" />
<?php

    if ($pun_user['is_guest']) {
        $email_label = ($pun_config['p_force_guest_email'] == '1') ? '<strong>' . $lang_common['E-mail'] . '</strong>' : $lang_common['E-mail'];
        $email_form_name = ($pun_config['p_force_guest_email'] == '1') ? 'req_email' : 'email';

        ?>						<label class="conl"><strong><?php echo $lang_post['Guest name'] ?></strong><br /><input type="text" name="req_username" value="<?php if (isset($_POST['req_username'])) echo pun_htmlspecialchars($username);

        ?>" size="25" maxlength="25" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
						<label class="conl"><?php echo $email_label ?><br /><input type="text" name="<?php echo $email_form_name ?>" value="<?php if (isset($_POST[$email_form_name])) echo pun_htmlspecialchars($email);

        ?>" size="50" maxlength="50" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
						<div class="clearer"></div>
<?php

    } 

   if ($fid): ?>
						<label><strong><?php echo $lang_common['Subject'] ?></strong><br /><input class="longinput" type="text" name="req_subject" value="<?php if (isset($_POST['req_subject'])) echo pun_htmlspecialchars($subject);

    ?>" size="80" maxlength="70" tabindex="<?php echo $cur_index++ ?>" /><br /></label>
<?php endif; ?>
					  <label><strong><?php echo $lang_common['Message'] ?></strong><br />
						<textarea name="req_message" rows="20" cols="95" tabindex="<?php echo $cur_index++ ?>"><?php echo isset($_POST['req_message']) ? pun_htmlspecialchars(trim($_POST['req_message'])) : (isset($quote) ? $quote : ''); ?></textarea><br /></label>
						<ul class="bblinks">
							<li><a href="help.php#bbcode" onclick="window.open(this.href); return false;"><?php echo $lang_common['BBCode'] ?></a>: <?php echo ($pun_config['p_message_bbcode'] == '1') ? $lang_common['on'] : $lang_common['off'];

    ?></li>
							<li><a href="help.php#img" onclick="window.open(this.href); return false;"><?php echo $lang_common['img tag'] ?></a>: <?php echo ($pun_config['p_message_img_tag'] == '1') ? $lang_common['on'] : $lang_common['off'];

    ?></li>
							<li><a href="help.php#smilies" onclick="window.open(this.href); return false;"><?php echo $lang_common['Smilies'] ?></a>: <?php echo ($pun_config['o_smilies'] == '1') ? $lang_common['on'] : $lang_common['off'];

    ?></li>
						</ul>
					</div>
				</fieldset>
<?php

    $checkboxes = array();
    if (!$pun_user['is_guest']) {
        if ($pun_config['o_smilies'] == '1')
            $checkboxes[] = '<label><input type="checkbox" name="hide_smilies" value="1" tabindex="' . ($cur_index++) . '"' . (isset($_POST['hide_smilies']) ? ' checked="checked"' : '') . ' />' . $lang_post['Hide smilies'];
        if ($pun_config['o_subscriptions'] == '1')
            $checkboxes[] = '<label><input type="checkbox" name="subscribe" value="1" tabindex="' . ($cur_index++) . '"' . (isset($_POST['subscribe']) ? ' checked="checked"' : '') . ' />' . $lang_post['Subscribe'];
    } else if ($pun_config['o_smilies'] == '1')
        $checkboxes[] = '<label><input type="checkbox" name="hide_smilies" value="1" tabindex="' . ($cur_index++) . '"' . (isset($_POST['hide_smilies']) ? ' checked="checked"' : '') . ' />' . $lang_post['Hide smilies'];
    if (!empty($checkboxes)) {

        ?>
			</div>
			<div class="inform">
				<fieldset>
					<legend><?php echo $lang_common['Options'] ?></legend>
					<div class="infldset">
						<div class="rbox">
							<?php echo implode('<br /></label>' . "\n\t\t\t\t", $checkboxes) . '<br /></label>' . "\n" ?>
						</div>
					</div>
				</fieldset>
<?php

    } 

    ?>
			</div>
			<p><input type="submit" name="submit" value="<?php echo $lang_common['Submit'] ?>" tabindex="<?php echo $cur_index++ ?>" accesskey="s" /><input type="submit" name="preview" value="<?php echo $lang_post['Preview'] ?>" tabindex="<?php echo $cur_index++ ?>" accesskey="p" /><a href="javascript:history.go(-1)"><?php echo $lang_common['Go back'] ?></a></p>
		</form>
	</div>
</div>

<?php
}
require PUN_ROOT . 'footer.php';
