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
'Bad request'			=>	'Ooops. Otkud Vi spadoste?',
'No view'				=>	'Nemate ovla�tenja za slijede�e kategorije.',
'No permission'			=>	'Nemate ovla�tenja.',
'Bad referrer'			=>	'Lo� HTTP_REFERER. Provjerite u Admin - Opcije URL foruma.',

// Topic/forum indicators
'New icon'				=>	'Postoje novi komentari',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Ova tema je zatvorena',
'Redirect icon'			=>	'Kategorija je preusmjerena',

// Miscellaneous
'Announcement'			=>	'Blic!',
'Options'				=>	'Opcije',
'Actions'				=>	'Akcije',
'Submit'				=>	'Potvrda',	// "name" of submit buttons
'Ban message'			=>	'Vi ste izba�eni s foruma.',
'Ban message 2'			=>	'Zabrana Vam isti�e tek',
'Ban message 3'			=>	'Razlog Va�oj zabrani pristupa je:',
'Ban message 4'			=>	'Ukoliko imate pitanja, kontaktirajte administratora na',
'Never'					=>	'Nikada',
'Today'					=>	'Danas',
'Yesterday'				=>	'Ju�er',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Povratak',
'Maintenance'			=>	'Odr�avanje',
'Redirecting'			=>	'Preusmjeravanje',
'Click redirect'		=>	'ukoliko Vas ne preusmjeri za par sekundi, kliknite ovdje',
'on'					=>	'dozvoljen',		// as in "BBCode is on"
'off'					=>	'zabranjen',
'Invalid e-mail'		=>	'Pogre�no ste upisali e-mail adresu.',
'required field'		=>	'obavezno morate popuniti.',	// for javascript form validation
'Last post'				=>	'Zadnji upis',
'by'					=>	'od',	// as in last post by someuser
'New posts'				=>	'Novi&nbsp;komentari',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Idi na prvi novi komentar u ovoj temi.',	// the popup text for new posts links
'Username'				=>	'Korisni�ko ime',
'Password'				=>	'Lozinka',
'E-mail'				=>	'e-mail',
'Send e-mail'			=>	'Po�aljite e-mail',
'Moderated by'			=>	'Ure�uje',
'Registered'			=>	'Registrovan',
'Subject'				=>	'Naslov',
'Message'				=>	'Poruka',
'Topic'					=>	'Tema',
'Forum'					=>	'Kategorija',
'Posts'					=>	'Komentari',
'Replies'				=>	'Odgovori',
'Author'				=>	'Autor',
'Pages'					=>	'Stranice',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Emocije',
'and'					=>	'i',
'Image link'			=>	'slika',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'pi�e',	// For [quote]'s
'Code'					=>	'Code',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Va�na informacija',
'Write message legend'	=>	'Unesite Va�u poruku i potvrdite',

// Title
'Title'					=>	'Level',
'Member'				=>	'Korisnik',	// Default title
'Moderator'				=>	'Ure�uje',
'Administrator'			=>	'Admin',
'Banned'				=>	'Izba�en',
'Guest'					=>	'Gost',

// Stuff for include/parser.php
'BBCode error'			=>	'Pogre�an BBcode.',
'BBCode error 1'		=>	'Nedostaje po�etak [/quote].',
'BBCode error 2'		=>	'Nedostaje kraj [code].',
'BBCode error 3'		=>	'Nedostaje po�etak [/code].',
'BBCode error 4'		=>	'Nedostaje jedan ili vi�e krajeva za [quote].',
'BBCode error 5'		=>	'Nedostaje jedan ili vi�e po�etaka za [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Po�etna',
'User list'				=>	'�lanovi',
'Rules'					=>  'Pravila',
'Search'				=>  'Pretraga',
'Register'				=>  'Registracija',
'Login'					=>  'Prijava',
'Not logged in'			=>  'Trenutno niste prijavljeni...',
'Profile'				=>	'Profil',
'Logout'				=>	'Odjava',
'Logged in as'			=>	'Prijavljeni ste kao',
'Admin'					=>	'Admin',
'Last visit'			=>	'Zadnja posjeta',
'Show new posts'		=>	'Prika�i nove komentare od zadnje prijave',
'Mark all as read'		=>	'Ozna�ite sve komentare kao pro�itane',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Podno�je',
'Search links'			=>	'Linkovi pretrage',
'Show recent posts'		=>	'Prika�i fri�ke komentare',
'Show unanswered posts'	=>	'Prika�i komentare bez odgovora',
'Show your posts'		=>	'Prika�i vlastite komentare',
'Show subscriptions'	=>	'Prika�i teme na koje ste prijavljeni',
'Jump to'				=>	'Idi na',
'Go'					=>	' Idi ',		// submit button in forum jump
'Move topic'			=>  'Pomjeri temu',
'Open topic'			=>  'Otvori temu',
'Close topic'			=>  'Zatvori temu',
'Unstick topic'			=>  'Odljepi temu',
'Stick topic'			=>  'Zaljepi temu',
'Moderate forum'		=>	'Uredite forum',
'Delete posts'			=>	'Obri�ite vi�e komentara',
'Debug table'			=>	'Debug',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Najaktivniji komentari na',	// board_title will be appended to this string
'RSS Desc New'			=>	'Najnoviji komentar na',					// board_title will be appended to this string
'Posted'				=>	'Upisano'	// The date/time a topic was started

);
