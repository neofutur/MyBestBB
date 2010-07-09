<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'slovenian';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'sl_SI.ISO8859-2';
		break;

	default:
		$locale = 'sl_SI';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'smer pisanja jezika',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'Napaèna zahteva. Povazava je nepravilna ali je èasovno ¾e pretekla.',
'No view'				=>	'Nima¹ dovoljenja za ogled forumov.',
'No permission'			=>	'Nima¹ dovoljenja za dostop do te strani.',
'Bad referrer'			=>	'Napaèna zahteva. Zahteva prihaja iz neavtoriziranega vira. Èe problem ne popusti preveri èe je pravilno nastavljen \'Base URL\' v Admin/Opcije in èe dostopa¹ do foruma s tem URL nalovom. Veè informacij najdi v PunBB dokumentaciji.',

// Topic/forum indicators
'New icon'				=>	'Tukaj so nove objave',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Ta tema je zaprta',
'Redirect icon'			=>	'Forum je preusmerjen ',

// Miscellaneous
'Announcement'			=>	'Posebno obvestilo',
'Options'				=>	'Opcije',
'Actions'				=>	'Dejanje',
'Submit'				=>	'Po¹lji',	// "name" of submit buttons
'Ban message'			=>	'Do tega foruma ima¹ prepoved dostopa.',
'Ban message 2'			=>	'Prepoved poteèe konec',
'Ban message 3'			=>	'Administrator oziroma moderator, ki ti je prepovedal dostop ti je pustil naslednje sporoèilo:',
'Ban message 4'			=>	'Prosim po¹lji vpra¹anje administratorju foruma na',
'Never'					=>	'Nikoli',
'Today'					=>	'Danes',
'Yesterday'				=>	'Vèeraj',
'Info'					=>	'Informacija',		// a common table header
'Go back'				=>	'Nazaj',
'Maintenance'			=>	'Vzdr¾evanje',
'Redirecting'			=>	'Preusmerjanje',
'Click redirect'		=>	'Klikni sem, èe noèe¹ èakati (ali èe te brskalnik ni avtomatsko preusmeril)',
'on'					=>	'vkljuèeno',		// as in "BBCode is on"
'off'					=>	'izkljuèeno',
'Invalid e-mail'		=>	'Vne¹en e-po¹tni naslov ni pravilen.',
'required field'		=>	'zahtevano polje v obrazcu.',	// for javascript form validation
'Last post'				=>	'Zadnja objava',
'by'					=>	'',	// as in last post by someuser
'New posts'				=>	'Nove&nbsp;objave',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Pojdi na prvo novo objavo v tej temi.',	// the popup text for new posts links
'Username'				=>	'Uporabni¹ko ime',
'Password'				=>	'Geslo',
'E-mail'				=>	'e-po¹tni naslov',
'Send e-mail'			=>	'Po¹lji e-po¹to',
'Moderated by'			=>	'Moderira',
'Registered'			=>	'Registriran',
'Subject'				=>	'Naslov sporoèila',
'Message'				=>	'Telo sporoèila',
'Topic'					=>	'Tema',
'Forum'					=>	'Forum',
'Posts'					=>	'Objav',
'Replies'				=>	'Odgovori',
'Author'				=>	'Avtor',
'Pages'					=>	'Strani',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] oznaka',
'Smilies'				=>	'Sme¹ki',
'and'					=>	'in',
'Image link'			=>	'slika',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'je napisal',	// For [quote]'s
'Code'					=>	'Koda',		// For [code]'s
'Mailer'				=>	'Adresar',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Pomembne informacije',
'Write message legend'	=>	'Napi¹i sporoèilo in po¹lji',

// Title
'Title'					=>	'Naslov',
'Member'				=>	'Èlan',	// Default title
'Moderator'				=>	'Moderator',
'Administrator'			=>	'Administrator',
'Banned'				=>	'Prepovedan',
'Guest'					=>	'Gost',

// Stuff for include/parser.php
'BBCode error'			=>	'Sintaksa BBCode v tem sporoèilu je napaèna.',
'BBCode error 1'		=>	'Napaèna zaèetna oznaka za [/quote].',
'BBCode error 2'		=>	'Napaèna konèna oznaka za [code].',
'BBCode error 3'		=>	'Napaèna zaèetna oznaka za  [/code].',
'BBCode error 4'		=>	'Manjka ena ali veè oznak za  [quote].',
'BBCode error 5'		=>	'Manjka ena ali veè zaèetnih oznak za  [quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Indeks',
'User list'				=>	'Seznam uporabnikov',
'Rules'					=>  'Pravila',
'Search'				=>  'Iskanje',
'Register'				=>  'Registracija',
'Login'					=>  'Prijava',
'Not logged in'			=>  'Nisi prijavljen.',
'Profile'				=>	'Profil',
'Logout'				=>	'Odjava',
'Logged in as'			=>	'Prijavljen kot',
'Admin'					=>	'Administracija',
'Last visit'			=>	'Zadnji obisk',
'Show new posts'		=>	'Prika¾i nove objave od zadnjega obiska',
'Mark all as read'		=>	'Oznaèi vse teme kot prebrane',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Noga deske',
'Search links'			=>	'Išèi povezave',
'Show recent posts'		=>	'Prika¾i novej¹e objave ',
'Show unanswered posts'	=>	'Prika¾i neodgovorjene objave',
'Show your posts'		=>	'Prika¾i moje objave',
'Show subscriptions'	=>	'Prika¾i naroèene teme',
'Jump to'				=>	'Pojdi na',
'Go'					=>	'Pojdi',		// submit button in forum jump
'Move topic'			=>  'Premakni temo',
'Open topic'			=>  'Odpri temo',
'Close topic'			=>  'Zapri temo',
'Unstick topic'			=>  'Odlepi temo',
'Stick topic'			=>  'Prilepi temo',
'Moderate forum'		=>	'Moderiraj forum',
'Delete posts'			=>	'Izbri¹i objave',
'Debug table'			=>	'Informacije za razhro¹èevanje',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Novej¹e  aktivne teme',	// board_title will be appended to this string
'RSS Desc New'			=>	'Najnovej¹e teme',					// board_title will be appended to this string
'Posted'				=>	'Poslano'	// The date/time a topic was started

);
