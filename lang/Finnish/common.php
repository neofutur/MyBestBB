<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'finnish';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'fi_FI.ISO8859-1';
		break;

	default:
		$locale = 'fi_FI';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'	=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'		=>	'utf-8',
'lang_multibyte'	=>	false,

// Notices
'Bad request'		=>	'Bad request. The link you followed is incorrect or outdated.',
'No view'		=>	'Sinulla ei ole lupaa seurata näitä foorumeita.',
'No permission'		=>	'Sinulla ei ole lupaa sivun lataamiseen.',
'Bad referrer'		=>	'Bad HTTP_REFERER. You were referred to this page from an unauthorized source. If the problem persists please make sure that \'Base URL\' is correctly set in Admin/Options and that you are visiting the forum by navigating to that URL. More information regarding the referrer check can be found in the PunBB documentation.',

// Topic/forum indicators
'New icon'		=>	'There are new posts',
'Normal icon'		=>	'<!-- -->',
'Closed icon'		=>	'Tämä kanava on suljettu',
'Redirect icon'		=>	'Redirected forum',

// Miscellaneous
'Announcement'		=>	'Tiedoite',
'Options'		=>	'Asetukset',
'Actions'		=>	'Toimenpiteet',
'Submit'		=>	'Lähetä',	// "name" of submit buttons
'Ban message'		=>	'Olet porttikiellossa tällä foorumilla.',
'Ban message 2'		=>	'Pääset porttikiellosta',
'Ban message 3'		=>	'Porttikiellon määrääjä jätti sinulle seuraavan viestin:',
'Ban message 4'		=>	'Tiedustelut foorumin ylläpitäjälle',
'Never'			=>	'Ei koskaan',
'Today'			=>	'Tänään',
'Yesterday'		=>	'Eilen',
'Info'			=>	'Info',		// a common table header
'Go back'		=>	'Siirry takaisin',
'Maintenance'		=>	'Ylläpito',
'Redirecting'		=>	'Uudelleenohjaus',
'Click redirect'	=>	'Klikkaa tästä, jos kyllästyit odottamaan (tai jos selaimesi ei automaatisesti seuraa uudelleenohjausta)',
'on'			=>	'on',		// as in "BBCode is on"
'off'			=>	'off',
'Invalid e-mail'	=>	'Antamasi sähköpostiosoite on virheellinen.',
'required field'	=>	'on tieto, joka täytyy täyttää tällä lomakkeella.',	// for javascript form validation
'Last post'		=>	'Viimeinen viesti',
'by'			=>	'by',	// as in last post by someuser
'New posts'		=>	'Uudet&nbsp;viestit',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'	=>	'Mene ensimäiseen uuteen viestiin tässä viestiketjussa.',	// the popup text for new posts links
'Username'		=>	'Käyttäjätunnus',
'Password'		=>	'Salasana',
'E-mail'		=>	'E-mail',
'Send e-mail'		=>	'Lähetä sähköpostia',
'Moderated by'		=>	'Moderaattori',
'Registered'		=>	'Rekisteröity',
'Subject'		=>	'Aihe',
'Message'		=>	'Viesti',
'Topic'			=>	'Aihe',
'Forum'			=>	'Kanava',
'Posts'			=>	'Viestit',
'Replies'		=>	'Vastattu',
'Author'		=>	'Kirjoittaja',
'Pages'			=>	'Sivuja',
'BBCode'		=>	'BBCode',	// You probably shouldn't change this
'img tag'		=>	'[img] tag',
'Smilies'		=>	'Smilies',
'and'			=>	'and',
'Image link'		=>	'image',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'			=>	'kirjoitti',	// For [quote]'s
'Code'			=>	'Koodi',		// For [code]'s
'Mailer'		=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Tärkeää tietoa',
'Write message legend'	=>	'Kirjoita viesti ja lähetä',

// Title
'Title'			=>	'Titteli',
'Member'		=>	'Rekisteröity käyttäjä',	// Default title
'Moderator'		=>	'Moderaattori',
'Administrator'		=>	'Ylläpitäjä',
'Banned'		=>	'Porttikielto',
'Guest'			=>	'Vieras',

// Stuff for include/parser.php
'BBCode error'		=>	'Viestissä oleva muotoilukoodi on virheellinen.',
'BBCode error 1'	=>	'[/quote] tagin alku puuttuu.',
'BBCode error 2'	=>	'[code] tagin loppu puuttuu.',
'BBCode error 3'	=>	'[/code] tagin alku puuttuu.',
'BBCode error 4'	=>	'[quote] tagin loppu puuttuu.',
'BBCode error 5'	=>	'[/quote] tagin alku puuttuu.',

// Stuff for the navigator (top of every page)
'Index'			=>	'Sisällysluettelo',
'User list'		=>	'Jäsenet',
'Rules'			=>  	'Säännöt',
'Search'		=>  	'Etsi',
'Register'		=>  	'Käyttäjätunnus tästä!',
'Login'			=>  	'Käy peremmälle',
'Not logged in'		=>  	'Et ole kirjautunut käyttäjäksi.',
'Profile'		=>	'Omat asetukset',
'Logout'		=>	'Logout',
'Logged in as'		=>	'Olet kirjautunut tunnuksella',
'Admin'			=>	'Administration',
'Last visit'		=>	'Edellinen käynti',
'Show new posts'	=>	'Näytä edellisen käynnin jälkeen saapuneet viestit ',
'Mark all as read'	=>	'Merkitse kaikki viestiketjut luetuiksi',
'Link separator'	=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'		=>	'Board footer',
'Search links'		=>	'Hakulinkit',
'Show recent posts'	=>	'Näytä viimeisimmät viestit',
'Show unanswered posts'	=>	'Näytä vastaamattomat viestit',
'Show your posts'	=>	'Omat viestit näkyviin',
'Show subscriptions'	=>	'Näytä tilatut keskusteluaiheet',
'Jump to'		=>	'Vaihda kanavalle',
'Go'			=>	' Mene ',		// submit button in forum jump
'Move topic'		=>      'Move topic',
'Open topic'		=>      'Open topic',
'Close topic'		=>      'Close topic',
'Unstick topic'		=>      'Unstick topic',
'Stick topic'		=>      'Stick topic',
'Moderate forum'	=>	'Moderate forum',
'Delete posts'		=>	'Delete multiple posts',
'Debug table'		=>	'Debug information',

// For extern.php RSS feed
'RSS Desc Active'	=>	'The most recently active topics at',	// board_title will be appended to this string
'RSS Desc New'		=>	'The newest topics at',					// board_title will be appended to this string
'Posted'		=>	'Posted'	// The date/time a topic was started

);
