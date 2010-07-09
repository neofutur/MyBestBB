##
##
##        Mod title:  Forum Subscriber
##
##      Mod version:  1.0.1
##   Works on PunBB:  1.2, 1.2.1 to 1.2.11
##     Release date:  2006-04-25
##           Author:  Fabien Appert (appertfabien-web@yahoo.fr)
##
##      Description:  This mod allow users to subscribe to a forum
##
##   Affected files:  post.php
##                    misc.php
##                    viewtopic.php
##                    viewforum.php
##                    lang/XXX/misc.php
##                    lang/XXX/topic.php
##                    lang/XXX/forum.php
##
##       Affects DB:  Yes
##
##            Notes:  This mod allow users to subscribe to a forum, exactly 
##                    as they can subscribe to a topic. If they subscribe, 
##                    they will be notify by email of all post reply or new
##                    post in this forum (the message of the post could be 
##                    included depending on the same user profil option as 
##                    original topic subscription).
##                    Subscription to a topic is disabled when the user has
##                    already subscribe to the topic's forum.
##
##       DISCLAIMER:  Please note that "mods" are not officially supported by
##                    PunBB. Installation of this modification is done at your
##                    own risk. Backup your forum database and any and all
##                    applicable files before proceeding.
##
##


#
#---------[ 1. UPLOAD ]-------------------------------------------------------
#

install_mod.php to /
lang/French/mail_templates/new_topic.tpl
lang/French/mail_templates/new_topic_full.tpl
lang/English/mail_templates/new_topic.tpl
lang/English/mail_templates/new_topic_full.tpl

#
#---------[ 2. RUN ]----------------------------------------------------------
#

install_mod.php

#
#---------[ 3. DELETE ]-------------------------------------------------------
#

install_mod.php

#
#---------[ 4. OPEN ]---------------------------------------------------------
#

misc.php


#
#---------[ 5. FIND ]---------------------------------------------
#

else if (isset($_GET['subscribe']))
{


#
#---------[ 6. BEFORE, ADD ]---------------------------------------------------
#

// BEGIN - MOD: FORUM SUBSCRIBER
else if (isset($_GET['subscribe_forum']))
{
	if ($pun_user['is_guest'] || $pun_config['o_subscriptions'] != '1')
		message($lang_common['No permission']);

	$forum_id = intval($_GET['subscribe_forum']);
	if ($forum_id < 1)
		message($lang_common['Bad request']);

	$result = $db->query('SELECT 1 FROM '.$db->prefix.'subscriptions WHERE user_id='.$pun_user['id'].' AND forum_id='.$forum_id) or error('Impossible de retrouver les informations d\'abonnement', __FILE__, __LINE__, $db->error());
	if ($db->num_rows($result))
		message($lang_misc['Already subscribed forum']);

	$db->query('INSERT INTO '.$db->prefix.'subscriptions (user_id, topic_id, forum_id) VALUES('.$pun_user['id'].' ,0 ,'.$forum_id.')') or error('UImpossible d\'ajouter l\'abonnement', __FILE__, __LINE__, $db->error());

	redirect('viewforum.php?id='.$forum_id, $lang_misc['Subscribe redirect forum']);
}

else if (isset($_GET['unsubscribe_forum']))
{
	if ($pun_user['is_guest'] || $pun_config['o_subscriptions'] != '1')
		message($lang_common['No permission']);

	$forum_id = intval($_GET['unsubscribe_forum']);
	if ($forum_id < 1)
		message($lang_common['Bad request']);

	$result = $db->query('SELECT 1 FROM '.$db->prefix.'subscriptions WHERE user_id='.$pun_user['id'].' AND forum_id='.$forum_id) or error('Impossible de retrouver les informations d\'abonnement', __FILE__, __LINE__, $db->error());
	if (!$db->num_rows($result))
		message($lang_misc['Not subscribed forum']);

	$db->query('DELETE FROM '.$db->prefix.'subscriptions WHERE user_id='.$pun_user['id'].' AND forum_id='.$forum_id) or error('Impossible de supprimer l\'abonnement', __FILE__, __LINE__, $db->error());

	redirect('viewforum.php?id='.$forum_id, $lang_misc['Unsubscribe redirect forum']);
}
// END - MOD: FORUM SUBSCRIBER

#
#---------[ 7. OPEN ]---------------------------------------------------------
#

post.php

#
#---------[ 8. FIND (line: 218) ]--------------------------------------------
#

				$result = $db->query('SELECT u.id, u.email, u.notify_with_post, u.language FROM '.$db->prefix.'users AS u INNER JOIN '.$db->prefix.'subscriptions AS s ON u.id=s.user_id LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id='.$cur_posting['id'].' AND fp.group_id=u.group_id) LEFT JOIN '.$db->prefix.'online AS o ON u.id=o.user_id LEFT JOIN '.$db->prefix.'bans AS b ON u.username=b.username WHERE b.username IS NULL AND COALESCE(o.logged, u.last_visit)>'.$previous_post_time.' AND (fp.read_forum IS NULL OR fp.read_forum=1) AND s.topic_id='.$tid.' AND u.id!='.intval($pun_user['id'])) or error('Impossible de retrouver les informations d\'abonnement', __FILE__, __LINE__, $db->error());

#
#---------[ 9. REPLACE WITH ]-------------------------------------------------
#
				// MOD: FORUM SUBSCRIBER - line modified
				$result = $db->query('SELECT u.id, u.email, u.notify_with_post, u.language, s.forum_id AS is_forum_subscribed FROM '.$db->prefix.'users AS u INNER JOIN '.$db->prefix.'subscriptions AS s ON u.id=s.user_id LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id='.$cur_posting['id'].' AND fp.group_id=u.group_id) LEFT JOIN '.$db->prefix.'online AS o ON u.id=o.user_id LEFT JOIN '.$db->prefix.'bans AS b ON u.username=b.username WHERE b.username IS NULL AND COALESCE(o.logged, u.last_visit)>'.$previous_post_time.' AND (fp.read_forum IS NULL OR fp.read_forum=1) AND (s.topic_id='.$tid.' OR s.forum_id='.$cur_posting['id'].') AND u.id!='.intval($pun_user['id'])) or error('Impossible de retrouver les informations d\'abonnement', __FILE__, __LINE__, $db->error());
				
#
#---------[ 10. FIND (line: 252) ]--------------------------------------------
#
				
								$mail_message = str_replace('<unsubscribe_url>', $pun_config['o_base_url'].'/misc.php?unsubscribe='.$tid, $mail_message);

#
#---------[ 11. REPLACE WITH ]-------------------------------------------------
#
								// MOD: FORUM SUBSCRIBER - line modified
								$mail_message = str_replace('<unsubscribe_url>', $pun_config['o_base_url'].'/misc.php?unsubscribe'.($cur_subscriber['is_forum_subscribed']?"_forum":"").'='.($cur_subscriber['is_forum_subscribed']?$cur_posting['id']:$tid), $mail_message);	
								
#
#---------[ 12. FIND (line: 260) ]--------------------------------------------
#
								
								$mail_message_full = str_replace('<unsubscribe_url>', $pun_config['o_base_url'].'/misc.php?unsubscribe='.$tid, $mail_message_full);
								
#
#---------[ 13. REPLACE WITH ]-------------------------------------------------
#
								// MOD: FORUM SUBSCRIBER - line modified
								$mail_message_full = str_replace('<unsubscribe_url>', $pun_config['o_base_url'].'/misc.php?unsubscribe'.($cur_subscriber['is_forum_subscribed']?"_forum":"").'='.($cur_subscriber['is_forum_subscribed']?$cur_posting['id']:$tid), $mail_message_full);
								
#
#---------[ 14. FIND (line: 260) ]--------------------------------------------
#
		
update_forum($fid);						
								
#
#---------[ 15. AFTER, ADD ]-------------------------------------------------
#	
	
			// BEGIN - MOD: FORUM SUBSCRIBER
			// Should we send out notifications?
			if ($pun_config['o_subscriptions'] == '1')
			{
				$old_tid = $tid;
				$tid = $new_tid;

				// Get any subscribed users that should be notified (banned users are excluded)
				$result = $db->query('SELECT u.id, u.email, u.notify_with_post, u.language, s.forum_id AS is_forum_subscribed FROM '.$db->prefix.'users AS u INNER JOIN '.$db->prefix.'subscriptions AS s ON u.id=s.user_id LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id='.$fid.' AND fp.group_id=u.group_id) LEFT JOIN '.$db->prefix.'online AS o ON u.id=o.user_id LEFT JOIN '.$db->prefix.'bans AS b ON u.username=b.username WHERE b.username IS NULL AND COALESCE( (fp.read_forum IS NULL OR fp.read_forum=1) AND s.forum_id='.$fid.') AND u.id!='.intval($pun_user['id'])) or error('Impossible de retrouver les informations d\'abonnement', __FILE__, __LINE__, $db->error());
				if ($db->num_rows($result))
				{
					require_once PUN_ROOT.'include/email.php';

					$notification_emails = array();

					// Loop through subscribed users and send e-mails
					while ($cur_subscriber = $db->fetch_assoc($result))
					{
						// Is the subscription e-mail for $cur_subscriber['language'] cached or not?
						if (!isset($notification_emails[$cur_subscriber['language']]))
						{
							if (file_exists(PUN_ROOT.'lang/'.$cur_subscriber['language'].'/mail_templates/new_reply.tpl'))
							{
								// Load the "new reply" template
								$mail_tpl = trim(file_get_contents(PUN_ROOT.'lang/'.$cur_subscriber['language'].'/mail_templates/new_topic.tpl'));

								// Load the "new reply full" template (with post included)
								$mail_tpl_full = trim(file_get_contents(PUN_ROOT.'lang/'.$cur_subscriber['language'].'/mail_templates/new_topic_full.tpl'));

								// The first row contains the subject (it also starts with "Subject:")
								$first_crlf = strpos($mail_tpl, "\n");
								$mail_subject = trim(substr($mail_tpl, 8, $first_crlf-8));
								$mail_message = trim(substr($mail_tpl, $first_crlf));

								$first_crlf = strpos($mail_tpl_full, "\n");
								$mail_subject_full = trim(substr($mail_tpl_full, 8, $first_crlf-8));
								$mail_message_full = trim(substr($mail_tpl_full, $first_crlf));

								$mail_subject = str_replace('<topic_subject>', '\''.$subject.'\'', $mail_subject);
								$mail_message = str_replace('<replier>', $username, $mail_message);
								$mail_message = str_replace('<post_url>', $pun_config['o_base_url'].'/viewtopic.php?pid='.$new_pid.'#p'.$new_pid, $mail_message);
								$mail_message = str_replace('<unsubscribe_url>', $pun_config['o_base_url'].'/misc.php?unsubscribe'.($cur_subscriber['is_forum_subscribed']?"_forum":"").'='.($cur_subscriber['is_forum_subscribed']?$cur_posting['id']:$tid), $mail_message);
								$mail_message = str_replace('<board_mailer>', $pun_config['o_board_title'].' '.$lang_common['Mailer'], $mail_message);

								$mail_subject_full = str_replace('<topic_subject>', '\''.$subject.'\'', $mail_subject_full);
								$mail_message_full = str_replace('<replier>', $username, $mail_message_full);
								$mail_message_full = str_replace('<message>', $message, $mail_message_full);
								$mail_message_full = str_replace('<post_url>', $pun_config['o_base_url'].'/viewtopic.php?pid='.$new_pid.'#p'.$new_pid, $mail_message_full);
								$mail_message_full = str_replace('<unsubscribe_url>', $pun_config['o_base_url'].'/misc.php?unsubscribe'.($cur_subscriber['is_forum_subscribed']?"_forum":"").'='.($cur_subscriber['is_forum_subscribed']?$cur_posting['id']:$tid), $mail_message_full);
								$mail_message_full = str_replace('<board_mailer>', $pun_config['o_board_title'].' '.$lang_common['Mailer'], $mail_message_full);

								$notification_emails[$cur_subscriber['language']][0] = $mail_subject;
								$notification_emails[$cur_subscriber['language']][1] = $mail_message;
								$notification_emails[$cur_subscriber['language']][2] = $mail_subject_full;
								$notification_emails[$cur_subscriber['language']][3] = $mail_message_full;

								$mail_subject = $mail_message = $mail_subject_full = $mail_message_full = null;
							}
						}

						// We have to double check here because the templates could be missing
						if (isset($notification_emails[$cur_subscriber['language']]))
						{
							if ($cur_subscriber['notify_with_post'] == '0')
								pun_mail($cur_subscriber['email'], $notification_emails[$cur_subscriber['language']][0], $notification_emails[$cur_subscriber['language']][1]);
							else
								pun_mail($cur_subscriber['email'], $notification_emails[$cur_subscriber['language']][2], $notification_emails[$cur_subscriber['language']][3]);
						}
					}
				}
				$tid = $old_tid;
			}
			// END - MOD: FORUM SUBSCRIBER

	

							

#
#---------[ 16. OPEN ]---------------------------------------------------------
#

viewforum.php

								
#
#---------[ 17. FIND (line: 42) ]--------------------------------------------
#
								
$result = $db->query('SELECT f.forum_name, f.redirect_url, f.moderators, f.num_topics, f.sort_by, fp.post_topics FROM '.$db->prefix.'forums AS f LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id='.$pun_user['g_id'].') WHERE (fp.read_forum IS NULL OR fp.read_forum=1) AND f.id='.$id) or error('Impossible de retrouver les informations du forum', __FILE__, __LINE__, $db->error());
								
#
#---------[ 18. REPLACE WITH ]-------------------------------------------------
#

// MOD: FORUM SUBSCRIBER - line modified
$result = $db->query('SELECT f.forum_name, f.redirect_url, f.moderators, f.num_topics, f.sort_by, fp.post_topics, s.user_id AS is_subscribed  FROM '.$db->prefix.'forums AS f LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id='.$pun_user['g_id'].') LEFT JOIN '.$db->prefix.'subscriptions AS s ON (f.id=s.forum_id AND s.user_id='.$pun_user['id'].') WHERE (fp.read_forum IS NULL OR fp.read_forum=1) AND f.id='.$id) or error('Impossible de retrouver les informations du forum', __FILE__, __LINE__, $db->error());

#
#---------[ 19. FIND (line: 75) ]--------------------------------------------
#

// Generate paging links
$paging_links = $lang_common['Pages'].': '.paginate($num_pages, $p, 'viewforum.php?id='.$id);

#
#---------[ 20. AFTER, ADD ]-------------------------------------------------
#

// BEGIN - MOD: FORUM SUBSCRIBER
if (!$pun_user['is_guest'] && $pun_config['o_subscriptions'] == '1')
{
	if ($cur_forum['is_subscribed'])
		$subscribe_forum = '<p class="subscribelink clearb">'.$lang_forum['Is subscribed'].' - <a href="misc.php?unsubscribe_forum='.$id.'">'.$lang_forum['Unsubscribe'].'</a></p>'."\n";
	else
		$subscribe_forum = '<p class="subscribelink clearb"><a href="misc.php?subscribe_forum='.$id.'">'.$lang_forum['Subscribe'].'</a></p>'."\n";
}
else
	$subscribe_forum = '<div class="clearer"></div>'."\n";
// END - MOD: FORUM SUBSCRIBER

#
#---------[ 21. FIND (line: 247) ]--------------------------------------------
# TIPS => search "linksb" to add the link at the bottom of the forum or "linkst" to add it at the top

<div class="linksb">
	<div class="inbox">
		<p class="pagelink conl"><?php echo $paging_links ?></p>
<?php echo $post_link ?>
		<ul><li><a href="index.php"><?php echo $lang_common['Index'] ?></a>&#160;</li><li>&raquo;&#160;<?php echo pun_htmlspecialchars($cur_forum['forum_name']) ?></li></ul>
		<div class="clearer"></div>
		
#
#---------[ 22. REPLACE WITH ]-------------------------------------------------
#

<div class="linksb">
	<div class="inbox">
		<p class="pagelink conl"><?php echo $paging_links ?></p>
<?php echo $post_link ?>
		<ul><li><a href="index.php"><?php echo $lang_common['Index'] ?></a>&#160;</li><li>&raquo;&#160;<?php echo pun_htmlspecialchars($cur_forum['forum_name']) ?></li></ul>
		<?php echo $subscribe_forum ?>


#
#---------[ 23. OPEN ]---------------------------------------------------------
#

viewtopic.php

#
#---------[ 24. FIND (line: 96) ]--------------------------------------------
#

// Fetch some info about the topic
if (!$pun_user['is_guest'])
	$result = $db->query('SELECT t.subject, t.closed, t.num_replies, t.sticky, f.id AS forum_id, f.forum_name, f.moderators, fp.post_replies, s.user_id AS is_subscribed FROM '.$db->prefix.'topics AS t INNER JOIN '.$db->prefix.'forums AS f ON f.id=t.forum_id LEFT JOIN '.$db->prefix.'subscriptions AS s ON (t.id=s.topic_id AND s.user_id='.$pun_user['id'].') LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id='.$pun_user['g_id'].') WHERE (fp.read_forum IS NULL OR fp.read_forum=1) AND t.id='.$id.' AND t.moved_to IS NULL') or error('Impossible de retrouver les informations de la discussion', __FILE__, __LINE__, $db->error());

#
#---------[ 25. REPLACE WITH ]-------------------------------------------------
# !!! TAKE CARE !!! If you have the mod "MARK AS READ" you will have to uncomment a line et comment an other one

// Fetch some info about the topic
if (!$pun_user['is_guest'])
	// MOD: FORUM SUBSCRIBER - line modified
	$result = $db->query('SELECT t.subject, t.closed, t.num_replies, t.sticky, f.id AS forum_id, f.forum_name, f.moderators, fp.post_replies, s.topic_id AS is_subscribed, s.forum_id AS is_subscribed_forum FROM '.$db->prefix.'topics AS t INNER JOIN '.$db->prefix.'forums AS f ON f.id=t.forum_id LEFT JOIN '.$db->prefix.'subscriptions AS s ON ( (t.id=s.topic_id OR t.forum_id=s.forum_id) AND s.user_id='.$pun_user['id'].') LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id='.$pun_user['g_id'].') WHERE (fp.read_forum IS NULL OR fp.read_forum=1) AND t.id='.$id.' AND t.moved_to IS NULL') or error('Impossible de retrouver les informations de la discussion', __FILE__, __LINE__, $db->error());
	// If you use MARK TOPIC AS READ MOD uncomment the line after this message and comment the one above
	// $result = $db->query('SELECT t.subject, t.closed, t.num_replies, t.sticky, t.last_post, f.id AS forum_id, f.forum_name, f.moderators, fp.post_replies, s.topic_id AS is_subscribed, s.forum_id AS is_subscribed_forum FROM '.$db->prefix.'topics AS t INNER JOIN '.$db->prefix.'forums AS f ON f.id=t.forum_id LEFT JOIN '.$db->prefix.'subscriptions AS s ON ( (t.id=s.topic_id OR t.forum_id=s.forum_id) AND s.user_id='.$pun_user['id'].') LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id='.$pun_user['g_id'].') WHERE (fp.read_forum IS NULL OR fp.read_forum=1) AND t.id='.$id.' AND t.moved_to IS NULL') or error('Impossible de retrouver les informations de la discussion', __FILE__, __LINE__, $db->error());

#
#---------[ 26. FIND (line: 154) ]--------------------------------------------
#

	if ($cur_topic['is_subscribed'])
	
#
#---------[ 27. REPLACE WITH ]-------------------------------------------------
#
	// MOD: FORUM SUBSCRIBER - 2 new line 1 line modified
	if ($cur_topic['is_subscribed_forum'])
		$subscraction = '<p class="subscribelink clearb">'.$lang_topic['Is subscribed forum'].'</p>'."\n";
	elseif ($cur_topic['is_subscribed'])


#
#---------[ 28. OPEN ]---------------------------------------------------------
#

lang/French/forum.php

#
#---------[ 29. FIND ]--------------------------------------------
#

'Empty forum'	=>	'Le forum est vide.'

#
#---------[ 30. REPLACE WITH ]-------------------------------------------------
#

'Empty forum'	=>	'Le forum est vide.',

// BEGIN - MOD: FORUM SUBSCRIBER
'Is subscribed'		=>	'Vous êtes abonné à ce forum',
'Unsubscribe'		=>	'Désabonner',
'Subscribe'			=>	'S\'abonner à ce forum'
// END - MOD: FORUM SUBSCRIBER

#
#---------[ 31. OPEN ]---------------------------------------------------------
#

lang/French/misc.php

#
#---------[ 32. FIND ]--------------------------------------------
#

'Unsubscribe redirect'		=>	'Votre abonnement a été annulé. Redirection ...',

#
#---------[ 33. AFTER, ADD ]-------------------------------------------------
#

// BEGIN - MOD: FORUM SUBSCRIBER
'Already subscribed forum'		=>	'Vous êtes déjà abonné à ce forum.',
'Subscribe redirect forum'		=>	'Votre abonnement au forum a été pris en compte. Redirection ...',
'Not subscribed forum'			=>	'Vous n\'êtes pas abonné à ce forum.',
'Unsubscribe redirect forum'		=>	'Votre abonnement au forum a été annulé. Redirection ...',
// END - MOD: FORUM SUBSCRIBER
 
#
#---------[ 34. OPEN ]---------------------------------------------------------
#

lang/French/topic.php

#
#---------[ 35. FIND ]--------------------------------------------
#

'Is subscribed'		=>	'Vous êtes abonné à cette discussion',

#
#---------[ 36. AFTER, ADD ]-------------------------------------------------
#

// MOD: FORUM SUBSCRIBER - 1 line added
'Is subscribed forum'	=>	'Vous êtes abonné à ce forum',


#
#---------[ 37. OPEN ]---------------------------------------------------------
#

lang/English/forum.php

#
#---------[ 38. FIND ]--------------------------------------------
#

'Empty forum'	=>	'Forum is empty.'

#
#---------[ 39. REPLACE WITH ]-------------------------------------------------
#


'Empty forum'	=>	'Forum is empty.',

// BEGIN - MOD: FORUM SUBSCRIBER
'Is subscribed'		=>	'You are currently subscribed to this forum',
'Unsubscribe'		=>	'Unsubscribe',
'Subscribe'			=>	'Subscribe to this forum'
// END - MOD: FORUM SUBSCRIBER

#
#---------[ 40. OPEN ]---------------------------------------------------------
#

lang/English/misc.php

#
#---------[ 41. FIND ]--------------------------------------------
#

'Unsubscribe redirect'		=>	'Your subscription has been removed. Redirection ...',

#
#---------[ 42. AFTER, ADD ]-------------------------------------------------
#

// BEGIN - MOD: FORUM SUBSCRIBER
'Already subscribed forum'		=>	'You are already subscribed to this forum.',
'Subscribe redirect forum'		=>	'Your subscription to this forum has been added. Redirection ...',
'Not subscribed forum'			=>	'You are not subscribed to this forum.',
'Unsubscribe redirect forum'		=>	'Your subscription to this forum has been removed. Redirection ...',
// END - MOD: FORUM SUBSCRIBER

#
#---------[ 43. OPEN ]---------------------------------------------------------
#

lang/English/topic.php

#
#---------[ 44. FIND ]--------------------------------------------
#

'Is subscribed'		=>	'You are currently subscribed to this topic',

#
#---------[ 45. AFTER, ADD ]-------------------------------------------------
#

// MOD: FORUM SUBSCRIBER - 1 line added
'Is subscribed forum'		=>	'You are currently subscribed to this forum',



#
#---------[ 46. SAVE/UPLOAD ]-------------------------------------------------
#