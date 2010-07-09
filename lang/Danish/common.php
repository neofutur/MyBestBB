<?php


// Determine what locale to use
switch (PHP_OS)
{
    case 'WINNT':
    case 'WIN32':
        $locale = 'danish';
        break;

    case 'FreeBSD':
    case 'NetBSD':
    case 'OpenBSD':
        $locale = 'da_DK.ISO8859-1';
        break;

    default:
        $locale = 'da_DK';
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
'Bad request'			=>	'Forkert foresp�rgsel. Linket du fulgte er ikke korrekt, eller for gammelt.',
'No view'				=>	'Du har ikke tilladelse til at se disse fora.',
'No permission'			=>	'Du ahr ikke tilladelse til at se denne side.',
'Bad referrer'			=>	'Forkert HTTP_REFERER. Du er blevet henledt til denne side fra en uautoriseret kilde. Hvis problemet forts�tter, skal du v�re sikker p� at \'Base URL\' er sat korrekt i Admin/Muligheder og at du bes�ger forummet ved at navigere til den URL. Du kan finde mere information omkring referrer check i PunBB-dokumentationen.',

// Topic/forum indicators
'New icon'				=>	'Der er nye indl�g',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Dette emne er lukket',
'Redirect icon'			=>	'Henvist forum',

// Miscellaneous
'Announcement'			=>	'Bekendtg�relse',
'Options'				=>	'Muligheder',
'Actions'				=>	'Handlinger',
'Submit'				=>	'Indsend',	// "name" of submit buttons
'Ban message'			=>	'Du er bandlyst fra dette forum.',
'Ban message 2'			=>	'Bandlysningen udl�ber i slutningen af',
'Ban message 3'			=>	'Administratoren eller moderatoren der bandlyste dig, efterlod f�lgende besked:',
'Ban message 4'			=>	'Direkte henvendelser henvises til forumadministratoren p�',
'Never'					=>	'Aldrig',
'Today'					=>	'I dag',
'Yesterday'				=>	'I g�r',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'G� tilbage',
'Maintenance'			=>	'Vedligeholdelse',
'Redirecting'			=>	'Henviser',
'Click redirect'		=>	'Klik her, hvis du ikke vil vente l�ngere (eller hvis din browser ikke henviser dig automatisk)',
'on'					=>	'til',		// as in "BBCode is on"
'off'					=>	'fra',
'Invalid e-mail'		=>	'Emailadressen du skrev er ikke gyldig.',
'required field'		=>	'er et obligatorisk felt i denne form.',	// for javascript form validation
'Last post'				=>	'Sidste indl�g',
'by'					=>	'af',	// as in last post by someuser
'New posts'				=>	'Nye&nbsp;indl�g',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'G� til den f�rste nye post i dette emne.',	// the popup text for new posts links
'Username'				=>	'Brugernavn',
'Password'				=>	'Kodeord',
'E-mail'				=>	'Email',
'Send e-mail'			=>	'Send email',
'Moderated by'			=>	'Modereret af',
'Registered'			=>	'Registreret',
'Subject'				=>	'Emne',
'Message'				=>	'Besked',
'Topic'					=>	'Emne',
'Forum'					=>	'Forum',
'Posts'					=>	'Indl�g',
'Replies'				=>	'Svar',
'Author'				=>	'Forfatter',
'Pages'					=>	'Sider',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Smilies',
'and'					=>	'og',
'Image link'			=>	'billede',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'skrev',	// For [quote]'s
'Code'					=>	'Kode',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Vigtig information',
'Write message legend'	=>	'Skriv din besked og indsend',

// Title
'Title'					=>	'Titel',
'Member'				=>	'Medlem',	// Default title
'Moderator'				=>	'Moderator',
'Administrator'			=>	'Administrator',
'Banned'				=>	'Bandlyst',
'Guest'					=>	'G�st',

// Stuff for include/parser.php
'BBCode error'			=>	'BBCode syntaksen i beskeden er ukorrekt.',
'BBCode error 1'		=>	'Manglende start tag til [/quote].',
'BBCode error 2'		=>	'Manglende slut tag til [code].',
'BBCode error 3'		=>	'Manglende start tag til [/code].',
'BBCode error 4'		=>	'Mangler en eller flere tags til [quote].',
'BBCode error 5'		=>	'Mangler en eller flere start tags til [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Forumforside',
'User list'				=>	'Brugerliste',
'Rules'					=>  'Regler',
'Search'				=>  'S�g',
'Register'				=>  'Registrer',
'Login'					=>  'Log ind',
'Not logged in'			=>  'Du er ikke logget ind.',
'Profile'				=>	'Profil',
'Logout'				=>	'Log ud',
'Logged in as'			=>	'Logget ind som',
'Admin'					=>	'Administration',
'Last visit'			=>	'Sidste bes�g',
'Show new posts'		=>	'Vis nye indl�g siden sidste bes�g',
'Mark all as read'		=>	'Mark�r alle emner som l�st',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Board footer',
'Search links'			=>	'S�g i links',
'Show recent posts'		=>	'Vis nyere indl�g',
'Show unanswered posts'	=>	'Vis ubesvarede indl�g',
'Show your posts'		=>	'Vis dine indl�g',
'Show subscriptions'	=>	'Vis de emner du abonnerer p�',
'Jump to'				=>	'Hop til',
'Go'					=>	' G� ',		// submit button in forum jump
'Move topic'			=>  'Flyt emne',
'Open topic'			=>  'Open topic',
'Close topic'			=>  'Luk emne',
'Unstick topic'			=>  'Fjern indl�ggets kl�brighed',
'Stick topic'			=>  'G�r indl�g kl�brigt',
'Moderate forum'		=>	'Moder�r forum',
'Delete posts'			=>	'Slet flere indl�g',
'Debug table'			=>	'Fejlretningsinformation',

// For extern.php RSS feed
'RSS Desc Active'		=>	'De mest aktive emner p�',	// board_title will be appended to this string
'RSS Desc New'			=>	'De nyeste emner p�',					// board_title will be appended to this string
'Posted'				=>	'Indsendt'	// The date/time a topic was started

);
