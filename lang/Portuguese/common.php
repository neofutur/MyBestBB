<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'portuguese';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'pt_PT.ISO8859-1';
		break;

	default:
		$locale = 'pt_PT';
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
'Bad request'			=>	'Erro. A hiperliga��o indicada est� incorrecta ou n�o j� n�o existe.',
'No view'			=>	'N�o tem presiss�o para aceder a este forum.',
'No permission'			=>	'N�o tem permiss�o para aceder a esta p�gina.',
'Bad referer'			=>	'Erro HTTP_REFERER. Foi direccionado para esta p�gina atrav�s de uma fonte n�o autorizada. Por favor, volte e tente novamente. Caso este problema volte a ocorrer, certifique-se de que a \'URL\' est� correctamente indicada em Administra��o/Op��es e de que est� a aceder o F�rum utilizando a \'URL\' inidicada.',

// Topic/forum indicators
'New icon'				=>	'N�o existem mensagens novas',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'O t�pico est� fechado',
'Redirect icon'			=>	'Forum redireccionado',

// Miscellaneous (used in many scripts)
'Announcement'			=>	'Aviso',
'Options'				=>	'Op�&otilde;es',
'Actions'				=>	'Ac�&ccedil;&otilde;es',
'Submit'				=>	'Confirmar',	// "name" of submit buttons
'Ban message'			=>	'Voc&ecirc; foi expulso deste f&oacute;rum.',
'Ban message 2'			=>	'Poder&aacute; voltar a acerder este f&oacute;rum em',
'Ban message 3'			=>	'O Administrador ou Moderador respons&acute;vel por sua expuls�o deixou a seguinte mensagem:',
'Ban message 4'			=>	'Por favor, envie suas d�vidas ou sugest�es para o Administrador dos F�runs',
'Never'					=>	'Nunca',
'Today'					=>	'Hoje',
'Yesterday'				=>	'Ontem',
'Info'					=>	'Informa��o',		// a common table header
'Go back'				=>	'Voltar',
'Maintenance'			=>	'Manuten��o',
'Redirecting'			=>	'A redireccionar',
'Click redirect'		=>	'A redireccionar automaticamente.',
'on'					=>	'ligado',		// as in "BBCode is on"
'off'					=>	'desligado',
'Invalid e-mail'		=>	'O correio electr�nico indicado n�o � v�lido.',
'required field'		=>	'� um campo de preenchimento obrigat�orio.',	// for javascript form validation
'Last post'				=>	'�ltimo Coment�rio',
'by'					=>	'por:',	// as in last post by someuser
'New posts'				=>	'Novos&nbsp;coment&aacute;rios',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Ir para o comentario mais recente deste t�pico.',	// the popup text for new posts links
'Username'				=>	'Identifica��o',
'Password'				=>	'Palavra-Passe',
'E-mail'				=>	'Correio Electr�nico',
'Send e-mail'			=>	'Enviar correio electr�nico',
'Moderated by'			=>	'Moderado por',
'Registered'			=>	'Registado',
'Subject'				=>	'Assunto',
'Message'				=>	'Mensagem',
'Topic'					=>	'T�pico',
'Forum'					=>	'Forum',
'Posts'					=>	'Coment�rios',
'Replies'				=>	'Respostas',
'Author'				=>	'Autor',
'Pages'					=>	'Pag.',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'\'Smilies\'',
'and'					=>	'e',
'Image link'			=>	'imagem',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'Comentou',	// For [quote]'s
'Code'					=>	'C�digo',		// For [code]'s
'Mailer'				=>	'Remetente',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Informa��o Importante',
'Write message legend'	=>	'Escreva a sua mensagem e envie-a',

// Title
'Title'					=>	'T�tulo',
'Member'				=>	'Utilizador',	// Default title
'Moderator'				=>	'Moderador',
'Administrator'			=>	'Administrador',
'Banned'				=>	'Expulso',
'Guest'					=>	'Convidado',

// Stuff for include/parser.php
'BBCode error'			=>	'A sintax do BBCode est� incorrecta.',
'BBCode error 1'		=>	'N�o foi indicada a \'tag\' inicial [/quote].',
'BBCode error 2'		=>	'N�o foi indicada a \'tag\' final [code].',
'BBCode error 3'		=>	'N�o foi indicada a \'tag\' inicial [/code].',
'BBCode error 4'		=>	'N�o foi indicada uma ou mais \'tags\' finais para [quote].',
'BBCode error 5'		=>	'N�o foi indicada uma ou mais \'tags\' iniciais para [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'In�cio',
'User list'				=>	'Utilizadores',
'Rules'					=>  'Regras',
'Search'				=>  'Pesquisa',
'Register'				=>  'Registar-se',
'Login'					=>  'Entrar',
'Not logged in'			=>  'Voc� n�o est� identificado.',
'Profile'				=>	'Perfil',
'Logout'				=>	'Sair',
'Logged in as'			=>	'Identifica��o:',
'Admin'					=>	'Admin',
'Last visit'			=>	'�ltima visita',
'Show new posts'		=>	'Exibir os coment�rios novos desde a �ltima visita',
'Mark all as read'		=>	'Marcas todas os coment�rios como lidos',
'Link separator'		=>	'',	// The text that separates links in the navigator


// Stuff for the page footer
'Board footer'			=>	'Rodap� do forum',
'Search links'			=>	'Links de pesquisa',
'Show recent posts'		=>	'Exibir coment�rios recentes',
'Show unanswered posts'	=>	'Exibir coment�rios n�o respondidos',
'Show your posts'		=>	'Exibir meus coment�rios',
'Show subscriptions'	=>	'Exibir os t�picos seleccionados',
'Jump to'				=>	'Ir para',
'Go'					=>	' Ir ',		// submit button in forum jump
'Move topic'			=>  'Mover T�pico',
'Open topic'			=>  'Abrir T�pico',
'Close topic'			=>  'Fechar T�pico',
'Unstick topic'			=>  'Separar T�pico',
'Stick topic'			=>  'Fundir T�pico',
'Moderate forum'		=>	'Moderar F�rum',
'Delete posts'			=>	'Eliminar m�ltiplos coment�rios',
'Debug table'			=>	'Informa��o de "debug"',

// For extern.php RSS feed
'RSS Desc Active'		=>	'O t�pico mais activo em',	// board_title will be appended to this string
'RSS Desc New'			=>	'O t�pico mais recente em',					// board_title will be appended to this string
'Posted'			=>    'Colocado'	// The date/time a topic was started

);
