<?php

	// Fetch topic info
	$result = $fdb->query('SELECT topics.*, users.username FROM '.$_SESSION['php'].$_SESSION['phpnuke'].'topics AS topics, '.$_SESSION['php'].'users AS users WHERE topic_id > '.$start.' AND topics.topic_poster=users.user_id ORDER BY topic_id LIMIT '.$_SESSION['limit']) or myerror('phpBB: Unable to get table: topics', __FILE__, __LINE__, $fdb->error());
	$last_id = -1;
	while($ob = $fdb->fetch_assoc($result))
	{
		$last_id = $ob['topic_id'];
		echo $ob['topic_title'].' ('.$ob['topic_id'].")<br>\n"; flush();

		// Solves last-post-problem when there are no answers
		if( $ob['topic_last_post_id'] != '' )
		{
			$sql = 'SELECT username,post_username,post_time FROM '.$_SESSION['php'].$_SESSION['phpnuke'].'posts AS p, '.$_SESSION['php'].'users AS u WHERE p.poster_id=u.user_id AND post_id='.$ob['topic_last_post_id'];
			$lastresult = $fdb->query($sql) or myerror("Unable to get user info", __FILE__, __LINE__, $fdb->error());
			list($last['poster'], $last['guestname'], $last['posted']) = $fdb->fetch_row($lastresult);
			$last['poster'] == '' ? $last['poster'] = $last['guestname'] : null;
		}

		// Check for anonymous poster id problem
		$ob['topic_first_post_id'] == -1 ? $ob['topic_first_post_id'] = 1 : null;
		if( $ob['topic_last_post_id'] == -1 ){
			$ob['topic_last_post_id'] = 1;
			$last['poster'] = 'Guest';
		}

		// Dataarray
		$todb = array(
			'id'				=>		$ob['topic_id'],
			'poster'			=>		$ob['username'],
			'subject'		=>		$ob['topic_title'],
			'posted'			=>		$ob['topic_time'],
			'num_views'		=>		$ob['topic_views'],
			'num_replies'	=>		$ob['topic_replies'],
			'last_post'		=>		$last['posted'],
			'last_post_id'	=>		$ob['topic_last_post_id'],
			'last_poster'	=>		$last['poster'],
			'sticky'			=>		(int)($ob['topic_type'] > 0),
			'closed'			=>		(int)($ob['topic_status'] == 1),
			'forum_id'		=>		$ob['forum_id'],
		);

		// Save data
		insertdata('topics', $todb, __FILE__, __LINE__);

		// Moved topic
		if($ob['topic_status'] == 2)
			$db->query('UPDATE '.$_SESSION['pun'].'topics SET moved_to=\''.$ob['topic_moved_id'].'\' WHERE id='.$ob['topic_id']) or myerror("Unable to update modeved-topic", __FILE__, __LINE__, $db->error());
	}

	convredirect('topic_id', $_SESSION['phpnuke'].'topics', $last_id);

?>