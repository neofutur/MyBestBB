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
'Bad request'			=>	'Requisição inválida. O link acessado está incorreto ou não existe mais.',
'No view'				=>	'Você não possui permissão para ver esses fóruns.',
'No permission'			=>	'Você não possui permissão para acessar esta página.',
'Bad referrer'			=>	'HTTP_REFERER inválido. Você foi direcionado para esta página através de uma fonte não autorizada. Se o problema persistir, verifique se a \'URL Base\' está configurada corretamente em Administração / Opções e que você está acessando o fórum através daquela URL. Mais informações a respeito da verificação da fonte (referrer) pode ser encontrada na documentação do PunBB.',

// Topic/forum indicators
'New icon'				=>	'Não existem novos tópicos',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Este tópico está fechado',
'Redirect icon'			=>	'Fórum redirecionado',

// Miscellaneous
'Announcement'			=>	'Aviso',
'Options'				=>	'Opções',
'Actions'				=>	'Ações',
'Submit'				=>	'Enviar',	// "name" of submit buttons
'Ban message'			=>	'Você está banido deste fórum.',
'Ban message 2'			=>	'O banimento expira em ',
'Ban message 3'			=>	'O administrador ou moderador que te baniu deixou a seguinte mensagem:',
'Ban message 4'			=>	'Por favor, envie suas dúvidas para o administrador do fórum em',
'Never'					=>	'Nunca',
'Today'					=>	'Hoje',
'Yesterday'				=>	'Ontem',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Voltar',
'Maintenance'			=>	'Manutenção',
'Redirecting'			=>	'Redirecionando',
'Click redirect'		=>	'Clique aqui caso seu navegador não redirecione automaticamente',
'on'					=>	'ativado',		// as in "BBCode is on"
'off'					=>	'desativado',
'Invalid e-mail'		=>	'O email que você digitou é inválido.',
'required field'		=>	'é um campo de preenchimento obrigatório.',	// for javascript form validation
'Last post'				=>	'Último post',
'by'					=>	'por',	// as in last post by someuser
'New posts'				=>	'Novos&nbsp;posts',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Ir para o primeiro post novo deste tópico.',	// the popup text for new posts links
'Username'				=>	'Usuário',
'Password'				=>	'Senha',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Enviar e-mail',
'Moderated by'			=>	'Moderado por',
'Registered'			=>	'Cadastrado',
'Subject'				=>	'Assunto',
'Message'				=>	'Mensagem',
'Topic'					=>	'Tópico',
'Forum'					=>	'Fórum',
'Posts'					=>	'Posts',
'Replies'				=>	'Respostas',
'Author'				=>	'Autor',
'Pages'					=>	'Páginas',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'tag [img]',
'Smilies'				=>	'Smilies',
'and'					=>	'e',
'Image link'			=>	'imagem',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'escreveu',	// For [quote]'s
'Code'					=>	'Código',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Informação importante',
'Write message legend'	=>	'Escreva sua mensagem e envie',

// Title
'Title'					=>	'Título',
'Member'				=>	'Membro',	// Default title
'Moderator'				=>	'Moderador',
'Administrator'			=>	'Administrador',
'Banned'				=>	'Banido',
'Guest'					=>	'Visitante',

// Stuff for include/parser.php
'BBCode error'			=>	'A sintaxe do BBCode na mensagem está incorreta.',
'BBCode error 1'		=>	'Está faltando a tag inicial para [/quote].',
'BBCode error 2'		=>	'Está faltando a tag final para [code].',
'BBCode error 3'		=>	'Está faltando a tag inicial para [/code].',
'BBCode error 4'		=>	'Estão faltando uma ou mais tags finais para [quote].',
'BBCode error 5'		=>	'Estão faltando uma ou mais tags iniciais para [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Índice',
'User list'				=>	'Lista de usuários',
'Rules'					=>  'Regras',
'Search'				=>  'Busca',
'Register'				=>  'Cadastro',
'Login'					=>  'Login',
'Not logged in'			=>  'Você não está logado.',
'Profile'				=>	'Perfil',
'Logout'				=>	'Sair',
'Logged in as'			=>	'Logado como',
'Admin'					=>	'Administração',
'Last visit'			=>	'Última visita',
'Show new posts'		=>	'Exibir novos posts desde a última visita',
'Mark all as read'		=>	'Marcar todos os tópicos como lidos',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Rodapé do fórum',
'Search links'			=>	'Links de busca',
'Show recent posts'		=>	'Exibir posts recentes',
'Show unanswered posts'	=>	'Exibir posts sem resposta',
'Show your posts'		=>	'Exibir os seus posts',
'Show subscriptions'	=>	'Exibir os tópicos em que você está inscrito',
'Jump to'				=>	'Ir para',
'Go'					=>	' Ir ',		// submit button in forum jump
'Move topic'			=>  'Mover tópico',
'Open topic'			=>  'Abrir tópico',
'Close topic'			=>  'Fechar tópico',
'Unstick topic'			=>  'Desfixar tópico',
'Stick topic'			=>  'Fixar tópico',
'Moderate forum'		=>	'Moderar fórum',
'Delete posts'			=>	'Excluir múltiplos posts',
'Debug table'			=>	'Informações de debug',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Os tópicos mais ativos recentemente em',	// board_title will be appended to this string
'RSS Desc New'			=>	'Os tópicos mais novos em',					// board_title will be appended to this string
'Posted'				=>	'Publicado'	// The date/time a topic was started

);
