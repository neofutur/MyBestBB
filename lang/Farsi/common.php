<?php

/*
// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':utf-8
	case 'WIN32':utf-8
		$locale = 'ÇäáíÓí';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'Fa Farsi-utf-8';
		break;

	default:
		$locale = 'İÇÑÓí fa';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);
*/

// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'rtl',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'ÏÑ ÎæÇÓÊ ÇÔÊÈÇå.áíäß ÇÔÊÈÇå ÈæÏå ÇÓÊ.',
'No view'				=>	'ÔãÇ ÇÌÇÒå ÏíÏä Çíä ÇäÌãä ÑÇ äÏÇÑíÏ.',
'No permission'			=>	'ÔãÇ ÇÌÇÒå ÏÓÊÑÓí Èå Çíä ÇäÍãä ÑÇ äÏÇÑíÏ.',
'Bad referrer'			=>	'Bad HTTP_REFERER. You were referred to this page from an unauthorized source. If the problem persists please make sure that \'Base URL\' is correctly set in Admin/Options and that you are visiting the forum by navigating to that URL. More information regarding the referrer check can be found in the PunBB documentation.',

// Topic/forum indicators
'New icon'				=>	'ÓÊ åÇí ÌÏíÏ',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'ÊÇíß ÈÓÊå ÔÏå ÇÓÊ',
'Redirect icon'			=>	'ÑÇåäãÇí ÇäÌãä',

// Miscellaneous
'Announcement'			=>	'ÇØáÇÚíå',
'Options'				=>	'ÇÎÊíÇÑÇÊ',
'Actions'				=>	'İÑãÇä åÇ',
'Submit'				=>	'ËÈÊ ',	// "äÇã" of submit buttons
'Ban message'			=>	'ÔãÇ ÇÒÈÓÊå ÔÏå ÇíÏ.',
'Ban message 2'			=>	'ÈÓÊå ÔÏä äÇã ÔãÇ ÊÇ',
'Ban message 3'			=>	'ãÏíÑ íÇ ãÏíÑ ßá ÔãÇ Èå ÚáÊ ÑíÒ ÈÓÊå ÇÓÊ:',
'Ban message 4'			=>	' ÈÇ ãÏíÑ ßá ÊãÇÓ ÈíÑíÏ',
'Never'					=>	'åÑÒ',
'Today'					=>	'ÇãÑæÒ',
'Yesterday'				=>	'İÑÏÇ',
'Info'					=>	'ÇØáÇÚÇÊ',		// a common table header
'Go back'				=>	'ÈÇÒÔÊ',
'Maintenance'			=>	'äå ÏÇÑí',
'Redirecting'			=>	'ÈÇÒ ÑÓí',
'Click redirect'		=>	'Çíä ÌÇ ÑÇ ßáíÏ ßäíÏ ÇÑ ãí ÎæÇåíÏ ßãÊÑ ÕÈÑ ßäíÏ(or if your browser does not automatically forward you)',
'on'					=>	'İÚÇá',		// as in "BBCode is on"
'off'					=>	'ÛíÑ İÚÇá',
'Invalid e-mail'		=>	'Çíãíá æÇÑÏ ÔÏå ÇÔÊÈÇÓÊ.',
'required field'		=>	'ÇÒ ßÇÑ ÇİÊÇÏäREQUIRED',	// for javascript form validation
'Last post'				=>	'ÂÎÑíä ÇÑÓÇá',
'by'					=>	'Èå',	// as in last post by someuser
'New posts'				=>	'ÌÏíÏ ÊÑíä ÇÑÓÇá',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'ÈÑæ Èå Çæáíä ÇÑÓÇá åÇí ÇäÌãä.',	// the popup text for new posts links
'Username'				=>	'äÇã ßÇÑÈÑí',
'Password'				=>	'ßáãå ÚÈæÑ',
'E-mail'				=>	'Çíãíá',
'Send e-mail'			=>	'ÇÑÓÇá Çíãíá',
'Moderated by'			=>	'ãÏíÑíÊ ÈÇ',
'Registered'			=>	'ËÈÊ äÇã ÔÏå',
'Subject'				=>	'ãæÖæÚ',
'Message'				=>	'íÇã',
'Topic'					=>	'ÊÇíß',
'Forum'					=>	'ÇäÌãä',
'Posts'					=>	'ÇÑÓÇá åÇ',
'Replies'				=>	'ÌæÇÈ åÇ',
'Author'				=>	'äæíÓäÏå',
'Pages'					=>	'ÕÛÍå åÇ',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Ôßáß åÇ',
'and'					=>	'æ',
'Image link'			=>	'ÚßÓ',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'äæÔÊå',	// For [quote]'s
'Code'					=>	'ßÏ',		// For [code]'s
'Mailer'				=>	'äÇãå ÑÓÇä',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'ÇØáÇÚÇÊ ãåã',
'Write message legend'	=>	'íÇã Îæ ÑÇ ÈäæíÓíÏ æ ËÈÊ ßäíÏ',

// Title
'Title'					=>	'ÚäæÇä',
'Member'				=>	'ÚÖæ',	// Default title
'Moderator'				=>	'ãÏíÑ',
'Administrator'			=>	'ãÏíÑ ßá',
'Banned'				=>	'ÇÎÑÇÌí/ÈÓÊå ÔÏå',
'Guest'					=>	'ãåãÇä',

// Stuff for include/parser.php
'BBCode error'			=>	'ÈíÈí ßÏ åÇ ÇÔÊÈÇÓÊ.',
'BBCode error 1'		=>	'äŞá Şæá ßÑÏå [/quote].',
'BBCode error 2'		=>	'Missing end tag for [code].',
'BBCode error 3'		=>	'Missing start tag for [/code].',
'BBCode error 4'		=>	'Missing one or more end tags for [quote].',
'BBCode error 5'		=>	'Missing one or more start tags for [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'ÕİÍå ÇÕáí',
'User list'				=>	'áíÓÊ ßÇÑÈÑÇä',
'Rules'					=>  'ÏÓÊæÑÇÊ',
'Search'				=>  'ÌÓÊÌæ',
'Register'				=>  'ËÈÊ äÇã',
'Login'					=>  'æÑæÏ',
'Not logged in'			=>  'ÔãÇ æÇÑÏ äÔÏå ÇíÏ.',
'Profile'				=>	'ãÔÎÕÇÊ ÔãÇ',
'Logout'				=>	'ÎÑæÌ',
'Logged in as'			=>	'æÇÑÏ ÔÏå ÈÇ ',
'Admin'					=>	'ãÏíÑíÊ',
'Last visit'			=>	'ÂÎÑíä ÈÇÒÏíÏ',
'Show new posts'		=>	'äãÇíÔ ÓÊ åÇ Ó ÇÒ ÂÎÑíä æÑæÏ ÔãÇ',
'Mark all as read'		=>	'ÚáÇãÊ ĞÇÑí ÎæÇäÏå ÔÏå åÇ',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Çííä ÕİÍå',
'Search links'			=>	'ÌÓÊÌæí ÂÏÑÓ',
'Show recent posts'		=>	'äãÇíÔ ÓÊ åÇí ÇÎíÑ',
'Show unanswered posts'	=>	'äãÇíÔ ÓÊ åÇí ÈÏæä ÇÓÎ',
'Show your posts'		=>	'äãÇíÔ ÓÊ åÇí ÔãÇ',
'Show subscriptions'	=>	'ÇÑÓÇá åÇíí ßå ÔÑßÊ ÏÇÔÊíÏ',
'Jump to'				=>	'ÈÑæ Èå',
'Go'					=>	' ÈÑæ ',		// submit button in forum jump
'Move topic'			=>  'ÇäÊŞÇá ÊÇíß',
'Open topic'			=>  'ÈÇÒ ßÑÏä ÊÇíß',
'Close topic'			=>  'ÈÓÊä ÊÇíß',
'Unstick topic'			=>  'ÎÑæÌ ÇÒ ãåã',
'Stick topic'			=>  'ãåã',
'Moderate forum'		=>	'ãíÇäíä ÇäÌãä',
'Delete posts'			=>	'Çß ßÑÏä ÊÇíß',
'Debug table'			=>	'ÏÑÓÊ ßÑÏä ÇØáÇÚÇÊ',

// For extern.php RSS feed
'RSS Desc Active'		=>	'ÔãÇ åäæÒ İÚÇáíÊí äÏÇÔÊíÏ RSS ãæÌæÏ äíÓÊ',	// board_title will be appended to this string
'RSS Desc New'			=>	'ÌÏíÏ ÊÑíä ÊÇíß ÏÑ',					// board_title will be appended to this string
'Posted'				=>	'ÇÑÓÇáí'	// The date/time a topic was started

);
ÇäÌãä ÊÎÕÕí ãÇåæÇÑåWWW.PERSIANSAT.NET
