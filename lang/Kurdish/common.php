<?php
//Kurdish Translation of Punbb by Aso Naderi @ www.all4kurds.net

// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'kurdish';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'ku_KU.KU-utf-8';
		break;

	default:
		$locale = 'ku_KU';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'rtl',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'داواكاری هه‌ڵه‌، به‌سته‌ری ویستراو هه‌ڵه‌یه‌ یان سڕاوه‌ته‌وه‌.',
'No view'				=>	'ڕێگه‌ت پینه‌دراوه‌ ئه‌م مه‌كۆیه‌ چاو لێبكه‌ی.',
'No permission'			=>	'ڕێگه‌ت پێنه‌دراوه‌ ئه‌م په‌ڕه‌یه‌ ببینی.',
'Bad referrer'			=>	'HTTP_REFERER هه‌ڵه‌. تۆ ڕه‌وانه‌ی ئه‌م په‌ڕه‌یه‌ كراوی له‌ سه‌رچاوه‌یه‌كی نه‌ناسراوه‌وه‌، ئه‌گه‌ر هه‌ڵه‌كه‌ وه‌ك خۆی مایه‌وه، تكایه‌ دڵنیا به‌ \'به‌سته‌ری ئه‌سڵی\' دروست دانراوه‌ له‌به‌شی به‌ڕێوه‌به‌رایه‌تی مه‌كۆدا.',

// Topic/forum indicators
'New icon'				=>	'هیچ په‌یام نیه‌',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'ئه‌م بابه‌ته‌ داخراوه‌',
'Redirect icon'			=>	'Redirected forum',

// Miscellaneous
'Announcement'			=>	'ئاگاداری',
'Options'				=>	'هه‌ڵبژاردنه‌كان',
'Actions'				=>	'فرمانه‌كان',
'Submit'				=>	'ناردن',	// "name" of submit buttons
'Ban message'			=>	'تۆ ده‌ركراوی له‌م مه‌كۆیه‌.',
'Ban message 2'			=>	'كاتی ده‌ركردنه‌كه‌ت له‌ كۆتایی ئه‌م كاته‌دا ته‌واو ده‌بێت',
'Ban message 3'			=>	'به‌ڕێوه‌به‌ر یان چاوه‌دێری كه‌ ده‌ری كردووی، ئه‌م په‌یامه‌ی بۆ نووسیووی:',
'Ban message 4'			=>	'تكایه‌ له‌گه‌ڵ به‌دی كردنی هه‌ر جۆره‌ شتێكی نائاسایی، به‌ڕێوه‌به‌ری مه‌كۆ ئه‌گادار بكه‌وه‌',
'Never'					=>	'هیچ كاتێك',
'Today'					=>	'ئه‌مڕۆ',
'Yesterday'				=>	'دوێنێ',
'Info'					=>	'زانیاری',		// a common table header
'Go back'				=>	'گه‌ڕانه‌وه‌',
'Maintenance'			=>	'چاك كاری',
'Redirecting'			=>	'چاوه‌ڕوانبه‌',
'Click redirect'		=>	'ئێره‌ كرته‌ بكه‌ گه‌ر ناته‌وێ زۆرتر چاوه‌ڕوانبی، یان وێبگه‌ڕه‌كه‌ت پاڵپشتی گواستنه‌وه‌ی خۆكار ناكات',
'on'					=>	'چالاكه‌',		// as in "BBCode is on"
'off'					=>	'چالاك نیه‌',
'Invalid e-mail'		=>	'ئه‌و پۆستی ئه‌له‌كترۆنیه‌ی كه‌ نووسیووته‌ هه‌ڵه‌یه‌',
'required field'		=>	'بۆشاییه‌كی پێویسته‌ له‌م فۆرمه‌دا',	// for javascript form validation
'Last post'				=>	'دواترین په‌یام',
'by'					=>	'له‌لایه‌ن',	// as in last post by someuser
'New posts'				=>	'هه‌واڵ و&nbsp;بابه‌ته‌كان',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'بڕۆ یه‌كه‌مین نوێترین په‌یام له‌م بابه‌ته‌دا',	// the popup text for new posts links
'Username'				=>	'نازناو',
'Password'				=>	'وشه‌ی تێپه‌ڕبوون',
'E-mail'				=>	'پۆستی ئه‌له‌كترۆنی',
'Send e-mail'			=>	'پۆستی ئه‌له‌كترۆنی بنێره‌',
'Moderated by'			=>	'چاوه‌دێر',
'Registered'			=>	'ئه‌ندامه‌',
'Subject'				=>	'سه‌ردێڕ',
'Message'				=>	'په‌یام',
'Topic'					=>	'بابه‌ت',
'Forum'					=>	'مه‌كۆ',
'Posts'					=>	'په‌یامه‌كان',
'Replies'				=>	'وه‌ڵامه‌كان',
'Author'				=>	'نووسه‌ر',
'Pages'					=>	'په‌ڕه‌كان',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] تاگی',
'Smilies'				=>	'خه‌نده‌',
'and'					=>	'و',
'Image link'			=>	'وێنه‌',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'نووسی',	// For [quote]'s
'Code'					=>	'كۆد',		// For [code]'s
'Mailer'				=>	'نێره‌ر',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'زانیاری گرنگ',
'Write message legend'	=>	'په‌یامه‌كه‌ت بنووسه‌ و بینێره‌',

// Title
'Title'					=>	'سه‌ردێڕ',
'Member'				=>	'ئه‌ندام',	// Default title
'Moderator'				=>	'چاوه‌دێر',
'Administrator'			=>	'به‌ڕێوه‌به‌ر',
'Banned'				=>	'ده‌ركراو‌',
'Guest'					=>	'میوان',

// Stuff for include/parser.php
'BBCode error'			=>	'هه‌ڵه‌یه‌ك هه‌له‌ له‌ BBCODE ـه‌كانی به‌كاربراو له‌م په‌یامه‌دا',
'BBCode error 1'		=>	'كۆدی ده‌ستپیكرنی نیه‌ بۆ [/quote].',
'BBCode error 2'		=>	'كۆدی داخستن نیه‌ بۆ [code].',
'BBCode error 3'		=>	'كۆدی ده‌ستپیكرنی نیه‌ بۆ [/code].',
'BBCode error 4'		=>	'كۆدی داخستن نیه‌ بۆ [quote].',
'BBCode error 5'		=>	'كۆدی ده‌ستپیكرنی نیه‌ بۆ [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'سه‌ره‌تا',
'User list'				=>	'ئه‌ندامان',
'Rules'					=>  'یاساكانی مه‌كۆ',
'Search'				=>  'گه‌ڕان',
'Register'				=>  'به‌ ئه‌ندامبوون',
'Login'					=>  'چوونه‌ژووره‌وه‌',
'Not logged in'			=>  'تۆ له‌ ژووره‌وه‌ نیت.',
'Profile'				=>	'زانیاری تاكه‌كه‌سی',
'Logout'				=>	'ده‌رچوون',
'Logged in as'			=>	'هاتوویته‌ ژوورێ وه‌ك',
'Admin'					=>	'به‌ڕێوه‌به‌رایه‌تی',
'Last visit'			=>	'دواترین سه‌ردان',
'Show new posts'		=>	'نوێترین په‌یامه‌ نووسراوه‌كانی پاش دواترین سه‌ردانم پیشان بده‌',
'Mark all as read'		=>	'هه‌موو بابه‌ته‌كان وه‌ك خوێندراوه‌ دیاری بكه‌',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'خوارووی مه‌كۆ',
'Search links'			=>	'به‌سته‌ره‌كانی گه‌ڕان',
'Show recent posts'		=>	'پیشاندانی دواترین په‌یامه‌كان',
'Show unanswered posts'	=>	'پیشاندانی بابه‌ته‌ بێ وه‌ڵامه‌كان',
'Show your posts'		=>	'پیشاندانی په‌یامه‌كانی خۆم',
'Show subscriptions'	=>	'بابه‌ته‌ هه‌ڵبژێردراوه‌كانت پیشان بده‌',
'Jump to'				=>	'بڕۆ بۆ',
'Go'					=>	' بڕۆ ',		// submit button in forum jump
'Move topic'			=>  'بیگوازه‌وه‌',
'Open topic'			=>  'بابه‌ت بكه‌وه‌',
'Close topic'			=>  'بابه‌ت دابخه‌',
'Unstick topic'			=>  'بابه‌ت له‌ لكێندراو ده‌ربێنه‌',
'Stick topic'			=>  'بابه‌ت لكێندراو بكه‌',
'Moderate forum'		=>	'چاوه‌دێری مه‌كۆ',
'Delete posts'			=>	'په‌یامه‌ دووباره‌كان بسڕه‌وه‌',
'Debug table'			=>	'زانیاری',

// For extern.php RSS feed
'RSS Desc Active'		=>	'چالاكترین بابه‌ت له‌',	// board_title will be appended to this string
'RSS Desc New'			=>	'نوێترین بابه‌ت له‌',					// board_title will be appended to this string
'Posted'				=>	'نێردرا'	// The date/time a topic was started

);
