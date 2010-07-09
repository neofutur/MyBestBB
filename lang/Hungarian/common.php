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
'Bad request'			=>	'Rossz k�relem. A k�vetett hivatkoz�s hib�s vagy elavult.',
'No view'				=>	'Nincs enged�lyed ezeknek a f�rumoknak a megtekint�s�re.',
'No permission'			=>	'Nincs enged�lyed ennek a lapnak a megjelen�t�s�re.',
'Bad referrer'			=>	'Rossz HTTP_REFERER. Egy �rv�nytelen forr�st�l k�ldtek erre a lapra. Ha a probl�ma tov�bbra is fenn�ll, ellen�rizd, hogy a \'Base URL\' helyesen van be�ll�tva az Admin/Be�ll�t�sok �s hogy a f�rumot a be�ll�tott c�mr�l l�togatod. Tov�bbi inform�ci� a forr�sokr�l a PunBB dokument�ci�ban tal�lhat� meg.',

// Topic/forum indicators
'New icon'				=>	'Nincs �j �zenet',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Lez�rt t�ma',
'Redirect icon'			=>	'�tir�ny�tott f�rum',

// Miscellaneous
'Announcement'			=>	'Hirdetm�ny',
'Options'				=>	'Be�ll�t�sok',
'Actions'				=>	'M�veletek',
'Submit'				=>	'Elk�ld�s',	// "name" of submit buttons
'Ban message'			=>	'Ki vagy tiltva err�l a f�rumr�l.',
'Ban message 2'			=>	'A tilt�s lej�r a h�nap v�g�n: ',
'Ban message 3'			=>	'Az adminisztr�tor vagy moder�toroder, aki kitiltott, a k�vetkez� �zenetet hagyta:',
'Ban message 4'			=>	'Ha k�rd�sed van, �rdekl�dj a f�rum adminisztr�torn�l: ',
'Never'					=>	'Soha',
'Today'					=>	'Ma',
'Yesterday'				=>	'Tegnap',
'Info'					=>	'Inf�',		// a common table header
'Go back'				=>	'Vissza',
'Maintenance'			=>	'Karbantart�s',
'Redirecting'			=>	'�tir�ny�t�s',
'Click redirect'		=>	'Kattints ide, ha nem akarsz tov�bb v�rni (vagy ha a b�ng�sz�d nem tov�bb�t automatikusan)',
'on'					=>	'be',		// as in "BBCode is on"
'off'					=>	'ki',
'Invalid e-mail'		=>	'A megadott e-mail c�m �rv�nytelen.',
'required field'		=>	'egy sz�ks�ges mez� ezen az �rlapon.',	// for javascript form validation
'Last post'				=>	'Utols� �zenet',
'by'					=>	'�rta',	// as in last post by someuser
'New posts'				=>	'�j&nbsp;�zenetek',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'A f�rum els� �j �zenete.',	// the popup text for new posts links
'Username'				=>	'Felhaszn�l�n�v',
'Password'				=>	'Jelsz�',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'E-mail k�ld�se',
'Moderated by'			=>	'Moder�lva: ',
'Registered'			=>	'Regisztr�lt',
'Subject'				=>	'C�m',
'Message'				=>	'�zenet',
'Topic'					=>	'T�ma',
'Forum'					=>	'F�rum',
'Posts'					=>	'�zenetek',
'Replies'				=>	'V�laszok',
'Author'				=>	'K�sz�t�',
'Pages'					=>	'Lapok',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] c�mke',
'Smilies'				=>	'Mosolyg�k',
'and'					=>	'�s',
'Image link'			=>	'k�p',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'�rta',	// For [quote]'s
'Code'					=>	'K�d',		// For [code]'s
'Mailer'				=>	'Levelez�',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Fontos inform�ci�',
'Write message legend'	=>	'�rd meg �zeneted �s k�ldd el',

// Title
'Title'					=>	'C�m',
'Member'				=>	'Tag',	// Default title
'Moderator'				=>	'Moder�tor',
'Administrator'			=>	'Adminisztr�tor',
'Banned'				=>	'Tiltott',
'Guest'					=>	'Vend�g',

// Stuff for include/parser.php
'BBCode error'			=>	'A BBCode kifejez�s az �zenetben helytelen.',
'BBCode error 1'		=>	'Hi�nyz� kezd�c�mke a [/quote]-hoz.',
'BBCode error 2'		=>	'Hi�nyz� z�r�c�mke a [code]-hoz.',
'BBCode error 3'		=>	'Hi�nyz� kezd�c�mke a [/code]-hoz.',
'BBCode error 4'		=>	'Hi�nyzik egy vagy t�bb z�r�c�mke a [quote]-hoz.',
'BBCode error 5'		=>	'Hi�nyzik egy vagy t�bb kezd�c�mke a [/quote]-hoz.',

// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Felhaszn�l�k',
'Rules'					=>  'Szab�lyok',
'Search'				=>  'Keres�s',
'Register'				=>  'Regisztr�ci�',
'Login'					=>  'Bel�p�s',
'Not logged in'			=>  'Nem vagy bel�pve.',
'Profile'				=>	'Profil',
'Logout'				=>	'Kil�p�s',
'Logged in as'			=>	'Bel�pve mint',
'Admin'					=>	'Adminisztr�ci�',
'Last visit'			=>	'Utolj�ra bel�pve',
'Show new posts'		=>	'Utols� bel�p�s �ta �rt �zenetek mutat�sa',
'Mark all as read'		=>	'�sszes t�ma olvasottk�nt megjel�l�se',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'F�rum l�bl�c',
'Search links'			=>	'Linkek keres�se',
'Show recent posts'		=>	'�j �zenetek',
'Show unanswered posts'	=>	'Megv�laszolatlan �zenetek',
'Show your posts'		=>	'Saj�t �zenetek',
'Show subscriptions'	=>	'Figyelt t�m�k megjelen�t�se',
'Jump to'				=>	'Ugr�s: ',
'Go'					=>	' Ugr�s ',		// submit button in forum jump
'Move topic'			=>  'T�ma �thelyez�se',
'Open topic'			=>  'T�ma kinyit�sa',
'Close topic'			=>  'T�ma lez�r�sa',
'Unstick topic'			=>  'Kiemelts�g megsz�ntet�se',
'Stick topic'			=>  'T�ma kiemel�se',
'Moderate forum'		=>	'F�rum moder�l�sa',
'Delete posts'			=>	'T�bbsz�r�s �zenetek t�rl�se',
'Debug table'			=>	'Hibakeres�si inform�ci�',

// For extern.php RSS feed
'RSS Desc Active'		=>	'A legutolj�ra ak�tv t�m�k itt:',	// board_title will be appended to this string
'RSS Desc New'			=>	'A leg�jabb t�m�k itt:',					// board_title will be appended to this string
'Posted'				=>	'Elk�ldve'	// The date/time a topic was started

);
