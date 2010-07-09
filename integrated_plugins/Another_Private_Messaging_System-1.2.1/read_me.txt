##
##
##        Mod title:  Another Private Messaging System
##                    Based on Private Messaging Sytem (PMS) 1.2.2
##
##      Mod version:  1.2.1
##   Works on PunBB:  1.2.x
##    Release date :  2006-09-07
##        Date 1.2 :  2006-08-30
##      Date 1.1.2 :  2006-06-20
##      Date 1.1.1 :  2006-06-20
##        Date 1.1 :  2006-06-17
##        Date 1.0 :  2006-06-10
##
##           Author:  Vincent Garnier a.k.a. vin100 (vin100@forx.fr)
##
## PMS 1.2.x author:  Connorhd (connorhd@mypunbb.com)
## PMS 1.1.x author:  David 'Chacmool' Djurbäck (chacmool@spray.se)
##
##      Description:  Private Messaging System for PunBB
##
##   Affected files:  include/common.php
##                    include/functions.php
##                    footer.php
##                    header.php
##                    profile.php
##                    viewtopic.php
##                    /style/your_style.css
##
##       Affects DB:  New table:
##                       'messages'
##                       'contacts'
##                    New options:
##                       'o_pms_enabled'
##                       'o_pms_mess_per_page'
##                       'o_pms_max_receiver'
##                       'o_pms_notification'
##                       'o_pms_popup'
##                    New users option:
##                       'notify_mp'
##                    New groups permissions:
##                       'g_pm'
##                       'g_pm_limit'
##
##
##       DISCLAIMER:  Please note that "mods" are not officially supported by
##                    PunBB. Installation of this modification is done at your
##                    own risk. Backup your forum database and any and all
##                    applicable files before proceeding.
##
##


#-------------------------------------------------------------------------------
#
#---------[ UPGRADE ]-----------------------------------------------------------


To update from Private Messaging System 1.2.x, remove "simply" the code and 
the files of the mod and follow the instructions below.




#-------------------------------------------------------------------------------
#
#---------[ 1. UPLOAD ]---------------------------------------------------------
#

install_mod.php in /

pms_contacts.php in /
pms_list.php in /
pms_popup.php in /
pms_send.php in /

lang/English/mail_templates/new_pm.tpl in /lang/English/mail_templates/
lang/English/pms.php in /lang/English/

lang/French/mail_templates/new_pm.tpl in /lang/French/mail_templates/
lang/French/pms.php in /lang/French/

plugins/AP_Private_messaging.php in /plugins/


#
#---------[ 2. RUN ]------------------------------------------------------------
#

install_mod.php


#
#---------[ 3. DELETE ]---------------------------------------------------------
#

install_mod.php




#-------------------------------------------------------------------------------
#
#---------[ 4. OPEN ]-----------------------------------------------------------
#

include/common.php


#
#---------[ 5. FIND ]-----------------------------------------------------------
#

// Check if we are to display a maintenance message
if ($pun_config['o_maintenance'] && $pun_user['g_id'] > PUN_ADMIN && !defined('PUN_TURN_OFF_MAINT'))
	maintenance_message();


#
#---------[ 6.  REPLACE BY ]---------------------------------------------------
#


/* Start MOD PM */
require PUN_ROOT.'lang/'.$pun_user['language'].'/pms.php';
/* End MOD PM */

// Check if we are to display a maintenance message
if ($pun_config['o_maintenance'] && $pun_user['g_id'] > PUN_ADMIN && !defined('PUN_TURN_OFF_MAINT'))
	maintenance_message();




#-------------------------------------------------------------------------------
#
#---------[ 7. OPEN ]-----------------------------------------------------------
#

include/functions.php


#
#---------[ 8. FIND ]-----------------------------------------------------------
#

	$result = $db->query('SELECT u.*, g.*, o.logged, o.idle FROM '.$db->prefix.'users AS u INNER JOIN '.$db->prefix.'groups AS g ON u.group_id=g.g_id LEFT JOIN '.$db->prefix.'online AS o ON o.user_id=u.id WHERE u.id='.intval($cookie['user_id']))


#
#---------[ 9.  REPLACE BY ]---------------------------------------------------
#

	$result = $db->query('SELECT u.*, g.*, o.logged, o.idle, COUNT(pm.id) AS total_pm FROM '.$db->prefix.'users AS u INNER JOIN '.$db->prefix.'groups AS g ON u.group_id=g.g_id LEFT JOIN '.$db->prefix.'online AS o ON o.user_id=u.id LEFT JOIN '.$db->prefix.'messages AS pm ON pm.owner=u.id WHERE u.id='.intval($cookie['user_id']).' GROUP BY u.id')


#
#---------[ 10. FIND ]---------------------------------------------------------
#

		if ($pun_user['g_id'] > PUN_MOD)
		{
			if ($pun_user['g_search'] == '1')
				$links[] = '<li id="navsearch"><a href="search.php">'.$lang_common['Search'].'</a>';

			$links[] = '<li id="navprofile"><a href="profile.php?id='.$pun_user['id'].'">'.$lang_common['Profile'].'</a>';
			$links[] = '<li id="navlogout"><a href="login.php?action=out&amp;id='.$pun_user['id'].'">'.$lang_common['Logout'].'</a>';
		}
		else
		{
			$links[] = '<li id="navsearch"><a href="search.php">'.$lang_common['Search'].'</a>';
			$links[] = '<li id="navprofile"><a href="profile.php?id='.$pun_user['id'].'">'.$lang_common['Profile'].'</a>';
			$links[] = '<li id="navadmin"><a href="admin_index.php">'.$lang_common['Admin'].'</a>';
			$links[] = '<li id="navlogout"><a href="login.php?action=out&amp;id='.$pun_user['id'].'">'.$lang_common['Logout'].'</a>';
		}


#
#---------[ 11.  REPLACE BY ]---------------------------------------------------
#

		if ($pun_user['g_id'] > PUN_MOD)
		{
			if ($pun_user['g_search'] == '1')
				$links[] = '<li id="navsearch"><a href="search.php">'.$lang_common['Search'].'</a>';

			$links[] = '<li id="navprofile"><a href="profile.php?id='.$pun_user['id'].'">'.$lang_common['Profile'].'</a>';
			/* Start MOD PM */
			if ($pun_config['o_pms_enabled'] == '1' && $pun_user['g_pm'] == 1 && $pun_user['use_pm'] == 1)
				$links[] = '<li id="navpm"><a href="pms_list.php">'.$GLOBALS['lang_pms']['PM'].'</a>';	
			/* End MOD PM */
			$links[] = '<li id="navlogout"><a href="login.php?action=out&amp;id='.$pun_user['id'].'">'.$lang_common['Logout'].'</a>';
		}
		else
		{
			$links[] = '<li id="navsearch"><a href="search.php">'.$lang_common['Search'].'</a>';
			$links[] = '<li id="navprofile"><a href="profile.php?id='.$pun_user['id'].'">'.$lang_common['Profile'].'</a>';
			/* Start MOD PM */
			if ($pun_config['o_pms_enabled'] == '1' && $pun_user['g_pm'] == 1 && $pun_user['use_pm'] == 1)
				$links[] = '<li id="navpm"><a href="pms_list.php">'.$GLOBALS['lang_pms']['PM'].'</a>';	
			/* End MOD PM */
			$links[] = '<li id="navadmin"><a href="admin_index.php">'.$lang_common['Admin'].'</a>';
			$links[] = '<li id="navlogout"><a href="login.php?action=out&amp;id='.$pun_user['id'].'">'.$lang_common['Logout'].'</a>';
		}


#
#---------[ 12. FIND ]----------------------------------------------------------
#

function message($message, $no_back_link = false)
{
	global $db, $lang_common, $pun_config, $pun_start, $tpl_main;


#
#---------[ 13. REPLACE BY ]----------------------------------------------------
#

function message($message, $no_back_link = false)
{
	global $db, $lang_common, $lang_pms, $pun_config, $pun_start, $tpl_main;




#------------------------------------------------------------------------------
#
#---------[ 14. OPEN ]---------------------------------------------------------
#

footer.php


#
#---------[ 15. FIND ]---------------------------------------------------------
#


// If no footer style has been specified, we use the default (only copyright/debug info)
$footer_style = isset($footer_style) ? $footer_style : NULL;


#
#---------[ 16.  REPLACE BY ]---------------------------------------------------
#

// If no footer style has been specified, we use the default (only copyright/debug info)
$footer_style = isset($footer_style) ? $footer_style : NULL;


/* Start MOD PM */
if ($footer_style == 'pms_list')
{
?>
			<dl id="searchlinks" class="conl">
				<dt><strong>Liens messages privés</strong></dt>
<?php
if ($num_new_mp > 0)
	echo "\t\t\t\t\t\t".'<dd><a href="pms_list.php?action=markall&amp;box='.$box.'&amp;p='.$p.'">'.$lang_pms['Mark all'].'</a></dd>'."\n";
	
	echo '</dl>';
}
/* End MOD PM */




#-------------------------------------------------------------------------------
#
#---------[ 17. OPEN ]----------------------------------------------------------
#

header.php

#
#---------[ 18. FIND ]----------------------------------------------------------
#


$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';


#
#---------[ 19.  REPLACE BY ]---------------------------------------------------
#

/* Start MOD PM */
if (defined('JS_DISABLED_PM_FIELD'))
{
?>
<script type="text/javascript">
//<![CDATA[
	window.onload = function() {
		document.getElementById('notify_mp').disabled = true;
		document.getElementById('popup_pm').disabled = true;
	}
//]]>
</script>
<?php
}
/* End MOD PM */

$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';


#
#---------[ 20. FIND ]----------------------------------------------------------
#


	if (in_array(basename($_SERVER['PHP_SELF']), array('index.php', 'search.php')))


#
#---------[ 21.  REPLACE BY ]---------------------------------------------------
#

	/* Start MOD PM */
	$num_new_mp = 0;
	if (!$pun_user['is_guest'] && $pun_user['g_pm'] == 1 && $pun_user['use_pm'] == 1 && $pun_config['o_pms_enabled'] == '1')
	{
		// Boxes status
		$mp_boxes_full = ($pun_user['total_pm'] >= $pun_user['g_pm_limit']) ? true : false;
		$mp_boxes_empty = ($pun_user['total_pm'] <= 0) ? true : false;
		if ($pun_user['g_pm_limit'] != 0 && $pun_user['g_id'] > PUN_GUEST)
		{	
			if ($mp_boxes_empty)
				$tpl_temp .= "\n\t\t\t\t".'<li>'.$lang_pms['Empty boxes'].'</li>';
			elseif ($mp_boxes_full)
				$tpl_temp .= "\n\t\t\t\t".'<li><a href="pms_list.php"><strong>'.$lang_pms['Full boxes'].'</strong></a></li>';
			else {
				$per_cent_box = ceil($pun_user['total_pm'] / $pun_user['g_pm_limit'] * 100);
				$tpl_temp .= "\n\t\t\t\t".'<li>'.sprintf($lang_pms['Full to'],$per_cent_box.'%').'</li>';
			}
		}
		
		// Check for new messages
		$result_messages = $db->query('SELECT COUNT(id) FROM '.$db->prefix.'messages WHERE showed=0 AND owner='.$pun_user['id']) or error('Impossible de vérifier la présence de nouveaux messages', __FILE__, __LINE__, $db->error());
		$num_new_mp = $db->result($result_messages);
		
		if ($num_new_mp > 0)
			$tpl_temp .= "\n\t\t\t\t".'<li class="pmlink"><a href="pms_list.php"><strong>'.($num_new_mp == 1 ? $lang_pms['New message'] : sprintf($lang_pms['New messages'],$num_new_mp)).'</strong></a></li>';		
	}
	/* End MOD PM */
	
	if (in_array(basename($_SERVER['PHP_SELF']), array('index.php', 'search.php')))


#
#---------[ 22. FIND ]---------------------------------------------------------
#


	else
		$tpl_temp .= "\n\t\t\t".'</ul>'."\n\t\t\t".'<div class="clearer"></div>'."\n\t\t".'</div>';


#
#---------[ 23.  REPLACE BY ]---------------------------------------------------
#

	else
		$tpl_temp .= "\n\t\t\t".'</ul>'."\n\t\t\t".'<div class="clearer"></div>'."\n\t\t".'</div>';

	/* Start MOD PM */
	if ($num_new_mp > 0 && $pun_config['o_pms_popup'] == '1' && $pun_user['popup_pm'] == 1 && !preg_match('/^pms_/',basename($_SERVER['PHP_SELF'])))
	{
		$tpl_temp .= "\n\t\t\t\t".'<script type="text/javascript">'.
					 "\n\t\t\t\t".'//<![CDATA['.
					 "\n\t\t\t\t\t".'window.open("pms_popup.php","New PM","dependent=yes,width=500,height=250,resizable=yes,scrollbars=yes,alwaysRaised=yes");'.
					 "\n\t\t\t\t".'//]]>'.
					 "\n\t\t\t\t".'</script>'."\n";
	}
	/* End MOD PM */




#-------------------------------------------------------------------------------
#
#---------[ 24. OPEN ]----------------------------------------------------------
#

profile.php


#
#---------[ 25. FIND ]----------------------------------------------------------
#

	else if ($section == 'privacy')
	{


#
#---------[ 26. REPLACE BY ]----------------------------------------------------
#

	else if ($section == 'privacy')
	{
		/* Start MOD PM */
		if (!$user['use_pm'] == 1) define('JS_DISABLED_PM_FIELD', 1);
		/* End MOD PM */


#
#---------[ 27. FIND ]----------------------------------------------------------
#


		redirect('index.php', $lang_profile['User delete redirect']);


#
#---------[ 28. REPLACE BY ]----------------------------------------------------
#
		
		/* Start MOD PM */
		$db->query('DELETE FROM '.$db->prefix.'messages WHERE owner='.$id) or error('Impossible de supprimer les messages de l\'utilisateur', __FILE__, __LINE__, $db->error());
		$db->query('DELETE FROM '.$db->prefix.'contacts WHERE user_id='.$id) or error('Impossible de supprimer les contacts de l\'utilisateur', __FILE__, __LINE__, $db->error());
		/* End MOD PM */
		
		redirect('index.php', $lang_profile['User delete redirect']);



#
#---------[ 29. FIND ]----------------------------------------------------------
#


		case 'privacy':
		{
			$form = extract_elements(array('email_setting', 'save_pass', 'notify_with_post'));

			$form['email_setting'] = intval($form['email_setting']);
			if ($form['email_setting'] < 0 && $form['email_setting'] > 2) $form['email_setting'] = 1;

			if (!isset($form['save_pass']) || $form['save_pass'] != '1') $form['save_pass'] = '0';
			if (!isset($form['notify_with_post']) || $form['notify_with_post'] != '1') $form['notify_with_post'] = '0';

			// If the save_pass setting has changed, we need to set a new cookie with the appropriate expire date
			if ($pun_user['id'] == $id && $form['save_pass'] != $pun_user['save_pass'])
			{
				$result = $db->query('SELECT password FROM '.$db->prefix.'users WHERE id='.$id) or error('Unable to fetch user password hash', __FILE__, __LINE__, $db->error());
				pun_setcookie($id, $db->result($result), ($form['save_pass'] == '1') ? time() + 31536000 : 0);
			}

			break;
		}




#
#---------[ 30. REPLACE BY ]----------------------------------------------------
#
		
		case 'privacy':
		{
			$form = extract_elements(array('email_setting', 'save_pass', 'notify_with_post', 'use_pm', 'notify_mp', 'popup_pm'));

			$form['email_setting'] = intval($form['email_setting']);
			if ($form['email_setting'] < 0 && $form['email_setting'] > 2) $form['email_setting'] = 1;

			if (!isset($form['save_pass']) || $form['save_pass'] != '1') $form['save_pass'] = '0';
			if (!isset($form['notify_with_post']) || $form['notify_with_post'] != '1') $form['notify_with_post'] = '0';
			if (!isset($form['use_pm']) || $form['use_pm'] != '1') $form['use_pm'] = '0';
			if (!isset($form['notify_mp']) || $form['notify_mp'] != '1') $form['notify_mp'] = '0';
			if (!isset($form['popup_pm']) || $form['popup_pm'] != '1') $form['popup_pm'] = '0';

			// If the save_pass setting has changed, we need to set a new cookie with the appropriate expire date
			if ($pun_user['id'] == $id && $form['save_pass'] != $pun_user['save_pass'])
			{
				$result = $db->query('SELECT password FROM '.$db->prefix.'users WHERE id='.$id) or error('Unable to fetch user password hash', __FILE__, __LINE__, $db->error());
				pun_setcookie($id, $db->result($result), ($form['save_pass'] == '1') ? time() + 31536000 : 0);
			}

			break;
		}



#
#---------[ 31. FIND ]----------------------------------------------------------
#


u.notify_with_post, 



#
#---------[ 32. REPLACE BY ]----------------------------------------------------
#
		
u.notify_with_post, u.notify_mp, u.use_pm, u.popup_pm, 


#
#---------[ 33. FIND ]----------------------------------------------------------
#


							<dd><?php echo $email_field ?></dd>


#
#---------[ 34. REPLACE BY ]----------------------------------------------------
#
		
							<dd><?php echo $email_field ?></dd>
<?php /* Start MOD PM */
if ($pun_config['o_pms_enabled'] == '1' && !$pun_user['is_guest'] && $pun_user['g_pm'] == 1 && $pun_user['use_pm'] == 1 && $user['use_pm'] == 1) : ?>
							<dt><?php echo $lang_pms['PM'] ?>: </dt>
							<dd><a href="pms_send.php?uid=<?php echo $id ?>&amp;from_profile=<?php echo $id ?>"><?php echo $lang_pms['Quick message'] ?></a></dd>
							<dd><a href="pms_contacts.php?add=<?php echo $id ?>"><?php echo $lang_pms['Add to contacts'] ?></a></dd>
<?php endif;
/* End MOD PM */ ?>


#
#---------[ 35. FIND ]----------------------------------------------------------
#

			$email_field = '<label><strong>'.$lang_common['E-mail'].'</strong><br /><input type="text" name="req_email" value="'.$user['email'].'" size="40" maxlength="50" /><br /></label><p><a href="misc.php?email='.$id.'">'.$lang_common['Send e-mail'].'</a></p>'."\n";


#
#---------[ 36. REPLACE BY ]----------------------------------------------------
#
		

			$email_field = '<label><strong>'.$lang_common['E-mail'].'</strong><br /><input type="text" name="req_email" value="'.$user['email'].'" size="40" maxlength="50" /><br /></label><p><a href="misc.php?email='.$id.'">'.$lang_common['Send e-mail'].'</a></p>'."\n";
			/* Start MOD PM */
			if ($user['use_pm'] == 1)
				$email_field .= '<p><a href="pms_send.php?uid='.$id.'&amp;from_profile='.$id.'">'.$lang_pms['Quick message'].'</a> - <a href="pms_contacts.php?add='.$id.'">'.$lang_pms['Add to contacts'].'</a></p>'."\n";
			/* End MOD PM */



#
#---------[ 37. FIND ]----------------------------------------------------------
#

							<div class="rbox">
								<label><input type="checkbox" name="form[notify_with_post]" value="1"<?php if ($user['notify_with_post'] == '1') echo ' checked="checked"' ?> /><?php echo $lang_profile['Notify full'] ?><br /></label>
							</div>
						</div>
					</fieldset>
				</div>


#
#---------[ 38. REPLACE BY ]----------------------------------------------------
#

							<div class="rbox">
								<label><input type="checkbox" name="form[notify_with_post]" value="1"<?php if ($user['notify_with_post'] == '1') echo ' checked="checked"' ?> /><?php echo $lang_profile['Notify full'] ?><br /></label>
							</div>
						</div>
					</fieldset>
				</div>
				<?php /* Start MOD PM */
				if ($pun_config['o_pms_enabled'] == '1' && $pun_user['g_pm'] == '1') : ?>
				<script type="text/javascript">
				//<![CDATA[
				function switchEtatByCheck(id_element, id_from_element)
				{
					if (!document.getElementById) { return; }
					
					var element = document.getElementById(id_element);
					
					if (document.getElementById(id_from_element).checked==false) {
						element.blur();
						element.disabled = true;
					}
					else {
						element.disabled = false;
						element.focus();
					}
				}
				//]]>
				</script>
				<div class="inform">
					<fieldset>
						<legend><?php echo $lang_pms['Private Messages'] ?></legend>
						<div class="infldset">
							<div class="rbox">
								<label><input type="checkbox" id="use_pm" name="form[use_pm]" value="1"<?php if ($user['use_pm'] == 1) echo ' checked="checked"' ?> onclick="switchEtatByCheck('notify_mp', this.id);switchEtatByCheck('popup_pm', this.id);" /><?php echo $lang_pms['use_pm_option'] ?><br /></label>
							</div>
							<?php if ($pun_config['o_pms_notification'] == '1') : ?>
							<p><?php echo $lang_pms['email_option_infos'] ?></p>
							<div class="rbox">
								<label><input type="checkbox" id="notify_mp" name="form[notify_mp]" value="1"<?php if ($user['notify_mp'] == 1) echo ' checked="checked"' ?> /><?php echo $lang_pms['email_option'] ?><br /></label>
							</div>
							<?php else : ?>
							<input type="hidden" id="notify_mp" name="form[notify_mp]" value="0" />
							<?php endif; ?>
							<?php if ($pun_config['o_pms_popup'] == '1') : ?>
							<p><?php echo $lang_pms['popup_option_infos'] ?></p>
							<div class="rbox">
								<label><input type="checkbox" id="popup_pm" name="form[popup_pm]" value="1"<?php if ($user['popup_pm'] == 1) echo ' checked="checked"' ?> /><?php echo $lang_pms['popup_option'] ?><br /></label>
							</div>
							<?php else : ?>
							<input type="hidden" id="popup_pm" name="form[popup_pm]" value="0" />
							<?php endif; ?>
						</div>
					</fieldset>
				</div>
				<?php endif; 
				/* End MOD PM */ ?>




#-------------------------------------------------------------------------------
#
#---------[ 39. OPEN ]----------------------------------------------------------
#

viewtopic.php


#
#---------[ 40. FIND ]----------------------------------------------------------
#

u.email_setting, 


#
#---------[ 41. REPLACE BY ]----------------------------------------------------
#

u.email_setting, u.use_pm, 

#
#---------[ 42. FIND ]----------------------------------------------------------
#
			

			if ($cur_post['url'] != '')
				$user_contacts[] = '<a href="'.pun_htmlspecialchars($cur_post['url']).'">'.$lang_topic['Website'].'</a>';


#
#---------[ 43. REPLACE BY ]----------------------------------------------------
#
			
			/* Start MOD PM */
			if ($pun_config['o_pms_enabled'] == '1' && !$pun_user['is_guest'] && $pun_user['g_pm'] == 1 && $pun_user['use_pm'] == 1 && $cur_post['use_pm'] == 1)
			{
				$pid = isset($cur_post['poster_id']) ? $cur_post['poster_id'] : $cur_post['id'];
				$user_contacts[] = '<a href="pms_send.php?uid='.$pid.'&tid='.$id.'">'.$lang_pms['PM'].'</a>';
			}
			/* End MOD PM */			
			

			if ($cur_post['url'] != '')
				$user_contacts[] = '<a href="'.pun_htmlspecialchars($cur_post['url']).'">'.$lang_topic['Website'].'</a>';




#-------------------------------------------------------------------------------
#
#---------[ 44. OPEN ]----------------------------------------------------------
#

/style/your_style.css


#
#---------[ 45. ADD AT THE BOTTOM ]---------------------------------------------
#

/****************************************************************/
/* 13. ADDED PMS STUFF ( Private Messaging )                    */
/****************************************************************/

div#mp_bar_ext {
	border: 1px solid #336699;
	width: 100px;
	height: 10px;
	text-align: left;
}
div#mp_bar_int {
	background-color: #336699;
	height: 10px;
}




#-----------------------------------------------------------------------------
#
#---------[ 46. SAVE/UPLOAD ]-------------------------------------------------
#

include/common.php
include/functions.php
footer.php
header.php
profile.php
viewtopic.php
/style/your_style.css

