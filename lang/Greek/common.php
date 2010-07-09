<?php


// Translated by Spiros Doikas - www.translatum.gr/cv.htm
// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'greek';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'el_GR.GR-ASCII';
		break;

	default:
		$locale = 'el_GR';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'windows-1253',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'Ακατάλληλη αίτηση. Ο σύνδεσμός που ακολουθήσετε είναι εσφαλμένος ή παλιός.',
'No view'				=>	'Δεν έχετε δικαίωμα να δείτε αυτό το φόρουμ.',
'No permission'			=>	'Δεν έχετε δικαίωμα πρόσβασης σε αυτή τη σελίδα.',
'Bad referrer'			=>	'Εσφαλμένος HTTP_REFERER. Η παραπομπή σε αυτήν την ιστοσελίδα έγινε από μια μη εξουσιοδοτημένη πηγή. Εάν το πρόβλημα δεν λυθεί βεβαιωθείτε ότι το \'URL βάσης]\' έχει οριστεί σωστά στο Admin/Options (Διαχείριση/Επιλογές) και ότι επισκέπτεστε το φόρουμ χρησιμοποιώντας το συγκεκριμένο URL. Μπορείτε να βρείτε περισσότερες πληροφορίες σχετικά με τον έλεγχο παραπομπέα στην τεκμηρίωση του PunBB.',

// Topic/forum indicators
'New icon'				=>	'Υπάρχουν νέα μηνύματα',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Αυτό το θέμα έχει κλείσει',
'Redirect icon'			=>	'Ανακατεύθυνση φόρουμ',

// Miscellaneous
'Announcement'			=>	'Ανακοίνωση',
'Options'				=>	'Επιλογές',
'Actions'				=>	'Ενέργειες',
'Submit'				=>	'Υποβολή',	// "name" of submit buttons
'Ban message'			=>	'Έχετε αποκλειστεί από αυτό το φόρουμ.',
'Ban message 2'			=>	'Ο αποκλεισμός λήγει στο τέλος της',
'Ban message 3'			=>	'Ο διαχειριστής ή ο συντονιστής ο οποίος επέβαλε τον αποκλεισμό σας άφησε το ακόλουθο μήνυμα:',
'Ban message 4'			=>	'Για τυχόν απορίες σας απευθυνθείτε στον διαχειριστής του φόρουμ στο',
'Never'					=>	'Ποτέ',
'Today'					=>	'Σήμερα',
'Yesterday'				=>	'Χτες',
'Info'					=>	'Πληροφορίες',		// a common table header
'Go back'				=>	'Επιστροφή',
'Maintenance'			=>	'Συντήρηση',
'Redirecting'			=>	'Ανακατεύθυνση',
'Click redirect'		=>	'Πατήστε εδώ εάν δεν θέλετε να περιμένετε άλλο (ή εάν το πρόγραμμα περιήγησης που χρησιμοποιείτε δεν σας προωθήσει αυτόματα)',
'on'					=>	'ενεργό',		// as in "BBCode is on"
'off'					=>	'ανενεργός',
'Invalid e-mail'		=>	'Η διεύθυνση e-mail που εισαγάγατε δεν είναι έγκυρη.',
'required field'		=>	'είναι ένα απαιτούμενο πεδίο σε αυτή τη φόρμα.',	// for javascript form validation
'Last post'				=>	'Τελευταίο μήνυμα',
'by'					=>	'από',	// as in last post by someuser
'New posts'				=>	'Νέα&nbsp;μηνύματα',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Μετάβαση στο πρώτο νέο μήνυμα σε αυτό το θέμα.',	// the popup text for new posts links
'Username'				=>	'Όνομα χρήστη',
'Password'				=>	'Κωδικός πρόσβασης',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Αποστολή e-mail',
'Moderated by'			=>	'Συντονιστής',
'Registered'			=>	'Εγγραφή',
'Subject'				=>	'Τίτλος',
'Message'				=>	'Μήνυμα',
'Topic'					=>	'θέμα',
'Forum'					=>	'Φόρουμ',
'Posts'					=>	'Μηνύματα',
'Replies'				=>	'Απαντήσεις',
'Author'				=>	'Συντάκτης',
'Pages'					=>	'Σελίδες',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'Ετικέτα [img]',
'Smilies'				=>	'Φατσούλες',
'and'					=>	'και',
'Image link'			=>	'εικόνα',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'έγραψε',	// For [quote]'s
'Code'					=>	'Κώδικας',		// For [code]'s
'Mailer'				=>	'Πρόγραμμα ταχυδρομείου',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Σημαντικές πληροφορίες',
'Write message legend'	=>	'Γράψτε το μήνυμά σας και πατήστε το κουμπί "Υποβολή"',

// Title
'Title'					=>	'Επίπεδο',
'Member'				=>	'Μέλος',	// Default title
'Moderator'				=>	'Συντονιστής',
'Administrator'			=>	'Διαχειριστής',
'Banned'				=>	'Αποκλεισμένος',
'Guest'					=>	'Επισκέπτης',

// Stuff for include/parser.php
'BBCode error'			=>	'Το συντακτικό του κώδικα BBCode στο μήνυμα είναι εσφαλμένο.',
'BBCode error 1'		=>	'Λείπει η αρχική ετικέτα για το [/quote].',
'BBCode error 2'		=>	'Λείπει η αρχική ετικέτα για το [code].',
'BBCode error 3'		=>	'Λείπει η αρχική ετικέτα για το [/code].',
'BBCode error 4'		=>	'Λείπιυν μία ή περισσότερες ετικέτες για το [quote].',
'BBCode error 5'		=>	'Λείπουν μία ή περισσότερες αρχικές ετικέτες για το [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Αρχική',
'User list'				=>	'Λίστα χρηστών',
'Rules'					=>  'Κανόνες',
'Search'				=>  'Αναζήτηση',
'Register'				=>  'Εγγραφή',
'Login'					=>  'Σύνδεση',
'Not logged in'			=>  'Δεν είστε συνδεδεμένος.',
'Profile'				=>	'Προφίλ',
'Logout'				=>	'Αποσύνδεση',
'Logged in as'			=>	'Συνδεδεμένος ως',
'Admin'					=>	'Διαχείριση',
'Last visit'			=>	'Τελευταία επίσκεψη',
'Show new posts'		=>	'Εμφάνιση νέων μηνυμάτων από την τελευταία επίσκεψη',
'Mark all as read'		=>	'Σήμανση όλων των μηνυμάτων ως αναγνωσμένα',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Υποσέλιδο πίνακα',
'Search links'			=>	'Σύνδεσμοι αναζήτησης',
'Show recent posts'		=>	'Εμφάνιση πρόσφατων μηνυμάτων',
'Show unanswered posts'	=>	'Εμφάνιση αναπάντητων μηνυμάτων',
'Show your posts'		=>	'Εμφάνιση των μηνυμάτων σας',
'Show subscriptions'	=>	'Εμφάνιση μηνυμάτων με ειδοποιήσεις',
'Jump to'				=>	'Μετάβαση σε',
'Go'					=>	'Μετάβαση ',		// submit button in forum jump
'Move topic'			=>  'Μετακίνηση θέματος',
'Open topic'			=>  '’νοιγμα θέματος',
'Close topic'			=>  'Κλείσιμο θέματος',
'Unstick topic'			=>  'Μη μόνιμο θέμα',
'Stick topic'			=>  'Μόνιμο θέμα',
'Moderate forum'		=>	'Συντονισμός φόρουμ',
'Delete posts'			=>	'Διαγραφή πολλαπλών μηνυμάτων',
'Debug table'			=>	'Πληροφορίες εντοπισμού σφαλμάτων',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Τα πιο πρόσφατα ενεργά θέματα στο',	// board_title will be appended to this string
'RSS Desc New'			=>	'Τα πιο πρόσφατα θέματα στο',					// board_title will be appended to this string
'Posted'				=>	'Δημοσιεύτηκε'	// The date/time a topic was started

);













