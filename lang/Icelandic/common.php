<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'icelandic';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'is_IS.ISO8859-1';
		break;

	default:
		$locale = 'is_IS';
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
'Bad request'			=>	'Fyrirspurn mistókst. Tengill sem þú notaðir er vitlaus eða úreltur.',
'No view'				=>	'Þú hefur ekki réttindi til að skoða þessi spjallborð.',
'No permission'			=>	'Þú hefur ekki réttindi til að komast á þessa síðu.',
'Bad referrer'			=>	'Röng tilvísun(HTTP_REFERER). Þér var vísað hingað af röngum stað. Vinsamlegast farið til baka og reynið aftur. Ef vandamálið heldur áfram verið þá viss um að  \'Base URL\' sé rétt skilgreint í Admin/Options og að þú sért að heimsækja korkana á því URL. Hægt er að finna meiri upplýsingar um HTTP_REFERER í PunBB skjöluninni.',

// Topic/forum indicators
'New icon'				=>	'Það eru nýjir póstar.',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Þessi þráður er lokaður',
'Redirect icon'			=>	'Flutt spjallborð',

// Miscellaneous
'Announcement'			=>	'Tilkynning',
'Options'				=>	'Valmöguleiki',
'Actions'				=>	'Aðgerðir',
'Submit'				=>	'Senda',	// "name" of submit buttons
'Ban message'			=>	'Þú ert í banni á þessu spjallborði.',
'Ban message 2'			=>	'Bannið rennur út ',
'Ban message 3'			=>	'Stjórnandinn eða umsjónarmaðurinn sem bannaði þig skyldi eftir þessi skilaboð: ',
'Ban message 4'			=>	'Vinsamlegast beinið öllum fyrirspurnum til stjórnandans ',
'Never'					=>	'Aldrei',
'Today'					=>	'Í dag',
'Yesterday'				=>	'Í gær',
'Info'					=>	'Upplýsingar',		// a common table header
'Go back'				=>	'Til baka',
'Maintenance'			=>	'Viðhald',
'Redirecting'			=>	'Áframsendi',
'Click redirect'		=>	'Smelltu hér ef þú vilt ekki bíða lengur (eða ef vafrinn þinn sendir þig ekki sjálfkrafa áfram)',
'on'					=>	'á',		// as in "BBCode is on"
'off'					=>	'af',
'Invalid e-mail'		=>	'Netfangið sem þú slóst inn er ekki löglegt.',
'required field'		=>	'þarfnast útfyllingar',	// for javascript form validation
'Last post'				=>	'Síðasti póstur',
'by'					=>	'eftir ',	// as in last post by someuser
'New posts'				=>	'Nýr&nbsp;póstur',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Fara á fyrsta nýja póstinn í þessum þráð.',	// the popup text for new posts links
'Username'				=>	'Notendanafn',
'Password'				=>	'Lykilorð',
'E-mail'				=>	'Netfang',
'Send e-mail'			=>	'Senda tölvupóst',
'Moderated by'			=>	'Stjórnað af',
'Registered'			=>	'Skráður',
'Subject'				=>	'Efni',
'Message'				=>	'Skilaboð',
'Topic'					=>	'Þráður',
'Forum'					=>	'Spjallborð',
'Posts'					=>	'Póstar',
'Replies'				=>	'Svör',
'Author'				=>	'Höfundur',
'Pages'					=>	'Síður',
'BBCode'				=>	'BBKóði',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Bros',
'and'					=>	'og',
'Image link'			=>	'mynd',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'skrifaði',	// For [quote]'s
'Code'					=>	'Kóði',		// For [code]'s
'Mailer'				=>	'Póstari',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Áríðandi upplýsingar',
'Write message legend'	=>	'Skrifaðu skilaboðin og sendu þau',

// Title
'Title'					=>	'Titill',
'Member'				=>	'Meðlimur',	// Default title
'Moderator'				=>	'Umsjónarmaður',
'Administrator'			=>	'Stjórnandi',
'Banned'				=>	'Bannaður',
'Guest'					=>	'Gestur',

// Stuff for include/parser.php
'BBCode error'			=>	'BBKóðinn í skilaboðinu er ekki réttur.',
'BBCode error 1'		=>	'Vantar upphafstag fyrir [/quote].',
'BBCode error 2'		=>	'Vantar endatag fyrir [code].',
'BBCode error 3'		=>	'Vantar upphafstag fyrir [/code].',
'BBCode error 4'		=>	'Vantar eitt eða fleiri endatög fyrir [quote].',
'BBCode error 5'		=>	'Vantar eitt eða fleiri upphafstög fyrir [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Yfirlit',
'User list'				=>	'Notendalisti',
'Rules'					=>  'Reglur',
'Search'				=>  'Leita',
'Register'				=>  'Skráning',
'Login'					=>  'Innskrá',
'Not logged in'			=>  'Þú ert ekki skráður inn',
'Profile'				=>	'Stillingar',
'Logout'				=>	'Útskrá',
'Logged in as'			=>	'Skráður inn sem',
'Admin'					=>	'Stjórnandi',
'Last visit'			=>	'Síðasta heimsókn',
'Show new posts'		=>	'Sýna nýja pósta frá síðustu heimsókn',
'Mark all as read'		=>	'Merkja alla þræði sem lesna',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Board footer',
'Search links'			=>	'Search links',
'Show recent posts'		=>	'Sýna nýlega pósta',
'Show unanswered posts'	=>	'Sýna ósvaraða pósta',
'Show your posts'		=>	'Sýna mína pósta',
'Show subscriptions'	=>	'Sýna áskriftarþræði',
'Jump to'				=>	'Hoppa til',
'Go'					=>	'Áfram',		// submit button in forum jump
'Move topic'			=>  'Færa þráð',
'Open topic'			=>  'Opna þráð',
'Close topic'			=>  'Loka þráð',
'Unstick topic'			=>  'Afklístra þráð',
'Stick topic'			=>  'Klístra þráð',
'Moderate forum'		=>	'Stjórna spjallborði',
'Delete posts'			=>	'Eyða mörgum póstum',
'Debug table'			=>	'Villuleitar upplýsingar',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Virkustu þræðirnir',	// board_title will be appended to this string
'RSS Desc New'			=>	'Nýjustu þræðirnir',					// board_title will be appended to this string
'Posted'				=>	'Póstað'	// The date/time a topic was started

);
