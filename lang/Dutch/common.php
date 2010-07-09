<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'dutch';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'nl_NL.ISO8859-1';
		break;

	default:
		$locale = 'nl_NL';
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
'Bad request'			=>	'Ongeldig verzoek. De koppeling die je opende is onjuist of verouderd.',
'No view'				=>	'Je hebt geen toestemming om deze forums te bekijken.',
'No permission'			=>	'Je hebt geen toestemming om deze pagina te openen.',
'Bad referrer'			=>	'Verkeerde HTTP_REFERER. Je werd doorgestuurd naar deze pagina vanaf een niet geautoriseerde locatie. Als dit probleem zich blijft voordoen, controleer dan of \'Base URL\' correct is ingesteld in Beheer/Opties en of je toegang tot het forum zoekt via die URL. Meer informatie betreffende de \'referrer\' controle kun je in de PunBB documentatie vinden.',

// Topic/forum indicators
'New icon'				=>	'Er zijn nieuwe bijdragen',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Dit onderwerp is gesloten',
'Redirect icon'			=>	'Omgeleid forum',

// Miscellaneous
'Announcement'			=>	'Aankondiging',
'Options'				=>	'Opties',
'Actions'				=>	'Acties',
'Submit'				=>	'Verzenden',	// "name" of submit buttons
'Ban message'			=>	'Je bent uitgesloten van dit forum',
'Ban message 2'			=>	'De uitsluiting verloopt aan het eind van',
'Ban message 3'			=>	'De beheerder of moderator die je heeft uitgesloten, liet het volgende bericht achter:',
'Ban message 4'			=>	'Stuur vragen a.u.b. naar de beheerder van het forum op',
'Never'					=>	'Nooit',
'Today'					=>	'Vandaag',
'Yesterday'				=>	'Gisteren',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Ga terug',
'Maintenance'			=>	'Onderhoud',
'Redirecting'			=>	'Bezig met omleiden',
'Click redirect'		=>	'Klik hier als je niet langer wilt wachten (of als je browser niet automatisch omleidt.)',
'on'					=>	'aan',		// as in "BBCode is on"
'off'					=>	'uit',
'Invalid e-mail'		=>	'Het e-mail adres dat je opgaf is ongeldig.',
'required field'		=>	'is een verplicht veld in dit formulier',	// for javascript form validation
'Last post'				=>	'Nieuwste bijdrage',
'by'					=>	'van',	// as in last post by someuser
'New posts'				=>	'Nieuwe&nbsp;bijdragen',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Ga naar de eerste nieuwe bijdrage voor dit onderwerp.',	// the popup text for new posts links
'Username'				=>	'Gebruikersnaam',
'Password'				=>	'Wachtwoord',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'E-mail verzenden',
'Moderated by'			=>	'Gemodereerd door',
'Registered'			=>	'Geregistreerd',
'Subject'				=>	'Onderwerp',
'Message'				=>	'Bericht',
'Topic'					=>	'Onderwerp',
'Forum'					=>	'Forum',
'Posts'					=>	'Bijdragen',
'Replies'				=>	'Antwoorden',
'Author'				=>	'Auteur',
'Pages'					=>	'Pagina\'s',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Smilies',
'and'					=>	'en',
'Image link'			=>	'plaatje',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'schreef',	// For [quote]'s
'Code'					=>	'Code',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Belangrijke informatie',
'Write message legend'	=>	'Schrijf je bericht en klik Verzenden',

// Title
'Title'					=>	'Titel',
'Member'				=>	'Lid',	// Default title
'Moderator'				=>	'Moderator',
'Administrator'			=>	'Beheerder',
'Banned'				=>	'Uitgesloten',
'Guest'					=>	'Gast',

// Stuff for include/parser.php
'BBCode error'			=>	'De BBCode syntax in het bericht is onjuist.',
'BBCode error 1'		=>	'Het openlabel voor [/quote] ontbreekt.',
'BBCode error 2'		=>	'Het sluitlabel voor [code] ontbreekt.',
'BBCode error 3'		=>	'Het openlabel voor [/code] ontbreekt.',
'BBCode error 4'		=>	'Er ontbreken een of meer sluitlabels voor [quote].',
'BBCode error 5'		=>	'Er ontbreken een of meer sluitlabels voor [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Gebruikerslijst',
'Rules'					=>  'Regels',
'Search'				=>  'Zoeken',
'Register'				=>  'Registreren',
'Login'					=>  'Inloggen',
'Not logged in'			=>  'Je bent niet ingelogd.',
'Profile'				=>	'Profiel',
'Logout'				=>	'Uitloggen',
'Logged in as'			=>	'Ingelogd als',
'Admin'					=>	'Beheer',
'Last visit'			=>	'Vorige bezoek',
'Show new posts'		=>	'Laat nieuwe bijdragen sinds het vorige bezoek zien',
'Mark all as read'		=>	'Markeer alle onderwerpen als gelezen',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Bulletin Board voettekst',
'Search links'			=>	'Zoekkoppelingen',
'Show recent posts'		=>	'Toon recente bijdragen',
'Show unanswered posts'	=>	'Toon onbeantwoorde bijdragen',
'Show your posts'		=>	'Toon jouw bijdragen',
'Show subscriptions'	=>	'Toon onderwerpen waarop je geabonneerd bent',
'Jump to'				=>	'Ga naar',
'Go'					=>	' Ga ',		// submit button in forum jump
'Move topic'			=>  'Verplaats onderwerp',
'Open topic'			=>  'Open onderwerp',
'Close topic'			=>  'Sluit onderwerp',
'Unstick topic'			=>  'Onderwerp loslaten',
'Stick topic'			=>  'Onderwerp vastzetten',
'Moderate forum'		=>	'Forum modereren',
'Delete posts'			=>	'Verwijder meervoudige bijdragen',
'Debug table'			=>	'Debuginformatie',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Het meest-recent actieve onderwerp op',	// board_title will be appended to this string
'RSS Desc New'			=>	'De nieuwste onderwerpen op',					// board_title will be appended to this string
'Posted'				=>	'Gestart'	// The date/time a topic was started

);
