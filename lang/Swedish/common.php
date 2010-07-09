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
'Bad request'			=>	'Felaktig f�rfr�gan. L�nken du f�ljde �r inkorrekt eller utdaterad.',
'No view'				=>	'Du har inte r�ttigheter att l�sa dessa fora.',
'No permission'			=>	'Du har inte �tkomst till denna sida.',
'Bad referrer'			=>	'Felaktig HTTP_REFERER. Du refererades till denna sida fr�n en icke-auktoriserad k�lla. Om problemet kvarst�r, kontrollera s� att \'Base URL\' i Admin/Options �r korrekt och att du bes�ker forumet genom att navigera till denna URL. Mer information finns i dokumentationen till PunBB.',

// Topic/forum indicators
'New icon'				=>	'Nya inl�gg',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Denna tr�d �r l�st',
'Redirect icon'			=>	'Medflyttningsforum',

// Miscellaneous
'Announcement'			=>	'Meddelande',
'Options'				=>	'Val',
'Actions'				=>	'�tg�rd',
'Submit'				=>	'Skicka',	// "name" of submit buttons
'Ban message'			=>	'Du �r avst�ngd fr�n detta forum.',
'Ban message 2'			=>	'Avst�ngningen upph�r',
'Ban message 3'			=>	'Administrat�ren eller moderatorn som har st�ngt av dig l�mnade f�ljande meddelande:',
'Ban message 4'			=>	'Om du har n�gra fr�gor kan du kontakta forumadministrat�ren p�',
'Never'					=>	'Aldrig',
'Today'					=>	'Idag',
'Yesterday'				=>	'Ig�r',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'G� tillbaka',
'Maintenance'			=>	'Underh�ll',
'Redirecting'			=>	'Omdirigerar',
'Click redirect'		=>	'Klicka h�r om du inte vill v�nta (eller om din browser inte omdirigerar dig automatiskt)',
'on'					=>	'p�',		// as in "BBCode is on"
'off'					=>	'av',
'Invalid e-mail'		=>	'E-postadressen du angav �r inte korrekt.',
'required field'		=>	'�r ett obligatoriskt f�lt i detta formul�r.',	// for javascript form validation
'Last post'				=>	'Senaste inl�gget',
'by'					=>	'av',	// as in last post by someuser
'New posts'				=>	'Nya&nbsp;inl�gg',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'G� till det f�rsta nya inl�gget i denna tr�d.',	// the popup text for new posts links
'Username'				=>	'Anv�ndarnamn',
'Password'				=>	'L�senord',
'E-mail'				=>	'E-post',
'Send e-mail'			=>	'Skicka e-post',
'Moderated by'			=>	'Modererat av',
'Registered'			=>	'Registrerad',
'Subject'				=>	'�mne',
'Message'				=>	'Inl�gg',
'Topic'					=>	'Tr�d',
'Forum'					=>	'Forum',
'Posts'					=>	'Inl�gg',
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
'Mailer'				=>	'E-posttj�nst',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Viktig information',
'Write message legend'	=>	'Skriv ditt meddelande och klicka p� skicka',

// Title
'Title'					=>	'Titel',
'Member'				=>	'Medlem',	// Default title
'Moderator'				=>	'Moderator',
'Administrator'			=>	'Administrat�r',
'Banned'				=>	'Avst�ngd',
'Guest'					=>	'G�st',

// Stuff for include/parser.php
'BBCode error'			=>	'BBCode-syntaxen i inl�gget �r inte korrekt.',
'BBCode error 1'		=>	'Starttagg saknas f�r [/quote].',
'BBCode error 2'		=>	'Sluttagg saknas f�r [code].',
'BBCode error 3'		=>	'Starttagg saknas f�r [/code].',
'BBCode error 4'		=>	'En eller flera sluttaggar saknas f�r [quote].',
'BBCode error 5'		=>	'En eller flera starttaggar saknas f�r [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Anv�ndarlista',
'Rules'					=>  'Regler',
'Search'				=>  'S�k',
'Register'				=>  'Registrera dig',
'Login'					=>  'Logga in',
'Not logged in'			=>  'Du �r inte inloggad.',
'Profile'				=>	'Profil',
'Logout'				=>	'Logga ut',
'Logged in as'			=>	'Inloggad som',
'Admin'					=>	'Administration',
'Last visit'			=>	'Du var senast h�r',
'Show new posts'		=>	'Visa nya inl�gg sedan senaste bes�ket',
'Mark all as read'		=>	'Markera alla tr�dar l�sta',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Sidfot',
'Search links'			=>	'S�kl�nkar',
'Show recent posts'		=>	'Visa de senaste inl�ggen',
'Show unanswered posts'	=>	'Visa obesvarade inl�gg',
'Show your posts'		=>	'Visa dina inl�gg',
'Show subscriptions'	=>	'Visa dina tr�dprenumerationer',
'Jump to'				=>	'Hoppa till',
'Go'					=>	' G� ',		// submit button in forum jump
'Move topic'			=>  'Flytta tr�d',
'Open topic'			=>  '�ppna tr�d',
'Close topic'			=>  'St�ng tr�d',
'Unstick topic'			=>  'Avklistra tr�d',
'Stick topic'			=>  'Klistra tr�d',
'Moderate forum'		=>	'Moderera detta forum',
'Delete posts'			=>	'Radera flera inl�gg',
'Debug table'			=>	'Debuginformation',

// For extern.php RSS feed
'RSS Desc Active'		=>	'De senast aktiva tr�darna i',		// board_title will be appended to this string
'RSS Desc New'			=>	'De senaste tr�darna i',			// board_title will be appended to this string
'Posted'				=>	'Postat'	// The date/time a topic was started

);
