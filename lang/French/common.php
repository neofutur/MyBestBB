<?php

/*
// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'french';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'fr_FR.ISO8859-1';
		break;

	default:
		$locale = 'fr_FR';
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
'Bad request'			=>	'Erreur. Le lien que vous avez suivi est incorrect ou perime.',
'No view'				=>	'Vous n etes pas autorise a visiter ces forums.',
'No permission'			=>	'Vous n etes pas autorise a afficher cette page.',
'Bad referrer'			=>	'Mauvais HTTP_REFERER. Vous avez ete renvoye sur cette page par une source inconnue ou interdite. Si le probleme persiste, assurez-vous que le champ "URL de base" de la page Admin/Options est correctement renseigne et que vous visitez ces forums en utilisant cette URL. Plus d informations pourront etre trouvees dans la documentation de PunBB.',
 
// Topic/forum indicators
'New icon'				=>	'Il y a des nouveaux messages',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Cette discussion est fermee',
'Redirect icon'			=>	'Forum de redirection',
 
// Miscellaneous
'Announcement'			=>	'Annonce',
'Options'				=>	'Options',
'Actions'				=>	'Actions',
'Submit'				=>	'Envoyer',	// "name" of submit buttons
'Ban message'			=>	'Vous etes exclu de ce forum.',
'Ban message 2'			=>	'Votre exclusion expire le',
'Ban message 3'			=>	'L administrateur ou le moderateur qui vous a exclu envoit le message suivant&#160;:',
'Ban message 4'			=>	'Pour toute question, contactez l administrateur',
'Never'					=>	'Jamais',
'Today'					=>	'Aujourd hui',
'Yesterday'				=>	'Hier',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Retour',
'Maintenance'			=>	'Maintenance',
'Redirecting'			=>	'Redirection',
'Click redirect'		=>	'Cliquez ici si vous ne voulez pas attendre (ou si votre navigateur ne vous redirige pas).',
'on'					=>	'actif',		// as in "BBCode is on"
'off'					=>	'inactif',
'Invalid e-mail'		=>	'L adresse e-mail que vous avez saisie est invalide.',
'required field'		=>	'est un champ requis pour ce formulaire.',	// for javascript form validation
'Last post'				=>	'Dernier message',
'by'					=>	'par',	// as in last post by someuser
'New posts'				=>	'Nouveaux&#160;messages',	// the link that leads to the first new post (use &#160; for spaces)
'New posts info'		=>	'Allez au premier nouveau message de cette discussion.',	// the popup text for new posts links
'Username'				=>	'Nom d utilisateur',
'Password'				=>	'Mot de passe',
'E-mail'				=>	'e-mail',
'Send e-mail'			=>	'Envoyer un e-mail',
'Moderated by'			=>	'Modere par',
'Registered'			=>	'Date d inscription',
'Subject'				=>	'Sujet',
'Message'				=>	'Message',
'Topic'					=>	'Discussion',
'Forum'					=>	'Forum',
'Posts'					=>	'Messages',
'Replies'				=>	'Reponses',
'Author'				=>	'Auteur',
'Pages'					=>	'Pages',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'Balise [img]',
'Smilies'				=>	'Emoticenes',
'and'					=>	'et',
'Image link'			=>	'image',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'a ecrit',	// For [quote]'s
'Code'					=>	'Code',		// For [code]'s
'Mailer'				=>	'E-mail automatique',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Information importante',
'Write message legend'	=>	'Veuillez ecrire votre message et l envoyer',
 
// Title
'Title'					=>	'Titre',
'Member'				=>	'Membre',	// Default title
'Moderator'				=>	'Moderateur',
'Administrator'			=>	'Administrateur',
'Banned'				=>	'Banni',
'Guest'					=>	'Invite',
 
// Stuff for include/parser.php
'BBCode error'			=>	'La syntaxe BBCode est incorrecte.',
'BBCode error 1'		=>	'Il manque la balise d ouverture pour [/quote].',
'BBCode error 2'		=>	'Il manque la balise de fermeture pour [code].',
'BBCode error 3'		=>	'Il manque la balise d ouverture pour [/code].',
'BBCode error 4'		=>	'Il manque une ou plusieurs balises de fermeture pour [quote].',
'BBCode error 5'		=>	'Il manque une ou plusieurs balises d ouverture manquantes pour [/quote].',
 
// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Liste des membres',
'Rules'					=>  'Regles',
'Search'				=>  'Recherche',
'Register'				=>  'Inscription',
'Login'					=>  'S identifier',
'Not logged in'			=>  'Vous n etes pas identifie.',
'Profile'				=>	'Profil',
'Logout'				=>	'Deconnexion',
'Logged in as'			=>	'Connecte en tant que',
'Admin'					=>	'Administration',
'Last visit'			=>	'Derniere visite',
'Show new posts'		=>	'Afficher les nouveaux messages depuis la derniere visite',
'Mark all as read'		=>	'Marquer toutes les discussions comme lues',
'Link separator'		=>	'',	// The text that separates links in the navigator
 
// Stuff for the page footer
'Board footer'			=>	'Pied de page des forums',
'Search links'			=>	'Liens de recherche',
'Show recent posts'		=>	'Afficher les messages recents',
'Show unanswered posts'	=>	'Afficher les messages sans reponse',
'Show your posts'		=>	'Afficher vos messages',
'Show subscriptions'	=>	'Afficher les discussions auxquelles vous etes abonnes',
'Jump to'				=>	'Aller a',
'Go'					=>	' Aller ',		// submit button in forum jump
'Move topic'			=>  'Deplacer la discussion',
'Open topic'			=>  'Ouvrir la discussion',
'Close topic'			=>  'Fermer la discussion',
'Unstick topic'			=>  'Detacher la discussion',
'Stick topic'			=>  'Epingler la discussion',
'Moderate forum'		=>	'Moderer le forum',
'Delete posts'			=>	'Supprimer plusieurs messages',
'Debug table'			=>	'Informations de debogue',
 
// For extern.php RSS feed
'RSS Desc Active'		=>	'Les discussions recemment actives de',	// board_title will be appended to this string
'RSS Desc New'			=>	'Les dernieres discussions de',					// board_title will be appended to this string
'Posted'				=>	'Ecrit le'	// The date/time a topic was started
);
 
