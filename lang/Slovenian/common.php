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
'Bad request'			=>	'Napa�na zahteva. Povazava je nepravilna ali je �asovno �e pretekla.',
'No view'				=>	'Nima� dovoljenja za ogled forumov.',
'No permission'			=>	'Nima� dovoljenja za dostop do te strani.',
'Bad referrer'			=>	'Napa�na zahteva. Zahteva prihaja iz neavtoriziranega vira. �e problem ne popusti preveri �e je pravilno nastavljen \'Base URL\' v Admin/Opcije in �e dostopa� do foruma s tem URL nalovom. Ve� informacij najdi v PunBB dokumentaciji.',

// Topic/forum indicators
'New icon'				=>	'Tukaj so nove objave',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Ta tema je zaprta',
'Redirect icon'			=>	'Forum je preusmerjen ',

// Miscellaneous
'Announcement'			=>	'Posebno obvestilo',
'Options'				=>	'Opcije',
'Actions'				=>	'Dejanje',
'Submit'				=>	'Po�lji',	// "name" of submit buttons
'Ban message'			=>	'Do tega foruma ima� prepoved dostopa.',
'Ban message 2'			=>	'Prepoved pote�e konec',
'Ban message 3'			=>	'Administrator oziroma moderator, ki ti je prepovedal dostop ti je pustil naslednje sporo�ilo:',
'Ban message 4'			=>	'Prosim po�lji vpra�anje administratorju foruma na',
'Never'					=>	'Nikoli',
'Today'					=>	'Danes',
'Yesterday'				=>	'V�eraj',
'Info'					=>	'Informacija',		// a common table header
'Go back'				=>	'Nazaj',
'Maintenance'			=>	'Vzdr�evanje',
'Redirecting'			=>	'Preusmerjanje',
'Click redirect'		=>	'Klikni sem, �e no�e� �akati (ali �e te brskalnik ni avtomatsko preusmeril)',
'on'					=>	'vklju�eno',		// as in "BBCode is on"
'off'					=>	'izklju�eno',
'Invalid e-mail'		=>	'Vne�en e-po�tni naslov ni pravilen.',
'required field'		=>	'zahtevano polje v obrazcu.',	// for javascript form validation
'Last post'				=>	'Zadnja objava',
'by'					=>	'',	// as in last post by someuser
'New posts'				=>	'Nove&nbsp;objave',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Pojdi na prvo novo objavo v tej temi.',	// the popup text for new posts links
'Username'				=>	'Uporabni�ko ime',
'Password'				=>	'Geslo',
'E-mail'				=>	'e-po�tni naslov',
'Send e-mail'			=>	'Po�lji e-po�to',
'Moderated by'			=>	'Moderira',
'Registered'			=>	'Registriran',
'Subject'				=>	'Naslov sporo�ila',
'Message'				=>	'Telo sporo�ila',
'Topic'					=>	'Tema',
'Forum'					=>	'Forum',
'Posts'					=>	'Objav',
'Replies'				=>	'Odgovori',
'Author'				=>	'Avtor',
'Pages'					=>	'Strani',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] oznaka',
'Smilies'				=>	'Sme�ki',
'and'					=>	'in',
'Image link'			=>	'slika',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'je napisal',	// For [quote]'s
'Code'					=>	'Koda',		// For [code]'s
'Mailer'				=>	'Adresar',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Pomembne informacije',
'Write message legend'	=>	'Napi�i sporo�ilo in po�lji',

// Title
'Title'					=>	'Naslov',
'Member'				=>	'�lan',	// Default title
'Moderator'				=>	'Moderator',
'Administrator'			=>	'Administrator',
'Banned'				=>	'Prepovedan',
'Guest'					=>	'Gost',

// Stuff for include/parser.php
'BBCode error'			=>	'Sintaksa BBCode v tem sporo�ilu je napa�na.',
'BBCode error 1'		=>	'Napa�na za�etna oznaka za [/quote].',
'BBCode error 2'		=>	'Napa�na kon�na oznaka za [code].',
'BBCode error 3'		=>	'Napa�na za�etna oznaka za  [/code].',
'BBCode error 4'		=>	'Manjka ena ali ve� oznak za  [quote].',
'BBCode error 5'		=>	'Manjka ena ali ve� za�etnih oznak za  [quote].',

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
'Show new posts'		=>	'Prika�i nove objave od zadnjega obiska',
'Mark all as read'		=>	'Ozna�i vse teme kot prebrane',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Noga deske',
'Search links'			=>	'I��i povezave',
'Show recent posts'		=>	'Prika�i novej�e objave ',
'Show unanswered posts'	=>	'Prika�i neodgovorjene objave',
'Show your posts'		=>	'Prika�i moje objave',
'Show subscriptions'	=>	'Prika�i naro�ene teme',
'Jump to'				=>	'Pojdi na',
'Go'					=>	'Pojdi',		// submit button in forum jump
'Move topic'			=>  'Premakni temo',
'Open topic'			=>  'Odpri temo',
'Close topic'			=>  'Zapri temo',
'Unstick topic'			=>  'Odlepi temo',
'Stick topic'			=>  'Prilepi temo',
'Moderate forum'		=>	'Moderiraj forum',
'Delete posts'			=>	'Izbri�i objave',
'Debug table'			=>	'Informacije za razhro��evanje',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Novej�e  aktivne teme',	// board_title will be appended to this string
'RSS Desc New'			=>	'Najnovej�e teme',					// board_title will be appended to this string
'Posted'				=>	'Poslano'	// The date/time a topic was started

);
