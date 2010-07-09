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
'Bad request'			=>	'Неверный запрос. Ссылка, по которой вы пришли неверная или устаревшая.',
'No view'				=>	'Вы не имеете прав для просмотра этих форумов.',
'No permission'			=>	'Вы не имеете прав для доступа к этой странице.',
'Bad referrer'			=>	'Неверный источник. Вы попали на эту страницу из несанкционированного источника. Пожалуйста, вернитесь и попробуйте еще раз. Если проблема осталась, пожалуйста, убедитесь что \'Начальный URL\' правильно установлен в Администрирование/Свойства и, что, Вы попадаете на форум через этот URL.',

// Topic/forum indicators
'New icon'				=>	'Есть новые сообщения',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Эта тема закрыта',
'Redirect icon'			=>	'Форум перенесен',

// Miscellaneous
'Announcement'			=>	'Объявление',
'Options'				=>	'Свойства',
'Actions'				=>	'Действие',
'Submit'				=>	'Отправить',	// "name" of submit buttons
'Ban message'			=>	'На этом форуме, Вы в черном списке (забанены).',
'Ban message 2'			=>	'Время действия Вашего бана истекает',
'Ban message 3'			=>	'Забанивший Вас администратор или модератор оставил следующее сообщение:',
'Ban message 4'			=>	'Если у вас есть какие-нибудь вопросы, вы можете обратиться к администратору',
'Never'					=>	'Никогда',
'Today'					=>	'Сегодня',
'Yesterday'				=>	'Вчера',
'Info'					=>	'Информация',		// a common table header
'Go back'				=>	'Вернуться назад',
'Maintenance'			=>	'Сервис',
'Redirecting'			=>	'Переадресация',
'Click redirect'		=>	'Нажмите сюда, если вы не хотите больше ждать (или если браузер не перенаправляет Вас автоматически)',
'on'					=>	'включён',		// as in "BBCode is on"
'off'					=>	'выключен',
'Invalid e-mail'		=>	'E-mail адрес, который Вы ввели - неправильный',
'required field'		=>	'это поле обязательно для заполнения в этой форме.',	// for javascript form validation
'Last post'				=>	'Последнее сообщение',
'by'					=>	'оставил',	// as in last post by someuser
'New posts'				=>	'Новые&nbsp;сообщения',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Перейти к первому новому сообщению в этом топике.',	// the popup text for new posts links
'Username'				=>	'Имя',
'Password'				=>	'Пароль',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Послать e-mail',
'Moderated by'			=>	'Модераторы:',
'Registered'			=>	'Зарегистрирован',
'Subject'				=>	'Заголовок',
'Message'				=>	'Сообщение',
'Topic'					=>	'Тема',
'Forum'					=>	'Форум',
'Posts'					=>	'Сообщений',
'Replies'				=>	'Ответов',
'Author'				=>	'Автор',
'Pages'					=>	'Страниц',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] тег',
'Smilies'				=>	'Смайлики',
'and'					=>	'и',
'Image link'			=>	'изображение',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'написал',	// For [quote]'s
'Code'					=>	'Код',		// For [code]'s
'Mailer'				=>	'Почтовый робот',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Важная информация',
'Write message legend'	=>	'Напишите ваше сообщение и нажмите отправить',

// Title
'Title'					=>	'Статус',
'Member'				=>	'Участник',	// Default title
'Moderator'				=>	'Модератор',
'Administrator'			=>	'Администратор',
'Banned'				=>	'Забанен',
'Guest'					=>	'Гость',

// Stuff for include/parser.php
'BBCode error'			=>	'Синтаксис тегов BBCode в сообщении, неправильный.',
'BBCode error 1'		=>	'Отсутствует начальный тег для [/quote].',
'BBCode error 2'		=>	'Отсутствует конечный тег для [code].',
'BBCode error 3'		=>	'Отсутствует начальный тег для [/code].',
'BBCode error 4'		=>	'Отсутствует один или более конечных тегов для [quote].',
'BBCode error 5'		=>	'Отсутствует один или более начальных тегов для [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Список',
'User list'				=>	'Пользователи',
'Rules'					=>  'Правила',
'Search'				=>  'Поиск',
'Register'				=>  'Регистрация',
'Login'					=>  'Зайти',
'Not logged in'			=>  'Вы не зашли.',
'Profile'				=>	'Профиль',
'Logout'				=>	'Выйти',
'Logged in as'			=>	'Вы зашли как',
'Admin'					=>	'Администрирование',
'Last visit'			=>	'Ваш последний визит',
'Show new posts'		=>	'Показать новые сообщения, с момента Вашего последнего визита',
'Mark all as read'		=>	'Пометить все форумы как прочитанные',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Board footer',
'Search links'			=>	'Search links',
'Show recent posts'		=>	'Показать последние сообщения',
'Show unanswered posts'	=>	'Показать сообщения, не имеющие ответов',
'Show your posts'		=>	'Показать Ваши сообщения',
'Show subscriptions'	=>	'Показать сообщения на которые Вы подписаны',
'Jump to'				=>	'Перейти',
'Go'					=>	' Перейти ',		// submit button in forum jump
'Move topic'			=>  'Перенести тему',
'Open topic'			=>  'Открыть тему',
'Close topic'			=>  'Закрыть тему',
'Unstick topic'			=>  'Снять выделение',
'Stick topic'			=>  'Выделить тему',
'Moderate forum'		=>	'Модерировать форум',
'Delete posts'			=>	'Удалить сообщения',
'Debug table'			=>	'Отладочная информация',

// For extern.php RSS feed
'RSS Desc Active'		=>	'The most recently active topics at',	// board_title will be appended to this string
'RSS Desc New'			=>	'The newest topics at',					// board_title will be appended to this string
'Posted'				=>	'Posted'	// The date/time a topic was started

);
