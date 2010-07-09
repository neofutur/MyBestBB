<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'serbian';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'sr_YU.ISO8859-1';
		break;

	default:
		$locale = 'sr_YU';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'windows-1250',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'Pogre�an zahtev. Link koju ste uneli je neta�an ili zastareo.',
'No view'				=>	'Vi nemate dozvolu da pregledate ove forume.',
'No permission'			=>	'Vi nemate dozvolu da pristupite ovoj stranici.',
'Bad referrer'			=>	'Pogre�an HTTP_REFERER. Vi ste upu�eni na ovu stranicu sa neovla��enog izvora. Ako problem jo� uvek postoji, molimo proverite da li je \'Base URL\' ta�no postavljen u Admin/Options i da Vi pose�ujete ovaj forum usmeravaju�i se prema tom URL. Vi�e informacija u pogledu provere upu�iva�a mo�e se na�i u PunBB dokumentaciji.',

// Topic/forum indicators
'New icon'				=>	'Ima novih poruka',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Ova tema je zatvorena',
'Redirect icon'			=>	'Preusmeren forum',

// Miscellaneous
'Announcement'			=>	'Obave�tenje',
'Options'				=>	'Opcije',
'Actions'				=>	'Akcije',
'Submit'				=>	'Potvrda',	// "name" of submit buttons
'Ban message'			=>	'Vi ste banovani na ovom forumu.',
'Ban message 2'			=>	'Banovanje isti�e na kraju',
'Ban message 3'			=>	'Administrator ili urednik, koji Vas je banovao, ostavio je slede�u poruku:',
'Ban message 4'			=>	'Molimo po�aljite bilo kakva pitanja administratoru foruma na',
'Never'					=>	'Nikad',
'Today'					=>	'Danas',
'Yesterday'				=>	'Ju�e',
'Info'					=>	'Informacija',		// a common table header
'Go back'				=>	'Nazad',
'Maintenance'			=>	'Odr�avanje',
'Redirecting'			=>	'Preusmeravanje',
'Click redirect'		=>	'Kliknite ovde ako ne �elite vi�e da �ekate (ili ako Vas Va� pretra�iva� ne prosle�uje automatski)',
'on'					=>	'uklju�en',		// as in "BBCode is on"
'off'					=>	'isklju�en',
'Invalid e-mail'		=>	'e-mail adresa koju ste uneli je pogre�na.',
'required field'		=>	'je obavezno polje u ovoj formi.',	// for javascript form validation
'Last post'				=>	'Poslednja poruka',
'by'					=>	'od',	// as in last post by someuser
'New posts'				=>	'Nove&nbsp;poruke',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Idite na prvu novu poruku u ovoj temi.',	// the popup text for new posts links
'Username'				=>	'Korisni�ko ime',
'Password'				=>	'Lozinka',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Slanje e-mail',
'Moderated by'			=>	'Ure�eno od strane',
'Registered'			=>	'Registrovan',
'Subject'				=>	'Subjekt',
'Message'				=>	'Poruka',
'Topic'					=>	'Tema',
'Forum'					=>	'Forum',
'Posts'					=>	'Poruke',
'Replies'				=>	'Odgovori',
'Author'				=>	'Autor',
'Pages'					=>	'Strane',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Smajliji',
'and'					=>	'i',
'Image link'			=>	'slika',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'upisano',	// For [quote]'s
'Code'					=>	'Kod',		// For [code]'s
'Mailer'				=>	'mejler',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Va�na informacija',
'Write message legend'	=>	'Upi�ite Va�u poruku i potvrdite',

// Title
'Title'					=>	'Naslov',
'Member'				=>	'�lan',	// Default title
'Moderator'				=>	'Urednik',
'Administrator'			=>	'Administrator',
'Banned'				=>	'Banovan',
'Guest'					=>	'Gost',

// Stuff for include/parser.php
'BBCode error'			=>	'BBCode sintaksa u poruci je neta�na.',
'BBCode error 1'		=>	'Nedostaje po�etni tag za [/quote].',
'BBCode error 2'		=>	'Nedostaje zavr�ni tag za [code].',
'BBCode error 3'		=>	'Nedostaje po�etni tag za [/code].',
'BBCode error 4'		=>	'Nedostaje jedan ili vi�e zavr�nih tagova za [quote].',
'BBCode error 5'		=>	'Nedostaje jedan ili vi�e po�etnih tagova za [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Lista �lanova',
'Rules'					=>  'Pravila',
'Search'				=>  'Tra�enje',
'Register'				=>  'Registrovati se',
'Login'					=>  'Prijaviti se',
'Not logged in'			=>  'Niste prijavljeni.',
'Profile'				=>	'Profil',
'Logout'				=>	'Odjaviti se',
'Logged in as'			=>	'Prijavljen kao',
'Admin'					=>	'Administracija',
'Last visit'			=>	'Poslednja poseta',
'Show new posts'		=>	'Prikazati nove teme od poslednje posete',
'Mark all as read'		=>	'Obele�iti sve teme kao pro�itane',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Podno�je foruma',
'Search links'			=>	'Pretra�iti linkove',
'Show recent posts'		=>	'Prikazati nove poruke',
'Show unanswered posts'	=>	'Prikazati neodgovorene poruke',
'Show your posts'		=>	'Prikazati Va�e poruke',
'Show subscriptions'	=>	'Prikazati Va�e prijavljene teme',
'Jump to'				=>	'Skok na',
'Go'					=>	' Kreni ',		// submit button in forum jump
'Move topic'			=>  'Pomeriti temu',
'Open topic'			=>  'Otvoriti temu',
'Close topic'			=>  'Zatvoriti temu',
'Unstick topic'			=>  'Odlepiti temu',
'Stick topic'			=>  'Nalepiti temu',
'Moderate forum'		=>	'Urediti forum',
'Delete posts'			=>	'Brisanje vi�e poruka',
'Debug table'			=>	'Informacije za debagovanje',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Glavne nedavno aktivne teme',	// board_title will be appended to this string
'RSS Desc New'			=>	'Najnovije teme na',					// board_title will be appended to this string
'Posted'				=>	'Upisano'	// The date/time a topic was started

);
