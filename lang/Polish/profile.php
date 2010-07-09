<?php

// Language definitions used in profile.php
$lang_profile = array(

// Navigation and sections
'Profile menu'                                =>        'Menu Profilu',
'Section essentials'                =>        'Główne',
'Section personal'                        =>        'Personalne',
'Section messaging'                        =>        'Komunikatory',
'Section personality'                =>        'Sygnatura/Avatar',
'Section display'                        =>        'Wyświetlanie',
'Section privacy'                        =>        'Prywatność',
'Section admin'                                =>        'Administracja',

// Miscellaneous
'Username and pass legend'        =>        'Wprowadź login i hasło',
'Personal details legend'        =>        'Wprowadź dane personalne',
'Contact details legend'        =>        'Wprowadź dane komunikatorów',
'Options display'                        =>        'Ustaw opcje wyświetlania',
'Options post'                                =>        'Wyświetlanie postów',
'User activity'                                =>        'Informacje',
'Paginate info'                                =>        'Liczba wątków i postów ktore mają być wyświetlone na jednej stronie.',

// Password stuff
'Pass key bad'                                =>        'Klucz aktywacyjny hasła jest niepoprawny lub przedawniony. Użyj ponownie funkcji zmiany hasła. Jeżeli to nie pomoże skontaktuj się z administratorem na',
'Pass updated'                                =>        'Hasło zostało zaktualizowane. Możesz się teraz zalogować z nowym hasłem.',
'Pass updated redirect'                =>        'Hasło zaktualizowane. Przekierowywanie &hellip;',
'Wrong pass'                                =>        'Złe stare hasło.',
'Change pass'                                =>        'Zmień hasło',
'Change pass legend'                =>        'Wprowadź i potwierdź nowe hasło',
'Old pass'                                        =>        'Stare hasło',
'New pass'                                        =>        'Nowe hasło',
'Confirm new pass'                        =>        'Potwierdź nowe hasło',

// E-mail stuff
'E-mail key bad'                        =>        'Podany klucz aktywacyjny emaila jest niepoprawny lub wygasł. Użyj ponownie funkcji zmiany adresu email. Jeżeli to nie pomoże skontaktuj się z administratorem na',
'E-mail updated'                        =>        'Twój adres email został zaktualizowany.',
'Activate e-mail sent'                =>        'Email został wysłany na podany adres z instrukcją jak go aktywować. Jeżeli to nie działa to skontaktuj się z administratorem na',
'E-mail legend'                                =>        'Wprowadź Twój nowy adres',
'E-mail instructions'                =>        'Email z linkiem aktywacyjnym zostanie wysłany na nowy adres. Aby aktywować nowy adres musisz kliknąć w link znajdujący się w tym emailu.',
'Change e-mail'                                =>        'Zmień adres email',
'New e-mail'                                =>        'Nowy e-mail',

// Avatar upload stuff
'Avatars disabled'                        =>        'Administrator zablokował wsparcie avatarów.',
'Too large ini'                                =>        'Wybrany plik był zbyt duży aby go wysłać. Serwer nie pozwala na wysłanie.',
'Partial upload'                        =>        'Plik został częściowo wysłany. Spróbuj ponownie.',
'No tmp directory'                        =>        'PHP nie był w stanie zapisać pliku do podanego katalogu.',
'No file'                                        =>        'Nie wybrałeś pliku do wysłania.',
'Bad type'                                        =>        'Typ pliku który chcesz wysłać jest niedozwolony. Typy dozwolone to: gif, jpeg i png.',
'Too wide or high'                        =>        'Plik który chcesz wysłać przekracza dozwoloną szerokość lub wysokość',
'Too large'                                        =>        'Plik który chcesz wysłać jest zbyt duży',
'pixels'                                        =>        'pixeli',
'bytes'                                                =>        'bajty',
'Move failed'                                =>        'Serwer nie był w stanie pobrać wysyłanego pliku. Skontaktuj się z administratorem na',
'Unknown failure'                        =>        'Wystąpił nieznany błąd. Próbuj ponownie.',
'Avatar upload redirect'        =>        'Avatar wysłany. Przekierowywanie &hellip;',
'Avatar deleted redirect'        =>        'Avatar usunięty. Przekierowywanie &hellip;',
'Avatar desc'                                =>        'Avatar jest małym obrazkiem który będzie wywietlany pod Twoim loginem w postach. Nie może być większy niż',
'Upload avatar'                                =>        'Wyślij Avatar',
'Upload avatar legend'                =>        'Wprowadź plik do wysłania',
'Delete avatar'                                =>        'Usuń avatar',        // only for admins
'File'                                                =>        'Plik',
'Upload'                                        =>        'Wyślij',        // submit button

// Form validation stuff
'Dupe username'                                =>        'Ktoś już zarejestrował sobie taki login. Wróć i spróbuj inny.',
'Forbidden title'                        =>        'Tytuł który wpisałeś zawiera zakazane słowa. Musisz wybrać inny.',
'Profile redirect'                        =>        'Profil zaktualizowany. Przekierowywanie &hellip;',

// Profile display stuff
'Not activated'                                =>        'Ten użytkownik nie aktywował jeszcze swojego konta. Konto staje się aktywne po pierwszym zalogowaniu.',
'Unknown'                                        =>        '(Nieznany)',        // This is displayed when a user hasn't filled out profile field (e.g. Location)
'Private'                                        =>        '(Prywatny)',        // This is displayed when a user does not want to receive e-mails
'No avatar'                                        =>        '(Brak avatara)',
'Show posts'                                =>        'Pokaż wszystkie posty',
'Realname'                                        =>        'Prawdziwe imię',
'Location'                                        =>        'Lokacja',
'Website'                                        =>        'Strona WWW',
'Jabber'                                        =>        'Jabber',
'ICQ'                                                =>        'ICQ',
'MSN'                                                =>        'MSN Messenger',
'AOL IM'                                        =>        'AOL IM',
'Yahoo'                                                =>        'Yahoo! Messenger',
'Avatar'                                        =>        'Avatar',
'Signature'                                        =>        'Sygnatura',
'Sig max length'                        =>        'Maksymalna długość',
'Sig max lines'                                =>        'Maksymalna ilość linii',
'Avatar legend'                                =>        'Opcje wyświetlania avatara',
'Avatar info'                                =>        'Avatar jest obrazkiem, który będzie wyświetlany przy wszystkich Twoich postach. Możesz wysłać obrazek klikając w link poniżej. Pamiętaj o tym, że avatar będzie wyświetlany jeżeli zaznaczysz pole "Używaj avatara".',
'Change avatar'                                =>        'Zmień avatar',
'Use avatar'                                =>        'Używaj avatara.',
'Signature legend'                        =>        'Stwórz własną sygnaturę',
'Signature info'                        =>        'Sygnatura to tekst lub obrazek który może być dołączany do każdego posta. Możesz w niej wpisać co tylko chcesz. W sygnaturce działa BBCode, a włączone/wyłączone opcje będą pokazane przy jej edycji.',
'Sig preview'                                =>        'Podgląd aktualnej sygnatury:',
'No sig'                                        =>        'Brak sygnaturki w profilu.',
'Topics per page'                        =>        'Wątki',
'Topics per page info'                =>        'Ta opcja kontroluje liczbę wątków wyświetlonych na jednej stronie na forum. Jeżeli nie jesteś pewny co wpisać to pozostaw puste pole, wtedy zastosowane zostaną domyśle ustawienia.',
'Posts per page'                        =>        'Posts',
'Posts per page info'                =>        'Ta opcja kontroluje liczbę postów wyświetlonych na jednej stronie w wątku. Jeżeli nie jesteś pewny co wpisać to pozostaw puste pole, wtedy zastosowane zostaną domyśle ustawienia.',
'Leave blank'                                =>        'Pozostaw puste dla domyślnego ustawienia',
'Notify full'                                =>        'Zamieszczaj posty w subskrybowanych emailach.',
'Notify full info'                        =>        'Jeżeli opcja jest włączona to w emailach powiadamiających będzie zawarty post (sam tekst).',
'Show smilies'                                =>        'Pokazuj uśmieszki jako graficzne emotikony',
'Show smilies info'                        =>        'Ta opcja pozwala na zmiane tekstowych emot na obrazkowe emotikony.',
'Show images'                                =>        'Pokazuj obrazki w postach.',
'Show images info'                        =>        'Zablokuj to jeżeli nie chcesz widzieć obrazków w postach (obrazki zamieszczone między tagiem [img] a [/img]).',
'Show images sigs'                        =>        'Pokazuj obrazki w sygnaturach użytkowników.',
'Show images sigs info'                =>        'Zablokuj to jeżeli nie chcesz oglądać obrazków w sygnaturach (obrazki zamieszczone między tagiem [img] a [/img]).',
'Show avatars'                                =>        'Pokazuj avatary użytkowników w postach.',
'Show avatars info'                        =>        'Ta opcja pozwala użytkownikowi lub blokuje możliwość dodania obrazka znajdującego się przy poście.',
'Show sigs'                                        =>        'Pokazuj sygnaturę użytkownika.',
'Show sigs info'                        =>        'Włącz to jeśli chcesz widzieć sygnatury użytkowników.',
'Style legend'                                =>        'Wybierz preferowany styl',
'Style info'                                =>        'Ta opcja pozwala na zmianę stylu graficznego forum.',
'Admin note'                                =>        'Notka Admina',
'Pagination legend'                        =>        'Opcje wyświetlania na forum',
'Post display legend'                =>        'Ustawienia dla przeglądania postów',
'Post display info'                        =>        'Dla posiadaczy bardzo wolnych łącz. Wyłączając te możliwości przyspieszasz wczytywanie się forum..',
'Instructions'                                =>        'Po zaktualizowaniu profilu zostaniesz przekierowany tutaj.',

// Administration stuff
'Group membership legend'        =>        'Wybierz grupę użytkownika',
'Save'                                                =>        'Zapisz',
'Set mods legend'                        =>        'Ustaw dostęp moderatora',
'Moderator in'                                =>        'Moderator na',
'Moderator in info'                        =>        'Wybierz które fora mogą być moderowane przez tego użytkownika. Dotyczy to tylko moderatorów, gdyż administratorzy mają pełny dostęp na wszystkich forach.',
'Update forums'                                =>        'Aktualizuj fora',
'Delete ban legend'                        =>        'Usuń (tylko administratorzy) lub zbanuj użytkownika',
'Delete user'                                =>        'Usuń użytkownika',
'Ban user'                                        =>        'Zbanuj użytkownika',
'Confirm delete legend'                =>        'Przydatne: czytaj przed usuwaniem użytkownika',
'Confirm delete user'                =>        'Potwierdź usunięcie użytkownika',
'Confirmation info'                        =>        'Potwierdź usunięcie użytkownika',        // the username will be appended to this string
'Delete warning'                        =>        'Uwaga! Usunięte wątki i posty nie mogą zostać przywrócone. Jeżeli nie zaznaczysz tej opcji, to posty i wątki napisane przez tego użytkownika mogą być usunięte tylko ręcznie.',
'Delete posts'                                =>        'Usuń posty i wątki stworzone przez tego użytkownika.',
'Delete'                                        =>        'Usuń',                // submit button (confirm user delete)
'User delete redirect'                =>        'Użytkownik usunięty. Przekierowywanie &hellip;',
'Group membership redirect'        =>        'Grupa użytkownika zapisana. Przekierowywanie &hellip;',
'Update forums redirect'        =>        'Uprawnienia moderatora zaktualizowane. Przekierowywanie &hellip;',
'Ban redirect'                                =>        'Przekierowywanie &hellip;'

);
