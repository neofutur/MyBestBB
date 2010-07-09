<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'czech';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'cz_CZ.utf-8';
		break;

	default:
		$locale = 'cz_CZ';
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
'Bad request'			=>	'Špatný požadavek. Objekt, který jste požadovali, je nesprávný nebo starý.',
'No view'				=>	'Nemáte oprávnění prohlížet toto fórum.',
'No permission'			=>	'Nemáte oprávnění přístupu na stránku.',
'Bad referrer'			=>	'Špatný HTTP_REFERER. Byli jste přesměrováni na tuto stránku z neautorizovaného zdroje. Pokud problém přetrvává, prosím ověřte, zda \'Base URL\' je nastavená v Administrace/Options and a že jste navštívili fórum přes tuto adresu URL. Také ověřte, zda Váš prohlížeč nebo proxy server tyto hlavičky posílá správně. Více informací o kontrole HTTP_REFERER naleznete v dokumentaci k PunBB.',

// Topic/forum indicators
'New icon'				=>	'V tématu jsou nové příspěvky',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Téma je zavřeno.',
'Redirect icon'			=>	'Přesměrované fórum',

// Miscellaneous
'Announcement'			=>	'Oznámení',
'Options'				=>	'Nastavení',
'Actions'				=>	'Činnosti',
'Submit'				=>	'Odeslat',	// "name" of submit buttons
'Ban message'			=>	'Máte ban (zákaz) pro toto fórum.',
'Ban message 2'			=>	'Ban (zákaz) vyprší:',
'Ban message 3'			=>	'Administrátor nebo moderátor, který Vás zabanoval zanechal následující zprávu:',
'Ban message 4'			=>	'Jakékoliv dotazy směřujte na administrátora',
'Never'					=>	'Nikdy',
'Today'					=>	'Dnes',
'Yesterday'				=>	'Včera',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Zpět',
'Maintenance'			=>	'Údržba',
'Redirecting'			=>	'Přesměrování',
'Click redirect'		=>	'Klikněte sem pro rychlé přesměrování (nebo pokud vás prohlížeč automaticky nepřesměroval)',
'on'					=>	'on',		// as in "BBCode is on"
'off'					=>	'off',
'Invalid e-mail'		=>	'Zadaná e-mailová adresa není platná.',
'required field'		=>	'je nutné vyplnit v tomto formuláři',	// for javascript form validation
'Last post'				=>	'Poslední příspěvek',
'by'					=>	'od',	// as in last post by someuser
'New posts'				=>	'Nový&nbsp;příspěvek',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Zobrazit nejnovější příspěvek v tématu.',	// the popup text for new posts links
'Username'				=>	'Uživatelské jméno',
'Password'				=>	'Vaše heslo',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Poslat e-mail',
'Moderated by'			=>	'Moderuje',
'Registered'			=>	'Registrovaný',
'Subject'				=>	'Předmět',
'Message'				=>	'Zpráva',
'Topic'					=>	'Téma',
'Forum'					=>	'Fórum',
'Posts'					=>	'Příspěvky',
'Replies'				=>	'Odpovědi',
'Author'				=>	'Autor',
'Pages'					=>	'Stránky',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Smajlíky',
'and'					=>	'a',
'Image link'			=>	'obrázek',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'napsal(a)',	// For [quote]'s
'Code'					=>	'Code',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Důležité informace',
'Write message legend'	=>	'Napiš zprávu a odešli',

// Title
'Title'					=>	'Titulek',
'Member'				=>	'Člen',	// Default title
'Moderator'				=>	'Moderátor',
'Administrator'			=>	'Administrátor',
'Banned'				=>	'Zablokovaný',
'Guest'					=>	'Host',

// Stuff for include/parser.php
'BBCode error'			=>	'Syntaxe BBCode ve zprávě je špatná.',
'BBCode error 1'		=>	'Chybí úvodní tag pro [/quote].',
'BBCode error 2'		=>	'Chybí ukončovací tag pro [code].',
'BBCode error 3'		=>	'Chybí úvodní tag pro [/code].',
'BBCode error 4'		=>	'Chybí jeden či více ukončovacích tagů pro [quote].',
'BBCode error 5'		=>	'Chybí jeden či více počátečních tagů pro [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Seznam uživatelů',
'Rules'					=>  'Pravidla',
'Search'				=>  'Hledat',
'Register'				=>  'Registrace',
'Login'					=>  'Přihlásit',
'Not logged in'			=>  'Nejste přihlášen(a)',
'Profile'				=>	'Profil',
'Logout'				=>	'Odhlásit',
'Logged in as'			=>	'Přihlášen jako',
'Admin'					=>	'Administrace',
'Last visit'			=>	'Poslední návštěva',
'Show new posts'		=>	'Zobrazit nové příspěvky od poslední návštěvy',
'Mark all as read'		=>	'Označit všechna témata jako přečtená',
'Mark forum as read'	=>	'Označit toto fórum za přečtené', // MOD: MARK TOPICS AS READ
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Zápatí',
'Search links'			=>	'Hledané odkazy',
'Show recent posts'		=>	'Zobrazit poslední příspěvky',
'Show unanswered posts'	=>	'Zobrazit příspěvky bez odpovědí',
'Show your posts'		=>	'Zobrazit mé příspěvky',
'Show subscriptions'	=>	'Zobrazit témata s oznamováním',
'Jump to'				=>	'Přejít na',
'Go'					=>	'Přejít',		// submit button in forum jump
'Move topic'			=>  'Přesunout téma',
'Open topic'			=>  'Otevřít téma',
'Close topic'			=>  'Zavřít téma',
'Unstick topic'			=>  'Zrušit zvýraznění',
'Stick topic'			=>  'Zvýraznit téma',
'Moderate forum'		=>	'Moderovat fórum',
'Delete posts'			=>	'Smazat více příspěvků',
'Debug table'			=>	'Ladící informace',

// For extern.php RSS feed
'RSS Desc Active	'	=>	'Nejaktivnější témata',	// board_title will be appended to this string
'RSS Desc New'			=>	'Nejnovější témata',					// board_title will be appended to this string
'Posted'				=>	'Zaslaný'	// The date/time a topic was started

);

$czech_days=array(
	'Neděle',
	'Pondělí',
	'Úterý',
	'Středa',
	'Čtvrtek',
	'Pátek',
	'Sobota'
);

$v_czech_days=array(
	'v neděli',
	'v pondělí',
	'v úterý',
	've středu',
	've čtvrtek',
	'v pátek',
	'v sobotu'
);

function new_msg_cz($num)
{
	switch($num)
	{
		case 0:return 'žádná nová';
		case 1:return '1 nová';
		case 2:
		case 3:
		case 4:return $num.' nové';
		default:return $num.' nových';
	}
}
