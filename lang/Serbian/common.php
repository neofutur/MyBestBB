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
'Bad request'			=>	'Pogrešan zahtev. Link koju ste uneli je netaèan ili zastareo.',
'No view'				=>	'Vi nemate dozvolu da pregledate ove forume.',
'No permission'			=>	'Vi nemate dozvolu da pristupite ovoj stranici.',
'Bad referrer'			=>	'Pogrešan HTTP_REFERER. Vi ste upuæeni na ovu stranicu sa neovlašæenog izvora. Ako problem još uvek postoji, molimo proverite da li je \'Base URL\' taèno postavljen u Admin/Options i da Vi poseæujete ovaj forum usmeravajuæi se prema tom URL. Više informacija u pogledu provere upuæivaèa može se naæi u PunBB dokumentaciji.',

// Topic/forum indicators
'New icon'				=>	'Ima novih poruka',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Ova tema je zatvorena',
'Redirect icon'			=>	'Preusmeren forum',

// Miscellaneous
'Announcement'			=>	'Obaveštenje',
'Options'				=>	'Opcije',
'Actions'				=>	'Akcije',
'Submit'				=>	'Potvrda',	// "name" of submit buttons
'Ban message'			=>	'Vi ste banovani na ovom forumu.',
'Ban message 2'			=>	'Banovanje istièe na kraju',
'Ban message 3'			=>	'Administrator ili urednik, koji Vas je banovao, ostavio je sledeæu poruku:',
'Ban message 4'			=>	'Molimo pošaljite bilo kakva pitanja administratoru foruma na',
'Never'					=>	'Nikad',
'Today'					=>	'Danas',
'Yesterday'				=>	'Juèe',
'Info'					=>	'Informacija',		// a common table header
'Go back'				=>	'Nazad',
'Maintenance'			=>	'Održavanje',
'Redirecting'			=>	'Preusmeravanje',
'Click redirect'		=>	'Kliknite ovde ako ne želite više da èekate (ili ako Vas Vaš pretraživaè ne prosleðuje automatski)',
'on'					=>	'ukljuèen',		// as in "BBCode is on"
'off'					=>	'iskljuèen',
'Invalid e-mail'		=>	'e-mail adresa koju ste uneli je pogrešna.',
'required field'		=>	'je obavezno polje u ovoj formi.',	// for javascript form validation
'Last post'				=>	'Poslednja poruka',
'by'					=>	'od',	// as in last post by someuser
'New posts'				=>	'Nove&nbsp;poruke',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Idite na prvu novu poruku u ovoj temi.',	// the popup text for new posts links
'Username'				=>	'Korisnièko ime',
'Password'				=>	'Lozinka',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Slanje e-mail',
'Moderated by'			=>	'Ureðeno od strane',
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
'Important information'	=>	'Važna informacija',
'Write message legend'	=>	'Upišite Vašu poruku i potvrdite',

// Title
'Title'					=>	'Naslov',
'Member'				=>	'Èlan',	// Default title
'Moderator'				=>	'Urednik',
'Administrator'			=>	'Administrator',
'Banned'				=>	'Banovan',
'Guest'					=>	'Gost',

// Stuff for include/parser.php
'BBCode error'			=>	'BBCode sintaksa u poruci je netaèna.',
'BBCode error 1'		=>	'Nedostaje poèetni tag za [/quote].',
'BBCode error 2'		=>	'Nedostaje završni tag za [code].',
'BBCode error 3'		=>	'Nedostaje poèetni tag za [/code].',
'BBCode error 4'		=>	'Nedostaje jedan ili više završnih tagova za [quote].',
'BBCode error 5'		=>	'Nedostaje jedan ili više poèetnih tagova za [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Lista èlanova',
'Rules'					=>  'Pravila',
'Search'				=>  'Traženje',
'Register'				=>  'Registrovati se',
'Login'					=>  'Prijaviti se',
'Not logged in'			=>  'Niste prijavljeni.',
'Profile'				=>	'Profil',
'Logout'				=>	'Odjaviti se',
'Logged in as'			=>	'Prijavljen kao',
'Admin'					=>	'Administracija',
'Last visit'			=>	'Poslednja poseta',
'Show new posts'		=>	'Prikazati nove teme od poslednje posete',
'Mark all as read'		=>	'Obeležiti sve teme kao proèitane',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Podnožje foruma',
'Search links'			=>	'Pretražiti linkove',
'Show recent posts'		=>	'Prikazati nove poruke',
'Show unanswered posts'	=>	'Prikazati neodgovorene poruke',
'Show your posts'		=>	'Prikazati Vaše poruke',
'Show subscriptions'	=>	'Prikazati Vaše prijavljene teme',
'Jump to'				=>	'Skok na',
'Go'					=>	' Kreni ',		// submit button in forum jump
'Move topic'			=>  'Pomeriti temu',
'Open topic'			=>  'Otvoriti temu',
'Close topic'			=>  'Zatvoriti temu',
'Unstick topic'			=>  'Odlepiti temu',
'Stick topic'			=>  'Nalepiti temu',
'Moderate forum'		=>	'Urediti forum',
'Delete posts'			=>	'Brisanje više poruka',
'Debug table'			=>	'Informacije za debagovanje',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Glavne nedavno aktivne teme',	// board_title will be appended to this string
'RSS Desc New'			=>	'Najnovije teme na',					// board_title will be appended to this string
'Posted'				=>	'Upisano'	// The date/time a topic was started

);
