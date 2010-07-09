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
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'Nevareizs piepras�jums. Saite vai nu ir ievad�ta nekorekti vai sen vairs neeksist�.',
'No view'				=>	'Tev nav ties�bu las�t �os forumus',
'No permission'			=>	'Tev nav ties�bas piek�ut �ai lapai',
'Bad referrer'			=>	'Neder�gs HTTP_REFERER. Tu atn�ci uz �o lapu no neautoriz�tas lapas. Ja probl�ma atk�rtojas, p�rliecinies ka zem Admin/Iestat�jumi \'B�zes URL\' ir pareizi iest�d�ts, un tu apmekl�jat forumu ejot uz to pa�u adresi. Pla��ka inform�cija par nos�t�t�ju (Referer) pieejama PunBB dokument�cij�.',

// Topic/forum indicators
'New icon'				=>	'Ir jauni koment�ri',
'Normal icon'			=>	'',
'Closed icon'			=>	'Temats ir sl�gts',
'Redirect icon'			=>	'P�radres�ts forums',

// Miscellaneous
'Announcement'			=>	'Pazi�ojums',
'Options'				=>	'Perosn�gie iestat�jumi',
'Actions'				=>	'Darb�bas',
'Submit'				=>	'Nos�t�t',	// "name" of submit buttons
'Ban message'			=>	'Tu esi izraid�ts no �� foruma.',
'Ban message 2'			=>	'Izraid�jums beigsies p�c',
'Ban message 3'			=>	'Administrators vai moderators kas tevi izraid�ja, atst�ja tev sekojo�u pazi�ojumu:',
'Ban message 4'			=>	'Ar s�dz�b�m var griezties pie foruma administratora, uz ',
'Never'					=>	'Nekad',
'Today'					=>	'�odien',
'Yesterday'				=>	'Vakar',
'Info'					=>	'Inform�cija',		// a common table header
'Go back'				=>	'Atpaka�',
'Maintenance'			=>	'Apkalpo�ana',
'Redirecting'			=>	'P�radres�cija',
'Click redirect'		=>	'Klik��ini �eit, ja nevari sagaid�t (vai ar�, ja interneta p�rl�kprogramma tevi autom�tiski nep�radres�)',
'on'					=>	'iesl�gts',		// as in "BBCode is on"
'off'					=>	'izsl�gts',
'Invalid e-mail'		=>	'Tava ievad�t� e-pasta adrese nav der�ga.',
'required field'		=>	'oblig�ti aizpild�ms.',	// for javascript form validation
'Last post'				=>	'P�d�jais ieraksts',
'by'					=>	'autors',	// as in last post by someuser
'New posts'				=>	'Jaun�kais ieraksts',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Doties uz t�mas jaun�ko ierakstu.',	// the popup text for new posts links
'Username'				=>	'Lietot�js',
'Password'				=>	'Parole',
'E-mail'				=>	'E-pasts',
'Send e-mail'			=>	'Nos�t�t e-pastu',
'Moderated by'			=>	'P�rbaud�ja',
'Registered'			=>	'Re�istr�ts',
'Subject'				=>	'Temats',
'Message'				=>	'Zi�a',
'Topic'					=>	'T�ma',
'Forum'					=>	'Forums',
'Posts'					=>	'Ieraksti',
'Replies'				=>	'Atbildes',
'Author'				=>	'Autors',
'Pages'					=>	'Lapas',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] elements',
'Smilies'				=>	'Smaidi��',
'and'					=>	'un',
'Image link'			=>	'bilde',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'rakst�ja',	// For [quote]'s
'Code'					=>	'Kods',		// For [code]'s
'Mailer'				=>	'Pastnieks',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Svar�ga inform�cija',
'Write message legend'	=>	'Uzraksti zi�u un nos�ti',

// Title
'Title'					=>	'Grupa',
'Member'				=>	'Dal�bnieks',	// Default title
'Moderator'				=>	'Moderators',
'Administrator'			=>	'Administrators',
'Banned'				=>	'Izraid�ts',
'Guest'					=>	'Viesis',

// Stuff for include/parser.php
'BBCode error'			=>	'�aj� zi�� ir nepareiza BBCode rakst�ba.',
'BBCode error 1'		=>	'Nav s�kuma elements priek� [/quote].',
'BBCode error 2'		=>	'Nav beigu elements priek� [code].',
'BBCode error 3'		=>	'Nav s�kuma elements priek� [/code].',
'BBCode error 4'		=>	'Nav viens vai vair�ki beigu elementi priek� [quote].',
'BBCode error 5'		=>	'Nav viens vai vair�ki s�kuma elementi priek� [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Saturs',
'User list'				=>	'Lietot�ju saraksts',
'Rules'					=>  'Noteikumi',
'Search'				=>  'Mekl�t',
'Register'				=>  'Re�istr�ties',
'Login'					=>  'Ien�kt',
'Not logged in'			=>  'J�s neesat ien�cis.',
'Profile'				=>	'Profils',
'Logout'				=>	'Iziet',
'Logged in as'			=>	'Tu esi ien�cis k�',
'Admin'					=>	'Administratora r�ki',
'Last visit'			=>	'P�d�jais apmekl�jums',
'Show new posts'		=>	'Par�d�t jaunos koment�rus kop� mana p�d�j� apmekl�juma',
'Mark all as read'		=>	'Atz�m�t visus tematus k� izlas�tus',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Zi�ojumu d��a k�jene',
'Search links'			=>	'Mekl�t saites',
'Show recent posts'		=>	'Par�d�t p�d�jos koment�rus',
'Show unanswered posts'	=>	'Par�d�t neatbild�tos koment�rus',
'Show your posts'		=>	'Par�d�t manus koment�rus',
'Show subscriptions'	=>	'Par�d�t tematus uz kuriem es esmu pierakst�jies',
'Jump to'				=>	'Iet uz',
'Go'					=>	'Aiziet ',		// submit button in forum jump
'Move topic'			=>  'P�rvietot t�mu',
'Open topic'			=>  'Uzs�kt t�mu',
'Close topic'			=>  'Sl�gt t�mu',
'Unstick topic'			=>  'Atl�m�t t�mu',
'Stick topic'			=>  'Sal�m�t t�mu',
'Moderate forum'		=>	'Vad�t forumu',
'Delete posts'			=>	'Dz�st vair�kus ierakstus',
'Debug table'			=>	'K��du nov�r�anas inform�cija',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Visakt�v�kie temati iek�',	// board_title will be appended to this string
'RSS Desc New'			=>	'Jaun�kie temati iek�',					// board_title will be appended to this string
'Posted'				=>	'Nos�t�ts'	// The date/time a topic was started

);
