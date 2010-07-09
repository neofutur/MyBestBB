<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'slovak';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'sk_SK.utf-8';
		break;

	default:
		$locale = 'sk_SK';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'		=>	true,

// Notices
'Bad request'			=>	'Chybná požiadavka. Vami požadovaný odkaz je nesprávny alebo zastaralý.',
'No view'				=>	'Nemáte oprávnenie prezarať toto fórum.',
'No permission'			=>	'Nemáte prístup na túto stránku.',
'Bad referrer'			=>	'Bad HTTP_REFERER. Boli ste odkázaný na túto stránku z neoprávneného zdroja. Ak problém pretrváva, prosím preverte \'Base URL\' ľe je správne zadaná v Admin/Options a tieľ či prehliadate fórum pomocou navigačných URL. Viac informácií ohµadom overenia vzťahov/odkazovania môžete nájsť v dokumentácii PunBB.',

// Topic/forum indicators
'New icon'				=>	'Tu sú nové príspevky',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Téma je uzavretá',
'Redirect icon'			=>	'Presmerované fórum',

// Miscellaneous
'Announcement'			=>	'Oznámenie',
'Options'				=>	'Nastavenie',
'Actions'				=>	'Činnosti',
'Submit'				=>	'Odoslať',	// "name" of submit buttons
'Ban message'			=>	'Máte ban (zákaz prístupu) na toto fórum.',
'Ban message 2'			=>	'Ban uplynie koncom',
'Ban message 3'			=>	'Administrátor alebo moderátor, ktorý vám dal ban, zanechal nasledujúcu správu:',
'Ban message 4'			=>	'Akékoľvek otázky smerujte administrátorovi na',
'Never'					=>	'Nikdy',
'Today'					=>	'Dnes',
'Yesterday'				=>	'Včera',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Späť',
'Maintenance'			=>	'Údržba',
'Redirecting'			=>	'Presmerovanie',
'Click redirect'		=>	'Kliknite sem ak nechcete dlhšie čakať (alebo pokiaľ sa prehliadač nepresmeroval)',
'on'					=>	'on',		// as in "BBCode is on"
'off'					=>	'off',
'Invalid e-mail'		=>	'Zadaná emailová adresa je neplatná.',
'required field'		=>	'je nutné vyplniť v tomto formulári.',	// for javascript form validation
'Last post'				=>	'Posledný príspevok',
'by'					=>	'od',	// as in last post by someuser
'New posts'				=>	'Nové príspevky',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Zobraziť prvý nový príspevok v téme.',	// the popup text for new posts links
'Username'				=>	'Užívateľské meno',
'Password'				=>	'Heslo',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Poslať e-mail',
'Moderated by'			=>	'Moderované',
'Registered'			=>	'Registrovaný',
'Subject'				=>	'Predmet',
'Message'				=>	'Správa',
'Topic'					=>	'Téma',
'Forum'					=>	'Fórum',
'Posts'					=>	'Príspevky',
'Replies'				=>	'Odpovede',
'Author'				=>	'Autor',
'Pages'					=>	'Stránky',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Smajlíci',
'and'					=>	'a',
'Image link'			=>	'obrázok',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'napísal',	// For [quote]'s
'Code'					=>	'Code',		// For [code]'s
'Mailer'				=>	'Odosielateľ',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Dôležité informácie',
'Write message legend'	=>	'Napíš správu a odošli',

// Title
'Title'					=>	'Titul',
'Member'				=>	'Člen',	// Default title
'Moderator'				=>	'Moderátor',
'Administrator'			=>	'Administrátor',
'Banned'				=>	'Ban',
'Guest'					=>	'Návštevník',

// Stuff for include/parser.php
'BBCode error'			=>	'Syntax BBCode v správe je nesprávna.',
'BBCode error 1'		=>	'Chýba začiatočný tag pre [/quote].',
'BBCode error 2'		=>	'Chýba ukončovací tag pre [code].',
'BBCode error 3'		=>	'Chýba začiatočný tag pre [/code].',
'BBCode error 4'		=>	'Chýba jeden alebo viac ukončovacích tagov pre [quote].',
'BBCode error 5'		=>	'Chýba jeden alebo viac začiatočných tagov pre [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Zoznam užívateľov',
'Rules'					=>  'Pravidlá',
'Search'				=>  'Hľadať',
'Register'				=>  'Registrovať sa',
'Login'					=>  'Prihlásiť sa ',
'Not logged in'			=>  'Nie ste prihlásený.',
'Profile'				=>	'Profil',
'Logout'				=>	'Odhlásiť',
'Logged in as'			=>	'Naposledy prihlásený',
'Admin'					=>	'Administrácia',
'Last visit'			=>	'Posledná návšteva',
'Show new posts'		=>	'Zobraziť nové príspevky od poslednej návštevy',
'Mark all as read'		=>	'Označiť všetky témy ako prečítané',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Zápätie',
'Search links'			=>	'Hľadať odkazy',
'Show recent posts'		=>	'Zobraziť poslendé príspevky',
'Show unanswered posts'	=>	'Zobraziť príspevky bez odpovedí',
'Show your posts'		=>	'Zobraziť moje príspevky',
'Show subscriptions'	=>	'Zobraziť moje sledované témy',
'Jump to'				=>	'Prejsť na',
'Go'					=>	' Prejsť ',		// submit button in forum jump
'Move topic'			=>  'Preniesť tému',
'Open topic'			=>  'Otvoriť tému',
'Close topic'			=>  'Zavrieť tému',
'Unstick topic'			=>  'Zrušiť zvýraznenie',
'Stick topic'			=>  'Zvýrazniť tému',
'Moderate forum'		=>	'Moderovať fórum',
'Delete posts'			=>	'Zmazať viacero príspevkov',
'Debug table'			=>	'Informácie ladenia',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Najaktívnejšie témy v',	// board_title will be appended to this string
'RSS Desc New'			=>	'NajnovŠie témy v',					// board_title will be appended to this string
'Posted'				=>	'Poslané'	// The date/time a topic was started

);
