<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'swedish';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'sv_SE.ISO8859-1';
		break;

	default:
		$locale = 'sv_SE';
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
'Bad request'			=>	'Felaktig förfrågan. Länken du följde är inkorrekt eller utdaterad.',
'No view'				=>	'Du har inte rättigheter att läsa dessa fora.',
'No permission'			=>	'Du har inte åtkomst till denna sida.',
'Bad referrer'			=>	'Felaktig HTTP_REFERER. Du refererades till denna sida från en icke-auktoriserad källa. Om problemet kvarstår, kontrollera så att \'Base URL\' i Admin/Options är korrekt och att du besöker forumet genom att navigera till denna URL. Mer information finns i dokumentationen till PunBB.',

// Topic/forum indicators
'New icon'				=>	'Nya inlägg',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Denna tråd är låst',
'Redirect icon'			=>	'Medflyttningsforum',

// Miscellaneous
'Announcement'			=>	'Meddelande',
'Options'				=>	'Val',
'Actions'				=>	'Åtgärd',
'Submit'				=>	'Skicka',	// "name" of submit buttons
'Ban message'			=>	'Du är avstängd från detta forum.',
'Ban message 2'			=>	'Avstängningen upphör',
'Ban message 3'			=>	'Administratören eller moderatorn som har stängt av dig lämnade följande meddelande:',
'Ban message 4'			=>	'Om du har några frågor kan du kontakta forumadministratören på',
'Never'					=>	'Aldrig',
'Today'					=>	'Idag',
'Yesterday'				=>	'Igår',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Gå tillbaka',
'Maintenance'			=>	'Underhåll',
'Redirecting'			=>	'Omdirigerar',
'Click redirect'		=>	'Klicka här om du inte vill vänta (eller om din browser inte omdirigerar dig automatiskt)',
'on'					=>	'på',		// as in "BBCode is on"
'off'					=>	'av',
'Invalid e-mail'		=>	'E-postadressen du angav är inte korrekt.',
'required field'		=>	'är ett obligatoriskt fält i detta formulär.',	// for javascript form validation
'Last post'				=>	'Senaste inlägget',
'by'					=>	'av',	// as in last post by someuser
'New posts'				=>	'Nya&nbsp;inlägg',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Gå till det första nya inlägget i denna tråd.',	// the popup text for new posts links
'Username'				=>	'Användarnamn',
'Password'				=>	'Lösenord',
'E-mail'				=>	'E-post',
'Send e-mail'			=>	'Skicka e-post',
'Moderated by'			=>	'Modererat av',
'Registered'			=>	'Registrerad',
'Subject'				=>	'Ämne',
'Message'				=>	'Inlägg',
'Topic'					=>	'Tråd',
'Forum'					=>	'Forum',
'Posts'					=>	'Inlägg',
'Replies'				=>	'Svar',
'Author'				=>	'Skapare',
'Pages'					=>	'Sidor',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img]-taggen',
'Smilies'				=>	'Smilies',
'and'					=>	'och',
'Image link'			=>	'bild',		// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'skrev',	// For [quote]'s
'Code'					=>	'Kod',		// For [code]'s
'Mailer'				=>	'E-posttjänst',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Viktig information',
'Write message legend'	=>	'Skriv ditt meddelande och klicka på skicka',

// Title
'Title'					=>	'Titel',
'Member'				=>	'Medlem',	// Default title
'Moderator'				=>	'Moderator',
'Administrator'			=>	'Administratör',
'Banned'				=>	'Avstängd',
'Guest'					=>	'Gäst',

// Stuff for include/parser.php
'BBCode error'			=>	'BBCode-syntaxen i inlägget är inte korrekt.',
'BBCode error 1'		=>	'Starttagg saknas för [/quote].',
'BBCode error 2'		=>	'Sluttagg saknas för [code].',
'BBCode error 3'		=>	'Starttagg saknas för [/code].',
'BBCode error 4'		=>	'En eller flera sluttaggar saknas för [quote].',
'BBCode error 5'		=>	'En eller flera starttaggar saknas för [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Användarlista',
'Rules'					=>  'Regler',
'Search'				=>  'Sök',
'Register'				=>  'Registrera dig',
'Login'					=>  'Logga in',
'Not logged in'			=>  'Du är inte inloggad.',
'Profile'				=>	'Profil',
'Logout'				=>	'Logga ut',
'Logged in as'			=>	'Inloggad som',
'Admin'					=>	'Administration',
'Last visit'			=>	'Du var senast här',
'Show new posts'		=>	'Visa nya inlägg sedan senaste besöket',
'Mark all as read'		=>	'Markera alla trådar lästa',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Sidfot',
'Search links'			=>	'Söklänkar',
'Show recent posts'		=>	'Visa de senaste inläggen',
'Show unanswered posts'	=>	'Visa obesvarade inlägg',
'Show your posts'		=>	'Visa dina inlägg',
'Show subscriptions'	=>	'Visa dina trådprenumerationer',
'Jump to'				=>	'Hoppa till',
'Go'					=>	' Gå ',		// submit button in forum jump
'Move topic'			=>  'Flytta tråd',
'Open topic'			=>  'Öppna tråd',
'Close topic'			=>  'Stäng tråd',
'Unstick topic'			=>  'Avklistra tråd',
'Stick topic'			=>  'Klistra tråd',
'Moderate forum'		=>	'Moderera detta forum',
'Delete posts'			=>	'Radera flera inlägg',
'Debug table'			=>	'Debuginformation',

// For extern.php RSS feed
'RSS Desc Active'		=>	'De senast aktiva trådarna i',		// board_title will be appended to this string
'RSS Desc New'			=>	'De senaste trådarna i',			// board_title will be appended to this string
'Posted'				=>	'Postat'	// The date/time a topic was started

);
