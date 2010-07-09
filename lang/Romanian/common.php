<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'romanian';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'ro_RO.ISO8859-2';
		break;

	default:
		$locale = 'ro_RO';
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
'Bad request'			=>	'Cerere invalidă. Legătura folosită este incorectă sau expirată.',
'No view'				=>	'Nu aveţi permisiunea de a vizualiza aceste forumuri.',
'No permission'			=>	'Nu aveţi permisiunea de a accesa această pagină.',
'Bad referrer'			=>	'HTTP_REFERER incorect. Aţi vizitat această pagină având ca referinţă o sursă neautorizată. Dacă problema persistă, vă rog să vă asiguraţi că opţiunea \'Base URL\' este corect setată în Admin/Opţiuni şi că vizitaţi forumul navigând la acel URL. Mai multe informaţii despre verificarea referinţei pot fi găsite în documentaţia PunBB.',

// Topic/forum indicators
'New icon'				=>	'Acestea sunt mesaje noi',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Această conversaţie este închisă',
'Redirect icon'			=>	'Forum redirectat',

// Miscellaneous
'Announcement'			=>	'Anunţ',
'Options'				=>	'Opţiuni',
'Actions'				=>	'Acţiuni',
'Submit'				=>	'Trimite',	// "name" of submit buttons
'Ban message'			=>	'Aveţi accesul interzis la acest forum.',
'Ban message 2'			=>	'Perioada de interzicere expiră la sfârşitul',
'Ban message 3'			=>	'Administratorul sau moderatorul care v-a interzis accesul a lăsat următorul mesaj:',
'Ban message 4'			=>	'Vă rog să adresaţi orice întrebări către administratorul forumului la',
'Never'					=>	'Niciodată',
'Today'					=>	'Astăzi',
'Yesterday'				=>	'Ieri',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Înapoi',
'Maintenance'			=>	'Întreţinere',
'Redirecting'			=>	'Redirectare',
'Click redirect'		=>	'Faceţi clic aici dacă nu doriţi să mai aşteptaţi (sau dacă navigatorul dvs. nu vă redirectează automat)',
'on'					=>	'activat',		// as in "BBCode is on"
'off'					=>	'dezactivat',
'Invalid e-mail'		=>	'Adresa e-mail introdusă este invalidă.',
'required field'		=>	'este un câmp obligatoriu în acest forum.',	// for javascript form validation
'Last post'				=>	'Ultimul mesaj',
'by'					=>	'de la',	// as in last post by someuser
'New posts'				=>	'Mesaje&nbsp;noi',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Go to the first new post in this topic.',	// the popup text for new posts links
'Username'				=>	'Nume utilizator',
'Password'				=>	'Parolă',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Trimite e-mail',
'Moderated by'			=>	'Moderat de',
'Registered'			=>	'Înregistrat',
'Subject'				=>	'Titlu',
'Message'				=>	'Mesaj',
'Topic'					=>	'Subiect',
'Forum'					=>	'Forum',
'Posts'					=>	'Mesaje',
'Replies'				=>	'Răspunsuri',
'Author'				=>	'Autor',
'Pages'					=>	'Pagini',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Smilies',
'and'					=>	'şi',
'Image link'			=>	'imagine',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'a scris',	// For [quote]'s
'Code'					=>	'Cod',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Informaţie importantă',
'Write message legend'	=>	'Scrieţi şi trimiteţi mesajul dvs.',

// Title
'Title'					=>	'Titlu',
'Member'				=>	'Membru',	// Default title
'Moderator'				=>	'Moderator',
'Administrator'			=>	'Administrator',
'Banned'				=>	'Banned',
'Guest'					=>	'Oaspete',

// Stuff for include/parser.php
'BBCode error'			=>	'Sintaxa BBCode din mesaj este incorectă.',
'BBCode error 1'		=>	'Lipseşte tag-ul de început pentru [/quote].',
'BBCode error 2'		=>	'Lipseşte tag-ul de sfârşit pentru [code].',
'BBCode error 3'		=>	'Lipseşte tag-ul de început pentru [/code].',
'BBCode error 4'		=>	'Lipsesc unul sau mai multe tag-uri de sfârşit pentru [quote].',
'BBCode error 5'		=>	'Lipsesc unul sau mai multe tag-uri de început pentru [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Listă utilizatori',
'Rules'					=>  'Reguli',
'Search'				=>  'Căutare',
'Register'				=>  'Înregistrare',
'Login'					=>  'Autentificare',
'Not logged in'			=>  'Neautentificat.',
'Profile'				=>	'Profil',
'Logout'				=>	'Deautentificare',
'Logged in as'			=>	'Autentificat ca',
'Admin'					=>	'Administrare',
'Last visit'			=>	'Ultima vizită',
'Show new posts'		=>	'Afişează mesajele noi apărute de la ultima vizită',
'Mark all as read'		=>	'Marchează toate subiectele ca citite',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Antet forum',
'Search links'			=>	'Legături căutare',
'Show recent posts'		=>	'Afişează mesajele recente',
'Show unanswered posts'	=>	'Afişează mesajele fără răspuns',
'Show your posts'		=>	'Afişează mesajele proprii',
'Show subscriptions'	=>	'Afişează subiectele urmărite prin email',
'Jump to'				=>	'Salt la',
'Go'					=>	' Go ',		// submit button in forum jump
'Move topic'			=>  'Mută subiectul',
'Open topic'			=>  'Deschide subiectul',
'Close topic'			=>  'Închide subiectul',
'Unstick topic'			=>  'De-fixează subiectul',
'Stick topic'			=>  'Fixează subiectul',
'Moderate forum'		=>	'Moderează forumul',
'Delete posts'			=>	'Şterge mesajele multiple',
'Debug table'			=>	'Informaţii depanare',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Cele mai active subiecte recente din',	// board_title will be appended to this string
'RSS Desc New'			=>	'Cele mai noi subiecte din',					// board_title will be appended to this string
'Posted'				=>	'Trimis la'	// The date/time a topic was started

);
