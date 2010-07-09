<?php
/*

This thing will update the older database stored attachments to proper filestorage...

A few things to note:

* BACKUP BACKUP BACKUP, BEFORE you try to upgrade, if something fails, I can almost guaranteee that data will be lost!
* Make sure there aren't any attachments uploaded, or some things might freak out (like the attachment downloader)!
* You most defenetly want to do it in maintenence mode, as this will start chunking along...and consume alot of power, and lots of database transfer...
* BACKUP! Make sure you have backups before you start... if not, don't blame me if you loose attachments...


*/

/////////////////////////////////////////////////////////////////////////////////////////////////////


define('PUN_ROOT', './');
require PUN_ROOT.'include/common.php';
require PUN_ROOT.'include/attach/attach_incl.php'; //Attachment Mod row, loads variables, functions and lang file

if($pun_user['g_id']!=PUN_ADMIN)
	message($lang_common['No permission']);


if(isset($_GET['update'])){

	ini_set('max_execution_time',300); //Apache etc has often a timeout on that, according to the php manual, so I go with that... 
	
	$attach_amount = intval($_GET['update']);
	$curattachment = 0;
	
	if($attach_amount < 1 || strlen($attach_amount)==0)
		$attach_amount = 10;
		
	// loop through the attachments and save onto disk...
	// fetch next 'attach_amount' of files ...
	$attach_result = $db->query('SELECT af.id, af.owner, af.postid, af.filename, af.size, af.downloads, ad.mime, ad.data, af.dataid FROM '.$db->prefix.'attach_files AS af, '.$db->prefix.'attach_data AS ad WHERE ad.id=af.dataid ORDER BY af.id ASC LIMIT '.$attach_amount) or error('Error fetching attachments from database',__FILE__,__LINE__,$db->error());
	while(list($attach_id,$attach_owner,$attach_post_id,$attach_filename,$attach_size,$attach_downloads,$attach_mime,$attach_data,$attach_dataid)=$db->fetch_row($attach_result)){
		$curattachment++;
		// create new attachment...
		echo $curattachment.". Create new file (item: '.$attach_id.')...<br>\n";
		if(!attach_update_attachment($attach_id,$attach_owner,$attach_post_id,$attach_filename,attach_get_extension($attach_filename),$attach_size,$attach_downloads,$attach_mime,$attach_data))
			error('Unable to update attachment with id: "'.$attach_id.'"');
		
		// delete file entry in database
		echo $curattachment.". Delete file in database (item: '.$attach_id.')...<br>\n";
		$attach_result_2 = $db->query('DELETE FROM '.$db->prefix.'attach_files WHERE id=\''.$attach_id.'\' LIMIT 1') or error('Error deleting attachment entry',__FILE__,__LINE__,$db->error());
		// delete file data in database
		echo $curattachment.". Delete filedata in database (item: '.$attach_id.')...<br><br>\n";
		$attach_result_2 = $db->query('DELETE FROM '.$db->prefix.'attach_data WHERE id=\''.$attach_dataid.'\' LIMIT 1') or error('Error deleting attachment data',__FILE__,__LINE__,$db->error());
	}		
	
	// do a count query to see if the data table is empty, if so output endpage, else 'selfrefresh'
	$attach_result = $db->query('SELECT COUNT(af.id) FROM `'.$db->prefix.'attach_files` AS af') or error('Error fetching number of attachments still to do',__FILE__,__LINE__,$db->error());
	list($attach_rows_to_do)=$db->fetch_row($attach_result);
	if($attach_rows_to_do<1){
		//we're finished... delete the tables...
		echo "Delete old tables...<br>\n";
		switch($db_type){
			case 'mysql':
				$db->query('DROP TABLE IF EXISTS '.$db->prefix.'attach_files, '.$db->prefix.'attach_rules, '.$db->prefix.'attach_data')or error('Error dropping old empty tables (if exists)',__FILE__,__LINE__,$db->error());
				break;
			default:
				$db->query('DROP TABLE '.$db->prefix.'attach_files, '.$db->prefix.'attach_rules, '.$db->prefix.'attach_data')or error('Error dropping old empty tables',__FILE__,__LINE__,$db->error());
		}
		
		
		echo "<br>\n<br>\n<strong>Success!</strong><br>\nNow go set the rules for all the groups at the forums (they aren't converted, due to the large change usergroups have added).<br>\n<a href=\"admin_index.php\">Click here to go to Administration interface</a>.";
	}else{
		// output self refreshing page ...	
		echo '
<script>
setTimeout("this.location=\'install_mod_updater.php?update=\'+'.$attach_amount.'",1000);
</script>
<a href="install_mod_updater.php?update='.$attach_amount.'">Click to convert more files</a> (If you have javascript it should autorefresh after 1 second, so you can go and take a cup of coffee)<br>
Time this batch were ready: <strong>'.date('l dS of F Y h:i:s A').'</strong>';
	}
}else{
	echo '<html>
<body>
This will update the old attachment mod to the new version, it will move files from database storage to filestorage.<br>
<strong>MAKE SURE TO HAVE <u>BACKUPS BEFORE</u> PROCEEDING, IF IT FAILS YOU MIGHT LOOSE VALUABLE DATA!</strong><br>
Also, you will most likely stress the server during this process, so do this in maintenence mode.<br>
<form method="GET" action="install_mod_updater.php">
<input type="text" name="update" value="10">(more files per batch will go faster, but too many and you might timeout (Apache has a 300sec default on CGI scripts, PHP has 30(but script tries to set it to 300sec))<br>
<input type="submit" name="submit" value="Start conversion">
</form>
</body>
</html>';
}
exit();







function attach_update_attachment($attach_id,$attach_owner,$attach_post_id,$attach_filename,$attach_extension,$attach_size,$attach_downloads,$attach_mime,$attach_data){
		global $db, $pun_user, $pun_config;

		// fetch an unique name for the file
		$unique_name = attach_generate_filename($pun_config['attach_basefolder'].$pun_config['attach_subfolder'].'/',0,$attach_size);

		
		// create a new file on disk and fill it with data...
		$newfile = fopen($pun_config['attach_basefolder'].$pun_config['attach_subfolder'].'/'.$unique_name,'wb'); //wb = write, reset file to 0 bytes if existing, and b is just for windows, to tell it's binary mode...is ignored on other OS:es
		if (!$newfile)
			error('Error creating filepointer for file, for attachment with id: "'.$attach_id.'"',__FILE__,__LINE__);
			
		// write the data into the file ...			
		if(fwrite($newfile,$attach_data) === FALSE)
			error('Error filling empty file with data, attachment with id: "'.$attach_id.'"',__FILE__,__LINE__);
			
		fclose($newfile); // and close the file ...
						
		if(strlen($attach_mime)==0)
			$attach_mime = attach_create_mime(attach_find_extention($attach_filename));
		
		// update the database with this info
		$result = $db->query('INSERT INTO '.$db->prefix.'attach_2_files (id,owner,post_id,filename,extension,mime,location,size,downloads) VALUES (\''.$attach_id.'\',\''.$attach_owner.'\',\''.$attach_post_id.'\',\''.$db->escape($attach_filename).'\',\''.$attach_extension.'\',\''.$db->escape($attach_mime).'\',\''.$db->escape($pun_config['attach_subfolder'].'/'.$unique_name).'\',\''.$attach_size.'\',\''.$attach_downloads.'\')')or error('Unable to insert attachment record into database.',__FILE__,__LINE__,$db->error());
		return true;
}