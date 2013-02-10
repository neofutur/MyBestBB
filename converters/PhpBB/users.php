<?php

	// Fetch user info	
	$res = $fdb->query('SELECT * FROM '.$_SESSION['php'].'users WHERE user_id>'.$start.' ORDER BY user_id LIMIT '.ceil($_SESSION['limit']/5)) or myerror('Unable to get table: users', __FILE__, __LINE__, $fdb->error());
	$last_id = -1;
	while($ob = $fdb->fetch_assoc($res))
	{
		$last_id = $ob['user_id'];
		echo $ob['username'].' ('.$ob['user_id'].")<br>\n"; flush();

		// Rank -> Title
		$title = null;
		if($ob['user_rank'] != 0){
			$res = $fdb->query('SELECT rank_title FROM '.$_SESSION['php'].$_SESSION['phpnuke'].'ranks WHERE rank_id ='.$ob['user_rank'].' LIMIT 1') or myerror("Unable to get user rank", __FILE__, __LINE__, $fdb->error());
			list($title) = $fdb->fetch_row($res);
		}

		// Last post
		$lastresult = $fdb->query('SELECT post_time FROM '.$_SESSION['php'].$_SESSION['phpnuke'].'posts WHERE poster_id ='.$ob['user_id'].' ORDER BY post_id DESC LIMIT 1') or myerror("Unable to get user indo", __FILE__, __LINE__, $fdb->error());
		$last = $fdb->fetch_assoc($lastresult);
		$last['post_time'] == 0 ? $last['post_time'] = 'null' : null;

		// Check for user/guest collision
		if($ob['user_id'] == 1)
		{
			// Fetch last user id
			$last_result = $fdb->query('SELECT user_id FROM '.$_SESSION['php'].$_SESSION['phpnuke']."users ORDER BY user_id DESC LIMIT 1") or myerror('Unable to fetch last user id', __FILE__, __LINE__, $fdb->error());
			list($last_user_id) = $fdb->fetch_row($last_result);
			$ob['user_id'] = ++$last_user_id;
			$_SESSION['admin_id'] = $ob['user_id'];
		}

		// Dataarray
		$todb = array(
			'id'				=>		$ob['user_id'],
			'username'		=>		$ob['username'],
			'password'		=>		$ob['user_password'],
			'title'			=>		$title,
			'url'				=>		$ob['user_website'],
			'icq'				=>		$ob['user_icq'],
			'msn'				=>		$ob['user_msnm'],
			'aim'				=>		$ob['user_aim'],
			'yahoo'			=>		$ob['user_yim'],
			'num_posts'		=>		$ob['user_posts'],
			'last_post'		=>		$last['post_time'],
			'location'		=>		$ob['user_from'],
			'email_setting'=>		!$ob['user_viewemail'],
			'timezone'		=>		(int)$ob['user_timezone'],
			'last_visit'	=>		$ob['user_lastvisit'],
			'signature'		=>		convert_posts($ob['user_sig']),
			'email'			=>		$ob['user_email'],
		);

		// Handle the user registered date
		$todb['registered'] = intval($ob['user_regdate']) > 0 ? $ob['user_regdate'] : strtotime($ob['user_regdate']);

		if($_SESSION['pun_version'] == '1.1')
			$todb['last_action'] = $ob['user_lastvisit'];

		// Save data
		insertdata('users', $todb, __FILE__, __LINE__);
	}

	convredirect('user_id', 'users', $last_id);

?>