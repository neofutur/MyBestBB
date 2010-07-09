<?php

////////////////////////////////////
//Translate By Koko [Benny Elgazar]
//Icq: 1596119 
//Email:BennyElgazar@Gmail.com
////////////////////////////////////


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'hebrew';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'he_IL.ISO8859-8';
		break;

	default:
		$locale = 'he_IL';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'rtl',	// rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'הפניה שגויאה. הקישור שהעביר אותך לעמוד זה כנראה ואינו נכון.',
'No view'				=>	'אין לך הגישה לצפות בקבוצת דיון זו.',
'No permission'			=>	'אין לך הגישה לצפות בעמוד זה.',
'Bad referrer'			=>	'שגיאה ב HTTP_REFERER.',

// Topic/forum indicators
'New icon'				=>	'יש הודעות חדשות',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'אשכול נעול',
'Redirect icon'			=>	'סנכרן מחדש',

// Miscellaneous
'Announcement'			=>	'הכרזות',
'Options'				=>	'אפשרויות',
'Actions'				=>	'פעולות',
'Submit'				=>	'שלח',	// "name" of submit buttons
'Ban message'			=>	'נחסמת מפעילות בפורום זה.',
'Ban message 2'			=>	'פעילותך תחזור ב',
'Ban message 3'			=>	'המנהלים הראשים חסמו אותך מפעילות במערכת הפורומים מהסיבות הבאות:',
'Ban message 4'			=>	'לכל בעיה או שאלות לגבי החסימה יש לפנות למנהל הראשי בכתובת',
'Never'					=>	'אף פעם',
'Today'					=>	'היום',
'Yesterday'				=>	'אתמול',
'Info'					=>	'מידע',		// a common table header
'Go back'				=>	'חזור אחורה',
'Maintenance'			=>	'תחזוקה',
'Redirecting'			=>	'טוען עמוד',
'Click redirect'		=>	'לחץ כאן אם אין ברצונך להמתין עוד (או אם הדפדפן שלך לא מעביר אותך באופן ישיר)',
'on'					=>	'פעיל',		// as in "BBCode is on"
'off'					=>	'לא פעיל',
'Invalid e-mail'		=>	'כתובת הדואר האלקטרוני שהזנת אינה תקינה.',
'required field'		=>	'הוא שדה דרוש בטופס.',	// for javascript form validation
'Last post'				=>	'הודעה אחרונה',
'by'					=>	'על ידי',	// as in last post by someuser
'New posts'				=>	'חדש&nbsp;הודעות',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'עבור להודעה הראשונה באשכול.',	// the popup text for new posts links
'Username'				=>	'שם משתמש',
'Password'				=>	'סיסמה',
'E-mail'				=>	'דואר אלקטרוני',
'Send e-mail'			=>	'שלח הודעה לדואר האלקטרוני',
'Moderated by'			=>	'מנוהל ע"י',
'Registered'			=>	'רשומים',
'Subject'				=>	'נושא',
'Message'				=>	'הודעה',
'Topic'					=>	'אשכול',
'Forum'					=>	'קבוצות דיון',
'Posts'					=>	'הודעות',
'Replies'				=>	'תגובות',
'Author'				=>	'כותב',
'Pages'					=>	'עמודים',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'תאג התמונה',
'Smilies'				=>	'מחווה',
'and'					=>	'ו',
'Image link'			=>	'תמונה',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'כתב',	// For [quote]'s
'Code'					=>	'קוד',		// For [code]'s
'Mailer'				=>	'מיילר',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'מידע חשוב',
'Write message legend'	=>	'כתוב את הודעתך ושלח',

// Title
'Title'					=>	'שם',
'Member'				=>	'חבר',	// Default title
'Moderator'				=>	'מנהל',
'Administration'			=>	'מנהל ראשי',
'Banned'				=>	'חסום',
'Guest'					=>	'אורח',

// Stuff for include/parser.php
'BBCode error'			=>	'The BBCode syntax in the message is incorrect.',
'BBCode error 1'		=>	'חסר תאג ההתחלה ל [/quote].',
'BBCode error 2'		=>	'חסר תאג הסיום ל [code].',
'BBCode error 3'		=>	'חסר תאג ההתחלה ל [/code].',
'BBCode error 4'		=>	'חסר תאג אחד או יותר ל [quote].',
'BBCode error 5'		=>	'חסר תאג אחד או יותר ל [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'עמוד ראשי',
'User list'				=>	'רשימת משתמשים',
'Rules'					=>  'חוקים',
'Search'				=>  'חיפוש',
'Register'				=>  'הרשמה',
'Login'					=>  'התחבר',
'Not logged in'			=>  'אינך מחובר למערכת הפורומים.',
'Profile'				=>	'כרטיס אישי',
'Logout'				=>	'התנתק',
'Logged in as'			=>	'מחובר כ',
'Admin'					=>	'ממשק ניהול ראשי',
'Last visit'			=>	'ביקורך האחרון',
'Show new posts'		=>	'הצג הודעות חדשות מאז ביקורי האחרון',
'Mark all as read'		=>	'סמן את כל האשכולות כנקראו',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'זכויות הפורום',
'Search links'			=>	'קישורי חיפוש',
'Show recent posts'		=>	'הצג הודעות חדשות',
'Show unanswered posts'	=>	'הצג הודעות ללא מענה',
'Show your posts'		=>	'הצג את כל הודעותי',
'Show subscriptions'	=>	'הצג את ההודעות שאני עוקב אחריהם',
'Jump to'				=>	'עבור לקבוצת הדיון',
'Go'					=>	' עבור ',		// submit button in forum jump
'Move topic'			=>  'העבר אשכול',
'Open topic'			=>  'פתח אשכול',
'Close topic'			=>  'נעל אשכול',
'Unstick topic'			=>  'בטל נעיצת אשכול',
'Stick topic'			=>  'נעץ אשכול',
'Moderate forum'		=>	'נהל קבוצת דיון',
'Delete posts'			=>	'הסרה של יותר מהודעה אחת בו זמנית',
'Debug table'			=>	'מידע חיפוש גיאות',

// For extern.php RSS feed
'RSS Desc Active'		=>	'האשכולות החדשים הפעילים ביותר כ',	// board_title will be appended to this string
'RSS Desc New'			=>	'האשכולות החדשים כ',					// board_title will be appended to this string
'Posted'				=>	'נשלח'	// The date/time a topic was started

);
