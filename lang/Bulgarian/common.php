<?php


// Determine what locale to use
switch (PHP_OS)
{
//	case 'WINNT':
//	case 'WIN32':
//		$locale = 'english';
//		break;

	case 'FreeBSD':
//	case 'NetBSD':
//	case 'OpenBSD':
		$locale = 'bg_BG.UTF-8';
		break;

	default:
		$locale = 'bg_BG';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'UTF-8',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'Грешна заявка. Връзката която се опитвате да посетите е невалидна.',
'No view'				=>	'Нямате права за да видите този форум.',
'No permission'			=>	'Нямате права за достъп до тази страница.',
'Bad referrer'			=>	'ГРЕШЕН HTTP_REFERER. Вие сте пренасочен до тук от източник без правомощия. Ако проблема е постоянен, проверете \'Базово URL\' дали е настроено правилно в Админ/Опции. Още информация за препратките може да бъде открита в PunBB документацията.',

// Topic/forum indicators
'New icon'				=>	'Няма нови теми',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Темата е затворена',
'Redirect icon'			=>	'Пренасочен форум',

// Miscellaneous
'Announcement'			=>	'Анонси',
'Options'				=>	'Опции',
'Actions'				=>	'Действия',
'Submit'				=>	'Потвърди',	// "name" of submit buttons
'Ban message'			=>	'Забранено Ви е да посещавате този форум.',
'Ban message 2'			=>	'Забраната ще пирключи',
'Ban message 3'			=>	'Администратора или Модератора който Ви е забранил достъпа до форума, остави това съобщение:',
'Ban message 4'			=>	'Моля, свържете се с Администратора',
'Never'					=>	'Никога',
'Today'					=>	'Днес',
'Yesterday'				=>	'Вчера',
'Info'					=>	'Инфо',		// a common table header
'Go back'				=>	'Назад',
'Maintenance'			=>	'Поддръжка',
'Redirecting'			=>	'Пренасочване',
'Click redirect'		=>	'Щракнете тук ако не искате да чакате',
'on'					=>	'вкл.',		// as in "BBCode is on"
'off'					=>	'изкл.',
'Invalid e-mail'		=>	'E-mail адреса който сте въвели е грешен.',
'required field'		=>	'е задължително поле зе формата.',	// for javascript form validation
'Last post'				=>	'Последно мнение',
'by'					=>	'от',	// as in last post by someuser
'New posts'				=>	'Нови&nbsp;мнения',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Зарежда първото ново мнение.',	// the popup text for new posts links
'Username'				=>	'Потребител',
'Password'				=>	'Парола',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Изпраща e-mail',
'Moderated by'			=>	'Модерирана от',
'Registered'			=>	'Регистриран',
'Subject'				=>	'Относно',
'Message'				=>	'Съобщение',
'Topic'					=>	'Тема',
'Forum'					=>	'Форум',
'Posts'					=>	'Мнения',
'Replies'				=>	'Отговори',
'Author'				=>	'Автор',
'Pages'					=>	'Страници',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] таг',
'Smilies'				=>	'Емот икони',
'and'					=>	'и',
'Image link'			=>	'изображение',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'писа',	// For [quote]'s
'Code'					=>	'Код',		// For [code]'s
'Mailer'				=>	'Изпращач',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Важна информация',
'Write message legend'	=>	'Напишете и изпрате съобщението',

// Title
'Title'					=>	'Титла',
'Member'				=>	'Член',	// Default title
'Moderator'				=>	'Модератор',
'Administrator'			=>	'Администратор',
'Banned'				=>	'Блокиран',
'Guest'					=>	'Гост',

// Stuff for include/parser.php
'BBCode error'			=>	'BBCode синтаксиса в съобщението е грешен.',
'BBCode error 1'		=>	'Липсващ начален таг за [/quote].',
'BBCode error 2'		=>	'Липсващ краен таг за [code].',
'BBCode error 3'		=>	'Липсващ начален таг за [/code].',
'BBCode error 4'		=>	'Липсват един или повече тагове за [quote].',
'BBCode error 5'		=>	'Липсват един или повече начални тагове за [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Начало',
'User list'				=>	'Потребители',
'Rules'					=>  'Правила',
'Search'				=>  'Търсене',
'Register'				=>  'Регистрация',
'Login'					=>  'Вход',
'Not logged in'			=>  'Влезли сте.',
'Profile'				=>	'Профил',
'Logout'				=>	'Изход',
'Logged in as'			=>	'Влезли сте като',
'Admin'					=>	'Администрация',
'Last visit'			=>	'Последно посещение',
'Show new posts'		=>	'Нови мнения след последното Ви посещение',
'Mark all as read'		=>	'Маркиране на всички теми като прочетени',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Board footer',
'Search links'			=>	'Търсене',
'Show recent posts'		=>	'Показва последните мнения',
'Show unanswered posts'	=>	'Показва мнения без отговор',
'Show your posts'		=>	'Показва Вашите мнения',
'Show subscriptions'	=>	'Показва теми под наблюдение',
'Jump to'				=>	'Отиди на',
'Go'					=>	' Напред ',		// submit button in forum jump
'Move topic'			=>  'Местене на тема',
'Open topic'			=>  'Отваряне на тема',
'Close topic'			=>  'Затваряне на тема',
'Unstick topic'			=>  'Премахване на важноста от тема',
'Stick topic'			=>  'Прави темата важна',
'Moderate forum'		=>	'Модериране на форум',
'Delete posts'			=>	'Изтриване на няколко мнения',
'Debug table'			=>	'Информация от дебугера',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Най-активна тема',	// board_title will be appended to this string
'RSS Desc New'			=>	'Новата тема е',					// board_title will be appended to this string
'Posted'				=>	'Започната'	// The date/time a topic was started

);
