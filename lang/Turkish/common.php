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
'Bad request'			=>	'Hatalý Talep.Takip ettiðiniz link yanlýþ ya da güncel deðil',
'No view'				=>	'Bu forumlarý görmek için gerekli yetkiye sahip deðilsiniz.',
'No permission'			=>	'Bu sayfaya eriþmek için  için gerekli yetkiye sahip deðilsiniz.',
'Bad referrer'			=>	'Bad HTTP_REFERER. You were referred to this page from an unauthorized source. If the problem persists please make sure that \'Base URL\' is correctly set in Admin/Options and that you are visiting the forum by navigating to that URL. More information regarding the referrer check can be found in the PunBB documentation.',

// Topic/forum indicators
'New icon'				=>	'Yeni iletiler var.',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Bu baþlýk kapandý.',
'Redirect icon'			=>	'Yönlendirilmiþ forum',

// Miscellaneous
'Announcement'			=>	'Duyuru',
'Options'				=>	'Seçenekler',
'Actions'				=>	'Faaliyetler',
'Submit'				=>	'Onayla',	// "name" of submit buttons
'Ban message'			=>	'Bu forumdan banlandýnýz.',
'Ban message 2'			=>	'Ban kaldýrýlma tarihi ',
'Ban message 3'			=>	'Banlayan yönetici bu mesajý bu mesajý size býraktý:',
'Ban message 4'			=>	'Forum yöneticisiyle iletiþim kurmak için:',
'Never'					=>	'Asla',
'Today'					=>	'Bugün',
'Yesterday'				=>	'Dün',
'Info'					=>	'Bilgi',		// a common table header
'Go back'				=>	'Geri',
'Maintenance'			=>	'Bakým',
'Redirecting'			=>	'Yönlendirilyor',
'Click redirect'		=>	'Sayfaya hemen gitmek için buraya týklayýnýz.(ya da tarayýcýnýz sizi otomatik olarak yönlendirmiyorsa)',
'on'					=>	'Açýk',		// as in "BBCode is on"
'off'					=>	'Kapalý',
'Invalid e-mail'		=>	'Girdiðiniz e-posta adresi geçerli deðil.',
'required field'		=>	'forumda dolurulmasý zorunludur.',	// for javascript form validation
'Last post'				=>	'Son gönderilen ileti',
'by'					=>	'gönderen',	// as in last post by someuser
'New posts'				=>	'Yeni&nbsp;iletiler',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Bu baþlýktaki en yeni iletiye git.',	// the popup text for new posts links
'Username'				=>	'Kullanýcý ismi',
'Password'				=>	'Þifre',
'E-mail'				=>	'e-posta',
'Send e-mail'			=>	'e-posta gönder',
'Moderated by'			=>	'Denetmen: ',
'Registered'			=>	'Kayýtlý',
'Subject'				=>	'Konu baþlýðý',
'Message'				=>	'Mesaj',
'Topic'					=>	'Baþlýk',
'Forum'					=>	'Forum',
'Posts'					=>	'Ýletiler',
'Replies'				=>	'Cevaplar',
'Author'				=>	'Yazan',
'Pages'					=>	'Sayfalar',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Gülen yüzler',
'and'					=>	've',
'Image link'			=>	'resim',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'yazdý',	// For [quote]'s
'Code'					=>	'Kod',		// For [code]'s
'Mailer'				=>	'Posta servisi',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Önemli Bilgi',
'Write message legend'	=>	'Mesajýnýzý yazýp onaylayýn.',

// Title
'Title'					=>	'Baþlýk',
'Member'				=>	'Üye',	// Default title
'Moderator'				=>	'Denetmen',
'Administrator'			=>	'Yönetici',
'Banned'				=>	'Banlanan',
'Guest'					=>	'Misafir',

// Stuff for include/parser.php
'BBCode error'			=>	'Hatalý BBCode sözdizimi.',
'BBCode error 1'		=>	'[quote] tagýný yazmadýnýz.',
'BBCode error 2'		=>	'[code] tagý kapatýlmadý.',
'BBCode error 3'		=>	'[code] tagýný yazmadýnýz.',
'BBCode error 4'		=>	'Bir ya da birden fazla [quote] tagý kapanma hatasý.',
'BBCode error 5'		=>	'Bir ya da birden fazla [/quote] tagý baþlatma hatasý.',

// Stuff for the navigator (top of every page)
'Index'					=>	'Anasayfa',
'User list'				=>	'Kullanýcýlar',
'Rules'					=>  'Kurallar',
'Search'				=>  'Arama',
'Register'				=>  'Kayýt',
'Login'					=>  'Giriþ',
'Not logged in'			=>  'Giriþ yapmadýnýz.',
'Profile'				=>	'Profil',
'Logout'				=>	'Çýkýþ',
'Logged in as'			=>	'Giriþ yapan',
'Admin'					=>	'Yönetim',
'Last visit'			=>	'Son ziyaret',
'Show new posts'		=>	'En yeni iletiler',
'Mark all as read'		=>	'Hepsini okundu olarak iþaretle',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Board footer',
'Search links'			=>	'Arama baðlantýlarý',
'Show recent posts'		=>	'Yeni iletileri göster',
'Show unanswered posts'	=>	'Cevaplanmayan iletileri göster',
'Show your posts'		=>	'Ýletilerimi göster',
'Show subscriptions'	=>	'Üye olduðum konular.',
'Jump to'				=>	'Atla',
'Go'					=>	' Git',		// submit button in forum jump
'Move topic'			=>  'Konu taþý',
'Open topic'			=>  '',
'Close topic'			=>  'Konu kapat',
'Unstick topic'			=>  'Konudaki sabit özelliðini kaldýr',
'Stick topic'			=>  'Konuyu sabitle',
'Moderate forum'		=>	'Forumu kýsýtla',
'Delete posts'			=>	'Çoklu iletileri sil',
'Debug table'			=>	'Hata ayýklama bilgileri',

// For extern.php RSS feed
'RSS Desc Active	'	=>	'Ýlgili en yeni aktif baþlýklar',	// board_title will be appended to this string
'RSS Desc New'			=>	'Ýlgili en yeni baþlýk',					// board_title will be appended to this string
'Posted'				=>	'Gönderildi'	// The date/time a topic was started

);
