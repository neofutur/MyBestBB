<?php

/*
// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'english';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'en_US.US-ASCII';
		break;

	default:
		$locale = 'en_US';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);
*/

// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'Bloga u�klausa. Nuoroda, kuri� sekate yra neteisinga arba nebegaliojanti.',
'No view'				=>	'J�s neturite teis�s per�i�r�ti �i� forum�.',
'No permission'			=>	'J�s neturite teis�s prieiti prie �io puslapio.',
'Bad referrer'			=>	'Blogas nukreipimas. J�s buvote nukreiptas � �� puslap� nuo ne�galioto �altinio. Jei problema kartojasi, pra�ome patikrinti ar \'Startinis Adresas\' yra teisingai nustatytas nustatymuose. Daugiau informacijos, susijusios su nukreipim� tikrinimu, galite rasti PunBB dokumentacijoje.',

// Topic/forum indicators
'New icon'				=>	'Yra nauj� �inu�i�',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'�i tema yra u�daryta',
'Redirect icon'			=>	'Perkeltas forumas',

// Miscellaneous
'Announcement'			=>	'Skelbimas',
'Options'				=>	'Nustatymai',
'Actions'				=>	'Veiksmai',
'Submit'				=>	'Patvirtinimas',	// "name" of submit buttons
'Ban message'			=>	'Jums pri�imas prie �io forumo u�draustas.',
'Ban message 2'			=>	'Draudimas baigiasi',
'Ban message 3'			=>	'Administratorius ar moderatorius, kuris u�draud� jums pri�im�, paliko �inut�:',
'Ban message 4'			=>	'Pra�ome kreiptis �vairiais klausimais � forumo administratori� adresu',
'Never'					=>	'Niekada',
'Today'					=>	'�iandien',
'Yesterday'				=>	'Vakar',
'Info'					=>	'Informacija',		// a common table header
'Go back'				=>	'Atgal',
'Maintenance'			=>	'Einamasis remontas',
'Redirecting'			=>	'Perkeliama',
'Click redirect'		=>	'Spauskite �ia, jei nenorite ilgiau laukti (arba jei J�s� nar�ykl� negali automati�kai perkelti)',
'on'					=>	'�jungta',		// as in "BBCode is on"
'off'					=>	'i�jungta',
'Invalid e-mail'		=>	'E-pa�to adresas, kur� �ved�te, yra netinkamas.',
'required field'		=>	'yra b�tinas laukas �ioje formoje.',	// for javascript form validation
'Last post'				=>	'Paskutin� �inut�',
'by'					=>	'nuo',	// as in last post by someuser
'New posts'				=>	'Naujos&nbsp;�inut�s',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Eiti link pirmos �inut�s �ioje temoje.',	// the popup text for new posts links
'Username'				=>	'Vartotojo vardas',
'Password'				=>	'Slapta�odis',
'E-mail'				=>	'E-pa�tas',
'Send e-mail'			=>	'Si�sti lai�k�',
'Moderated by'			=>	'Moderuoja',
'Registered'			=>	'Registravosi',
'Subject'				=>	'Tematika',
'Message'				=>	'�inut�',
'Topic'					=>	'Tema',
'Forum'					=>	'Forumas',
'Posts'					=>	'�inut�s',
'Replies'				=>	'Atsakymai',
'Author'				=>	'Autorius',
'Pages'					=>	'Puslapiai',
'BBCode'				=>	'BBKodas',	// You probably shouldn't change this
'img tag'				=>	'[img] �yma',
'Smilies'				=>	'�ypsenos',
'and'					=>	'ir',
'Image link'			=>	'paveiksl�lis',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'ra��',	// For [quote]'s
'Code'					=>	'Kodas',		// For [code]'s
'Mailer'				=>	'Siunt�jas',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Svarbi informacija',
'Write message legend'	=>	'Para�ykite savo �inut� ir patvirtinkite',

// Title
'Title'					=>	'Pavadinimas',
'Member'				=>	'Narys',	// Default title
'Moderator'				=>	'Moderatorius',
'Administrator'			=>	'Administratorius',
'Banned'				=>	'U�draustas vartotojas',
'Guest'					=>	'Sve�ias',

// Stuff for include/parser.php
'BBCode error'			=>	'BBKodo sintaks� �inut�je yra neteisinga.',
'BBCode error 1'		=>	'Tr�ksta prad�ios �ymos [/quote] �ymei.',
'BBCode error 2'		=>	'Tr�ksta pabaigos �ymos [code] �ymei.',
'BBCode error 3'		=>	'Tr�ksta prad�ios �ymos [/code] �ymei.',
'BBCode error 4'		=>	'Tr�ksta vienos ar daugiau pabaigos �ym� [quote] �ymai.',
'BBCode error 5'		=>	'Tr�ksta vienos ar daugiau prad�ios �ym� [/quote] �ymai.',

// Stuff for the navigator (top of every page)
'Index'					=>	'Prad�ia',
'User list'				=>	'Vartotoj� s�ra�as',
'Rules'					=>  'Taisykl�s',
'Search'				=>  'Paie�ka',
'Register'				=>  'Registruotis',
'Login'					=>  'Prisijungti',
'Not logged in'			=>  'J�s nesate prisijung�.',
'Profile'				=>	'Profilis',
'Logout'				=>	'I�eiti',
'Logged in as'			=>	'Prisijung�s kaip',
'Admin'					=>	'Administravimas',
'Last visit'			=>	'Paskutinis apsilankymas',
'Show new posts'		=>	'Rodyti naujas �inutes nuo paskutinio apsilankymo',
'Mark all as read'		=>	'Pa�ym�ti visas temas kaip skaitytas',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Forumo apa�ia',
'Search links'			=>	'Ie�koti nuorod�',
'Show recent posts'		=>	'Rodyti naujas �inutes',
'Show unanswered posts'	=>	'Rodyti neatsakytas �inutes',
'Show your posts'		=>	'Rodyti J�s� �inutes',
'Show subscriptions'	=>	'Rodyti J�s� sukurtas temas',
'Jump to'				=>	'Pereiti �',
'Go'					=>	' Pereiti ',		// submit button in forum jump
'Move topic'			=>  'Perkelti tem�',
'Open topic'			=>  'Atidaryti tem�',
'Close topic'			=>  'U�daryti tem�',
'Unstick topic'			=>  'Nuimti svarbum�',
'Stick topic'			=>  'U�d�ti svarbum�',
'Moderate forum'		=>	'Moderuoti forum�',
'Delete posts'			=>	'Trinti kelet� �inu�i�',
'Debug table'			=>	'Klaid� taisymo informacija',

// For extern.php RSS feed
'RSS Desc Active'	=>	'Aktyviausios temos',	// board_title will be appended to this string
'RSS Desc New'			=>	'Naujausios temos',					// board_title will be appended to this string
'Posted'				=>	'Para�yta'	// The date/time a topic was started

);
