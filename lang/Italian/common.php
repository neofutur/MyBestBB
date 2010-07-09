<?php


// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'italian';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'it_IT.IT-ASCII';
		break;

	default:
		$locale = 'it_IT';
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
'Bad request'			=>	'Richiesta non valida. Il link che hai seguito non &egrave; valido oppure &egrave; scaduto.',
'No view'				=>	'Non hai il permesso di visualizzare questo forum.',
'No permission'			=>	'Non hai il permesso di accere a questa pagina.',
'Bad referrer'			=>	'HTTP_REFERER non valido. Sei stato indirizzato a questa pagina da una fonte non autorizzata. Se il problema persiste per favore assicurati che l\'indirizzo di base\' sia correttamente impostato nelle Amministrazione/Opzioni e che tu stia navigando nel forum con quell\'URL. Altre informazioni al riguardo possono essere reperite nella documentazione di PunBB.',

// Topic/forum indicators
'New icon'				=>	'Ci sono nuovi messaggi',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Questa discussione &egrave; chiusa',
'Redirect icon'			=>	'Forum reindirizzato',

// Miscellaneous
'Announcement'			=>	'Annuncio',
'Options'				=>	'Opzioni',
'Actions'				=>	'Azioni',
'Submit'				=>	'Invia',	// "name" of submit buttons
'Ban message'			=>	'Sei interdetto da questo forum.',
'Ban message 2'			=>	'L\'interdizione scade alla fine di',
'Ban message 3'			=>	'L\'amministratore o il moderatore che ti hanno interdetto ha lasciato il seguente messaggio:',
'Ban message 4'			=>	'Per favore inoltra ogni informazione all\'amministratore a',
'Never'					=>	'Mai',
'Today'					=>	'Oggi',
'Yesterday'				=>	'Ieri',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Torna indietro',
'Maintenance'			=>	'Manutenzione',
'Redirecting'			=>	'Reindirizzamento',
'Click redirect'		=>	'Clicca qui se non vuoi pi&ugrave; aspettare (o se il tuo browser non ti indirizza automaticamente)',
'on'					=>	'attivato',		// as in "BBCode is on"
'off'					=>	'disattivato',
'Invalid e-mail'		=>	'L\'indirizzo e-mail che hai inserito non &egrave; valido.',
'required field'		=>	'&egrave; richiesto in questo forum.',	// for javascript form validation
'Last post'				=>	'Ultimo messaggio',
'by'					=>	'di',	// as in last post by someuser
'New posts'				=>	'Nuovi&nbsp;Messaggi',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Vai al primo nuovo messaggio di questa discussione.',	// the popup text for new posts links
'Username'				=>	'Nome utente',
'Password'				=>	'Password',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Invia e-mail',
'Moderated by'			=>	'Moderato da',
'Registered'			=>	'Registrato',
'Subject'				=>	'Oggetto',
'Message'				=>	'Messaggio',
'Topic'					=>	'Argomento',
'Forum'					=>	'Categoria',
'Posts'					=>	'Messaggi',
'Replies'				=>	'Risposte',
'Author'				=>	'Autore',
'Pages'					=>	'Pagine',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'tag [img]',
'Smilies'				=>	'Faccine',
'and'					=>	'e',
'Image link'			=>	'immagine',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'ha scritto',	// For [quote]'s
'Code'					=>	'Codice',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Informazione importante',
'Write message legend'	=>	'Scrivi il tuo messaggio ed invia',

// Title
'Title'					=>	'Titolo',
'Member'				=>	'Membro',	// Default title
'Moderator'				=>	'Moderatore',
'Administrator'			=>	'Amministratore',
'Banned'				=>	'Interdetto',
'Guest'					=>	'Ospite',

// Stuff for include/parser.php
'BBCode error'			=>	'La sintassi BBCode nel messaggio non &egrave; valida.',
'BBCode error 1'		=>	'Tag d\'inizio di [/quote] omesso.',
'BBCode error 2'		=>	'Tag di chiusura di [code] omesso.',
'BBCode error 3'		=>	'Tag d\'inizio di [/code] omesso.',
'BBCode error 4'		=>	'Uno o pi&ugrave; tag di chiusura di [quote] omessi.',
'BBCode error 5'		=>	'Uno o pi&ugrave; tag d\'inizio di [/quote] omessi.',

// Stuff for the navigator (top of every page)
'Index'					=>	'Indice',
'User list'				=>	'Lista utenti',
'Rules'					=>  'Regolamento',
'Search'				=>  'Ricerca',
'Register'				=>  'Registrati',
'Login'					=>  'Accedi',
'Not logged in'			=>  'Non hai eseguito l\'accesso.',
'Profile'				=>	'Profilo',
'Logout'				=>	'Uscita',
'Logged in as'			=>	'Connesso come',
'Admin'					=>	'Amministrazione',
'Last visit'			=>	'Ultima visita',
'Show new posts'		=>	'Mostra i nuovi messaggi dall\'ultima visita',
'Mark all as read'		=>	'Segna tutte le discussioni come lette',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Footer forum',
'Search links'			=>	'Link ricerca',
'Show recent posts'		=>	'Mostra messaggi recenti',
'Show unanswered posts'	=>	'Mostra messaggi senza risposta',
'Show your posts'		=>	'Mostra i tuoi messaggi',
'Show subscriptions'	=>	'Mostra i tuoi messaggi sottoscritti',
'Jump to'				=>	'Vai a',
'Go'					=>	' Vai ',		// submit button in forum jump
'Move topic'			=>  'Sposta discussione',
'Open topic'			=>  'Apri discussione',
'Close topic'			=>  'Chiudi discussione',
'Unstick topic'			=>  'Disevidenzia discussione',
'Stick topic'			=>  'Evidenzia discussione',
'Moderate forum'		=>	'Modera categoria',
'Delete posts'			=>	'Cancella messaggi multipli',
'Debug table'			=>	'Informazione Debug',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Le discussioni nuove pi&ugrave; attive a ',	// board_title will be appended to this string
'RSS Desc New'			=>	'La discussione pi&ugrave; nuova a',					// board_title will be appended to this string
'Posted'				=>	'Inserito'	// The date/time a topic was started

);
