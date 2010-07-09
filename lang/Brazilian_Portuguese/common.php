<?php

// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'portuguese-brazil';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'pt_BR.ISO8859-1';
		break;

	default:
		$locale = 'pt_BR';
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
'Bad request'			=>	'Requisi��o inv�lida. O link acessado est� incorreto ou n�o existe mais.',
'No view'				=>	'Voc� n�o possui permiss�o para ver esses f�runs.',
'No permission'			=>	'Voc� n�o possui permiss�o para acessar esta p�gina.',
'Bad referrer'			=>	'HTTP_REFERER inv�lido. Voc� foi direcionado para esta p�gina atrav�s de uma fonte n�o autorizada. Se o problema persistir, verifique se a \'URL Base\' est� configurada corretamente em Administra��o / Op��es e que voc� est� acessando o f�rum atrav�s daquela URL. Mais informa��es a respeito da verifica��o da fonte (referrer) pode ser encontrada na documenta��o do PunBB.',

// Topic/forum indicators
'New icon'				=>	'N�o existem novos t�picos',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Este t�pico est� fechado',
'Redirect icon'			=>	'F�rum redirecionado',

// Miscellaneous
'Announcement'			=>	'Aviso',
'Options'				=>	'Op��es',
'Actions'				=>	'A��es',
'Submit'				=>	'Enviar',	// "name" of submit buttons
'Ban message'			=>	'Voc� est� banido deste f�rum.',
'Ban message 2'			=>	'O banimento expira em ',
'Ban message 3'			=>	'O administrador ou moderador que te baniu deixou a seguinte mensagem:',
'Ban message 4'			=>	'Por favor, envie suas d�vidas para o administrador do f�rum em',
'Never'					=>	'Nunca',
'Today'					=>	'Hoje',
'Yesterday'				=>	'Ontem',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Voltar',
'Maintenance'			=>	'Manuten��o',
'Redirecting'			=>	'Redirecionando',
'Click redirect'		=>	'Clique aqui caso seu navegador n�o redirecione automaticamente',
'on'					=>	'ativado',		// as in "BBCode is on"
'off'					=>	'desativado',
'Invalid e-mail'		=>	'O email que voc� digitou � inv�lido.',
'required field'		=>	'� um campo de preenchimento obrigat�rio.',	// for javascript form validation
'Last post'				=>	'�ltimo post',
'by'					=>	'por',	// as in last post by someuser
'New posts'				=>	'Novos&nbsp;posts',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Ir para o primeiro post novo deste t�pico.',	// the popup text for new posts links
'Username'				=>	'Usu�rio',
'Password'				=>	'Senha',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Enviar e-mail',
'Moderated by'			=>	'Moderado por',
'Registered'			=>	'Cadastrado',
'Subject'				=>	'Assunto',
'Message'				=>	'Mensagem',
'Topic'					=>	'T�pico',
'Forum'					=>	'F�rum',
'Posts'					=>	'Posts',
'Replies'				=>	'Respostas',
'Author'				=>	'Autor',
'Pages'					=>	'P�ginas',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'tag [img]',
'Smilies'				=>	'Smilies',
'and'					=>	'e',
'Image link'			=>	'imagem',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'escreveu',	// For [quote]'s
'Code'					=>	'C�digo',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Informa��o importante',
'Write message legend'	=>	'Escreva sua mensagem e envie',

// Title
'Title'					=>	'T�tulo',
'Member'				=>	'Membro',	// Default title
'Moderator'				=>	'Moderador',
'Administrator'			=>	'Administrador',
'Banned'				=>	'Banido',
'Guest'					=>	'Visitante',

// Stuff for include/parser.php
'BBCode error'			=>	'A sintaxe do BBCode na mensagem est� incorreta.',
'BBCode error 1'		=>	'Est� faltando a tag inicial para [/quote].',
'BBCode error 2'		=>	'Est� faltando a tag final para [code].',
'BBCode error 3'		=>	'Est� faltando a tag inicial para [/code].',
'BBCode error 4'		=>	'Est�o faltando uma ou mais tags finais para [quote].',
'BBCode error 5'		=>	'Est�o faltando uma ou mais tags iniciais para [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'�ndice',
'User list'				=>	'Lista de usu�rios',
'Rules'					=>  'Regras',
'Search'				=>  'Busca',
'Register'				=>  'Cadastro',
'Login'					=>  'Login',
'Not logged in'			=>  'Voc� n�o est� logado.',
'Profile'				=>	'Perfil',
'Logout'				=>	'Sair',
'Logged in as'			=>	'Logado como',
'Admin'					=>	'Administra��o',
'Last visit'			=>	'�ltima visita',
'Show new posts'		=>	'Exibir novos posts desde a �ltima visita',
'Mark all as read'		=>	'Marcar todos os t�picos como lidos',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Rodap� do f�rum',
'Search links'			=>	'Links de busca',
'Show recent posts'		=>	'Exibir posts recentes',
'Show unanswered posts'	=>	'Exibir posts sem resposta',
'Show your posts'		=>	'Exibir os seus posts',
'Show subscriptions'	=>	'Exibir os t�picos em que voc� est� inscrito',
'Jump to'				=>	'Ir para',
'Go'					=>	' Ir ',		// submit button in forum jump
'Move topic'			=>  'Mover t�pico',
'Open topic'			=>  'Abrir t�pico',
'Close topic'			=>  'Fechar t�pico',
'Unstick topic'			=>  'Desfixar t�pico',
'Stick topic'			=>  'Fixar t�pico',
'Moderate forum'		=>	'Moderar f�rum',
'Delete posts'			=>	'Excluir m�ltiplos posts',
'Debug table'			=>	'Informa��es de debug',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Os t�picos mais ativos recentemente em',	// board_title will be appended to this string
'RSS Desc New'			=>	'Os t�picos mais novos em',					// board_title will be appended to this string
'Posted'				=>	'Publicado'	// The date/time a topic was started

);
