<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'norwegian';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'nb_NO.ISO8859-1';
		break;

	default:
		$locale = 'nb_NO';
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
'Bad request'			=>	'Feil. Linken du fulgte er ikke korrekt eller utdatert.',
'No view'				=>	'Du har ikke rettigheter til å se dette forumet.',
'No permission'			=>	'Du har ikke rettigheter til å se denne siden.',
'Bad referrer'			=>	'Feil HTTP_REFERER. Du ble referert til denne siden fra en uautorisert kilde. Hvis problemet fortsetter, vær så snill å se til at \'Base URL\' er satt korrekt i Admin/Valg, og at du besøker forumet ved å navigere til den adressen. Mer informasjon om dette kan finnes i PunBB-dokumentasjonen.',

// Topic/forum indicators
'New icon'				=>	'Det er nye poster',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Dette emnet er stengt',
'Redirect icon'			=>	'Omdirigert forum',

// Miscellaneous
'Announcement'			=>	'Annonseringer',
'Options'				=>	'Valg',
'Actions'				=>	'Handlinger',
'Submit'				=>	'OK',	// "name" of submit buttons
'Ban message'			=>	'Du er bannet på dette forumet.',
'Ban message 2'			=>	'Banet går ut i enden av',
'Ban message 3'			=>	'Administratoren eller moderatoren som bannet deg la igjen følgende beskjed:',
'Ban message 4'			=>	'Send direkte spørsmål til forum-administratoren på',
'Never'					=>	'Aldri',
'Today'					=>	'Idag',
'Yesterday'				=>	'Igår',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Gå tilbake',
'Maintenance'			=>	'Vedlikehold',
'Redirecting'			=>	'Omdirigerer',
'Click redirect'		=>	'Klikk her om du ikke vil vente lengre (eller om browseren din ikke automatisk videresender deg)',
'on'					=>	'på',		// as in "BBCode is on"
'off'					=>	'av',
'Invalid e-mail'		=>	'E-post-adressen du skrev inn er ugyldig.',
'required field'		=>	'er et nødvendig felt i dette skjemaet.',	// for javascript form validation
'Last post'				=>	'Siste post',
'by'					=>	'av',	// as in last post by someuser
'New posts'				=>	'Nye&nbsp;poster',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Gå til den første nye posten i dette emnet.',	// the popup text for new posts links
'Username'				=>	'Brukernavn',
'Password'				=>	'Passord',
'E-mail'				=>	'E-post',
'Send e-mail'			=>	'Send e-post',
'Moderated by'			=>	'Moderert av',
'Registered'			=>	'Registrert',
'Subject'				=>	'Tittel',
'Message'				=>	'Innhold',
'Topic'					=>	'Emne',
'Forum'					=>	'Forum',
'Posts'					=>	'Poster',
'Replies'				=>	'Svar',
'Author'				=>	'Forfatter',
'Pages'					=>	'Sider',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Smilier',
'and'					=>	'og',
'Image link'			=>	'bilde',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'skrev',	// For [quote]'s
'Code'					=>	'Kode',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Viktig informasjon',
'Write message legend'	=>	'Skriv din melding og trykk OK',

// Title
'Title'					=>	'Tittel',
'Member'				=>	'Medlem',	// Default title
'Moderator'				=>	'Moderator',
'Administrator'			=>	'Administrator',
'Banned'				=>	'Bannet',
'Guest'					=>	'Gjest',

// Stuff for include/parser.php
'BBCode error'			=>	'BBCode-syntaksen i meldingen er feil.',
'BBCode error 1'		=>	'Mangler start-tag for[/quote].',
'BBCode error 2'		=>	'Mangler slutt-tag for [code].',
'BBCode error 3'		=>	'Mangler start-tag for [/code].',
'BBCode error 4'		=>	'Mangler en eller flere slutt-tagger for [quote].',
'BBCode error 5'		=>	'Mangler en eller flere start-tagger for [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Indeks',
'User list'				=>	'Brukerliste',
'Rules'					=>  'Regler',
'Search'				=>  'Søk',
'Register'				=>  'Registrer',
'Login'					=>  'Logg inn',
'Not logged in'			=>  'Du er ikke logget inn.',
'Profile'				=>	'Profil',
'Logout'				=>	'Logg ut',
'Logged in as'			=>	'Logget inn som',
'Admin'					=>	'Administrasjon',
'Last visit'			=>	'Siste besøk',
'Show new posts'		=>	'Vis nye poster siden siste besøk',
'Mark all as read'		=>	'Marker alle emner som lest',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Forum-bunn',
'Search links'			=>	'Søkelinker',
'Show recent posts'		=>	'Vis nyeste poster',
'Show unanswered posts'	=>	'Vis ubesvarte poster',
'Show your posts'		=>	'Vis dine poster',
'Show subscriptions'	=>	'Vis abonnerte emner',
'Jump to'				=>	'Hopp til',
'Go'					=>	' Gå ',		// submit button in forum jump
'Move topic'			=>  'Flytt emne',
'Open topic'			=>  'Åpne emne',
'Close topic'			=>  'Steng emne',
'Unstick topic'			=>  'Avklistre emne',
'Stick topic'			=>  'Klistre emne',
'Moderate forum'		=>	'Moderér forum',
'Delete posts'			=>	'Slett flere poster',
'Debug table'			=>	'Debug informasjon',

// For extern.php RSS feed
'RSS Desc Active'		=>	'De seneste aktive emnene på',	// board_title will be appended to this string
'RSS Desc New'			=>	'De nyeste emnene på',					// board_title will be appended to this string
'Posted'				=>	'Postet'	// The date/time a topic was started

);
