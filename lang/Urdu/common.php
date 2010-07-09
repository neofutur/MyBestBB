<?php

/*
// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'english';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'en_US.US-ASCII';
		break;

	default:
		$locale = 'en_US';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);
*/

// Language definitions for frequently used strings
$lang_common = array(
// Text orientation and encoding
'lang_direction'		=>	'rtl',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'UTF-8',
'lang_multibyte'		=>	true,

// Notices
'Bad request'			=>	'آپ نے غلط ربط کا تعاقب کیا ہے۔',
'No view'				=>	'آپ کے پاس ان فورمز کو دیکھنے کی اجازت نہیں۔',
'No permission'			=>	'آپ کے پاس اس صفحے کو دیکھنے کی اجازت نہیں۔',
'Bad referrer'			=>	'HTTP_REFERER درست نہیں۔ آپ غلط ربط ربط سے پوتے ہوئے ادھر آئے ہیں۔ اگر مسئلہ برقرار رہے تو خیال کریں کہ \'Base URL\' Admin/Options میں درست ہے اور آپ فورم پر ربط کے ذریعے تشریف لا رہے ہیں۔ مزید معلومات کے لیے پن بی بی کی مدد دیکھیں۔',
// Topic/forum indicators
'New icon'				=>	'نئی پوسٹ موجود ہیں',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'موضوع بند ہے',
'Redirect icon'			=>	'Redirected forum',

// Miscellaneous
'Announcement'			=>	'اعلان',
'Options'				=>	'اختیارات',
'Actions'				=>	'حرکات',
'Submit'				=>	'بھیجیں',	// "name" of submit buttons
'Ban message'			=>	'آپ اس فورم پر بین ہیں۔',
'Ban message 2'			=>	'بین ختم ہوگا: ',
'Ban message 3'			=>	'آپ کے بین کرنے کی وجہ کچھ یوں ہے:',
'Ban message 4'			=>	'فورم کے منتظم سے اپنے سوالات یہاں بھیجیں: ',
'Never'					=>	'کبھی نہیں',
'Today'					=>	'آج',
'Yesterday'				=>	'کل',
'Info'					=>	'معلومات',		// a common table header
'Go back'				=>	'واپس جائیں',
'Maintenance'			=>	'Maintenance',
'Redirecting'			=>	'منتقل کیا جا رہا ہے',
'Click redirect'		=>	'فوراً منتقل ہوجانےکے لیے یہاں کلک کریں',
'on'					=>	'آن',		// as in "BBCode is on"
'off'					=>	'آف',
'Invalid e-mail'		=>	'ای میل پتہ درست نہیں۔',
'required field'		=>	'فارم کا ضروری خانہ ہے۔',	// for javascript form validation
'Last post'				=>	'آخری مراسلہ',
'by'					=>	'منجانب',	// as in last post by someuser
'New posts'				=>	'نئے&nbsp;مراسلات',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'اس موضوع کے پہلے نئے مراسلے پر جائیں۔',	// the popup text for new posts links
'Username'				=>	'یوزر نیم',
'Password'				=>	'پاس ورڈ',
'E-mail'				=>	'ای میل',
'Send e-mail'			=>	'ای میل بھیجیں',
'Moderated by'			=>	'ماڈریٹ کرنے والے',
'Registered'			=>	'رجسٹر ہوئے',
'Subject'				=>	'عنوان',
'Message'				=>	'پیغام',
'Topic'					=>	'موضوع',
'Forum'					=>	'فورم',
'Posts'					=>	'مراسلات',
'Replies'				=>	'جوابات',
'Author'				=>	'لکھاری',
'Pages'					=>	'صفحات',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'سمائیلیز',
'and'					=>	'اور',
'Image link'			=>	'تصویر',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'نے لکھا',	// For [quote]'s
'Code'					=>	'کوڈ',		// For [code]'s
'Mailer'				=>	'',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'اہم معلومات',
'Write message legend'	=>	'اپنا پیغام لکھیے اور بھیجیے',

// Title
'Title'					=>	'عنوان',
'Member'				=>	'ممبر',	// Default title
'Moderator'				=>	'ماڈریٹر',
'Administrator'			=>	'منتظم',
'Banned'				=>	'بین شدہ',
'Guest'					=>	'مہمان',

// Stuff for include/parser.php
'BBCode error'			=>	'پیغام میں BBCode کا انداز درست نہیں۔',
'BBCode error 1'		=>	'شروعاتی ٹیگ موجود نہیں برائے [/quote]۔',
'BBCode error 2'		=>	'اختتامی ٹیگ موجود نہیں برائے [code]۔',
'BBCode error 3'		=>	'شروعاتی ٹیگ موجود نہیں برائے [/code]۔',
'BBCode error 4'		=>	'ایک یا ایک سے زائد اختتامی ٹیگ موجود نہیں برائے [quote]۔',
'BBCode error 5'		=>	'ایک یا ایک سے زائد شروعاتی ٹیگ موجود نہیں برائے [/quote]۔',

// Stuff for the navigator (top of every page)
'Index'					=>	'فہرست',
'User list'				=>	'یوزر کی لسٹ',
'Rules'					=>  'قواعد',
'Search'				=>  'تلاش',
'Register'				=>  'رجسٹر',
'Login'					=>  'لاگ ان',
'Not logged in'			=>  'آپ لاگ ان نہیں۔',
'Profile'				=>	'پروفائل',
'Logout'				=>	'لاگ آؤٹ',
'Logged in as'			=>	'لاگ ان: ',
'Admin'					=>	'نظامت',
'Last visit'			=>	'آخری پیشی',
'Show new posts'		=>	'آخری پیشی کے بعد کے مراسلات دکھائیں',
'Mark all as read'		=>	'تمام موضوعات کو پڑھا ہوا کریں',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Board footer',
'Search links'			=>	'روابط کو تلاش کریں',
'Show recent posts'		=>	'حالیہ مراسلات دکھائیں',
'Show unanswered posts'	=>	'بغیر جواب کے مراسلات دکھائیں',
'Show your posts'		=>	'میرے مراسلات دکھائیں',
'Show subscriptions'	=>	'فہرست میں شامل موضوعات دکھائیں',
'Jump to'				=>	'چھلانگ برائے: ',
'Go'					=>	' جاؤ ',		// submit button in forum jump
'Move topic'			=>  'موضوع کو منتقل کریں',
'Open topic'			=>  'موضوع کھولیں',
'Close topic'			=>  'موضوع بند کریں',
'Unstick topic'			=>  'موضوع کی چپکاہٹ ختم کریں',
'Stick topic'			=>  'موضوع کو چپکائیں',
'Moderate forum'		=>	'فورم ماڈریٹ کریں',
'Delete posts'			=>	'کئی مراسلات ایک ساتھ ختم کریں',
'Debug table'			=>	'ڈی بگنگ کی معلومات',

// For extern.php RSS feed
'RSS Desc Active'		=>	'حالیہ متحرک موضوعات برائے',	// board_title will be appended to this string
'RSS Desc New'			=>	'نئے موضوعات برائے بورڈ',					// board_title will be appended to this string
'Posted'				=>	'مراسلہ موصول ہوا: '	// The date/time a topic was started

);
