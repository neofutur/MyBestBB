<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'bosnian';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'bs_BA.ISO8859-2';
		break;

	default:
		$locale = 'bs_BA';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'Greska.',
'No view'				=>	'Nemate pristup pregledu ovog foruma.',
'No permission'			=>	'Nemate pristup ovoj stranici.',
'Bad referrer'			=>	'Bad HTTP_REFERER. You were referred to this page from an unauthorized source. If the problem persists please make sure that \'Base URL\' is correctly set in Admin/Options and that you are visiting the forum by navigating to that URL. More information regarding the referrer check can be found in the PunBB documentation.',

// Topic/forum indicators
'New icon'				=>	'Postoje novi komentari',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Ova tema je zakljucana',
'Redirect icon'			=>	'Preusmjeren forum',

// Miscellaneous
'Announcement'			=>	'Objava',
'Advertisement'			=>	'Reklama',
'Information'			=>	'Informacija',
'Guest_information'		=>	'Gost informacije',
'Options'				=>	'Opcije',
'Actions'				=>	'Akcije',
'Submit'				=>	'Potvrda',	// "name" of submit buttons
'Ban message'			=>	'Imate zabranu pristupa ovom forumu.',
'Ban message 2'			=>	'Zabrana istjece na kraju',
'Ban message 3'			=>	'Administrator ili urednik, koji  je postavio zabranu, ostavio je sljedecu poruku::',
'Ban message 4'			=>	'Molimo posaljite bilo kakva pitanja administratoru foruma',
'Never'					=>	'Nikad',
'Today'					=>	'Danas',
'Yesterday'				=>	'Jucer',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Idi nazad',
'Maintenance'			=>	'Odrzavanje',
'Redirecting'			=>	'Preusmjeravanje',
'Click redirect'		=>	'Kliknite ovdje ako ne zelite cekati (ili ako Vas pretrazivac ne preusmjerava automatski)',
'on'					=>	'Ukljucen',		// as in "BBCode is on"
'off'					=>	'Iskljucen',
'Invalid e-mail'		=>	'Upisana e-mail adresa je pogresna',
'required field'		=>	' Zadano polje u ovoj formi.',	// for javascript form validation
'Last post'				=>	'Zadnji komentar',
'by'					=>	'Od',	// as in last post by someuser
'New posts'				=>	'Novi&nbsp;komentari',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Idite na prvu novu poruku u ovoj temi.',	// the popup text for new posts links
'Username'				=>	'Korisnicko ime',
'Password'				=>	'Lozinka',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Posalji e-mail',
'Moderated by'			=>	'Urednik',
'Registered'			=>	'Registriran',
'Subject'				=>	'Naslov',
'Message'				=>	'Poruka',
'Topic'					=>	'Tema',
'Forum'					=>	'Forum',
'Posts'					=>	'Komentari',
'Replies'				=>	'Odgovori',
'Author'				=>	'Autor',
'Pages'					=>	'Strane',
'BBCode'				=>	'BBkod',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Emocije',
'and'					=>	'i',
'Image link'			=>	'slika',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'upisano',	// For [quote]'s
'Code'					=>	'Kod',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Vazna informacija',
'Write message legend'	=>	'Upisi svoju poruku pa potvrdi',

// Title
'Title'					=>	'Naslov',
'Member'				=>	'Clan',	// Default title
'Moderator'				=>	'Urednik',
'Administrator'			=>	'Administrator',
'Banned'				=>	'Korisnik sa zabranom',
'Guest'					=>	'Gost',

// Stuff for include/parser.php
'BBCode error'			=>	'The BBKod sintaksa u poruci je netocna.',
'BBCode error 1'		=>	'Nedostaje start tag za [/quote].',
'BBCode error 2'		=>	'Nedostaje end tag za [code].',
'BBCode error 3'		=>	'Nedostaje start tag za [/code].',
'BBCode error 4'		=>	'Nedostaje jedan ili vise tagova za [quote].',
'BBCode error 5'		=>	'Nedostaje jedan ili vise tagova za [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Pocetna',
'User list'				=>	'Lista korisnika',
'Rules'					=>  'Pravila',
'Search'				=>  'Pretraga',
'Register'				=>  'Registracija',
'Login'					=>  'Prijava',
'Not logged in'			=>  'Niste prijavljeni.',
'Profile'				=>	'Profil',
'Logout'				=>	'Izlaz',
'Logged in as'			=>	'Prijavljen kao',
'Admin'					=>	'Administracija',
'Last visit'			=>	'Zadnja posjeta',
'Show new posts'		=>	'Prikazi nove komentare od zadnje posjete',
'Mark all as read'		=>	'Obiljezi sve komentare kao procitane',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Podnozje foruma',
'Search links'			=>	'Trazi linkove',
'Show recent posts'		=>	'Prikazi svjeze poruke',
'Show unanswered posts'	=>	'Prikazi neodgovorene poruke',
'Show your posts'		=>	'Prikazi vlastite komentare',
'Show subscriptions'	=>	'Prikazi prijavljene teme',
'Jump to'				=>	'Idi na',
'Go'					=>	' Idi ',		// submit button in forum jump
'Move topic'			=>  'Pomjeri temu',
'Open topic'			=>  'Otvori temu',
'Close topic'			=>  'Zatvori temu',
'Unstick topic'			=>  'Odljepi temu',
'Stick topic'			=>  'Zaljepi temu',
'Moderate forum'		=>	'Uredi forum',
'Delete posts'			=>	'Obrisi vise poruka',
'Debug table'			=>	'Debug informacije',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Najaktivnije teme',	// board_title will be appended to this string
'RSS Desc New'			=>	'Najnovija tema',					// board_title will be appended to this string
'Posted'				=>	'Upisano'	// The date/time a topic was started

);
