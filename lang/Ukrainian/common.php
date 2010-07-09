<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'ukrainian';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'uk_UA.UTF-8';
		break;

	default:
		$locale = 'uk_UA.UTF-8';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'UTF-8',
'lang_multibyte'		=>	true,

// Notices
'Bad request'			=>	'Невірний запит. Посилання, по якому Ви прийшли невірне або застаріле.',
'No view'				=>	'У Вас немає прав для перегляду цих форумів.',
'No permission'			=>	'У Вас немає прав для доступу до цієї сторінки.',
'Bad referrer'			=>	'Невірне джерело. Ви потрапили на цю сторінку з несанкціонованого джерела. Будь ласка, поверніться назад і спробуйте ще раз. Якщо проблема залишилась, будь ласка, впевніться що \'Початковий URL\' вірно встановлений в Адміністрування/Властивості і що Ви потрапяєте на форум через цей URL.',

// Topic/forum indicators
'New icon'				=>	'Нові повідомлення',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Ця тема закрита',
'Redirect icon'			=>	'Форум перенесений',

// Miscellaneous
'Announcement'			=>	'Оголошення',
'Options'				=>	'Властивості',
'Actions'				=>	'Дії',
'Submit'				=>	'Відіслати',	// "name" of submit buttons
'Ban message'			=>	'На цьому форумі Ви в чорному списку (забанені).',
'Ban message 2'			=>	'Час дії Вашого бана закінчується',
'Ban message 3'			=>	'Адміністратор чи модератор, що вніс Вас у чорний список, залишив наступне повідомлення:',
'Ban message 4'			=>	'Якщо у Вас є якісь запитання, Ви можете звернутись до адміністратора за адресю:',
'Never'					=>	'Ніколи',
'Today'					=>	'Сьогодні',
'Yesterday'				=>	'Вчора',
'Info'					=>	'Інформація',		// a common table header
'Go back'				=>	'Повернутись назад',
'Maintenance'			=>	'Сервіс',
'Redirecting'			=>	'Переадресація',
'Click redirect'		=>	'Натисніть сюди, якщо Ви не хочете більше чекати (або якщо браузер не перенаправляє Вас автоматично)',
'on'					=>	'ввімкнено',		// as in "BBCode is on"
'off'					=>	'вимкнено',
'Invalid e-mail'		=>	'E-mail адреса, яку Ви ввели, невірна.',
'required field'		=>	'є обов\'язковим полем для заповнення в цій формі.',	// for javascript form validation
'Last post'				=>	'Останнє повідомлення',
'by'					=>	'залишив',	// as in last post by someuser
'New posts'				=>	'Нові&nbsp;повідомлення',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Перейти до першого нового повідомлення в цій темі.',	// the popup text for new posts links
'Username'				=>	'Логін',
'Password'				=>	'Пароль',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Надіслати e-mail',
'Moderated by'			=>	'Модератори:',
'Registered'			=>	'Зареєстрований',
'Subject'				=>	'Заголовок',
'Message'				=>	'Повідомлення',
'Topic'					=>	'Тема',
'Forum'					=>	'Форум',
'Posts'					=>	'Повідомлень',
'Replies'				=>	'Відповідей',
'Author'				=>	'Автор',
'Pages'					=>	'Сторінок',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'тег [img]',
'Smilies'				=>	'Смайлики',
'and'					=>	'і',
'Image link'			=>	'зображення',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'написав',	// For [quote]'s
'Code'					=>	'Код',		// For [code]'s
'Mailer'				=>	'Поштовий робот',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Важлива інформація',
'Write message legend'	=>	'Напишіть ваше повідомлення і натисніть "Відіслати"',

// Title
'Title'					=>	'Статус',
'Member'				=>	'Учасник',	// Default title
'Moderator'				=>	'Модератор',
'Administrator'			=>	'Адміністратор',
'Banned'				=>	'Забанений',
'Guest'					=>	'Гість',

// Stuff for include/parser.php
'BBCode error'			=>	'Синтаксис тегів BBCode у повідомленні невірний.',
'BBCode error 1'		=>	'Відсутній початковий тег для [/quote].',
'BBCode error 2'		=>	'Відсутній кінцевий тег для [code].',
'BBCode error 3'		=>	'Відсутній початковий тег для [/code].',
'BBCode error 4'		=>	'Відсутній один чи більше кінцевих тегів для [quote].',
'BBCode error 5'		=>	'Відсутній один чи більше початкових тегів для [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Список',
'User list'				=>	'Користувачі',
'Rules'					=>  'Правила',
'Search'				=>  'Пошук',
'Register'				=>  'Реєстрація',
'Login'					=>  'Зайти',
'Not logged in'			=>  'Ви не зайшли.',
'Profile'				=>	'Профіль',
'Logout'				=>	'Вийти',
'Logged in as'			=>	'Ви зайшли як',
'Admin'					=>	'Адміністрування',
'Last visit'			=>	'Ваш останній візит',
'Show new posts'		=>	'Показати нові повідомлення з моменту Вашого останнього візиту',
'Mark all as read'		=>	'Помітити всі форуми як прочитані',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Нижній колонтитул',
'Search links'			=>	'Пошукові посилання',
'Show recent posts'		=>	'Показати останні повідомлення',
'Show unanswered posts'	=>	'Показати повідомлення, на які немає відповіді',
'Show your posts'		=>	'Показати Ваші повідомлення',
'Show subscriptions'	=>	'Показати повідомлення, на які Ви підписані',
'Jump to'				=>	'Перейти',
'Go'					=>	' Перейти ',		// submit button in forum jump
'Move topic'			=>  'Перенести тему',
'Open topic'			=>  'Відкрити тему',
'Close topic'			=>  'Закрити тему',
'Unstick topic'			=>  'Відкріпити тему',
'Stick topic'			=>  'Прикріпити тему',
'Moderate forum'		=>	'Модерувати форум',
'Delete posts'			=>	'Знищити позначені повідомлення',
'Debug table'			=>	'Інформація для відлагодження',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Активні теми на',	// board_title will be appended to this string
'RSS Desc New'			=>	'Нові теми на',					// board_title will be appended to this string
'Posted'				=>	'Створена'	// The date/time a topic was started

);
