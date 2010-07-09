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
require PUN_ROOT.'include/attach/attach_incl.php'; //Attachment Mod row, loads variables, functions and lang file
/* Mod InstantQuote */
require(PUN_ROOT ."quote.common.php");
/* // Mod InstantQuote */


if ($pun_user['g_read_board'] == '0')
	message($lang_common['No view']);


$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
if ($id < 1 && $pid < 1)
	message($lang_common['Bad request']);

// Load the viewtopic.php language file
require PUN_ROOT.'lang/'.$pun_user['language'].'/topic.php';
require PUN_ROOT.'lang/'.$pun_user['language'].'/topic_rating.php';
require PUN_ROOT.'lang/'.$pun_user['language'].'/reputation.php';


// If a post ID is specified we determine topic ID and page number so we can redirect to the correct message
if ($pid)
{
	$result = $db->query('SELECT topic_id FROM '.$db->prefix.'posts WHERE id='.$pid) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());
	if (!$db->num_rows($result))
		message($lang_common['Bad request']);

	$id = $db->result($result);

	// Determine on what page the post is located (depending on $pun_user['disp_posts'])
	$result = $db->query('SELECT id FROM '.$db->prefix.'posts WHERE topic_id='.$id.' ORDER BY posted') or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());
	$num_posts = $db->num_rows($result);

	for ($i = 0; $i < $num_posts; ++$i)
	{
		$cur_id = $db->result($result, $i);
		if ($cur_id == $pid)
			break;
	}
	++$i;	// we started at 0

	$_GET['p'] = ceil($i / $pun_user['disp_posts']);
}

// If action=new, we redirect to the first new post (if any)
else if ($action == 'new' && !$pun_user['is_guest'])
{
	$result = $db->query('SELECT MIN(id) FROM '.$db->prefix.'posts WHERE topic_id='.$id.' AND posted>'.$pun_user['last_visit']) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());
	$first_new_post_id = $db->result($result);

	if ($first_new_post_id)
		header('Location: viewtopic.php?pid='.$first_new_post_id.'#p'.$first_new_post_id);
	else	// If there is no new post, we go to the last post
		header('Location: viewtopic.php?id='.$id.'&action=last');

	exit;
}

// If action=last, we redirect to the last post
else if ($action == 'last')
{
	$result = $db->query('SELECT MAX(id) FROM '.$db->prefix.'posts WHERE topic_id='.$id) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());
	$last_post_id = $db->result($result);

	if ($last_post_id)
	{
		header('Location: viewtopic.php?pid='.$last_post_id.'#p'.$last_post_id);
		exit;
	}
}
// RateTopic update for 1.19
        // Increase rating of the topic
        else if ($action == 'incr_rating')
        {
                if(($pun_user['last_rating'] > time() - $pun_config['o_rating_timeout']) || $pun_user['is_guest'])
                        message(str_replace('%d', $pun_config['o_rating_timeout'], $lang_topic_rating['Unallowed rate']));

                $db->query("UPDATE ".$db->prefix."topics SET rating = rating + 1 WHERE id=".$id) or error('Unable to update thread rating', __FILE__, __LINE__, $db->error());
                $db->query("UPDATE ".$db->prefix."users SET last_rating = ".time()." WHERE id=".$pun_user['id']) or error('Unable to update user timeout', __FILE__, __LINE__, $db->error());

                redirect(PUN_ROOT.'viewtopic.php?id='.$id, $lang_topic_rating['Topic rating increased']);
        }
        // Decrease rating of the topic
        else if ($action == 'decr_rating')
        {
                if(($pun_user['last_rating'] > time() - $pun_config['o_rating_timeout']) || $pun_user['is_guest'])
                        message(str_replace('%d', $pun_config['o_rating_timeout'], $lang_topic_rating['Unallowed rate']));

                $db->query("UPDATE ".$db->prefix."topics SET rating = rating - 1 WHERE id=".$id) or error('Unable to update thread rating', __FILE__, __LINE__, $db->error());
                $db->query("UPDATE ".$db->prefix."users SET last_rating = ".time()." WHERE id=".$pun_user['id']) or error('Unable to update user timeout', __FILE__, __LINE__, $db->error());

                redirect(PUN_ROOT.'viewtopic.php?id='.$id, $lang_topic_rating['Topic rating decreased']);
        }

// Fetch some info about the topic
if (!$pun_user['is_guest'])

$result = $db->query('SELECT t.subject, t.closed, t.num_replies, t.sticky, t.rating, f.id AS forum_id, f.forum_name, f.moderators, fp.post_replies, s.user_id AS is_subscribed, pf.forum_name AS parent_forum, f.parent_forum_id FROM '.$db->prefix.'topics AS t INNER JOIN '.$db->prefix.'forums AS f ON f.id=t.forum_id LEFT JOIN '.$db->prefix.'subscriptions AS s ON (t.id=s.topic_id AND s.user_id='.$pun_user['id'].') LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id='.$pun_user['g_id'].')  LEFT JOIN '.$db->prefix.'forums AS pf ON f.parent_forum_id=pf.id WHERE (fp.read_forum IS NULL OR fp.read_forum=1) AND t.id='.$id.' AND t.moved_to IS NULL') or error('Unable to fetch topic info', __FILE__, __LINE__, $db->error());
else
$result = $db->query('SELECT t.subject, t.closed, t.num_replies, t.sticky, t.rating, f.id AS forum_id, f.forum_name, f.moderators, fp.post_replies, pf.forum_name AS parent_forum, f.parent_forum_id, 0 FROM '.$db->prefix.'topics AS t INNER JOIN '.$db->prefix.'forums AS f ON f.id=t.forum_id LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id='.$pun_user['g_id'].') LEFT JOIN '.$db->prefix.'forums AS pf ON f.parent_forum_id=pf.id WHERE (fp.read_forum IS NULL OR fp.read_forum=1) AND t.id='.$id.' AND t.moved_to IS NULL') or error('Unable to fetch topic info', __FILE__, __LINE__, $db->error());

if (!$db->num_rows($result))
	message($lang_common['Bad request']);

$cur_topic = $db->fetch_assoc($result);

// Sort out who the moderators are and if we are currently a moderator (or an admin)
$mods_array = ($cur_topic['moderators'] != '') ? unserialize($cur_topic['moderators']) : array();
$is_admmod = ($pun_user['g_id'] == PUN_ADMIN || ($pun_user['g_id'] == PUN_MOD && array_key_exists($pun_user['username'], $mods_array))) ? true : false;

// Can we or can we not post replies?
if ($cur_topic['closed'] == '0')
{
	if (($cur_topic['post_replies'] == '' && $pun_user['g_post_replies'] == '1') || $cur_topic['post_replies'] == '1' || $is_admmod)
		$post_link = '<a href="post.php?tid='.$id.'">'.$lang_topic['Post reply'].'</a>';
	else
		$post_link = '&nbsp;';
}
else
{
	$post_link = $lang_topic['Topic closed'];

	if ($is_admmod)
		$post_link .= ' / <a href="post.php?tid='.$id.'">'.$lang_topic['Post reply'].'</a>';
}


// Determine the post offset (based on $_GET['p'])
$num_pages = ceil(($cur_topic['num_replies'] + 1) / $pun_user['disp_posts']);
$p = (!isset($_GET['p']) || !is_numeric($_GET['p']) || $_GET['p'] <= 1 || $_GET['p'] > $num_pages) ? 1 : $_GET['p'];
//$p = (!isset($_GET['p']) || $_GET['p'] <= 1 || $_GET['p'] > $num_pages) ? 1 : $_GET['p']; // punbb 1.2.20 security update

$start_from = $pun_user['disp_posts'] * ($p - 1);

// Generate paging links
$paging_links = $lang_common['Pages'].': '.paginate($num_pages, $p, 'viewtopic.php?id='.$id);


if ($pun_config['o_censoring'] == '1')
	$cur_topic['subject'] = censor_words($cur_topic['subject']);


$quickpost = false;
if ($pun_config['o_quickpost'] == '1' &&
	!$pun_user['is_guest'] &&
	($cur_topic['post_replies'] == '1' || ($cur_topic['post_replies'] == '' && $pun_user['g_post_replies'] == '1')) &&
	($cur_topic['closed'] == '0' || $is_admmod))
{
	$required_fields = array('req_message' => $lang_common['Message']);
	$quickpost = true;
}

if (!$pun_user['is_guest'] && $pun_config['o_subscriptions'] == '1')
{
	if ($cur_topic['is_subscribed'])
		// I apologize for the variable naming here. It's a mix of subscription and action I guess :-)
		$subscraction = '<p class="subscribelink clearb">'.$lang_topic['Is subscribed'].' - <a href="misc.php?unsubscribe='.$id.'">'.$lang_topic['Unsubscribe'].'</a></p>'."\n";
	else
		$subscraction = '<p class="subscribelink clearb"><a href="misc.php?subscribe='.$id.'">'.$lang_topic['Subscribe'].'</a></p>'."\n";
}
else
	$subscraction = '<div class="clearer"></div>'."\n";

$page_title = pun_htmlspecialchars($pun_config['o_board_title'].' / '.$cur_topic['subject']);
define('PUN_ALLOW_INDEX', 1);
require PUN_ROOT.'header.php';

?>
<div class="linkst">
	<div class="inbox">
		<p class="pagelink conl"><?php echo $paging_links ?></p>
		<p class="postlink conr"><?php echo $post_link ?></p>


<?php
if($cur_topic['parent_forum'])
{  echo "\t\t".'<ul><li><a href="index.php">'.$lang_common['Index'].'</a>&#160;</li><li>&raquo;&#160;<a href="viewforum.php?id='.$cur_topic['parent_forum_id'].'">'.pun_htmlspecialchars($cur_topic['parent_forum']).'</a>&#160;</li><li>&raquo;&#160;<a href="viewforum.php?id='.$cur_topic['forum_id'].'">'.pun_htmlspecialchars($cur_topic['forum_name']).'</a>&#160;</li><li>&raquo;&#160;'.pun_htmlspecialchars($cur_topic['subject']).'</li></ul>';
}
else
{        echo "\t\t".'<ul><li><a href="index.php">'. $lang_common['Index'] ?></a></li><li>&nbsp;&raquo;&nbsp;<a href="<?php echo makeurl("f", $cur_topic['forum_id'], $cur_topic['forum_name']) ?>"><?php echo pun_htmlspecialchars($cur_topic['forum_name']) ?></a></li><li>&nbsp;&raquo;&nbsp;<?php echo pun_htmlspecialchars($cur_topic['subject']) ?></li></ul>
<?php } ?>


        <?php
// RateTopic  modif for 1.19

        // This was added for topic rating
        if(!$pun_user['is_guest'])
                echo '<span>'.$lang_topic_rating['Topic rating'].' <a href="'.PUN_ROOT.'viewtopic.php?action=incr_rating&amp;id='.$id.'" title="Increase thread rating"><img src="'.PUN_ROOT.'img/rate_topic/warn_add.gif" alt="+" /></a> <strong>'.intval($cur_topic['rating']).'</strong> <a href="'.PUN_ROOT.'viewtopic.php?action=decr_rating&amp;id='.$id.'" title="Decrease thread rating"><img src="'.PUN_ROOT.'img/rate_topic/warn_minus.gif" alt="-" /></a></span>'."\n";
        else
                echo '<span>'.$lang_topic_rating['Topic rating'].' <strong>'.intval($cur_topic['rating']).'</strong></span>'."\n";
        // End topic rating subsection
        ?>

		<div class="clearer"></div>
	</div>
</div>

<?php


require PUN_ROOT.'include/parser.php';

$bg_switch = true;	// Used for switching background color in posts
$post_count = 0;	// Keep track of post numbers

// Retrieve the posts (and their respective poster/online status)
// mod Easy Profile Fields ( true -> false and  u.id AS uid nothing more . . .

$query='SELECT u.id AS uid, u.email, u.title, u.url, u.location, u.use_avatar, u.signature, u.email_setting, u.use_pm, u.num_posts, u.registered, u.admin_note, u.imgaward, SUM(r.rep_plus) AS count_rep_plus, SUM(r.rep_minus) AS count_rep_minus, u.reputation_enable, p.id, p.poster AS username, p.poster_id, p.poster_ip, p.poster_email, p.message, p.hide_smilies, p.posted, p.edited, p.edited_by, g.g_id, g.g_user_title, o.user_id AS is_online FROM '.$db->prefix.'posts AS p INNER JOIN '.$db->prefix.'users AS u ON u.id=p.poster_id INNER JOIN '.$db->prefix.'groups AS g ON g.g_id=u.group_id LEFT JOIN '.$db->prefix.'online AS o ON (o.user_id=u.id AND o.user_id!=1 AND o.idle=0) LEFT JOIN '.$db->prefix.'reputation as r ON (r.user_id=u.id) WHERE p.topic_id='.$id.'  GROUP BY p.id ORDER BY p.id LIMIT '.$start_from.','.$pun_user['disp_posts'];
//echo $query; exit;
$result = $db->query($query, false) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());
//$result = $db->query('SELECT u.id AS uid, u.email, u.title, u.url, u.location, u.use_avatar, u.signature, u.email_setting, u.num_posts, u.registered, u.admin_note, u.imgaward SUM(r.rep_plus) AS count_rep_plus, SUM(r.rep_minus) AS count_rep_minus, u.reputation_enable, p.id, p.poster AS username, p.poster_id, p.poster_ip, p.poster_email, p.message, p.hide_smilies, p.posted, p.edited, p.edited_by, g.g_id, g.g_user_title, o.user_id AS is_online FROM '.$db->prefix.'posts AS p INNER JOIN '.$db->prefix.'users AS u ON u.id=p.poster_id INNER JOIN '.$db->prefix.'groups AS g ON g.g_id=u.group_id LEFT JOIN '.$db->prefix.'online AS o ON (o.user_id=u.id AND o.user_id!=1 AND o.idle=0) LEFT JOIN '.$db->prefix.'reputation as r ON (r.user_id=u.id) WHERE p.topic_id='.$id.'  GROUP BY p.id ORDER BY p.id LIMIT '.$start_from.','.$pun_user['disp_posts'], false) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());

while ($cur_post = $db->fetch_assoc($result))
{
	$post_count++;
	$user_avatar = '';
	$user_info = array();
	$user_contacts = array();
	$post_actions = array();
	$is_online = '';
	$signature = '';
        $user_image_award = '';

	// If the poster is a registered user.
	if ($cur_post['poster_id'] > 1)
	{
		//added for Image Awards
		                // Image Award Mod Block Start
                if(strlen($cur_post['imgaward']) > 0){  // if we have something there, figure out what to output...
                        //figure out the size of the award (Name of award should be in teh form:  Test_Award_100x20.png ... where png is format, 100x20 is dimensions and Test_Award is name of award (seen in admin interface)
                        $awardmod_filename=$cur_post['imgaward'];
                        $awardmod_temp=substr($awardmod_filename,strrpos($awardmod_filename,'_')+1); //we still have the file extentsion
                        $awardmod_temp=substr($awardmod_temp,0,strpos($awardmod_temp,'.'));
                        $awardmod_dimensions = explode('x',$awardmod_temp);     // there ... now the array will hold 100 and 20 in [0] and [1] respecively ... :)
                        $awardmod_name=str_replace('_',' ',substr($awardmod_filename,0,strrpos($awardmod_filename,'_')));
                        if($pun_config['o_avatars'] == '1' && $pun_user['show_avatars'] != '0')
                                $user_image_award = "\t\t\t\t\t".'<dd><img src="img/awards/'.$awardmod_filename.'" width="'.$awardmod_dimensions[0].'" height="'.$awardmod_dimensions[1].'" alt="Award: '.$awardmod_name.'" /></dd>';
                        else
                                $user_image_award = "\t\t\t\t\t".'<dd>Award: "'.$awardmod_name.'"</dd>';
                }
                // Image Award Mod Block End
	
		$username = '<a href="profile.php?id='.$cur_post['poster_id'].'">'.pun_htmlspecialchars($cur_post['username']).'</a>';
		$user_title = get_title($cur_post);

		if ($pun_config['o_censoring'] == '1')
			$user_title = censor_words($user_title);

		// Format the online indicator
		$is_online = ($cur_post['is_online'] == $cur_post['poster_id']) ? '<strong>'.$lang_topic['Online'].'</strong>' : $lang_topic['Offline'];

		if ($pun_config['o_avatars'] == '1' && $cur_post['use_avatar'] == '1' && $pun_user['show_avatars'] != '0')
		{
			if ($img_size = @getimagesize($pun_config['o_avatars_dir'].'/'.$cur_post['poster_id'].'.gif'))
				$user_avatar = '<img src="'.$pun_config['o_avatars_dir'].'/'.$cur_post['poster_id'].'.gif" '.$img_size[3].' alt="" />';
			else if ($img_size = @getimagesize($pun_config['o_avatars_dir'].'/'.$cur_post['poster_id'].'.jpg'))
				$user_avatar = '<img src="'.$pun_config['o_avatars_dir'].'/'.$cur_post['poster_id'].'.jpg" '.$img_size[3].' alt="" />';
			else if ($img_size = @getimagesize($pun_config['o_avatars_dir'].'/'.$cur_post['poster_id'].'.png'))
				$user_avatar = '<img src="'.$pun_config['o_avatars_dir'].'/'.$cur_post['poster_id'].'.png" '.$img_size[3].' alt="" />';
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

			$user_info[] = '<dd>'.$lang_common['Registered'].': '.date($pun_config['o_date_format'], $cur_post['registered']);

			if ($pun_config['o_show_post_count'] == '1' || $pun_user['g_id'] < PUN_GUEST)
				$user_info[] = '<dd>'.$lang_common['Posts'].': '.$cur_post['num_posts'];

			// Now let's deal with the contact links (E-mail and URL)
			if (($cur_post['email_setting'] == '0' && !$pun_user['is_guest']) || $pun_user['g_id'] < PUN_GUEST)
				$user_contacts[] = '<a href="mailto:'.$cur_post['email'].'">'.$lang_common['E-mail'].'</a>';
			else if ($cur_post['email_setting'] == '1' && !$pun_user['is_guest'])
				$user_contacts[] = '<a href="misc.php?email='.$cur_post['poster_id'].'">'.$lang_common['E-mail'].'</a>';
                        /* Start MOD PM */
                        if ($pun_config['o_pms_enabled'] == '1' && !$pun_user['is_guest'] && $pun_user['g_pm'] == 1 && $pun_user['use_pm'] == 1 && $cur_post['use_pm'] == 1)
                        {
                                $pid = isset($cur_post['poster_id']) ? $cur_post['poster_id'] : $cur_post['id'];
                                $user_contacts[] = '<a href="pms_send.php?uid='.$pid.'&tid='.$id.'">'.$lang_pms['PM'].'</a>';
                        }
                        /* End MOD PM */

			if ($cur_post['url'] != '')
				$user_contacts[] = '<a href="'.pun_htmlspecialchars($cur_post['url']).'">'.$lang_topic['Website'].'</a>';
		}

		if ($pun_user['g_id'] < PUN_GUEST)
		{
			$user_info[] = '<dd>IP: <a href="moderate.php?get_host='.$cur_post['id'].'">'.$cur_post['poster_ip'].'</a>';

			if ($cur_post['admin_note'] != '')
				$user_info[] = '<dd>'.$lang_topic['Note'].': <strong>'.pun_htmlspecialchars($cur_post['admin_note']).'</strong>';
		}
	}
	// If the poster is a guest (or a user that has been deleted)
	else
	{
		$username = pun_htmlspecialchars($cur_post['username']);
		$user_title = get_title($cur_post);

		if ($pun_user['g_id'] < PUN_GUEST)
			$user_info[] = '<dd>IP: <a href="moderate.php?get_host='.$cur_post['id'].'">'.$cur_post['poster_ip'].'</a>';

		if ($pun_config['o_show_user_info'] == '1' && $cur_post['poster_email'] != '' && !$pun_user['is_guest'])
			$user_contacts[] = '<a href="mailto:'.$cur_post['poster_email'].'">'.$lang_common['E-mail'].'</a>';
	}
 /* MOD InstantQuote  */
  if($quickpost) {
    $quote_link = '<a href="post.php?tid='.$id.'&amp;qid='.$cur_post['id'].'" onMouseOver="this.href=\'#req_message\'" onclick="xajax_quote('.$cur_post['id'].')">';
    }
  else  {
    $quote_link = '<a href="post.php?tid='.$id.'&amp;qid='.$cur_post['id'].'">';
    }
 /* // MOD InstantQuote  */

	// Generation post action array (quote, edit, delete etc.)
	if (!$is_admmod)
	{
		if (!$pun_user['is_guest'])
			$post_actions[] = '<li class="postreport"><a href="misc.php?report='.$cur_post['id'].'">'.$lang_topic['Report'].'</a>';

		if ($cur_topic['closed'] == '0')
		{
			if ($cur_post['poster_id'] == $pun_user['id'])
			{
				if ((($start_from + $post_count) == 1 && $pun_user['g_delete_topics'] == '1') || (($start_from + $post_count) > 1 && $pun_user['g_delete_posts'] == '1'))
					$post_actions[] = '<li class="postdelete"><a href="delete.php?id='.$cur_post['id'].'">'.$lang_topic['Delete'].'</a>';
				if ($pun_user['g_edit_posts'] == '1')
					$post_actions[] = '<li class="postedit"><a href="edit.php?id='.$cur_post['id'].'">'.$lang_topic['Edit'].'</a>';
			}

			if (($cur_topic['post_replies'] == '' && $pun_user['g_post_replies'] == '1') || $cur_topic['post_replies'] == '1')

			$post_actions[] = '<li class="postquote">'.$quote_link . $lang_topic['Quote'].'</a>';
//multi quote mod
//			$post_actions[] = '<li class="postquote"><a href="post.php?tid='.$id.'&amp;qid='.$cur_post['id'].'">'.$lang_topic['Quote'].'</a>';
		}
	}
	else
// multiquote mod and movepost mod
    $post_actions[] = '<li class="postreport"><a href="misc.php?report='.$cur_post['id'].'">'.$lang_topic['Report'].'</a>'.$lang_topic['Link separator'].'</li><li class="postdelete"><a href="delete.php?id='.$cur_post['id'].'">'.$lang_topic['Delete'].'</a>'.$lang_topic['Link separator'].'</li><li class="postquote"><a href="movepost.php?id='.$cur_post['id'].'">'.$lang_topic['Move'].'</a>'.$lang_topic['Link separator'].'</li><li class="postedit"><a href="edit.php?id='.$cur_post['id'].'">'.$lang_topic['Edit'].'</a>'.$lang_topic['Link separator'].'</li><li class="postquote">'.$quote_link . $lang_topic['Quote'].'</a>';
    //$post_actions[] = '<li class="postreport"><a href="misc.php?report='.$cur_post['id'].'">'.$lang_topic['Report'].'</a>'.$lang_topic['Link separator'].'</li><li class="postdelete"><a href="delete.php?id='.$cur_post['id'].'">'.$lang_topic['Delete'].'</a>'.$lang_topic['Link separator'].'</li><li class="postquote"><a href="movepost.php?id='.$cur_post['id'].'">'.$lang_topic['Move'].'</a>'.$lang_topic['Link separator'].'</li><li class="postedit"><a href="edit.php?id='.$cur_post['id'].'">'.$lang_topic['Edit'].'</a>'.$lang_topic['Link separator'].'</li><li class="postquote"><a href="post.php?tid='.$id.'&amp;qid='.$cur_post['id'].'">'.$lang_topic['Quote'].'</a>'; //Move Post Mod 1.1.1 row


	// Switch the background color for every message.
	$bg_switch = ($bg_switch) ? $bg_switch = false : $bg_switch = true;
	$vtbg = ($bg_switch) ? ' roweven' : ' rowodd';


	// Perform the main parsing of the message (BBCode, smilies, censor words etc)
	$cur_post['message'] = parse_message($cur_post['message'], $cur_post['hide_smilies']);

	// Do signature parsing/caching
	if ($cur_post['signature'] != '' && $pun_user['show_sig'] != '0' && !isset($signatures[$cur_post['poster_id']] ))
	{
		if (isset($signature_cache[$cur_post['poster_id']]))
			$signature = $signature_cache[$cur_post['poster_id']];
		else
		{
			$signature = '<br><br>--------------------------------------------------------<br />'.parse_signature($cur_post['signature']);
			$signatures[$cur_post['poster_id']] = true;
			$signature_cache[$cur_post['poster_id']] = $signature;
		}
	}

        // Attachment Mod Block Start
        $attach_allow_download = false;
        $attach_output = '';
        $attach_num = 0;
        // Check if this post has any attachments
        $result_attach = $db->query('SELECT af.id, af.filename, af.size, af.downloads FROM '.$db->prefix.'attach_2_files AS af WHERE af.post_id='.$cur_post['id']) or error('Unable to fetch if there were any attachments to the post', __FILE__, __LINE__, $db->error());
        $attach_num = $db->num_rows($result_attach);
        if($attach_num > 0){
                if($pun_user['g_id']==PUN_ADMIN)$attach_allow_download=true;
                else{           //fetch the rules of the forum, and check so that the user is allowed to download.
                        $result_attach_two = $db->query('SELECT ar.rules FROM '.$db->prefix.'attach_2_rules AS ar WHERE ar.group_id=\''.$pun_user['group_id'].'\' AND ar.forum_id='.$cur_topic['forum_id'].' LIMIT 1')or error('Unable to fetch rules for the attachments', __FILE__, __LINE__, $db->error());
                        if($db->num_rows($result_attach_two)==1){
                                list($attach_rules)=$db->fetch_row($result_attach_two);
                                $attach_allow_download = attach_rules($attach_rules,ATTACH_DOWNLOAD);
                        }
                }
                if($attach_allow_download){//check if the user is allowed to download it.
                        $attach_output .= $lang_attach['Attachments:'].' ';
                        while(list($attachment_id, $attachment_filename, $attachment_size, $attachment_downloads)=$db->fetch_row($result_attach)){
                                $attachment_extension=attach_get_extension($attachment_filename);
                                $attach_output .= '<br />'."\n\t\t\t\t\t\t".attach_icon($attachment_extension).' <a href="./attachment.php?item='.$attachment_id.'">'.$attachment_filename.'</a>, '.$lang_attach['Size:'].' '.number_format($attachment_size).' '.$lang_attach['bytes'].', '.$lang_attach['Downloads:'].' '.number_format($attachment_downloads);
                        }
                }
        }
        // Attachment Mod Block End



?>
<div id="p<?php echo $cur_post['id'] ?>" class="blockpost<?php echo $vtbg ?><?php if (($post_count + $start_from) == 1) echo ' firstpost'; ?>">
	<h3><span><span class="conr">#<?php echo ($start_from + $post_count) ?>&nbsp;</span><a href="<?php echo makeurl("p",$cur_post['id'], format_time($cur_post['posted'])).'#p'.$cur_post['id'] ?>"><?php echo format_time($cur_post['posted']) ?></a></span></h3>
	<div class="box">
		<div class="inbox">
			<div class="postleft">
				<dl>
					<dt><strong><?php echo $username ?></strong></dt>
					<dd class="usertitle"><strong><?php echo $user_title ?></strong></dd>
					<?php if ( $user_avatar ) { ?><dd class="postavatar"><?php echo $user_avatar ?></dd><?php } ?>
					<?php if (strlen($user_image_award)>0) echo $user_image_award;  ## Image Award Mod ?>
<?php if (count($user_info)) echo "\t\t\t\t\t".implode('</dd>'."\n\t\t\t\t\t", $user_info).'</dd>'."\n"; ?>

        <?php // !! This was added for Easy Profile Fields !!
        $sql = "SELECT p.name, p.lang_entry, e.value FROM ".$db->prefix."profile_fields AS p INNER JOIN ".$db->prefix."profile_field_entries AS e ON p.id=e.f_id WHERE e.u_id=".$cur_post['uid']." ORDER BY p.order ASC";

// echo $sql;

        $ef_result = $db->query( $sql);
// affichage des profile fields
        while($ef_row = $db->fetch_assoc($ef_result))
        {
                $ef_name = $ef_row['lang_entry'] ? ($lang_common[$ef_row['lang_entry']] ? $lang_common[$ef_row['lang_entry']] : $ef_row['name']) : $ef_row['name'];
        if ($pun_config['o_make_links'] == '1')
                $text = do_clickable($ef_row['value']);

//                echo '<dd><strong>'.$ef_name.':</strong> '.$ef_row['value'].' </dd>';
                echo '<dd><strong>'.$ef_name.':</strong> '.$text.' </dd>';

        }
        ?>

<?php require(PUN_ROOT.'include/reputation/rep_viewtopic.php'); ?>
<?php if (count($user_contacts)) echo "\t\t\t\t\t".'<dd class="usercontacts">'.implode('&nbsp;&nbsp;', $user_contacts).'</dd>'."\n"; ?>
				</dl>
			</div>
			<div class="postright">
				<h3><?php if (($post_count + $start_from) > 1) echo ' Re: '; ?><?php echo pun_htmlspecialchars($cur_topic['subject']) ?></h3>
				<div class="postmsg">
					<?php echo $cur_post['message']."\n" ?>

<?php if ($cur_post['edited'] != '') echo "\t\t\t\t\t".'<p class="postedit"><em>'.$lang_topic['Last edit'].' '.pun_htmlspecialchars($cur_post['edited_by']).' ('.format_time($cur_post['edited']).')</em></p>'."\n"; ?>
<?php if ($attach_allow_download) echo "\t\t\t\t\t".'<div class="postsignature"><hr />'.$attach_output.'</div>'."\n"; ## Attachment Mod row ?>
				</div>
<?php if ($signature != '') echo "\t\t\t\t".'<div class="postsignature"><hr />'.$signature.'</div>'."\n"; ?>
			</div>
			<div class="clearer"></div>
			<div class="postfootleft"><?php if ($cur_post['poster_id'] > 1) echo '<p>'.$is_online.'</p>'; ?></div>
			<div class="postfootright"><?php echo (count($post_actions)) ? '<ul>'.implode($lang_topic['Link separator'].'</li>', $post_actions).'</li></ul></div>'."\n" : '<div>&nbsp;</div></div>'."\n" ?>
		</div>
	</div>
</div>

<?php

}

?>
<div class="postlinksb">
	<div class="inbox">
		<p class="postlink conr"><?php echo $post_link ?></p>
		<p class="pagelink conl"><?php echo $paging_links ?></p>
<?php
if($cur_topic['parent_forum'])
{
        echo "\t\t".'<ul><li><a href="index.php">'.$lang_common['Index'].'</a>&#160;</li><li>&raquo;&#160;<a href="viewforum.php?id='.$cur_topic['parent_forum_id'].'">'.pun_htmlspecialchars($cur_topic['parent_forum']).'</a>&#160;</li><li>&raquo;&#160;<a href="viewforum.php?id='.$cur_topic['forum_id'].'">'.pun_htmlspecialchars($cur_topic['forum_name']).'</a>&#160;</li><li>&raquo;&#160;'.pun_htmlspecialchars($cur_topic['subject']).'</li></ul>';
}
else
{
        echo "\t\t".'<ul><li><a href="index.php">'.$lang_common['Index'] ?> </a></li><li>&nbsp;&raquo;&nbsp;<a href="<?php echo makeurl("f", $cur_topic['forum_id'], $cur_topic['forum_name']) ?>"><?php echo pun_htmlspecialchars($cur_topic['forum_name']) ?></a></li><li>&nbsp;&raquo;&nbsp;<?php echo pun_htmlspecialchars($cur_topic['subject']) ?></li></ul>
<?php } ?>
		<?php echo $subscraction ?>
	</div>
</div>

<?php

// Display quick post if enabled
if ($quickpost)
{

?>
        <script type="text/javascript">
        function AddSmiley(text) {
                var txtarea = document.post.req_message;
                text = ' ' + text + ' ';
                if (txtarea.createTextRange && txtarea.caretPos) {
                        var caretPos = txtarea.caretPos;
                        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text;
                        txtarea.focus();
                } else {
                        txtarea.value  += text;
                        txtarea.focus();
                }
        }
        </script>

<div class="blockform">
	<h2><span><?php echo $lang_topic['Quick post'] ?></span></h2>
	<div class="box">
<!-- mod modern_bbcode -->
<!-- 		<form method="post" action="post.php?tid=<?php echo $id ?>" onsubmit="this.submit.disabled=true;if(process_form(this)){return true;}else{this.submit.disabled=false;return false;}"> -->
		<form id="post" method="post" name="qpost" action="post.php?tid=<?php echo $id ?>" onsubmit="this.submit.disabled=true;if(process_form(this)){return true;}else{this.submit.disabled=false;return false;}">
<!-- End mod modern_bbcode -->

			<div class="inform">
				<fieldset>
					<legend><?php echo $lang_common['Write message legend'] ?></legend>
					<div class="infldset txtarea">
						<input type="hidden" name="form_sent" value="1" />
						<input type="hidden" name="form_user" value="<?php echo (!$pun_user['is_guest']) ? pun_htmlspecialchars($pun_user['username']) : 'Guest'; ?>" />


<!-- mod modern_bbcode -->
<?php require PUN_ROOT.'mod_modern_bbcode.php'; ?>
<!-- End mod modern_bbcode -->
<!--mod multi quote -->
<label><textarea name="req_message" id="req_message" rows="7" cols="75" tabindex="1"></textarea></label>
<!-- <label><textarea name="req_message" rows="7" cols="75" tabindex="1"></textarea></label> -->
						<ul class="bblinks">
							<li><a href="help.php#bbcode" onclick="window.open(this.href); return false;"><?php echo $lang_common['BBCode'] ?></a>: <?php echo ($pun_config['p_message_bbcode'] == '1') ? $lang_common['on'] : $lang_common['off']; ?></li>
							<li><a href="help.php#img" onclick="window.open(this.href); return false;"><?php echo $lang_common['img tag'] ?></a>: <?php echo ($pun_config['p_message_img_tag'] == '1') ? $lang_common['on'] : $lang_common['off']; ?></li>
							<li><a href="help.php#smilies" onclick="window.open(this.href); return false;"><?php echo $lang_common['Smilies'] ?></a>: <?php echo ($pun_config['o_smilies'] == '1') ? $lang_common['on'] : $lang_common['off']; ?></li>
						</ul>
					</div>
				</fieldset>

			</div>
			<p><input type="submit" name="submit" tabindex="2" value="<?php echo $lang_common['Submit'] ?>" accesskey="s" /></p>
		</form>
	</div>
</div>
<?php

}

// Increment "num_views" for topic
$low_prio = ($db_type == 'mysql') ? 'LOW_PRIORITY ' : '';
$db->query('UPDATE '.$low_prio.$db->prefix.'topics SET num_views=num_views+1 WHERE id='.$id) or error('Unable to update topic', __FILE__, __LINE__, $db->error());

$forum_id = $cur_topic['forum_id'];
$footer_style = 'viewtopic';
require PUN_ROOT.'footer.php';
