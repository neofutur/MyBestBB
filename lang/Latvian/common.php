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
'Bad request'			=>	'Nevareizs pieprasîjums. Saite vai nu ir ievadîta nekorekti vai sen vairs neeksistç.',
'No view'				=>	'Tev nav tiesîbu lasît ðos forumus',
'No permission'			=>	'Tev nav tiesîbas piekïut ðai lapai',
'Bad referrer'			=>	'Nederîgs HTTP_REFERER. Tu atnâci uz ðo lapu no neautorizçtas lapas. Ja problçma atkârtojas, pârliecinies ka zem Admin/Iestatîjumi \'Bâzes URL\' ir pareizi iestâdîts, un tu apmeklçjat forumu ejot uz to paðu adresi. Plaðâka informâcija par nosûtîtâju (Referer) pieejama PunBB dokumentâcijâ.',

// Topic/forum indicators
'New icon'				=>	'Ir jauni komentâri',
'Normal icon'			=>	'',
'Closed icon'			=>	'Temats ir slçgts',
'Redirect icon'			=>	'Pâradresçts forums',

// Miscellaneous
'Announcement'			=>	'Paziòojums',
'Options'				=>	'Perosnîgie iestatîjumi',
'Actions'				=>	'Darbîbas',
'Submit'				=>	'Nosûtît',	// "name" of submit buttons
'Ban message'			=>	'Tu esi izraidîts no ðî foruma.',
'Ban message 2'			=>	'Izraidîjums beigsies pçc',
'Ban message 3'			=>	'Administrators vai moderators kas tevi izraidîja, atstâja tev sekojoðu paziòojumu:',
'Ban message 4'			=>	'Ar sûdzîbâm var griezties pie foruma administratora, uz ',
'Never'					=>	'Nekad',
'Today'					=>	'Ðodien',
'Yesterday'				=>	'Vakar',
'Info'					=>	'Informâcija',		// a common table header
'Go back'				=>	'Atpakaï',
'Maintenance'			=>	'Apkalpoðana',
'Redirecting'			=>	'Pâradresâcija',
'Click redirect'		=>	'Klikðíini ðeit, ja nevari sagaidît (vai arî, ja interneta pârlûkprogramma tevi automâtiski nepâradresç)',
'on'					=>	'ieslçgts',		// as in "BBCode is on"
'off'					=>	'izslçgts',
'Invalid e-mail'		=>	'Tava ievadîtâ e-pasta adrese nav derîga.',
'required field'		=>	'obligâti aizpildâms.',	// for javascript form validation
'Last post'				=>	'Pçdçjais ieraksts',
'by'					=>	'autors',	// as in last post by someuser
'New posts'				=>	'Jaunâkais ieraksts',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Doties uz tçmas jaunâko ierakstu.',	// the popup text for new posts links
'Username'				=>	'Lietotâjs',
'Password'				=>	'Parole',
'E-mail'				=>	'E-pasts',
'Send e-mail'			=>	'Nosûtît e-pastu',
'Moderated by'			=>	'Pârbaudîja',
'Registered'			=>	'Reìistrçts',
'Subject'				=>	'Temats',
'Message'				=>	'Ziòa',
'Topic'					=>	'Tçma',
'Forum'					=>	'Forums',
'Posts'					=>	'Ieraksti',
'Replies'				=>	'Atbildes',
'Author'				=>	'Autors',
'Pages'					=>	'Lapas',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] elements',
'Smilies'				=>	'Smaidiòð',
'and'					=>	'un',
'Image link'			=>	'bilde',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'rakstîja',	// For [quote]'s
'Code'					=>	'Kods',		// For [code]'s
'Mailer'				=>	'Pastnieks',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Svarîga informâcija',
'Write message legend'	=>	'Uzraksti ziòu un nosûti',

// Title
'Title'					=>	'Grupa',
'Member'				=>	'Dalîbnieks',	// Default title
'Moderator'				=>	'Moderators',
'Administrator'			=>	'Administrators',
'Banned'				=>	'Izraidîts',
'Guest'					=>	'Viesis',

// Stuff for include/parser.php
'BBCode error'			=>	'Ðajâ ziòâ ir nepareiza BBCode rakstîba.',
'BBCode error 1'		=>	'Nav sâkuma elements priekð [/quote].',
'BBCode error 2'		=>	'Nav beigu elements priekð [code].',
'BBCode error 3'		=>	'Nav sâkuma elements priekð [/code].',
'BBCode error 4'		=>	'Nav viens vai vairâki beigu elementi priekð [quote].',
'BBCode error 5'		=>	'Nav viens vai vairâki sâkuma elementi priekð [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Saturs',
'User list'				=>	'Lietotâju saraksts',
'Rules'					=>  'Noteikumi',
'Search'				=>  'Meklçt',
'Register'				=>  'Reìistrçties',
'Login'					=>  'Ienâkt',
'Not logged in'			=>  'Jûs neesat ienâcis.',
'Profile'				=>	'Profils',
'Logout'				=>	'Iziet',
'Logged in as'			=>	'Tu esi ienâcis kâ',
'Admin'					=>	'Administratora rîki',
'Last visit'			=>	'Pçdçjais apmeklçjums',
'Show new posts'		=>	'Parâdît jaunos komentârus kopð mana pçdçjâ apmeklçjuma',
'Mark all as read'		=>	'Atzîmçt visus tematus kâ izlasîtus',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Ziòojumu dçïa kâjene',
'Search links'			=>	'Meklçt saites',
'Show recent posts'		=>	'Parâdît pçdçjos komentârus',
'Show unanswered posts'	=>	'Parâdît neatbildçtos komentârus',
'Show your posts'		=>	'Parâdît manus komentârus',
'Show subscriptions'	=>	'Parâdît tematus uz kuriem es esmu pierakstîjies',
'Jump to'				=>	'Iet uz',
'Go'					=>	'Aiziet ',		// submit button in forum jump
'Move topic'			=>  'Pârvietot tçmu',
'Open topic'			=>  'Uzsâkt tçmu',
'Close topic'			=>  'Slçgt tçmu',
'Unstick topic'			=>  'Atlîmçt tçmu',
'Stick topic'			=>  'Salîmçt tçmu',
'Moderate forum'		=>	'Vadît forumu',
'Delete posts'			=>	'Dzçst vairâkus ierakstus',
'Debug table'			=>	'Kïûdu novçrðanas informâcija',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Visaktîvâkie temati iekð',	// board_title will be appended to this string
'RSS Desc New'			=>	'Jaunâkie temati iekð',					// board_title will be appended to this string
'Posted'				=>	'Nosûtîts'	// The date/time a topic was started

);
