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
'Bad request'			=>	'Vigane päring. Link mida klikkisid on ebakorrektne või aegunud.',
'No view'				=>	'Sul ei ole luba foorumi vaatamiseks.',
'No permission'			=>	'Sul ei ole luba selle lehe külastamiseks.',
'Bad referrer'			=>	'Vigane HTTP_REFERER. Sa saabusid sellele lehele teadmata kohast. Kui probleem jätkub siis kontrolli kas \'Base URL\' on õigesti seatud Admin/Seaded alt ja kas sa külastad foorumit seal määratud aadressilt. Täpsema info leiad PunBB dokumentatsioonist.',

// Topic/forum indicators
'New icon'				=>	'Uusi teateid ei ole',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'See teema on suletud',
'Redirect icon'			=>	'Übmbersuunatud foorumisse',

// Miscellaneous
'Announcement'			=>	'Teadaanne',
'Options'				=>	'Seaded',
'Actions'				=>	'Tegevused',
'Submit'				=>	'Saada',	// "name" of submit buttons
'Ban message'			=>	'Sa oled siin foorumis bännitud.',
'Ban message 2'			=>	'Ligipääsupiirang lõpeb',
'Ban message 3'			=>	'Administraator või moderaator jättis sulle järgneva teate:',
'Ban message 4'			=>	'Please direct any inquiries to the forum administrator at',
'Never'					=>	'Pole',
'Today'					=>	'Täna',
'Yesterday'				=>	'Eile',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Tagasi',
'Maintenance'			=>	'Hooldus',
'Redirecting'			=>	'Ümbersuunamine',
'Click redirect'		=>	'Kui sa ei soovi oodata siis kliki siia',
'on'					=>	'jah',		// as in "BBCode is on"
'off'					=>	'ei',
'Invalid e-mail'		=>	'Sisestatud email on vigane.',
'required field'		=>	'täitmine on nõutud.',	// for javascript form validation
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
'Important information'	=>	'Tähtis teave',
'Write message legend'	=>	'Kirjuta teade ja saada',

// Title
'Title'					=>	'Pealkiri',
'Member'				=>	'Liige',	// Default title
'Moderator'				=>	'Moderaator',
'Administrator'			=>	'Administraator',
'Banned'				=>	'Bännitud',
'Guest'					=>	'Külaline',

// Stuff for include/parser.php
'BBCode error'			=>	'BBKoodi süntaks ei ole korras.',
'BBCode error 1'		=>	'Puudub alustav [/quote] silt.',
'BBCode error 2'		=>	'Puudub lõpetav [code] silt.',
'BBCode error 3'		=>	'Puudub alustav [/code] silt.',
'BBCode error 4'		=>	'Puudub üks või enam lõpetavat [quote] silti.',
'BBCode error 5'		=>	'Puudub üks või enam alustavat [/quote] silti.',

// Stuff for the navigator (top of every page)
'Index'					=>	'Avaleht',
'User list'				=>	'Kasutajad',
'Rules'					=>  'Reeglid',
'Search'				=>  'Otsing',
'Register'				=>  'Registreeri',
'Login'					=>  'Logi sisse',
'Not logged in'			=>  'Sa ei ole sisse loginud.',
'Profile'				=>	'Profiil',
'Logout'				=>	'Logi välja',
'Logged in as'			=>	'Sisse loginud',
'Admin'					=>	'Administratsioon',
'Last visit'			=>	'Viimane külastus',
'Show new posts'		=>	'Näita uusi postitusi viimasest külastusest',
'Mark all as read'		=>	'Märgi kõik teemad loetuks',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Foorumi jalus',
'Search links'			=>	'Otsingu lingid',
'Show recent posts'		=>	'Vaata uusi postitusi',
'Show unanswered posts'	=>	'Vaata vastamata postitusi',
'Show your posts'		=>	'Vaata oma postitusi',
'Show subscriptions'	=>	'Vaata tellitud teemasid',
'Jump to'				=>	'Hüppa',
'Go'					=>	' Mine ',		// submit button in forum jump
'Move topic'			=>  'Liiguta teemat',
'Open topic'			=>  'Ava teema',
'Close topic'			=>  'Sule teema',
'Unstick topic'			=>  'Kaota püsiv olek',
'Stick topic'			=>  'Tee teema püsivaks',
'Moderate forum'		=>	'Modereeri foorumit',
'Delete posts'			=>	'Kustuta mitu postitust',
'Debug table'			=>	'Debug information',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Aktiivsed teemad on',	// board_title will be appended to this string
'RSS Desc New'			=>	'Uued teemad on',					// board_title will be appended to this string
'Posted'				=>	'Postitatud'	// The date/time a topic was started

);
