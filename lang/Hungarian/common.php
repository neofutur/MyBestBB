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
'Bad request'			=>	'Rossz kérelem. A követett hivatkozás hibás vagy elavult.',
'No view'				=>	'Nincs engedélyed ezeknek a fórumoknak a megtekintésére.',
'No permission'			=>	'Nincs engedélyed ennek a lapnak a megjelenítésére.',
'Bad referrer'			=>	'Rossz HTTP_REFERER. Egy érvénytelen forrástól küldtek erre a lapra. Ha a probléma továbbra is fennáll, ellenõrizd, hogy a \'Base URL\' helyesen van beállítva az Admin/Beállítások és hogy a fórumot a beállított címrõl látogatod. További információ a forrásokról a PunBB dokumentációban található meg.',

// Topic/forum indicators
'New icon'				=>	'Nincs új üzenet',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Lezárt téma',
'Redirect icon'			=>	'Átirányított fórum',

// Miscellaneous
'Announcement'			=>	'Hirdetmény',
'Options'				=>	'Beállítások',
'Actions'				=>	'Mûveletek',
'Submit'				=>	'Elküldés',	// "name" of submit buttons
'Ban message'			=>	'Ki vagy tiltva errõl a fórumról.',
'Ban message 2'			=>	'A tiltás lejár a hónap végén: ',
'Ban message 3'			=>	'Az adminisztrátor vagy moderátoroder, aki kitiltott, a következõ üzenetet hagyta:',
'Ban message 4'			=>	'Ha kérdésed van, érdeklõdj a fórum adminisztrátornál: ',
'Never'					=>	'Soha',
'Today'					=>	'Ma',
'Yesterday'				=>	'Tegnap',
'Info'					=>	'Infó',		// a common table header
'Go back'				=>	'Vissza',
'Maintenance'			=>	'Karbantartás',
'Redirecting'			=>	'Átirányítás',
'Click redirect'		=>	'Kattints ide, ha nem akarsz tovább várni (vagy ha a böngészõd nem továbbít automatikusan)',
'on'					=>	'be',		// as in "BBCode is on"
'off'					=>	'ki',
'Invalid e-mail'		=>	'A megadott e-mail cím érvénytelen.',
'required field'		=>	'egy szükséges mezõ ezen az ûrlapon.',	// for javascript form validation
'Last post'				=>	'Utolsó üzenet',
'by'					=>	'írta',	// as in last post by someuser
'New posts'				=>	'Új&nbsp;üzenetek',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'A fórum elsõ új üzenete.',	// the popup text for new posts links
'Username'				=>	'Felhasználónév',
'Password'				=>	'Jelszó',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'E-mail küldése',
'Moderated by'			=>	'Moderálva: ',
'Registered'			=>	'Regisztrált',
'Subject'				=>	'Cím',
'Message'				=>	'Üzenet',
'Topic'					=>	'Téma',
'Forum'					=>	'Fórum',
'Posts'					=>	'Üzenetek',
'Replies'				=>	'Válaszok',
'Author'				=>	'Készítõ',
'Pages'					=>	'Lapok',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] címke',
'Smilies'				=>	'Mosolygók',
'and'					=>	'és',
'Image link'			=>	'kép',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'írta',	// For [quote]'s
'Code'					=>	'Kód',		// For [code]'s
'Mailer'				=>	'Levelezõ',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Fontos információ',
'Write message legend'	=>	'Írd meg üzeneted és küldd el',

// Title
'Title'					=>	'Cím',
'Member'				=>	'Tag',	// Default title
'Moderator'				=>	'Moderátor',
'Administrator'			=>	'Adminisztrátor',
'Banned'				=>	'Tiltott',
'Guest'					=>	'Vendég',

// Stuff for include/parser.php
'BBCode error'			=>	'A BBCode kifejezés az üzenetben helytelen.',
'BBCode error 1'		=>	'Hiányzó kezdõcímke a [/quote]-hoz.',
'BBCode error 2'		=>	'Hiányzó zárócímke a [code]-hoz.',
'BBCode error 3'		=>	'Hiányzó kezdõcímke a [/code]-hoz.',
'BBCode error 4'		=>	'Hiányzik egy vagy több zárócímke a [quote]-hoz.',
'BBCode error 5'		=>	'Hiányzik egy vagy több kezdõcímke a [/quote]-hoz.',

// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Felhasználók',
'Rules'					=>  'Szabályok',
'Search'				=>  'Keresés',
'Register'				=>  'Regisztráció',
'Login'					=>  'Belépés',
'Not logged in'			=>  'Nem vagy belépve.',
'Profile'				=>	'Profil',
'Logout'				=>	'Kilépés',
'Logged in as'			=>	'Belépve mint',
'Admin'					=>	'Adminisztráció',
'Last visit'			=>	'Utoljára belépve',
'Show new posts'		=>	'Utolsó belépés óta írt üzenetek mutatása',
'Mark all as read'		=>	'Összes téma olvasottként megjelölése',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Fórum lábléc',
'Search links'			=>	'Linkek keresése',
'Show recent posts'		=>	'Új üzenetek',
'Show unanswered posts'	=>	'Megválaszolatlan üzenetek',
'Show your posts'		=>	'Saját üzenetek',
'Show subscriptions'	=>	'Figyelt témák megjelenítése',
'Jump to'				=>	'Ugrás: ',
'Go'					=>	' Ugrás ',		// submit button in forum jump
'Move topic'			=>  'Téma áthelyezése',
'Open topic'			=>  'Téma kinyitása',
'Close topic'			=>  'Téma lezárása',
'Unstick topic'			=>  'Kiemeltség megszüntetése',
'Stick topic'			=>  'Téma kiemelése',
'Moderate forum'		=>	'Fórum moderálása',
'Delete posts'			=>	'Többszörös üzenetek törlése',
'Debug table'			=>	'Hibakeresési információ',

// For extern.php RSS feed
'RSS Desc Active'		=>	'A legutoljára akítv témák itt:',	// board_title will be appended to this string
'RSS Desc New'			=>	'A legújabb témák itt:',					// board_title will be appended to this string
'Posted'				=>	'Elküldve'	// The date/time a topic was started

);
