<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'russian';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'ru_RU.CP1251';
		break;

	default:
		$locale = 'ru_RU';
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
'Bad request'			=>	'Памылковы запыт. Спасылка, па якой вы прыйшлі памылковыя ці ўстарэлая.',
'No view'				=>	'Вы не имеете прав для просмотра этих форумов.',
'No permission'			=>	'Вы не имеете прав для доступа к этой странице.',
'Bad referrer'			=>	'Неверный источник. Вы попали на эту страницу из несанкционированного источника. Пожалуйста, вернитесь и попробуйте еще раз. Если проблема осталась, пожалуйста, убедитесь что \'Начальный URL\' правильно установлен в Администрирование/Свойства и, что, Вы попадаете на форум через этот URL.',

// Topic/forum indicators
'New icon'				=>	'Ёсьць новыя паведамленьні',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Зачынена',
'Redirect icon'			=>	'форум перанесен',

// Miscellaneous
'Announcement'			=>	'Абвестка',
'Options'				=>	'Опцыі',
'Actions'				=>	'Дзеяньне',
'Submit'				=>	'Адправіць',	// "name" of submit buttons
'Ban message'			=>	'На гэтым форуме вы ў чорным сьпісе.',
'Ban message 2'			=>	'Тэрмін дзеяньня БАНа завершвается',
'Ban message 3'			=>	'Адміністратар ці мадэратар, які Вас заБАНіў, пакінуў паведамленьне:',
'Ban message 4'			=>	'Калі ў Вас ёсьць нейкія пытаньні, зьвяртайцеся да адміністратара',
'Never'					=>	'Ніколі',
'Today'					=>	'Сёньня',
'Yesterday'				=>	'Учора',
'Info'					=>	'Інфармацыя',		// a common table header
'Go back'				=>	'Вернуцца назад',
'Maintenance'			=>	'Сэрвис',
'Redirecting'			=>	'Пераадрасацыя',
'Click redirect'		=>	'Націсьніце сюды, калі не жадаеце больш чакаць ці калі браўзер не накіроўвае вас аўтаматычна.',
'on'					=>	'уключаны',		// as in "BBCode is on"
'off'					=>	'выключаны',
'Invalid e-mail'		=>	'E-mail адрас, які Вы пазначылі - несапраўдны',
'required field'		=>	'Гэтае поле абавязкова дзеля запаўнеьня.',	// for javascript form validation
'Last post'				=>	'Апошняе паведамленьне',
'by'					=>	'пакінуў',	// as in last post by someuser
'New posts'				=>	'Новыя&nbsp;паведамленьні',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Перайсьці да першага новага паведамленьня ў тэме.',	// the popup text for new posts links
'Username'				=>	'Імя',
'Password'				=>	'Пароль',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Адправіць e-mail',
'Moderated by'			=>	'Мадэратары:',
'Registered'			=>	'Зарэгістраваны',
'Subject'				=>	'Загаловак',
'Message'				=>	'Паведамленьне',
'Topic'					=>	'Тэма',
'Forum'					=>	'Форум',
'Posts'					=>	'Паведамленьні',
'Replies'				=>	'Адказы',
'Author'				=>	'Аўтар',
'Pages'					=>	'Старонак',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] тэг',
'Smilies'				=>	'Смайлы',
'and'					=>	'і',
'Image link'			=>	'вобразатворы',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'напісаў',	// For [quote]'s
'Code'					=>	'Код',		// For [code]'s
'Mailer'				=>	'Паштовы робат LT Group',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Важная інфармацыя',
'Write message legend'	=>	'Напішыце вашае паведамленьне й націсьніце адправіць',

// Title
'Title'					=>	'Статус',
'Member'				=>	'Удзельнік',	// Default title
'Moderator'				=>	'Мадэратар',
'Administrator'			=>	'Адміністратар',
'Banned'				=>	'Забанены',
'Guest'					=>	'Госьць',

// Stuff for include/parser.php
'BBCode error'			=>	'Сінтаксіс тэгаў BBCode у паведамленьні памылковы.',
'BBCode error 1'		=>	'Адсутнічае пачатковы тэг [/quote].',
'BBCode error 2'		=>	'Адсутнічае канцавы тэг [code].',
'BBCode error 3'		=>	'Адсутнічае пачатковы тэг [/code].',
'BBCode error 4'		=>	'Адсутнічае адзін ці болей канцавых тэгаў [quote].',
'BBCode error 5'		=>	'Адсутнічае адзін ці болей пачатковых тэгаў [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Форумы',
'User list'				=>	'Карыстальнікі',
'Rules'					=>  'Правілы',
'Search'				=>  'Пошук',
'Register'				=>  'Рэгістрацыя',
'Login'					=>  'Увайсьці',
'Not logged in'			=>  'Вы не зайшлі',
'Profile'				=>	'Профіль',
'Logout'				=>	'Выйсьці',
'Logged in as'			=>	'Вы зайшлі як',
'Admin'					=>	'Адміністраваньне',
'Last visit'			=>	'Ваш апошні візіт',
'Show new posts'		=>	'Новыя паведамленьні',
'Mark all as read'		=>	'Пазначыць усе форумы як прачытаныя',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Board footer',
'Search links'			=>	'Search links',
'Show recent posts'		=>	'Апошнія паведамленьні',
'Show unanswered posts'	=>	'Паведамленьні, якія ня маюць адказаў',
'Show your posts'		=>	'Вашы паведамленьні',
'Show subscriptions'	=>	'Паведамленьні, на якія вы падпісаны',
'Jump to'				=>	'Перайсьці',
'Go'					=>	' Перайсьці ',		// submit button in forum jump
'Move topic'			=>  'Перанесьці тэму',
'Open topic'			=>  'Адчыніць тэму',
'Close topic'			=>  'Зачыніць тэму',
'Unstick topic'			=>  'Скасаваць выдзяленьне',
'Stick topic'			=>  'Выдзяліць тэму',
'Moderate forum'		=>	'Мадэраваць форум',
'Delete posts'			=>	'Выдаліць паведамленьні',
'Debug table'			=>	'Інфармацыя наладжваньня',

// For extern.php RSS feed
'RSS Desc Active'		=>	'The most recently active topics at',	// board_title will be appended to this string
'RSS Desc New'			=>	'The newest topics at',					// board_title will be appended to this string
'Posted'				=>	'Posted'	// The date/time a topic was started

);
