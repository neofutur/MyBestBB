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
'Bad request'			=>	'Fyrirspurn mist�kst. Tengill sem �� nota�ir er vitlaus e�a �reltur.',
'No view'				=>	'�� hefur ekki r�ttindi til a� sko�a �essi spjallbor�.',
'No permission'			=>	'�� hefur ekki r�ttindi til a� komast � �essa s��u.',
'Bad referrer'			=>	'R�ng tilv�sun(HTTP_REFERER). ��r var v�sa� hinga� af r�ngum sta�. Vinsamlegast fari� til baka og reyni� aftur. Ef vandam�li� heldur �fram veri� �� viss um a�  \'Base URL\' s� r�tt skilgreint � Admin/Options og a� �� s�rt a� heims�kja korkana � �v� URL. H�gt er a� finna meiri uppl�singar um HTTP_REFERER � PunBB skj�luninni.',

// Topic/forum indicators
'New icon'				=>	'�a� eru n�jir p�star.',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'�essi �r��ur er loka�ur',
'Redirect icon'			=>	'Flutt spjallbor�',

// Miscellaneous
'Announcement'			=>	'Tilkynning',
'Options'				=>	'Valm�guleiki',
'Actions'				=>	'A�ger�ir',
'Submit'				=>	'Senda',	// "name" of submit buttons
'Ban message'			=>	'�� ert � banni � �essu spjallbor�i.',
'Ban message 2'			=>	'Banni� rennur �t ',
'Ban message 3'			=>	'Stj�rnandinn e�a umsj�narma�urinn sem banna�i �ig skyldi eftir �essi skilabo�: ',
'Ban message 4'			=>	'Vinsamlegast beini� �llum fyrirspurnum til stj�rnandans ',
'Never'					=>	'Aldrei',
'Today'					=>	'� dag',
'Yesterday'				=>	'� g�r',
'Info'					=>	'Uppl�singar',		// a common table header
'Go back'				=>	'Til baka',
'Maintenance'			=>	'Vi�hald',
'Redirecting'			=>	'�framsendi',
'Click redirect'		=>	'Smelltu h�r ef �� vilt ekki b��a lengur (e�a ef vafrinn �inn sendir �ig ekki sj�lfkrafa �fram)',
'on'					=>	'�',		// as in "BBCode is on"
'off'					=>	'af',
'Invalid e-mail'		=>	'Netfangi� sem �� sl�st inn er ekki l�glegt.',
'required field'		=>	'�arfnast �tfyllingar',	// for javascript form validation
'Last post'				=>	'S��asti p�stur',
'by'					=>	'eftir ',	// as in last post by someuser
'New posts'				=>	'N�r&nbsp;p�stur',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Fara � fyrsta n�ja p�stinn � �essum �r��.',	// the popup text for new posts links
'Username'				=>	'Notendanafn',
'Password'				=>	'Lykilor�',
'E-mail'				=>	'Netfang',
'Send e-mail'			=>	'Senda t�lvup�st',
'Moderated by'			=>	'Stj�rna� af',
'Registered'			=>	'Skr��ur',
'Subject'				=>	'Efni',
'Message'				=>	'Skilabo�',
'Topic'					=>	'�r��ur',
'Forum'					=>	'Spjallbor�',
'Posts'					=>	'P�star',
'Replies'				=>	'Sv�r',
'Author'				=>	'H�fundur',
'Pages'					=>	'S��ur',
'BBCode'				=>	'BBK��i',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Bros',
'and'					=>	'og',
'Image link'			=>	'mynd',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'skrifa�i',	// For [quote]'s
'Code'					=>	'K��i',		// For [code]'s
'Mailer'				=>	'P�stari',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'�r��andi uppl�singar',
'Write message legend'	=>	'Skrifa�u skilabo�in og sendu �au',

// Title
'Title'					=>	'Titill',
'Member'				=>	'Me�limur',	// Default title
'Moderator'				=>	'Umsj�narma�ur',
'Administrator'			=>	'Stj�rnandi',
'Banned'				=>	'Banna�ur',
'Guest'					=>	'Gestur',

// Stuff for include/parser.php
'BBCode error'			=>	'BBK��inn � skilabo�inu er ekki r�ttur.',
'BBCode error 1'		=>	'Vantar upphafstag fyrir [/quote].',
'BBCode error 2'		=>	'Vantar endatag fyrir [code].',
'BBCode error 3'		=>	'Vantar upphafstag fyrir [/code].',
'BBCode error 4'		=>	'Vantar eitt e�a fleiri endat�g fyrir [quote].',
'BBCode error 5'		=>	'Vantar eitt e�a fleiri upphafst�g fyrir [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Yfirlit',
'User list'				=>	'Notendalisti',
'Rules'					=>  'Reglur',
'Search'				=>  'Leita',
'Register'				=>  'Skr�ning',
'Login'					=>  'Innskr�',
'Not logged in'			=>  '�� ert ekki skr��ur inn',
'Profile'				=>	'Stillingar',
'Logout'				=>	'�tskr�',
'Logged in as'			=>	'Skr��ur inn sem',
'Admin'					=>	'Stj�rnandi',
'Last visit'			=>	'S��asta heims�kn',
'Show new posts'		=>	'S�na n�ja p�sta fr� s��ustu heims�kn',
'Mark all as read'		=>	'Merkja alla �r��i sem lesna',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Board footer',
'Search links'			=>	'Search links',
'Show recent posts'		=>	'S�na n�lega p�sta',
'Show unanswered posts'	=>	'S�na �svara�a p�sta',
'Show your posts'		=>	'S�na m�na p�sta',
'Show subscriptions'	=>	'S�na �skriftar�r��i',
'Jump to'				=>	'Hoppa til',
'Go'					=>	'�fram',		// submit button in forum jump
'Move topic'			=>  'F�ra �r��',
'Open topic'			=>  'Opna �r��',
'Close topic'			=>  'Loka �r��',
'Unstick topic'			=>  'Afkl�stra �r��',
'Stick topic'			=>  'Kl�stra �r��',
'Moderate forum'		=>	'Stj�rna spjallbor�i',
'Delete posts'			=>	'Ey�a m�rgum p�stum',
'Debug table'			=>	'Villuleitar uppl�singar',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Virkustu �r��irnir',	// board_title will be appended to this string
'RSS Desc New'			=>	'N�justu �r��irnir',					// board_title will be appended to this string
'Posted'				=>	'P�sta�'	// The date/time a topic was started

);
