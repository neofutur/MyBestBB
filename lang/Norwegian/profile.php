<?php

// Language definitions used in profile.php
$lang_profile = array(

// Navigation and sections
'Profile menu'				=>	'Profilmeny',
'Section essentials'		=>	'Grunnleggende',
'Section personal'			=>	'Personlig',
'Section messaging'			=>	'Kontakt',
'Section personality'		=>	'Personlighet',
'Section display'			=>	'Visning',
'Section privacy'			=>	'Sikkerhet',
'Section admin'				=>	'Administrasjon',

// Miscellaneous
'Username and pass legend'	=>	'Skriv inn ditt brukernavn og passord',
'Personal details legend'	=>	'Skriv inn dine personlige detaljer',
'Contact details legend'	=>	'Skriv inn dine kontakt-detaljer',
'Options display'			=>	'Sett dine visningsvalg.',
'Options post'				=>	'Sett valg for visning av poster',
'User activity'				=>	'Brukeraktivitet',
'Paginate info'				=>	'Skriv inn antallet emner og poster du vil se på hver side.',

// Password stuff
'Pass key bad'				=>	'Den spesifiserte passord-aktiveringsnøkkelen var feil eller utdatert. Vennligst få tilsendt et nytt passord. Om det ikke lykkes, kontakt administratoren på',
'Pass updated'				=>	'Ditt passord har blitt oppdatert. Du kan logge inn med ditt nye passord.',
'Pass updated redirect'		=>	'Passord oppdatert. Omdirigerer &hellip;',
'Wrong pass'				=>	'Galt gammelt passord.',
'Change pass'				=>	'Endre passord',
'Change pass legend'		=>	'Skriv inn og bekreft ditt nye passord',
'Old pass'					=>	'Gammelt passord',
'New pass'					=>	'Nytt passord',
'Confirm new pass'			=>	'Bekreft nytt passord',

// E-mail stuff
'E-mail key bad'			=>	'Den spesifiserte e-post-aktiveringsnøkkelen var feil eller utdatert. Vennligst få tilsendt et nytt passord. Om det ikke lykkes, kontakt administratoren på',
'E-mail updated'			=>	'Din e-post-adresse har blitt oppdatert.',
'Activate e-mail sent'		=>	'En e-post har blitt sendt til den spesifiserte adressen med instruksjoner for hvordan du kan aktivere den nye e-post-adressen. Om den ikke kommer frem, kan du kontakte administratoren på',
'E-mail legend'				=>	'Skriv inn din nye e-post-adresse',
'E-mail instructions'		=>	'En e-post vil bli sendt til din nye adresse med en aktiveringslink. Du må klikke på linken for å aktivere den nye adressen.',
'Change e-mail'				=>	'Bytt e-post-adresse',
'New e-mail'				=>	'Ny e-post',

// Avatar upload stuff
'Avatars disabled'			=>	'Administratoren har slått av avatarer.',
'Too large ini'				=>	'Den valgte filen var for stor for å lastes opp. Serveren tillatte ikke opplastningen.',
'Partial upload'			=>	'Den valgte filen ble bare delvis lastet opp. Vennligst prøv igjen.',
'No tmp directory'			=>	'PHP kunne ikke lagre den opplastede filen til en midlertidig plassering.',
'No file'					=>	'Du valgte ikke en fil for opplastningen.',
'Bad type'					=>	'Filen du forsøkte å laste opp er ikke en tillatt type. Tillatte filtyper er gif, jpeg og png.',
'Too wide or high'			=>	'Filen du forsøkte å laste opp er bredere og/eller høyere enn det som er maksimum tillatt',
'Too large'					=>	'Filen du forsøkte å laste opp er større enn det som er maksimum tillatt',
'pixels'					=>	'pixler',
'bytes'						=>	'byte',
'Move failed'				=>	'Serveren var ikke i stand til å lagre den opplastede filen. Vennligst kontakt administratoren på',
'Unknown failure'			=>	'En ukjent feil skjedde. Vennligst prøv igjen.',
'Avatar upload redirect'	=>	'Avatar lastet opp. Omdirigerer &hellip;',
'Avatar deleted redirect'	=>	'Avatar slettet. Omdirigerer &hellip;',
'Avatar desc'				=>	'En avatar er et lite bilde som vil bli vist under brukernavnet i dine poster. Det kan ikke være større enn',
'Upload avatar'				=>	'Last opp avatar',
'Upload avatar legend'		=>	'Legg til en avatar for å lastes opp',
'Delete avatar'				=>	'Slett avatar',	// only for admins
'File'						=>	'Fil',
'Upload'					=>	'Last opp',	// submit button

// Form validation stuff
'Dupe username'				=>	'Noen andre er allerede registrert med det brukernavnet. Vennligst gå tilbake og prøv et annet brukernavn.',
'Forbidden title'			=>	'Titlen du skrev inn inneholder et forbudt ord. Du må velge en annen tittel.',
'Profile redirect'			=>	'Profil oppdatert. Omdirigerer &hellip;',

// Profile display stuff
'Not activated'				=>	'Denne brukeren har ikke aktivert hans/hennes konto enda. Kontoen blir aktivert når han/hun logger inn for første gang.',
'Unknown'					=>	'(Ukjent)',	// This is displayed when a user hasn't filled out profile field (e.g. Location)
'Private'					=>	'(Privat)',	// This is displayed when a user does not want to receive e-mails
'No avatar'					=>	'(Ingen avatar)',
'Show posts'				=>	'Vis alle poster',
'Realname'					=>	'Ekte navn',
'Location'					=>	'Sted',
'Website'					=>	'Hjemmeside',
'Jabber'					=>	'Jabber',
'ICQ'						=>	'ICQ',
'MSN'						=>	'MSN Messenger',
'AOL IM'					=>	'AOL IM',
'Yahoo'						=>	'Yahoo! Messenger',
'Avatar'					=>	'Avatar',
'Signature'					=>	'Signatur',
'Sig max length'			=>	'Maks. lengde',
'Sig max lines'				=>	'Maks. linjer',
'Avatar legend'				=>	'Sett dine avatarvisningsvalg',
'Avatar info'				=>	'En avatar er et lite bilde som vil bli vist under brukernavnet i dine poster. Du kan laste opp en avatar ved å følge linken under. Boksen \'Bruk avatar\' under må være haket av for at avataren skal vises med dine poster.',
'Change avatar'				=>	'Bytt avatar',
'Use avatar'				=>	'Bruk avatar.',
'Signature legend'			=>	'Lag en signatur',
'Signature info'			=>	'En signatur er et lite stykke tekst som blir lagt til under postene dine. Det kan inneholde hva som helst. Kanskje du vil skrive inn ditt favorittsitat, eller ditt stjernetegn. Det er opp til deg! I signaturen kan du bruke BBCode om det er tillatt på forumet. Du kan se hva som er tillatt/ikke tillatt når du endrer signaturen.',
'Sig preview'				=>	'Forhåndsvisning av nåværende signatur:',
'No sig'					=>	'For øyeblikket er det ingen signatur lagret i profilen.',
'Topics per page'			=>	'Emner',
'Topics per page info'		=>	'Denne innstillingen velger hvor mange emner som vises per side når du går gjennom et forum. Hvis du ikke er sikker på hva du vil bruke, kan du bare la den stå tom og la forumstandarden bestemme.',
'Posts per page'			=>	'Poster',
'Posts per page info'		=>	'Denne innstillingen velger hvor mange poster som vises per side når du går gjennom et emne. Hvis du ikke er sikker på hva du vil bruke, kan du bare la den stå tom og la forumstandarden bestemme.',
'Leave blank'				=>	'La feltene stå tomme for å bruke forumstandard.',
'Notify full'				=>	'Inkluder post i abonnement-e-post.',
'Notify full info'			=>	'Med dette på, vil en tekst-versjon av den nye posten bli inkludert med abonnement-e-post.',
'Show smilies'				=>	'Vis smilier som grafiske ikoner',
'Show smilies info'			=>	'Hvis du slår på dette valget, vil små bilder bli satt inn i stedet for tekst-smilier.',
'Show images'				=>	'Vis bilder i poster.',
'Show images info'			=>	'Slå av dette om du ikke vil se bilder i poster (f.eks. bilder vist med [img]-koden.)',
'Show images sigs'			=>	'Vis bilder i brukeres signaturer.',
'Show images sigs info'		=>	'Slå av dette om du ikke vil se bilder i signaturer (f.eks. bilder vist med [img]-koden.)',
'Show avatars'				=>	'Vis brukeres avatarer i poster.',
'Show avatars info'			=>	'Dette slår av/på om andre brukeres avatarer skal vises med postene',
'Show sigs'					=>	'Vis brukeres signaturer.',
'Show sigs info'			=>	'Slå på dette om du vil se brukeres signaturer.',
'Style legend'				=>	'Velg din foretrukne stil',
'Style info'				=>	'Om du vil kan du bruke en annen visuell stil på forumet.',
'Admin note'				=>	'Admin-notat',
'Pagination legend'			=>	'Skriv inn dine sidevisningsvalg',
'Post display legend'		=>	'Sett dine valg for visning av poster',
'Post display info'			=>	'Om du er på en treg tilkobling kan du ved å slå av disse valgene, spesielt å vise bilder i poster og signaturer, få sidene til å vises raskere.',
'Instructions'				=>	'Når du oppdaterer profilen, vil du sendes tilbake til denne siden.',

// Administration stuff
'Group membership legend'	=>	'Velg brukergruppe',
'Save'						=>	'Lagre',
'Set mods legend'			=>	'Sett moderatortilgang',
'Moderator in'				=>	'Moderator i',
'Moderator in info'			=>	'Velg hvilke forum denne brukeren skal være tillatt å moderere. NB: Dette gjelder bare moderatorer. Administratorer har alltid full tillatelse i alle forum.',
'Update forums'				=>	'Oppdater forum',
'Delete ban legend'			=>	'Slett (kun for administratorer) eller ban bruker',
'Delete user'				=>	'Slett bruker',
'Ban user'					=>	'Ban bruker',
'Confirm delete legend'		=>	'Viktig: les før du sletter bruker',
'Confirm delete user'		=>	'Bekreft sletting av bruker',
'Confirmation info'			=>	'Vennligst bekreft at du ønsker å slette brukeren',	// the username will be appended to this string
'Delete warning'			=>	'Advarsel! Slettede brukere og/eller poster kan ikke gjenopprettes. Om du velger å ikke slette postene skrevet av denne brukeren, kan postene bare slettes manuelt senere.',
'Delete posts'				=>	'Slett alle poster og emner denne brukeren har laget.',
'Delete'					=>	'Slett',		// submit button (confirm user delete)
'User delete redirect'		=>	'Bruker slettet. Omdirigerer &hellip;',
'Group membership redirect'	=>	'Gruppemedlemskap lagre. Omdirigerer &hellip;',
'Update forums redirect'	=>	'Moderator-rettigheter oppdatert. Omdirigerer &hellip;',
'Ban redirect'				=>	'Omdirigerer &hellip;'

);
