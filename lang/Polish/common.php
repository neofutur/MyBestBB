<?php


// Determine what locale to use
switch (PHP_OS)
{
        case 'WINNT':
        case 'WIN32':
                $locale = 'polish';
                break;

        case 'FreeBSD':
        case 'NetBSD':
        case 'OpenBSD':
                $locale = 'pl_PL.UTF-8';
                break;

        default:
                $locale = 'pl_PL';
                break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'     =>        'ltr',        // ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'      =>        'utf-8',
'lang_multibyte'     =>        false,

// Notices
'Bad request'                        =>        'Złe zapytanie. Link który podałeś jest niepoprawny lub nieaktualny.',
'No view'                                =>        'Brak pozwolenia na przeglądanie tego forum.',
'No permission'                        =>        'Brak pozwolenia na dostęp do tej strony.',
'Bad referrer'                        =>        'Złe HTTP_REFERER. Próbowałeś się dostać do tej strony z nieznanego źródła. Jeśli problem nadal istnieje to upewnij się, że \'Base URL\'  jest poprawnie ustawiona w Admin/Opcje. Wszelkie problemy są opisane w dokumentacji punBB.',

// Topic/forum indicators
'New icon'                                =>        'Nowe posty',
'Normal icon'                        =>        '<!-- -->',
'Closed icon'                        =>        'Ten wątek jest zamknięty',
'Redirect icon'                        =>        'Przekierowane forum',

// Miscellaneous
'Announcement'                        =>        'Ogłoszenie',
'Options'                                =>        'Opcje',
'Actions'                                =>        'Akcje',
'Submit'                                =>        'Potwierdź',        // "name" of submit buttons
'Ban message'                        =>        'Zostałeś zbanowany na tym forum',
'Ban message 2'                        =>        'Ban wygasa',
'Ban message 3'                        =>        'Administrator lub moderator zostawił, następującą wiadomość:',
'Ban message 4'                        =>        'Proszę kierować wszelkie pytania do administratora na',
'Never'                                        =>        'Nigdy',
'Today'                                        =>        'Dzisiaj',
'Yesterday'                                =>        'Wczoraj',
'Info'                                        =>        'Info',                // a common table header
'Go back'                                =>        'Powrót',
'Maintenance'                        =>        'Remont',
'Redirecting'                        =>        'Przekierowywanie',
'Click redirect'                =>        'Kliknij tutaj jeżeli nie chcesz dłużej czekać (lub przeglądarka nie obsługuje przekierowywania)',
'on'                                        =>        'włączone',                // as in "BBCode is on"
'off'                                        =>        'wyłączone',
'Invalid e-mail'                =>        'Adres email który podałeś jest niepoprawny.',
'required field'                =>        'jest obowiązkowym polem.',        // for javascript form validation
'Last post'                                =>        'Ostatni post',
'by'                                        =>        'przez',        // as in last post by someuser
'New posts'                                =>        'Nowe&nbsp;posty',        // the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'                =>        'Idź do pierwszego nowego posta w tym wątku.',        // the popup text for new posts links
'Username'                                =>        'Login',
'Password'                                =>        'Hasło',
'E-mail'                                =>        'E-mail',
'Send e-mail'                        =>        'Wyślij e-mail',
'Moderated by'                        =>        'Moderowane przez',
'Registered'                        =>        'Zarejestrowany',
'Subject'                                =>        'Temat',
'Message'                                =>        'Wiadomość',
'Topic'                                        =>        'Wątek',
'Forum'                                        =>        'Forum',
'Posts'                                        =>        'Posty',
'Replies'                                =>        'Odpowiedzi',
'Author'                                =>        'Autor',
'Pages'                                        =>        'Strony',
'BBCode'                                =>        'BBCode',        // You probably shouldn't change this
'img tag'                                =>        'tag [img]',
'Smilies'                                =>        'Emoty',
'and'                                        =>        'i',
'Image link'                        =>        'obrazek',        // This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'                                        =>        'napisał',        // For [quote]'s
'Code'                                        =>        'Kod',                // For [code]'s
'Mailer'                                =>        'Mailer',        // As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'        =>        'ważna informacja',
'Write message legend'        =>        'Napisz nowego posta',

// Title
'Title'                                        =>        'Tytuł',
'Member'                                =>        'Użytkownik',        // Default title
'Moderator'                                =>        'Moderator',
'Administrator'                        =>        'Administrator',
'Banned'                                =>        'Zbanowany',
'Guest'                                        =>        'Gość',

// Stuff for include/parser.php
'BBCode error'                        =>        'Składnia BBCode w wiadomości jest błędna.',
'BBCode error 1'                =>        'Brakujący tag startowy dla [/quote].',
'BBCode error 2'                =>        'Brakujący tag końcowy dla [code].',
'BBCode error 3'                =>        'Brakujący tag startowy dla  [/code].',
'BBCode error 4'                =>        'Brakuje jednego lub więcej końcowych tagów dla [quote].',
'BBCode error 5'                =>        'Brakuje jednego lub więcej startowych tagów dla [/quote].',

// Stuff for the navigator (top of every page)
'Index'                                        =>        'Index',
'User list'                                =>        'Lista użytkowników',
'Rules'                                        =>  'Zasady',
'Search'                                =>  'Szukaj',
'Register'                                =>  'Rejestracja',
'Login'                                        =>  'Logowanie',
'Not logged in'                        =>  'Nie jesteś zalogowany.',
'Profile'                                =>        'Profil',
'Logout'                                =>        'Wyloguj',
'Logged in as'                        =>        'Zalogowany jako',
'Admin'                                        =>        'Administracja',
'Last visit'                        =>        'Ostatnia wizyta',
'Show new posts'                =>        'Pokaż nowe posty od ostatniej wizyty',
'Mark all as read'                =>        'Oznacz nowe posty jako przeczytane',
'Link separator'                =>        '',        // The text that separates links in the navigator

// Stuff for the page footer
'Board footer'                        =>        'Stopka forum',
'Search links'                        =>        'Linki szukania',
'Show recent posts'                =>        'Pokaż nowe posty',
'Show unanswered posts'        =>        'Pokaż wątki bez odpowiedzi',
'Show your posts'                =>        'Pokaż Twoje posty',
'Show subscriptions'        =>        'Pokaż Twoje subskrybowane wątki',
'Jump to'                                =>        'Skocz do',
'Go'                                        =>        ' Idź ',                // submit button in forum jump
'Move topic'                        =>  'Przenieś wątek',
'Open topic'                        =>  'Otwórz wątek',
'Close topic'                        =>  'Zamknij wątek',
'Unstick topic'                        =>  'Odklej wątek',
'Stick topic'                        =>  'Przyklej wątek',
'Moderate forum'                =>        'Moderuj forum',
'Delete posts'                        =>        'Usuń posty',
'Debug table'                        =>        'Informacje debugowania',

// For extern.php RSS feed
'RSS Desc Active'                =>        'Ostatnio najbardziej aktywne wątki na',        // board_title will be appended to this string
'RSS Desc New'                        =>        'Najnowsze wątki na',                                        // board_title will be appended to this string
'Posted'                                =>        'Napisany'        // The date/time a topic was started

);
