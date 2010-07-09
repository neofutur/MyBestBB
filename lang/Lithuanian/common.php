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
'Bad request'			=>	'Bloga uþklausa. Nuoroda, kurià sekate yra neteisinga arba nebegaliojanti.',
'No view'				=>	'Jûs neturite teisës perþiûrëti ðiø forumø.',
'No permission'			=>	'Jûs neturite teisës prieiti prie ðio puslapio.',
'Bad referrer'			=>	'Blogas nukreipimas. Jûs buvote nukreiptas á ðá puslapá nuo neágalioto ðaltinio. Jei problema kartojasi, praðome patikrinti ar \'Startinis Adresas\' yra teisingai nustatytas nustatymuose. Daugiau informacijos, susijusios su nukreipimø tikrinimu, galite rasti PunBB dokumentacijoje.',

// Topic/forum indicators
'New icon'				=>	'Yra naujø þinuèiø',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Ði tema yra uþdaryta',
'Redirect icon'			=>	'Perkeltas forumas',

// Miscellaneous
'Announcement'			=>	'Skelbimas',
'Options'				=>	'Nustatymai',
'Actions'				=>	'Veiksmai',
'Submit'				=>	'Patvirtinimas',	// "name" of submit buttons
'Ban message'			=>	'Jums priëimas prie ðio forumo uþdraustas.',
'Ban message 2'			=>	'Draudimas baigiasi',
'Ban message 3'			=>	'Administratorius ar moderatorius, kuris uþdraudë jums priëimà, paliko þinutæ:',
'Ban message 4'			=>	'Praðome kreiptis ávairiais klausimais á forumo administratoriø adresu',
'Never'					=>	'Niekada',
'Today'					=>	'Ðiandien',
'Yesterday'				=>	'Vakar',
'Info'					=>	'Informacija',		// a common table header
'Go back'				=>	'Atgal',
'Maintenance'			=>	'Einamasis remontas',
'Redirecting'			=>	'Perkeliama',
'Click redirect'		=>	'Spauskite èia, jei nenorite ilgiau laukti (arba jei Jûsø narðyklë negali automatiðkai perkelti)',
'on'					=>	'ájungta',		// as in "BBCode is on"
'off'					=>	'iðjungta',
'Invalid e-mail'		=>	'E-paðto adresas, kurá ávedëte, yra netinkamas.',
'required field'		=>	'yra bûtinas laukas ðioje formoje.',	// for javascript form validation
'Last post'				=>	'Paskutinë þinutë',
'by'					=>	'nuo',	// as in last post by someuser
'New posts'				=>	'Naujos&nbsp;þinutës',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Eiti link pirmos þinutës ðioje temoje.',	// the popup text for new posts links
'Username'				=>	'Vartotojo vardas',
'Password'				=>	'Slaptaþodis',
'E-mail'				=>	'E-paðtas',
'Send e-mail'			=>	'Siøsti laiðkà',
'Moderated by'			=>	'Moderuoja',
'Registered'			=>	'Registravosi',
'Subject'				=>	'Tematika',
'Message'				=>	'Þinutë',
'Topic'					=>	'Tema',
'Forum'					=>	'Forumas',
'Posts'					=>	'Þinutës',
'Replies'				=>	'Atsakymai',
'Author'				=>	'Autorius',
'Pages'					=>	'Puslapiai',
'BBCode'				=>	'BBKodas',	// You probably shouldn't change this
'img tag'				=>	'[img] þyma',
'Smilies'				=>	'Ðypsenos',
'and'					=>	'ir',
'Image link'			=>	'paveikslëlis',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'raðë',	// For [quote]'s
'Code'					=>	'Kodas',		// For [code]'s
'Mailer'				=>	'Siuntëjas',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Svarbi informacija',
'Write message legend'	=>	'Paraðykite savo þinutæ ir patvirtinkite',

// Title
'Title'					=>	'Pavadinimas',
'Member'				=>	'Narys',	// Default title
'Moderator'				=>	'Moderatorius',
'Administrator'			=>	'Administratorius',
'Banned'				=>	'Uþdraustas vartotojas',
'Guest'					=>	'Sveèias',

// Stuff for include/parser.php
'BBCode error'			=>	'BBKodo sintaksë þinutëje yra neteisinga.',
'BBCode error 1'		=>	'Trûksta pradþios þymos [/quote] þymei.',
'BBCode error 2'		=>	'Trûksta pabaigos þymos [code] þymei.',
'BBCode error 3'		=>	'Trûksta pradþios þymos [/code] þymei.',
'BBCode error 4'		=>	'Trûksta vienos ar daugiau pabaigos þymø [quote] þymai.',
'BBCode error 5'		=>	'Trûksta vienos ar daugiau pradþios þymø [/quote] þymai.',

// Stuff for the navigator (top of every page)
'Index'					=>	'Pradþia',
'User list'				=>	'Vartotojø sàraðas',
'Rules'					=>  'Taisyklës',
'Search'				=>  'Paieðka',
'Register'				=>  'Registruotis',
'Login'					=>  'Prisijungti',
'Not logged in'			=>  'Jûs nesate prisijungæ.',
'Profile'				=>	'Profilis',
'Logout'				=>	'Iðeiti',
'Logged in as'			=>	'Prisijungæs kaip',
'Admin'					=>	'Administravimas',
'Last visit'			=>	'Paskutinis apsilankymas',
'Show new posts'		=>	'Rodyti naujas þinutes nuo paskutinio apsilankymo',
'Mark all as read'		=>	'Paþymëti visas temas kaip skaitytas',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Forumo apaèia',
'Search links'			=>	'Ieðkoti nuorodø',
'Show recent posts'		=>	'Rodyti naujas þinutes',
'Show unanswered posts'	=>	'Rodyti neatsakytas þinutes',
'Show your posts'		=>	'Rodyti Jûsø þinutes',
'Show subscriptions'	=>	'Rodyti Jûsø sukurtas temas',
'Jump to'				=>	'Pereiti á',
'Go'					=>	' Pereiti ',		// submit button in forum jump
'Move topic'			=>  'Perkelti temà',
'Open topic'			=>  'Atidaryti temà',
'Close topic'			=>  'Uþdaryti temà',
'Unstick topic'			=>  'Nuimti svarbumà',
'Stick topic'			=>  'Uþdëti svarbumà',
'Moderate forum'		=>	'Moderuoti forumà',
'Delete posts'			=>	'Trinti keletà þinuèiø',
'Debug table'			=>	'Klaidø taisymo informacija',

// For extern.php RSS feed
'RSS Desc Active'	=>	'Aktyviausios temos',	// board_title will be appended to this string
'RSS Desc New'			=>	'Naujausios temos',					// board_title will be appended to this string
'Posted'				=>	'Paraðyta'	// The date/time a topic was started

);
