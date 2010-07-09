##
##
##        Mod title:  Image Award Mod
##
##      Mod version:  1.0.0
##   Works on PunBB:  1.2.5
##     Release date:  2005-05-16
##           Author:  Frank Hagstrom (frank.hagstrom+punbb@gmail.com)
##
##      Description:  This mod will add the ability to assign image awards for
##                    users. That is shown below their avatar.
##
##   Affected files:  viewtopic.php
##
##       Affects DB:  Yes
##
##            Notes:  Well, having these things might be handy, a good way to
##                    show that a user has been warned for his actions, or just
##                    that the user is in some way special. The addition of new
##                    awards is very easy. Just create an image, save it with
##                    correct naming, upload, and then assign to the user.
##                    Description on how to name the files is in the admin
##                    plugin interface.
##                    The plugin part might be improved later, but typing in id
##                    I think is better than generating a list of users. As the
##                    userlist might grow to several thousands, and that's a
##                    hard list to find names in...
##                    
##                    Written by Frank H
##                    on: 2005-05-16 17:47
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

AP_Image_Award.php to /plugins/

Warning_100x20.png to /img/awards/
Banned_100x20.png to /img/awards/
Warning_Red_100x20.png to /img/awards/


#
#---------[ 2. RUN ]---------------------------------------------------------
#

install_mod.php


#
#---------[ 3. DELETE ]------------------------------------------------------
#

install_mod.php


#
#---------[ 4. OPEN ]--------------------------------------------------------
#

viewtopic.php

#
#---------[ 5. FIND (line: 186) ]--------------------------------------------
#

$result = $db->query('SELECT u.email, u.title, u.url, u.location, u.use_avatar, u.signature, u.email_setting, u.num_posts, u.registered, u.admin_note, p.id, p.poster AS username, p.poster_id, p.poster_ip, p.poster_email, p.message, p.hide_smilies, p.posted, p.edited, p.edited_by, g.g_id, g.g_user_title, o.user_id AS is_online FROM '.$db->prefix.'posts AS p INNER JOIN '.$db->prefix.'users AS u ON u.id=p.poster_id INNER JOIN '.$db->prefix.'groups AS g ON g.g_id=u.group_id LEFT JOIN '.$db->prefix.'online AS o ON (o.user_id=u.id AND o.idle=0) WHERE p.topic_id='.$id.' ORDER BY p.id LIMIT '.$start_from.','.$pun_user['disp_posts'], true) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());


#
#---------[ 6. REPLACE WITH ]------------------------------------------------
#		

$result = $db->query('SELECT u.email, u.title, u.url, u.location, u.use_avatar, u.signature, u.email_setting, u.num_posts, u.registered, u.admin_note, u.imgaward, p.id, p.poster AS username, p.poster_id, p.poster_ip, p.poster_email, p.message, p.hide_smilies, p.posted, p.edited, p.edited_by, g.g_id, g.g_user_title, o.user_id AS is_online FROM '.$db->prefix.'posts AS p INNER JOIN '.$db->prefix.'users AS u ON u.id=p.poster_id INNER JOIN '.$db->prefix.'groups AS g ON g.g_id=u.group_id LEFT JOIN '.$db->prefix.'online AS o ON (o.user_id=u.id AND o.idle=0) WHERE p.topic_id='.$id.' ORDER BY p.id LIMIT '.$start_from.','.$pun_user['disp_posts'], true) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error()); // Image Award Mod altered this (added one more column to fetch)


#
#---------[ 7. FIND (line: 195) ]--------------------------------------------
#

	$signature = '';


#
#---------[ 8. AFTER, ADD ]--------------------------------------------------
#

	$user_image_award = '';


#
#---------[ 9. FIND (line: 199) ]--------------------------------------------
#

	if ($cur_post['poster_id'] > 1)
	{


#
#---------[ 10. AFTER, ADD ]-------------------------------------------------
#

		// Image Award Mod Block Start
		if(strlen($cur_post['imgaward']) > 0){	// if we have something there, figure out what to output...
			//figure out the size of the award (Name of award should be in teh form:  Test_Award_100x20.png ... where png is format, 100x20 is dimensions and Test_Award is name of award (seen in admin interface)
			$awardmod_filename=$cur_post['imgaward'];
			$awardmod_temp=substr($awardmod_filename,strrpos($awardmod_filename,'_')+1); //we still have the file extentsion
			$awardmod_temp=substr($awardmod_temp,0,strpos($awardmod_temp,'.'));
			$awardmod_dimensions = explode('x',$awardmod_temp);	// there ... now the array will hold 100 and 20 in [0] and [1] respecively ... :)
			$awardmod_name=str_replace('_',' ',substr($awardmod_filename,0,strrpos($awardmod_filename,'_')));
			if($pun_config['o_avatars'] == '1' && $pun_user['show_avatars'] != '0')
				$user_image_award = "\t\t\t\t\t".'<dd><img src="img/awards/'.$awardmod_filename.'" width="'.$awardmod_dimensions[0].'" height="'.$awardmod_dimensions[1].'" alt="Award: '.$awardmod_name.'" /></dd>';
			else
				$user_image_award = "\t\t\t\t\t".'<dd>Award: "'.$awardmod_name.'"</dd>';
		}
		// Image Award Mod Block End


#
#---------[ 11. FIND (line: 336) ]-------------------------------------------
#

					<dd class="postavatar"><?php echo $user_avatar ?></dd>


#
#---------[ 12. AFTER, ADD ]-------------------------------------------------
#

<?php if (strlen($user_image_award)>0) echo $user_image_award;  ## Image Award Mod ?>


#
#---------[ 13. SAVE, UPLOAD ]-----------------------------------------------
#
