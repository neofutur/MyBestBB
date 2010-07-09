##
##
##        Mod title:  Attachment Mod
##
##      Mod version:  2.0.1
##   Works on PunBB:  1.2.5
##     Release date:  2005-04-28
##           Author:  Frank Hagstrom (frank.hagstrom+punbb@gmail.com)
##
##      Description:  This mod will add the ability for attachments beeing
##                    posted in PunBB 1.2.5
##
##   Affected files:  delete.php
##                    edit.php
##                    moderate.php
##                    post.php
##                    viewtopic.php
##
##       Affects DB:  Yes
##
##            Notes:  This is the second Attachment Mod I have written. The
##                    earlier mod used the database to store the binary data,
##                    for a huge amount of files, this might start getting hard
##                    to make backups etc. of. (first mod was intended for few
##                    files, not gigabytes of data, but I have come closer and
##                    closer to this, and would like to be able to keep it on
##                    files instead.)
##                    
##                    To be able to get attachments, one need to enable upload
##                    of files in PHP, and set the max_file_size (and some
##                    other variables, so read documentation after installing
##                    the mod)
##                    There's now no longer any need of having large buffers
##                    for the database, so these can be returned to the values
##                    one had before installing the first mod (if you have that
##                    installed, but I guess you should do that after the files
##                    has been converted to disk files)
##                    
##                    There's also no need for editing php files to set options,
##                    these are set in the Administration interface, located in
##                    the Plugins menu. These are cached and should therefore be
##                    at least just as quick (perhaps quicker as they're
##                    combined with the forum config), so it's easier to
##                    administrate the mod now, adding icons, and such.
##                    
##                    Another great new thing done is that you only have to
##                    backup each file once, as there will never be two files
##                    with the same name in a directory. So one only need to
##                    download the new files from the subfolders, old deleted
##                    files will be emptied (0 bytes), but still be in the
##                    folders to keep new attachments to get the same name. As
##                    if they would, one would need to download all files during
##                    backup procedure.
##                    
##                    And as a further upgrade, posts are no longer limited to
##                    one attachment per post. I still have a limit of one file
##                    per opportunity (i.e. one on post creation, rest on edit),
##                    but the admin set the limit of max files per post, a per 
##                    group and per forum basis.
##                    
##                    I strongly suggest you read the whole documentation
##                    before start using the mod, the documentation is in the
##                    Administration interface. Or at the very least the first
##                    chapter!
##
##
##
##                    **** PREPARATIONS NEEDED TO BE DONE FIRST! ****
##
##                    1. Backup!
##                    2. Create a directory where you want the attachments to
##                       be stored. (Suggestion is somewhere the browser does
##                       NOT reach, if not bruteforcing to find files is
##                       possible)
##                    3. Make sure php is allowed to create files and
##                       directories in the above directory.
##                    
##                    Written by Frank H  
##                    on: 2005-04-12 17:11
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

audio.png to img/attach/
compressed.pnd to img/attach/
image.png to img/attach/
index.html to img/attach/
text.png to img/attach/
unknown.png to img/attach/
video.png to img/attach/

attach_incl.php to include/attach/
attach_func.php to include/attach/

attach.php to lang/English/

AP_Attachment_Mod.php to plugins/

attachment.php to /
install_mod.php to /
install_mod_updater.php to /

index.htm to attachment-directory  (read the preparations above!)
.htaccess to attachment-directory


#
#---------[ 2. OPEN ]---------------------------------------------------------
#

delete.php


#
#---------[ 3. FIND (line: 27) ]----------------------------------------------
#

require PUN_ROOT.'include/common.php';


#
#---------[ 4. AFTER, ADD ]---------------------------------------------------
#

require PUN_ROOT.'include/attach/attach_incl.php'; //Attachment Mod row, loads variables, functions and lang file


#
#---------[ 5. FIND (line: 75) ]----------------------------------------------
#

	if ($is_topic_post)
	{


#
#---------[ 6. AFTER, ADD ]---------------------------------------------------
#

		attach_delete_thread($cur_post['tid']);	// Attachment Mod , delete the attachments in the whole thread (orphan check is checked in this function)


#
#---------[ 7. FIND (line: 82) ]----------------------------------------------
#

		redirect('viewforum.php?id='.$cur_post['fid'], $lang_delete['Topic del redirect']);
	}
	else
	{


#
#---------[ 8. AFTER, ADD ]---------------------------------------------------
#

		attach_delete_post($id);	// Attachment Mod , delete the attachments in this post (orphan check is checked in this function)


#
#---------[ 9. OPEN ]---------------------------------------------------------
#

edit.php

	
#
#---------[ 10. FIND (line: 27) ]---------------------------------------------
#

require PUN_ROOT.'include/common.php';	


#
#---------[ 11. AFTER, ADD ]--------------------------------------------------
#

require PUN_ROOT.'include/attach/attach_incl.php'; //Attachment Mod row, loads variables, functions and lang file


#
#---------[ 12. FIND (line: 127) ]--------------------------------------------
#

		// Update the post
		$db->query('UPDATE '.$db->prefix.'posts SET message=\''.$db->escape($message).'\', hide_smilies=\''.$hide_smilies.'\''.$edited_sql.' WHERE id='.$id) or error('Unable to update post', __FILE__, __LINE__, $db->error());
		


#
#---------[ 13. AFTER, ADD ]--------------------------------------------------
#		

		//Attachment Mod 2.0 Block Start
		//First check if there are any files to delete, the postvariables should be named 'attach_delete_'.$i , if it's set you're going to delete the value of this (the 0 =< $i < attachments, just to get some order in there...)
		if(isset($_POST['attach_num_attachments'])){
			// if there is any number of attachments, check if there has been any deletions ... if so, delete the files if allowed...
			$attach_num_attachments = intval($_POST['attach_num_attachments']);
			for($i=0;$i<$attach_num_attachments;$i++){
				if(array_key_exists('attach_delete_'.$i,$_POST)){
					$attach_id=intval($_POST['attach_delete_'.$i]);
					//fetch info about it ... owner and such ... (so we know if it's going to be ATTACH_OWNER_DELETE or ATTACH_DELETE that will affect the rulecheck...
					$result_attach = $db->query('SELECT af.owner,ar.rules FROM '.$db->prefix.'attach_2_files AS af, '.$db->prefix.'attach_2_rules AS ar, '.$db->prefix.'posts AS p, '.$db->prefix.'topics AS t WHERE af.id=\''.$attach_id.'\' AND ar.group_id=\''.$pun_user['g_id'].'\' AND ar.forum_id=t.forum_id AND t.id=p.topic_id AND p.id=af.post_id LIMIT 1') or error('Unable to fetch attachment details and forum rules', __FILE__, __LINE__, $db->error());
					if($db->num_rows($result_attach)>0||$pun_user['g_id']==PUN_ADMIN){
						list($attach_cur_owner,$attach_rules)=$db->fetch_row($result_attach);
						
						$attach_allowed = false;
						
						if($pun_user['g_id']==PUN_ADMIN)//admin overrides
							$attach_allowed = true;
						elseif($attach_cur_owner==$pun_user['id'])//it's the owner of the file that want to delete it
							$attach_allowed=attach_rules($attach_rules,ATTACH_OWNER_DELETE);
						else //it's not the owner that wants to delete the attachment...
							$attach_allowed=attach_rules($attach_rules,ATTACH_DELETE);

						if($attach_allowed){
							if(!attach_delete_attachment($attach_id)){
								// uncomment if you want to show error if it fails to delete
								//error('Unable to delete attachment.');
							}
						}else{
							// the user may not delete it ... uncomment the error if you want to use it ...
							//error('You\'re not allowed to delete the attachment');
						}
					}else{
						// the user probably hasn't any rules in this forum any longer...
					}
				}
			}
		}		
		//Then recieve any potential new files
		if((isset($_FILES['attached_file'])&&$_FILES['attached_file']['size']!=0&&is_uploaded_file($_FILES['attached_file']['tmp_name']))){
			//ok, we have a new file, much similar to post, except we need to check if the user uploads too many files...
			$attach_allowed=false;
			if($pun_user['g_id']==PUN_ADMIN){
				$attach_allowed=true;
			}else{
				//fetch forum rules and the number of attachments for this post.
				$result_attach = $db->query('SELECT COUNT(af.id) FROM '.$db->prefix.'attach_2_files AS af WHERE af.post_id = \''.$id.'\' GROUP BY af.post_id LIMIT 1')or error('Unable to fetch current number of attachments in post',__FILE__,__LINE__,$db->error());	
				if($db->num_rows($result_attach)==1){
					list($attach_num_attachments)=$db->fetch_row($result_attach);
				}else{
					$attach_num_attachments=0;
				}

				$result_attach = $db->query('SELECT ar.rules,ar.size,ar.file_ext,ar.per_post FROM '.$db->prefix.'attach_2_rules AS ar, '.$db->prefix.'posts AS p, '.$db->prefix.'topics AS t WHERE group_id=\''.$pun_user['g_id'].'\' AND p.id = \''.$id.'\' AND t.id = p.topic_id AND ar.forum_id = t.forum_id LIMIT 1')or error('Unable to fetch attachment rules',__FILE__,__LINE__,$db->error());	
				if($db->num_rows($result_attach)==1){
					list($attach_rules,$attach_size,$attach_file_ext,$attach_per_post)=$db->fetch_row($result_attach);
					//first check if the user is allowed to upload
					$attach_allowed=attach_allow_upload($attach_rules,$attach_size,$attach_file_ext,$_FILES['attached_file']['size'],$_FILES['attached_file']['name']); //checks so that extensions, size etc is ok
					if($attach_allowed && $attach_num_attachments < $attach_per_post) // if we haven't attached too many...
						$attach_allowed=true;
					else
						$attach_allowed=false;
				}else{
					// probably no rules, don't allow upload
					$attach_allowed=false;
				}
			}
			// ok, by now we should know if it's allowed to upload or not ... 
			if($attach_allowed){ //if so upload it ... 
				if(!attach_create_attachment($_FILES['attached_file']['name'],$_FILES['attached_file']['type'],$_FILES['attached_file']['size'],$_FILES['attached_file']['tmp_name'],$id,count_chars($message))){
					error('Error creating attachment, inform the owner of this bulletin board of this problem. (Most likely something to do with rights on the filesystem)',__FILE__,__LINE__);
				}
			}
		}		
		//Attachment Mod 2.0 Block End		
		
		
#
#---------[ 14. FIND (line: 205) ]--------------------------------------------
#	

		redirect('viewtopic.php?pid='.$id.'#p'.$id, $lang_post['Edit redirect']);
	}
}


#
#---------[ 15. AFTER, ADD ]--------------------------------------------------
#

//Attachment Mod 2.0 Block Start
//ok, first check the rules, so we know if the user may may upload more or delete potentially existing attachments
$attach_allow_delete=false;
$attach_allow_owner_delete=false;
$attach_allow_upload=false;
$attach_allowed=false;
$attach_allow_size=0;
$attach_per_post=0;
if($pun_user['g_id']==PUN_ADMIN){
	$attach_allow_delete=true;
	$attach_allow_owner_delete=true;
	$attach_allow_upload=true;
	$attach_allow_size=$pun_config['attach_max_size'];
	$attach_per_post=-1;
}else{
	$result_attach=$db->query('SELECT ar.rules,ar.size,ar.per_post,COUNT(f.id) FROM '.$db->prefix.'attach_2_rules AS ar, '.$db->prefix.'attach_2_files AS f, '.$db->prefix.'posts AS p, '.$db->prefix.'topics AS t WHERE group_id=\''.$pun_user['g_id'].'\' AND p.id = \''.$id.'\' AND t.id = p.topic_id AND ar.forum_id = t.forum_id GROUP BY f.post_id LIMIT 1')or error('Unable to fetch attachment rules and current number of attachments in post (#2)',__FILE__,__LINE__,$db->error());	
	if($db->num_rows($result_attach)==1){
		list($attach_rules,$attach_allow_size,$attach_per_post,$attach_num_attachments)=$db->fetch_row($result_attach);
		//may the user delete others attachments?
		$attach_allow_delete = attach_rules($attach_rules,ATTACH_DELETE);
		//may the user delete his/her own attachments?
		$attach_allow_owner_delete = attach_rules($attach_rules,ATTACH_OWNER_DELETE);
		//may the user upload new files?
		$attach_allow_upload = attach_rules($attach_rules,ATTACH_UPLOAD);
	}else{
		//no rules set, so nothing allowed
	}
}
$attach_output = '';
$attach_output_two = '';
//check if this post has attachments, if so make the appropiate output
if($attach_allow_delete||$attach_allow_owner_delete||$attach_allow_upload){
	$attach_allowed=true;
	$result_attach=$db->query('SELECT af.id, af.owner, af.filename, af.extension, af.size, af.downloads FROM '.$db->prefix.'attach_2_files AS af WHERE post_id=\''.$id.'\'')or error('Unable to fetch current attachments',__FILE__,__LINE__,$db->error());
	if($db->num_rows($result_attach)>0){
		//time for some output ... create the existing files ... 
		$i=0;
		while(list($attach_id,$attach_owner,$attach_filename,$attach_extension,$attach_size,$attach_downloads)=$db->fetch_row($result_attach)){
			if(($attach_owner==$pun_user['id']&&$attach_allow_owner_delete)||$attach_allow_delete)
				$attach_output .= '<br />'."\n".'<input type="checkbox" name="attach_delete_'.$i.'" value="'.$attach_id.'" />'.$lang_attach['Delete?'].' '.attach_icon($attach_extension).' <a href="./attachment.php?item='.$attach_id.'">'.$attach_filename.'</a>, '.$lang_attach['Size:'].' '.number_format($attach_size).' '.$lang_attach['bytes'].', '.$lang_attach['Downloads:'].' '.number_format($attach_downloads);
			else
				$attach_output_two .= '<br />'."\n".attach_icon($attach_extension).' <a href="./attachment.php?item='.$attach_id.'">'.$attach_filename.'</a>, '.$lang_attach['Size:'].' '.number_format($attach_size).' '.$lang_attach['bytes'].', '.$lang_attach['Downloads:'].' '.number_format($attach_downloads);
			$i++;
		}
		if(strlen($attach_output)>0)
			$attach_output = '<input type="hidden" name="attach_num_attachments" value="'.$db->num_rows($result_attach).'" />'.$lang_attach['Existing'] . $attach_output;
		if(strlen($attach_output_two)>0)
			$attach_output .= "<br />\n".$lang_attach['Existing2'] . $attach_output_two;
		$attach_output .= "<br />\n";
	}else{
		// we have not existing files
	}
}
//fix the 'new upload' field...
if($attach_allow_upload){
	if(strlen($attach_output)>0)$attach_output .= "<br />\n";
	if($attach_per_post==-1)$attach_per_post = '<em>unlimited</em>';
	$attach_output .= str_replace('%%ATTACHMENTS%%',$attach_per_post,$lang_attach['Upload'])."<br />\n".'<input type="hidden" name="MAX_FILE_SIZE" value="'.$attach_allow_size.'" /><input type="file" name="attached_file" size="80" />';
	
	
	
}
//Attachment Mod 2.0 Block End


#
#---------[ 16. FIND (line: 341) ]--------------------------------------------
#

		<form id="edit" method="post" action="edit.php?id=<?php echo $id ?>&amp;action=edit" onsubmit="return process_form(this)">



#
#---------[ 17. REPLACE WITH ]------------------------------------------------
#		

		<form id="edit" method="post" <?php echo 'enctype="multipart/form-data"'; ##Attachment Mod 2.0 ?> action="edit.php?id=<?php echo $id ?>&amp;action=edit" onsubmit="return process_form(this)">


#
#---------[ 18. FIND (line: 360) ]--------------------------------------------
#

$checkboxes = array();
if ($pun_config['o_smilies'] == '1')


#
#---------[ 19. BEFORE, ADD ]-------------------------------------------------
#

//Attachment Mod Block Start
if($attach_allowed){
?>
			</div>
			<div class="inform">
				<fieldset>
					<legend><?php echo $lang_attach['Attachment'] ?></legend>
					<div class="infldset">
						<div class="rbox">
							<?php echo $attach_output; ?><br />
							<?php echo $lang_attach['Note2']; ?>
						</div>
					</div>
				</fieldset>
<?php
}
//Attachment Mod Block End


#
#---------[ 20. OPEN ]--------------------------------------------------------
#

moderate.php

#
#---------[ 21. FIND (line: 27) ]---------------------------------------------
#

require PUN_ROOT.'include/common.php';


#
#---------[ 22. AFTER, ADD ]--------------------------------------------------
#

require PUN_ROOT.'include/attach/attach_incl.php'; //Attachment Mod row, loads variables, functions and lang file


#
#---------[ 23. FIND (line: 105) ]--------------------------------------------
#

			// Delete the posts
			$db->query('DELETE FROM '.$db->prefix.'posts WHERE id IN('.$posts.')') or error('Unable to delete posts', __FILE__, __LINE__, $db->error());


#
#---------[ 24. BEFORE, ADD ]-------------------------------------------------
#

			//Attachment Mod Block Start
			foreach(explode(',',$posts) as $value)
				attach_delete_post($value);
			//Attachment Mod Block End


#
#---------[ 25. FIND (line: 413) ]--------------------------------------------
#

		// Delete the topics and any redirect topics
		$db->query('DELETE FROM '.$db->prefix.'topics WHERE id IN('.$topics.') OR moved_to IN('.$topics.')') or error('Unable to delete topic', __FILE__, __LINE__, $db->error());


#
#---------[ 26. BEFORE, ADD ]-------------------------------------------------
#

		//Attachment Mod Block Start
		foreach(explode(',',$topics) as $value)
			attach_delete_thread($value);
		//Attachment Mod Block End


#
#---------[ 27. OPEN ]--------------------------------------------------------
#

post.php

#
#---------[ 28. FIND (line: 27) ]---------------------------------------------
#

require PUN_ROOT.'include/common.php';	


#
#---------[ 29. AFTER, ADD ]--------------------------------------------------
#

require PUN_ROOT.'include/attach/attach_incl.php'; //Attachment Mod row, loads variables, functions and lang file


#
#---------[ 30. FIND (line: 317) ]--------------------------------------------
#

		if (!$pun_user['is_guest'])
		{
			$low_prio = ($db_type == 'mysql') ? 'LOW_PRIORITY ' : '';
			$db->query('UPDATE '.$low_prio.$db->prefix.'users SET num_posts=num_posts+1, last_post='.$now.' WHERE id='.$pun_user['id']) or error('Unable to update user', __FILE__, __LINE__, $db->error());
		}


#
#---------[ 31. AFTER, ADD ]--------------------------------------------------
#


		// Attachment Mod Block Start
		if (isset($_FILES['attached_file'])&&$_FILES['attached_file']['size']!=0&&is_uploaded_file($_FILES['attached_file']['tmp_name'])){
			//fetch the rules for this forum for this group
			$attach_result = $db->query('SELECT rules,size,file_ext FROM '.$db->prefix.'attach_2_rules WHERE group_id=\''.$pun_user['g_id'].'\' AND forum_id=\''.$cur_posting['id'].'\' LIMIT 1')or error('Unable to fetch attachment rules',__FILE__,__LINE__,$db->error());	
			if($db->num_rows($attach_result)!=0||$pun_user['g_id']==PUN_ADMIN){
				$attach_rules=0; $attach_size=0; $attach_file_ext=''; // just some defaults to get the parser to stop nagging me if it's an admin :D
				if($db->num_rows($attach_result)!=0)
					list($attach_rules,$attach_size,$attach_file_ext)=$db->fetch_row($attach_result);
				//check so that the user is allowed to upload
				if(attach_allow_upload($attach_rules,$attach_size,$attach_file_ext,$_FILES['attached_file']['size'],$_FILES['attached_file']['name'])){
					// ok we're allowed to post ... time to fix everything... 
					if(!attach_create_attachment($_FILES['attached_file']['name'],$_FILES['attached_file']['type'],$_FILES['attached_file']['size'],$_FILES['attached_file']['tmp_name'],$new_pid,count_chars($message))){
						error('Error creating attachment, inform the owner of this bulletin board of this problem. (Most likely something to do with rights on the filesystem)',__FILE__,__LINE__);
					}
				}else{
					// no output ... but if you want, enable this error (you really shouldn't need to as this will only happen if someone try to go around the restrictions
					// error($lang_attach['Not allowed to post attachments']);
				}
			}else{
				// no output ... but if you want, enable this error (you really shouldn't need to as this will only happen if someone try to go around the restrictions
				// error($lang_attach['Not allowed to post attachments']);
			}
		}
		// Attachment Mod Block End

		
#
#---------[ 32. FIND (line: 358) ]--------------------------------------------
#

	$form = '<form id="post" method="post" action="post.php?action=post&amp;tid='.$tid.'" onsubmit="this.submit.disabled=true;if(process_form(this)){return true;}else{this.submit.disabled=false;return false;}">';


#
#---------[ 33. REPLACE WITH ]------------------------------------------------
#	
	
	$form = '<form id="post" method="post" enctype="multipart/form-data" action="post.php?action=post&amp;tid='.$tid.'" onsubmit="this.submit.disabled=true;if(process_form(this)){return true;}else{this.submit.disabled=false;return false;}">'; //Attachment Mod has added enctype="multipart/form-data"


#
#---------[ 34. FIND (line: 411) ]--------------------------------------------
#

	$form = '<form id="post" method="post" action="post.php?action=post&amp;fid='.$fid.'" onsubmit="return process_form(this)">';


#
#---------[ 35. REPLACE WITH ]------------------------------------------------
#

	$form = '<form id="post" method="post" enctype="multipart/form-data" action="post.php?action=post&amp;fid='.$fid.'" onsubmit="return process_form(this)">';		//Attachment Mod has added enctype="multipart/form-data"


#
#---------[ 36. FIND (line: 431) ]--------------------------------------------
#

require PUN_ROOT.'header.php';


#
#---------[ 37. BEFORE, ADD ]-------------------------------------------------
#

//Attachment Mod Block Start
//Fetch some stuff so we know if the user is allowed to attach files to the post ... oh and preview won't work... I'm not going to add shitload of stuff to get some temporary upload area ;)
$attach_allowed = false;
$attach_result = $db->query('SELECT rules,size FROM '.$db->prefix.'attach_2_rules WHERE group_id=\''.$pun_user['g_id'].'\' AND forum_id=\''.$cur_posting['id'].'\' LIMIT 1')or error('Unable to fetch attachment rules',__FILE__,__LINE__,$db->error());	
if($db->num_rows($attach_result)){
	list($attach_rules,$attach_size)=$db->fetch_row($attach_result);
	if(attach_rules($attach_rules,ATTACH_UPLOAD))
		$attach_allowed=true;
}elseif($pun_user['g_id']==PUN_ADMIN){
	$attach_allowed=true;
	$attach_size=$pun_config['attach_max_size'];	
}
//Attachment Mod Block End


#
#---------[ 38. FIND (line: 544) ]--------------------------------------------
#

$checkboxes = array();
if (!$pun_user['is_guest'])


#
#---------[ 39. BEFORE, ADD ]-------------------------------------------------
#

//Attachment Mod Block Start
if($attach_allowed){
?>
			</div>
			<div class="inform">
				<fieldset>
					<legend><?php echo $lang_attach['Attachment'] ?></legend>
					<div class="infldset">
						<div class="rbox">
							<input type="hidden" name="MAX_FILE_SIZE" value="<?php print $attach_size; ?>" /><input type="file" name="attached_file" size="80" tabindex="<?php echo $cur_index++ ?>" /><br />
							<?php echo $lang_attach['Note'] ?>
						</div>
					</div>
				</fieldset>
<?php
}
//Attachment Mod Block End


#
#---------[ 40. OPEN ]--------------------------------------------------------
#

viewtopic.php

#
#---------[ 41. FIND (line: 27) ]---------------------------------------------
#

require PUN_ROOT.'include/common.php';	


#
#---------[ 42. AFTER, ADD ]--------------------------------------------------
#

require PUN_ROOT.'include/attach/attach_incl.php'; //Attachment Mod row, loads variables, functions and lang file


#
#---------[ 43. FIND (line: 187) ]--------------------------------------------
#

$result = $db->query('SELECT u.email, u.title, u.url, u.location, u.use_avatar, u.signature, u.email_setting, u.num_posts, u.registered, u.admin_note, p.id, p.poster AS username, p.poster_id, p.poster_ip, p.poster_email, p.message, p.hide_smilies, p.posted, p.edited, p.edited_by, g.g_id, g.g_user_title, o.user_id AS is_online FROM '.$db->prefix.'posts AS p INNER JOIN '.$db->prefix.'users AS u ON u.id=p.poster_id INNER JOIN '.$db->prefix.'groups AS g ON g.g_id=u.group_id LEFT JOIN '.$db->prefix.'online AS o ON (o.user_id=u.id AND o.idle=0) WHERE p.topic_id='.$id.' ORDER BY p.id LIMIT '.$start_from.','.$pun_user['disp_posts'], true) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error());


#
#---------[ 44. REPLACE WITH ]--(if you have added the latest changeset, just change the true to false, and add comment)---
#

$result = $db->query('SELECT u.email, u.title, u.url, u.location, u.use_avatar, u.signature, u.email_setting, u.num_posts, u.registered, u.admin_note, p.id, p.poster AS username, p.poster_id, p.poster_ip, p.poster_email, p.message, p.hide_smilies, p.posted, p.edited, p.edited_by, g.g_id, g.g_user_title, o.user_id AS is_online FROM '.$db->prefix.'posts AS p INNER JOIN '.$db->prefix.'users AS u ON u.id=p.poster_id INNER JOIN '.$db->prefix.'groups AS g ON g.g_id=u.group_id LEFT JOIN '.$db->prefix.'online AS o ON (o.user_id=u.id AND o.idle=0) WHERE p.topic_id='.$id.' ORDER BY p.id LIMIT '.$start_from.','.$pun_user['disp_posts'], false) or error('Unable to fetch post info', __FILE__, __LINE__, $db->error()); //Attachment Mod, changed the true to false...


#
#---------[ 45. FIND (line: 308) ]--------------------------------------------
#

			$signature = parse_signature($cur_post['signature']);
			$signature_cache[$cur_post['poster_id']] = $signature;
		}
	}


#
#---------[ 46. AFTER, ADD ]--------------------------------------------------
#

	// Attachment Mod Block Start
	$attach_allow_download = false;
	$attach_output = '';
	$attach_num = 0;
	// Check if this post has any attachments
	$result_attach = $db->query('SELECT af.id, af.filename, af.size, af.downloads FROM '.$db->prefix.'attach_2_files AS af WHERE af.post_id='.$cur_post['id']) or error('Unable to fetch if there were any attachments to the post', __FILE__, __LINE__, $db->error());
	$attach_num = $db->num_rows($result_attach);
	if($attach_num > 0){
		if($pun_user['g_id']==PUN_ADMIN)$attach_allow_download=true;
		else{ 		//fetch the rules of the forum, and check so that the user is allowed to download.
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


#
#---------[ 47. FIND (line: 356) ]--------------------------------------------
#

<?php if ($cur_post['edited'] != '') echo "\t\t\t\t\t".'<p class="postedit"><em>'.$lang_topic['Last edit'].' '.pun_htmlspecialchars($cur_post['edited_by']).' ('.format_time($cur_post['edited']).')</em></p>'."\n"; ?>


#
#---------[ 48. AFTER, ADD ]--------------------------------------------------
#

<?php if ($attach_allow_download) echo "\t\t\t\t\t".'<div class="postsignature"><hr />'.$attach_output.'</div>'."\n"; ## Attachment Mod row ?>


#
#---------[ 49. SAVE, UPLOAD ]------------------------------------------------
#



#
#---------[ 50. RUN ]---------------------------------------------------------
#

install_mod.php


#
#---------[ 51. DELETE ]------------------------------------------------------
#

install_mod.php


#
#---------[ 52. RUN ]-----( only needed if you used the old mod )-------------
#

install_mod_updater.php


#
#---------[ 53. DELETE ]------------------------------------------------------
#

install_mod_updater.php
