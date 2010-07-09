<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'estonian';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'et_EE.ISO8859-15';
		break;

	default:
		$locale = 'et_EE';
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
'Bad request'			=>	'Vigane p�ring. Link mida klikkisid on ebakorrektne v�i aegunud.',
'No view'				=>	'Sul ei ole luba foorumi vaatamiseks.',
'No permission'			=>	'Sul ei ole luba selle lehe k�lastamiseks.',
'Bad referrer'			=>	'Vigane HTTP_REFERER. Sa saabusid sellele lehele teadmata kohast. Kui probleem j�tkub siis kontrolli kas \'Base URL\' on �igesti seatud Admin/Seaded alt ja kas sa k�lastad foorumit seal m��ratud aadressilt. T�psema info leiad PunBB dokumentatsioonist.',

// Topic/forum indicators
'New icon'				=>	'Uusi teateid ei ole',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'See teema on suletud',
'Redirect icon'			=>	'�bmbersuunatud foorumisse',

// Miscellaneous
'Announcement'			=>	'Teadaanne',
'Options'				=>	'Seaded',
'Actions'				=>	'Tegevused',
'Submit'				=>	'Saada',	// "name" of submit buttons
'Ban message'			=>	'Sa oled siin foorumis b�nnitud.',
'Ban message 2'			=>	'Ligip��supiirang l�peb',
'Ban message 3'			=>	'Administraator v�i moderaator j�ttis sulle j�rgneva teate:',
'Ban message 4'			=>	'Please direct any inquiries to the forum administrator at',
'Never'					=>	'Pole',
'Today'					=>	'T�na',
'Yesterday'				=>	'Eile',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Tagasi',
'Maintenance'			=>	'Hooldus',
'Redirecting'			=>	'�mbersuunamine',
'Click redirect'		=>	'Kui sa ei soovi oodata siis kliki siia',
'on'					=>	'jah',		// as in "BBCode is on"
'off'					=>	'ei',
'Invalid e-mail'		=>	'Sisestatud email on vigane.',
'required field'		=>	't�itmine on n�utud.',	// for javascript form validation
'Last post'				=>	'Viimane postitus',
'by'					=>	'',	// as in last post by someuser
'New posts'				=>	'Uued&nbsp;postitused',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Mine uusima postituse juurde.',	// the popup text for new posts links
'Username'				=>	'Kasutaja',
'Password'				=>	'Parool',
'E-mail'				=>	'Email',
'Send e-mail'			=>	'Saada email',
'Moderated by'			=>	'Modereerib',
'Registered'			=>	'Registreeritud',
'Subject'				=>	'Teema',
'Message'				=>	'Teade',
'Topic'					=>	'Teema',
'Forum'					=>	'Foorum',
'Posts'					=>	'Postitus',
'Replies'				=>	'Vastused',
'Author'				=>	'Autor',
'Pages'					=>	'Lehed',
'BBCode'				=>	'BBKood',	// You probably shouldn't change this
'img tag'				=>	'[img] silt',
'Smilies'				=>	'Smailid',
'and'					=>	'ja',
'Image link'			=>	'pilt',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'kirjutas',	// For [quote]'s
'Code'					=>	'Kood',		// For [code]'s
'Mailer'				=>	'Mailisaatja',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'T�htis teave',
'Write message legend'	=>	'Kirjuta teade ja saada',

// Title
'Title'					=>	'Pealkiri',
'Member'				=>	'Liige',	// Default title
'Moderator'				=>	'Moderaator',
'Administrator'			=>	'Administraator',
'Banned'				=>	'B�nnitud',
'Guest'					=>	'K�laline',

// Stuff for include/parser.php
'BBCode error'			=>	'BBKoodi s�ntaks ei ole korras.',
'BBCode error 1'		=>	'Puudub alustav [/quote] silt.',
'BBCode error 2'		=>	'Puudub l�petav [code] silt.',
'BBCode error 3'		=>	'Puudub alustav [/code] silt.',
'BBCode error 4'		=>	'Puudub �ks v�i enam l�petavat [quote] silti.',
'BBCode error 5'		=>	'Puudub �ks v�i enam alustavat [/quote] silti.',

// Stuff for the navigator (top of every page)
'Index'					=>	'Avaleht',
'User list'				=>	'Kasutajad',
'Rules'					=>  'Reeglid',
'Search'				=>  'Otsing',
'Register'				=>  'Registreeri',
'Login'					=>  'Logi sisse',
'Not logged in'			=>  'Sa ei ole sisse loginud.',
'Profile'				=>	'Profiil',
'Logout'				=>	'Logi v�lja',
'Logged in as'			=>	'Sisse loginud',
'Admin'					=>	'Administratsioon',
'Last visit'			=>	'Viimane k�lastus',
'Show new posts'		=>	'N�ita uusi postitusi viimasest k�lastusest',
'Mark all as read'		=>	'M�rgi k�ik teemad loetuks',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Foorumi jalus',
'Search links'			=>	'Otsingu lingid',
'Show recent posts'		=>	'Vaata uusi postitusi',
'Show unanswered posts'	=>	'Vaata vastamata postitusi',
'Show your posts'		=>	'Vaata oma postitusi',
'Show subscriptions'	=>	'Vaata tellitud teemasid',
'Jump to'				=>	'H�ppa',
'Go'					=>	' Mine ',		// submit button in forum jump
'Move topic'			=>  'Liiguta teemat',
'Open topic'			=>  'Ava teema',
'Close topic'			=>  'Sule teema',
'Unstick topic'			=>  'Kaota p�siv olek',
'Stick topic'			=>  'Tee teema p�sivaks',
'Moderate forum'		=>	'Modereeri foorumit',
'Delete posts'			=>	'Kustuta mitu postitust',
'Debug table'			=>	'Debug information',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Aktiivsed teemad on',	// board_title will be appended to this string
'RSS Desc New'			=>	'Uued teemad on',					// board_title will be appended to this string
'Posted'				=>	'Postitatud'	// The date/time a topic was started

);
