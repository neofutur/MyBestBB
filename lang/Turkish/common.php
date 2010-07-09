<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'turkish';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'tr_TR.ISO8859-9';
		break;

	default:
		$locale = 'tr_TR';
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
'Bad request'			=>	'Hatal� Talep.Takip etti�iniz link yanl�� ya da g�ncel de�il',
'No view'				=>	'Bu forumlar� g�rmek i�in gerekli yetkiye sahip de�ilsiniz.',
'No permission'			=>	'Bu sayfaya eri�mek i�in  i�in gerekli yetkiye sahip de�ilsiniz.',
'Bad referrer'			=>	'Bad HTTP_REFERER. You were referred to this page from an unauthorized source. If the problem persists please make sure that \'Base URL\' is correctly set in Admin/Options and that you are visiting the forum by navigating to that URL. More information regarding the referrer check can be found in the PunBB documentation.',

// Topic/forum indicators
'New icon'				=>	'Yeni iletiler var.',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Bu ba�l�k kapand�.',
'Redirect icon'			=>	'Y�nlendirilmi� forum',

// Miscellaneous
'Announcement'			=>	'Duyuru',
'Options'				=>	'Se�enekler',
'Actions'				=>	'Faaliyetler',
'Submit'				=>	'Onayla',	// "name" of submit buttons
'Ban message'			=>	'Bu forumdan banland�n�z.',
'Ban message 2'			=>	'Ban kald�r�lma tarihi ',
'Ban message 3'			=>	'Banlayan y�netici bu mesaj� bu mesaj� size b�rakt�:',
'Ban message 4'			=>	'Forum y�neticisiyle ileti�im kurmak i�in:',
'Never'					=>	'Asla',
'Today'					=>	'Bug�n',
'Yesterday'				=>	'D�n',
'Info'					=>	'Bilgi',		// a common table header
'Go back'				=>	'Geri',
'Maintenance'			=>	'Bak�m',
'Redirecting'			=>	'Y�nlendirilyor',
'Click redirect'		=>	'Sayfaya hemen gitmek i�in buraya t�klay�n�z.(ya da taray�c�n�z sizi otomatik olarak y�nlendirmiyorsa)',
'on'					=>	'A��k',		// as in "BBCode is on"
'off'					=>	'Kapal�',
'Invalid e-mail'		=>	'Girdi�iniz e-posta adresi ge�erli de�il.',
'required field'		=>	'forumda dolurulmas� zorunludur.',	// for javascript form validation
'Last post'				=>	'Son g�nderilen ileti',
'by'					=>	'g�nderen',	// as in last post by someuser
'New posts'				=>	'Yeni&nbsp;iletiler',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Bu ba�l�ktaki en yeni iletiye git.',	// the popup text for new posts links
'Username'				=>	'Kullan�c� ismi',
'Password'				=>	'�ifre',
'E-mail'				=>	'e-posta',
'Send e-mail'			=>	'e-posta g�nder',
'Moderated by'			=>	'Denetmen: ',
'Registered'			=>	'Kay�tl�',
'Subject'				=>	'Konu ba�l���',
'Message'				=>	'Mesaj',
'Topic'					=>	'Ba�l�k',
'Forum'					=>	'Forum',
'Posts'					=>	'�letiler',
'Replies'				=>	'Cevaplar',
'Author'				=>	'Yazan',
'Pages'					=>	'Sayfalar',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'G�len y�zler',
'and'					=>	've',
'Image link'			=>	'resim',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'yazd�',	// For [quote]'s
'Code'					=>	'Kod',		// For [code]'s
'Mailer'				=>	'Posta servisi',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'�nemli Bilgi',
'Write message legend'	=>	'Mesaj�n�z� yaz�p onaylay�n.',

// Title
'Title'					=>	'Ba�l�k',
'Member'				=>	'�ye',	// Default title
'Moderator'				=>	'Denetmen',
'Administrator'			=>	'Y�netici',
'Banned'				=>	'Banlanan',
'Guest'					=>	'Misafir',

// Stuff for include/parser.php
'BBCode error'			=>	'Hatal� BBCode s�zdizimi.',
'BBCode error 1'		=>	'[quote] tag�n� yazmad�n�z.',
'BBCode error 2'		=>	'[code] tag� kapat�lmad�.',
'BBCode error 3'		=>	'[code] tag�n� yazmad�n�z.',
'BBCode error 4'		=>	'Bir ya da birden fazla [quote] tag� kapanma hatas�.',
'BBCode error 5'		=>	'Bir ya da birden fazla [/quote] tag� ba�latma hatas�.',

// Stuff for the navigator (top of every page)
'Index'					=>	'Anasayfa',
'User list'				=>	'Kullan�c�lar',
'Rules'					=>  'Kurallar',
'Search'				=>  'Arama',
'Register'				=>  'Kay�t',
'Login'					=>  'Giri�',
'Not logged in'			=>  'Giri� yapmad�n�z.',
'Profile'				=>	'Profil',
'Logout'				=>	'��k��',
'Logged in as'			=>	'Giri� yapan',
'Admin'					=>	'Y�netim',
'Last visit'			=>	'Son ziyaret',
'Show new posts'		=>	'En yeni iletiler',
'Mark all as read'		=>	'Hepsini okundu olarak i�aretle',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Board footer',
'Search links'			=>	'Arama ba�lant�lar�',
'Show recent posts'		=>	'Yeni iletileri g�ster',
'Show unanswered posts'	=>	'Cevaplanmayan iletileri g�ster',
'Show your posts'		=>	'�letilerimi g�ster',
'Show subscriptions'	=>	'�ye oldu�um konular.',
'Jump to'				=>	'Atla',
'Go'					=>	' Git',		// submit button in forum jump
'Move topic'			=>  'Konu ta��',
'Open topic'			=>  '',
'Close topic'			=>  'Konu kapat',
'Unstick topic'			=>  'Konudaki sabit �zelli�ini kald�r',
'Stick topic'			=>  'Konuyu sabitle',
'Moderate forum'		=>	'Forumu k�s�tla',
'Delete posts'			=>	'�oklu iletileri sil',
'Debug table'			=>	'Hata ay�klama bilgileri',

// For extern.php RSS feed
'RSS Desc Active	'	=>	'�lgili en yeni aktif ba�l�klar',	// board_title will be appended to this string
'RSS Desc New'			=>	'�lgili en yeni ba�l�k',					// board_title will be appended to this string
'Posted'				=>	'G�nderildi'	// The date/time a topic was started

);
