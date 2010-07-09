<?php

// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'catalan';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'ca_ES.ISO8859-1';
		break;

	default:
		$locale = 'ca_ES';
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
'Bad request'			=>	'Sol�licitud err�nia. L\'enlla� seguit �s incorrecte o ha caducat.',
'No view'				=>	'No teniu perm�s per a veure aquests f�rums.',
'No permission'			=>	'No teniu perm�s per a accedir a aquesta p�gina.',
'Bad referrer'			=>	'HTTP_REFERER erroni. Heu estat dirigit a aquesta p�gina des de una font no autoritzada. Si el problema continua per favor assegureu-vos que la \'URL base\' est� correctament configurada a Admin/Options i que esteu visitant el f�rum a partir d\'aquesta URL. Podeu trobar m�s informaci� al voltant d\'aquest tema a la documentaci� de PunBB.',

// Topic/forum indicators
'New icon'				=>	'Hi ha missatges nous',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Aquest tema est� tancat',
'Redirect icon'			=>	'F�rum redirigit',

// Miscellaneous
'Announcement'			=>	'Av�s',
'Options'				=>	'Opcions',
'Actions'				=>	'Accions',
'Submit'				=>	'Envia',	// "name" of submit buttons
'Ban message'			=>	'Esteu expulsat d\'aquest f�rum.',
'Ban message 2'			=>	'L\'expulsi� expira a la fi de',
'Ban message 3'			=>	'L\'administrador o moderador que vos ha expulsat ha deixat el seg�ent missatge:',
'Ban message 4'			=>	'Per favor adreceu qualsevol pregunta a l\'administrador del f�rum a',
'Never'					=>	'Mai',
'Today'					=>	'Avui',
'Yesterday'				=>	'Ahir',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Tornar arrere',
'Maintenance'			=>	'Manteniment',
'Redirecting'			=>	'Redirigint',
'Click redirect'		=>	'Premeu ac� si no voleu esperar m�s (o si el vostre explorador no vos reenvia autom�ticament)',
'on'					=>	'actiu',		// as in "BBCode is on"
'off'					=>	'inactiu',
'Invalid e-mail'		=>	'L\'adre�a de correu que heu proporcionat no �s v�lida.',
'required field'		=>	'�s un camp requerit en aquest formulari.',	// for javascript form validation
'Last post'				=>	'�ltim missatge',
'by'					=>	'per',	// as in last post by someuser
'New posts'				=>	'Missatges&nbsp;nous',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Anar al primer missatge nou d\'aquest tema.',	// the popup text for new posts links
'Username'				=>	'Nom d\'Usuari',
'Password'				=>	'Contrasenya',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Envia e-mail',
'Moderated by'			=>	'Moderat per',
'Registered'			=>	'Registrat',
'Subject'				=>	'Assumpte',
'Message'				=>	'Missatge',
'Topic'					=>	'Tema',
'Forum'					=>	'F�rum',
'Posts'					=>	'Missatges',
'Replies'				=>	'Respostes',
'Author'				=>	'Autor',
'Pages'					=>	'P�gines',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'Marcador [img]',
'Smilies'				=>	'Smilies',
'and'					=>	'i',
'Image link'			=>	'imatge',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'escrigu�',	// For [quote]'s
'Code'					=>	'Codi',		// For [code]'s
'Mailer'				=>	'Administrador de correu',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Informaci� important',
'Write message legend'	=>	'Escriviu el vostre missatge i envieu',

// Title
'Title'					=>	'T�tol',
'Member'				=>	'Membre',	// Default title
'Moderator'				=>	'Moderador',
'Administrator'			=>	'Administrador',
'Banned'				=>	'Expulsat',
'Guest'					=>	'Visitant',

// Stuff for include/parser.php
'BBCode error'			=>	'La sintaxi del BBCode en aquest missatge �s err�nia.',
'BBCode error 1'		=>	'Falta el marcador d\'inici per a [/quote].',
'BBCode error 2'		=>	'Falta el marcador de fi per a [code].',
'BBCode error 3'		=>	'Falta el marcador d\'inici per a [/code].',
'BBCode error 4'		=>	'Falta un o m�s marcadors de fi per a [quote].',
'BBCode error 5'		=>	'Falta un o m�s marcadors d\'inici per a [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Inici',
'User list'				=>	'Llista d\'usuaris',
'Rules'					=>  'Regles',
'Search'				=>  'Cerca',
'Register'				=>  'Registre',
'Login'					=>  'Entreu',
'Not logged in'			=>  'No esteu identificat.',
'Profile'				=>	'Perfil',
'Logout'				=>	'Sortiu',
'Logged in as'			=>	'Identificat com',
'Admin'					=>	'Administraci�',
'Last visit'			=>	'�ltima visita',
'Show new posts'		=>	'Mostra missatges nous des de l\'�ltima visita',
'Mark all as read'		=>	'Marca tots els temes com a llegits',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Peu del f�rum',
'Search links'			=>	'Cerca enlla�os',
'Show recent posts'		=>	'Mostra missatges recents',
'Show unanswered posts'	=>	'Mostra missatges sense resposta',
'Show your posts'		=>	'Mostra els meus missatges',
'Show subscriptions'	=>	'Mostra els meus temes subscrits',
'Jump to'				=>	'Anar a',
'Go'					=>	' Anar ',		// submit button in forum jump
'Move topic'			=>  'Mou tema',
'Open topic'			=>  'Obri tema',
'Close topic'			=>  'Tanca tema',
'Unstick topic'			=>  'Desmarca permanent',
'Stick topic'			=>  'Marca com a permanent',
'Moderate forum'		=>	'Modereu el f�rum',
'Delete posts'			=>	'Esborra missatges m�ltiples',
'Debug table'			=>	'Informaci� de depuraci�',

//For extern.php RSS feed
'RSS Desc Active'		=>	'�ltims temes actius a',	// board_title will be appended to this string
'RSS Desc New'			=>	'�ltims temes a',	// board_title will be appended to this string
'Posted'				=>	'Enviat'	// The date/time the topic was started

);
