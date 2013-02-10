<?php

	// Settings, such as page title...
	$settings = array(
		'Title'   => 'InvPB to PunBB converter',
		'Forum'   => 'InvPB',
		'Page'	 => '<b>InvPB to PunBB</b> converter at page: ',
		'db_def'  => 'invpb',
		'pre_def' => 'inv_'
		);

	// List of pages to go through
	$parts = array(
//		'start',
		'users',
		'categories',
		'forums',
		'topics',
		'posts',
//		'polls',
		'bans',
//		'censoring',
		'end'
	);

	$tables = array(
		'Users'			=>	'members',
		'Categories'	=>	'',
		'Forums'			=>	'',
		'Topics'			=>	'topics',
		'Posts'			=>	'posts',
		'Polls'			=>	'polls',
		'Messages'		=>	'',
	);

	// Convert posts BB-code
	function convert_posts($message){
		
		$pattern = array(
			// <b> <i> <u>
			'#\<b>(.*?)</b>#is',
			'#\<i>(.*?)</i>#is',
			'#\<u>(.*?)</u>#is',

			// Image -> <img src='http://chacmool.shacknet.nu/invpb2/style_emoticons/default/cool.gif' border='0' alt='user posted image' />
			"#<img src=[\"'](\S+?)['\"].+?".">#",
			
			// Smileys -> <!--emo&:D-->
			'#\<!--emo&(.*?)-->(.*?)<!--endemo-->#i',

			// Font, Size, Color & Url
			"#\<span style='font-family:(.*?)'>(.*?)</span>#i",
			"#\<span style='font-size:(.*?)pt;line-height:100%'>(.*?)</span>#i",
			"#\<span style='color:(.*?)'>(.*?)</span>#i",
			"#\<a href='(.*?)' target='_blank'>(.*?)</a>#i",
			
			// Quotes
			"#<!--QuoteBegin-->(.+?)<!--QuoteEBegin-->#",
			"#<!--QuoteBegin-{1,2}([^>]+?)\+([^>]+?)-->(.+?)<!--QuoteEBegin-->#",
			"#<!--QuoteBegin-{1,2}([^>]+?)\+-->(.+?)<!--QuoteEBegin-->#",
			"#<!--QuoteEnd-->(.+?)<!--QuoteEEnd-->#",
			"#\[right\]\[snapback\](.*?)\[/snapback\]\[/right\]<br>#",

			// Code
			"#<!--c1-->(.+?)<!--ec1-->#",
			"#<!--c2-->(.+?)<!--ec2-->#",

			// Lists
			'#\<ul>(.*?)</ul>#i',
			'#\<li>(.*?)</li>#i',

			// Mail -> <a href="mailto:chacmool@spray.se">chacmool.spray.se</a>
			'#\<a href="mailto:(.*?)">(.*?)</a>#i',
			
			// Urls
			"#\<a href='(.*?)' target='_blank'>(.*?)</a>#i",

			// <br>
			'#\<br>#i',
			'#\<br />#i'
			
		);
		
		$replace = array(
			// <b> <i> <u>
			'[b]$1[/b]',
			'[i]$1[/i]',
			'[u]$1[/u]',
			
			// Iamge -> [img]...[/img]
			'[img]$1[/img]', 
			
			// Smileys -> :D
			'$1',

			// Font, Size, Color & Url
			'[font=$1]$2[/font]',
			'[size=$1]$2[/size]',
			'[color=$1]$2[/color]',
			'[url=$1]$2[/url]',

			// Quotes
			'[quote]',
			'[quote=$1,$2]',
			'[quote=$1]',
			'[/quote]',
			'',

			// Code
			'[code]',
			'[/code]',

			// Lists
			"\r\n$1\r\n",
			" * $1\r\n",

			// Mail -> [email]myname@mydomain.com[/email]
			'[email=$1]$2[/email]', 
			
			// Urls
			'[url=$1]$2[/url]',
			
			// <br>
			"\r\n",
			"\r\n"
		);

		return preg_replace($pattern, $replace, $message);
		
	}

?>