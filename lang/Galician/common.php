<?php

// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'galician';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'gl_ES.ISO8859-1';
		break;

	default:
		$locale = 'gl_ES';
		break;
}

// Attempt to set the locale (required for fulltext indexing to work correctly)
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'Solicitude errónea. O enlace seguido é incorrecto ou caducou.',
'No view'				=>	'Careces de permisos para ver estes foros.',
'No permission'			=>	'Careces de permisos para acceder a esta páxina',
'Bad referrer'			=>	'HTTP_REFERER erróneo. Fuches dirixido a esta páxina dende unha fonte non autorizada. Se o problema continúa por favor asegurate que a \'URL base\' está correctamente configurada en Admin/Options e que estás visitando o foro dende esta URL. Podes atopar máis información sobre este tema na documentación de PUNBB.',

// Topic/forum indicators
'New icon'				=>	'Hai mensaxes novos',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Este tema está pechado',
'Redirect icon'			=>	'Foro redirixido',

// Miscellaneous
'Announcement'			=>	'Aviso',
'Options'				=>	'Opcións',
'Actions'				=>	'Accións',
'Submit'				=>	'Enviar',	// "name" of submit buttons
'Ban message'			=>	'Estás expulsado deste foro. ',
'Ban message 2'			=>	'A expulsión expira ó final de',
'Ban message 3'			=>	'O administrador ou moderador que te expulsou deixou o seguinte mensaxe:',
'Ban message 4'			=>	'Por favor dirixir calquera pregunta ó administrador do foro en',
'Never'					=>	'Nunca',
'Today'					=>	'Hoxe',
'Yesterday'				=>	'Onte',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Volver atrás',
'Maintenance'			=>	'Mantemento',
'Redirecting'			=>	'Redirixindo',
'Click redirect'		=>	'Fai clic aquí se non queres agardar máis (ou se o teu explorador non te reenvía automaticamente)',
'on'					=>	'activo',		// as in "BBCODE is on"
'off'					=>	'inactivo',
'Invalid e-mail'		=>	'O enderezo de correo que entraches non é válido.',
'required field'		=>	'é un campo requirido neste formulario.',	// for javascript form validation
'Last post'				=>	'Ultimo mensaxe',
'by'					=>	'por',	// as in last pos by someuser
'New posts'				=>	'Mensaxes&nbsp;novos',	// the link that leads to the first new pos (use &nbsp; for spaces)
'New posts info'		=>	'Ir ó primeiro mensaxe novo deste tema.',	// the popup text for new posts links
'Username'				=>	'Nome de usuario (seudónimo)',
'Password'				=>	'Contraseña',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Envía e-mail',
'Moderated by'			=>	'Moderado por',
'Registered'			=>	'Rexistrado',
'Subject'				=>	'Asunto',
'Message'				=>	'Mensaxe',
'Topic'					=>	'Tema',
'Forum'					=>	'Foro',
'Posts'					=>	'Mensaxes',
'Replies'				=>	'Respostas',
'Author'				=>	'Autor',
'Pages'					=>	'Páxinas',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'Marcador [img]',
'Smilies'				=>	'Smileys',
'and'					=>	'e',
'Image link'			=>	'imaxe',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'dixo',	// For [quote]'s
'Code'					=>	'Código',		// For [code]'s
'Mailer'				=>	'Administrador de correo',	// As in "MYFORUMS Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Información importante',
'Write message legend'	=>	'Escribe a túa mensaxe e envíao',

// Title
'Title'					=>	'Título',
'Member'				=>	'Membro',	// Default title
'Moderator'				=>	'Moderador',
'Administrator'			=>	'Administrador',
'Banned'				=>	'Expulsado',
'Guest'					=>	'Convidado',

// Stuff for include/parser.php
'BBCode error'			=>	'A sintaxe do BBCODE neste mensaxe é errónea.',
'BBCode error 1'		=>	'Falta o marcador de inicio para un [/quote].',
'BBCode error 2'		=>	'Falta o marcador de fin para un [code].',
'BBCode error 3'		=>	'Falta o marcador de inicio para un [/code].',
'BBCode error 4'		=>	'Falta un ou máis marcadores de fin para un [quote].',
'BBCode error 5'		=>	'Falta un ou máis marcadores de inicio para un [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Inicio',
'User list'				=>	'Lista de usuarios',
'Rules'					=>  'Regras',
'Search'				=>  'Busca',
'Register'				=>  'Rexistrate',
'Login'					=>  'Entrar',
'Not logged in'			=>  'Non te rexistraches',
'Profile'				=>	'Perfil',
'Logout'				=>	'Saír',
'Logged in as'			=>	'Identificado como',
'Admin'					=>	'Administración',
'Last visit'			=>	'Ultima visita',
'Show new posts'		=>	'Mostra mensaxes novos dende a última visita',
'Mark all as read'		=>	'Marca-los temas como lidos',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Pé do foro',
'Search links'			=>	'Busca enlaces',
'Show recent posts'		=>	'Mostra mensaxes recentes',
'Show unanswered posts'	=>	'Mostra mensaxes sen resposta',
'Show your posts'		=>	'Mostra as miñas mensaxes',
'Show subscriptions'	=>	'Mostra os meus temas suscritos',
'Jump to'				=>	'Ir a',
'Go'					=>	' Ir',		// submit button in forum jump
'Move topic'			=>  'Move tema',
'Open topic'			=>  'Abre tema',
'Close topic'			=>  'Pecha tema',
'Unstick topic'			=>  'Desmarca permanente',
'Stick topic'			=>  'Marca como permanente',
'Moderate forum'		=>	'Modera-lo foro',
'Delete posts'			=>	'Borra mensaxes múltiples',
'Debug table'			=>	'Información de depuración',

//For extern.php RSS feed
'RSS Desc Active'		=>	'Ultimos temas activos en',	// board_title will be appended to this string
'RSS Desc New'			=>	'Ultimos temas en',	// board_title will be appended to this string
'Posted'				=>	'Envíado'	// The topic was started

);
