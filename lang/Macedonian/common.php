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
'Bad request'			=>	'Неправилно барање. Линкот што го побаравте е неточен или застарен.',
'No view'				=>	'Вие немате дозвола за преглед на овие теми.',
'No permission'			=>	'Вие немате дозвола за преглед на оваа страна.',
'Bad referrer'			=>	'Погрешен HTTP_REFERER. Страницата што ве испрати до оваа страна не е дозволен извор за пренасочување. Видете дали \'Base URL\' е точно поставена во Администрација/Опции и дека го посетувате форумот со навигација на оваа URL. Повеќе информации за оваа грешка може да се најдат во документацијата за PunBB.',

// Topic/forum indicators
'New icon'				=>	'Нови пораки',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Оваа тема е затворена',
'Redirect icon'			=>	'Пренасочен форум',

// Miscellaneous
'Announcement'			=>	'Соопштение',
'Options'				=>	'Опции',
'Actions'				=>	'Акции',
'Submit'				=>	'Прати',	// "name" of submit buttons
'Ban message'			=>	'Вие имате забрана за овој форум.',
'Ban message 2'			=>	'Забраната истекува после',
'Ban message 3'			=>	'Администраторот или модераторот кој што ја постави забраната остави порака:',
'Ban message 4'			=>	'За сите забелешки обратете се кај администраторот на',
'Never'					=>	'Никогаш',
'Today'					=>	'Денес',
'Yesterday'				=>	'Вчера',
'Info'					=>	'Инфо',		// a common table header
'Go back'				=>	'Назад',
'Maintenance'			=>	'Одржување',
'Redirecting'			=>	'Пренасочување',
'Click redirect'		=>	'Кликнете тука ако вашиот browser не ве пренасочи автоматски',
'on'					=>	'да',		// as in "BBCode is on"
'off'					=>	'не',
'Invalid e-mail'		=>	'Е-mail адресата што ја внесовте не е валидна.',
'required field'		=>	'мора да се внесе.',	// for javascript form validation
'Last post'				=>	'Последна порака',
'by'					=>	'by',	// as in last post by someuser
'New posts'				=>	'Нови&nbsp;пораки',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Оди на првата порака во оваа тема.',	// the popup text for new posts links
'Username'				=>	'Корисничко име',
'Password'				=>	'Лозинка',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Прати e-mail',
'Moderated by'			=>	'Модерирано од',
'Registered'			=>	'Регистриран',
'Subject'				=>	'Наслов',
'Message'				=>	'Порака',
'Topic'					=>	'Тема',
'Forum'					=>	'Форум',
'Posts'					=>	'Пораки',
'Replies'				=>	'Одговори',
'Author'				=>	'Автор',
'Pages'					=>	'Страници',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] таг',
'Smilies'				=>	'Смешковци',
'and'					=>	'и',
'Image link'			=>	'image',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'напиша',	// For [quote]'s
'Code'					=>	'Код',		// For [code]'s
'Mailer'				=>	'Праќа',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Важна информација',
'Write message legend'	=>	'Напишете ја вашата порака и пратете',

// Title
'Title'					=>	'Наслов',
'Member'				=>	'Член',	// Default title
'Moderator'				=>	'Модератор',
'Administrator'			=>	'Администратор',
'Banned'				=>	'Избркан',
'Guest'					=>	'Гостин',

// Stuff for include/parser.php
'BBCode error'			=>	'BBCode синтаксата во пораката е неточна.',
'BBCode error 1'		=>	'Недостига почетен таг за [/quote].',
'BBCode error 2'		=>	'Недостига краен таг за [code].',
'BBCode error 3'		=>	'Недостига почетен таг за [/code].',
'BBCode error 4'		=>	'Недостигаат еден или повеќе крајни тагови за [quote].',
'BBCode error 5'		=>	'Недостигаат еден или повеќе почетни тагови за  [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Главна',
'User list'				=>	'Корисници',
'Rules'					=>  'Правила',
'Search'				=>  'Пребарување',
'Register'				=>  'Регистрација',
'Login'					=>  'Најавување',
'Not logged in'			=>  'Не сте најавени.',
'Profile'				=>	'Профил',
'Logout'				=>	'Одјави се',
'Logged in as'			=>	'Најавени сте како',
'Admin'					=>	'Администрација',
'Last visit'			=>	'Последна посета',
'Show new posts'		=>	'Пораки пратени после вашата последна посета',
'Mark all as read'		=>	'Обежи ги сите теми како читани',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Footer на форумот',
'Search links'			=>	'Линкови за пребарување',
'Show recent posts'		=>	'Скорашни пораки',
'Show unanswered posts'	=>	'Неодговорени пораки',
'Show your posts'		=>	'Ваши пораки',
'Show subscriptions'	=>	'Теми на кои сте претплатени',
'Jump to'				=>	'Скокни до',
'Go'					=>	' OK ',		// submit button in forum jump
'Move topic'			=>  'Премести тема',
'Open topic'			=>  'Отвори тема',
'Close topic'			=>  'Затвори тема',
'Unstick topic'			=>  'Одлепи тема од горе',
'Stick topic'			=>  'Залепи тема најгоре',
'Moderate forum'		=>	'Модерирај форум',
'Delete posts'			=>	'Избриши повеќе пораки',
'Debug table'			=>	'Debug информации',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Скорашно активни теми на',	// board_title will be appended to this string
'RSS Desc New'			=>	'Најновата тема на',					// board_title will be appended to this string
'Posted'				=>	'Пратено'	// The date/time a topic was started

);
