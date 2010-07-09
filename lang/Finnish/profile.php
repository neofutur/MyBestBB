<?php

// Language definitions used in profile.php
$lang_profile = array(

// Navigation and sections
'Profile menu'			=>	'Omat asetukset',
'Section essentials'		=>	'Perustiedot',
'Section personal'		=>	'Henkilötiedot',
'Section messaging'		=>	'Viestintään liittyvää',
'Section personality'		=>	'Allekirjoitus ja kuva',
'Section display'		=>	'Näytön asetukset',
'Section privacy'		=>	'Tietosuoja',
'Section admin'			=>	'Ylläpito',

// Miscellaneous
'Username and pass legend'	=>	'Käyttäjätunnus ja salasana',
'Personal details legend'	=>	'Nimi, sijainti ja kotisivujen osoite',
'Contact details legend'	=>	'Yhteystiedot',
'Options display'		=>	'Näytön asetukset',
'Options post'			=>	'Viestien katselun asetukset',
'User activity'			=>	'Aktiivisuus',
'Paginate info'			=>	'Kuinka monta aihepiiriä ja viestiä haluat nähdä yhdellä sivulla.',

// Password stuff
'Pass key bad'			=>	'Salasanan aktivointiavain oli väärä tai vanhentunut. Yritä salasanan vaihtoa uudestaan. Jos et vieläkään onnistu, ota yhteyttä ylläpitäjään',
'Pass updated'			=>	'Salasanasi on päivitetty. Voit kirjautua järjestelmään uudella salasanallasi.',
'Pass updated redirect'		=>	'Salasana päivitetty. Uudelleenohjaus &hellip;',
'Wrong pass'			=>	'Väärä vanha salasana',
'Change pass'			=>	'Muuta salasanaa',
'Change pass legend'		=>	'Kirjoita ja vahvista salasanasi',
'Old pass'			=>	'Vanha salasana',
'New pass'			=>	'Uusi salasana',
'Confirm new pass'		=>	'Vahvista uusi salasana',

// E-mail stuff
'E-mail key bad'		=>	'Sähköpostin aktivointiavain oli väärä tai vanhentunut. Yritä uudelleen. Jos et vieläkään onnistu, ota yhteyttä ylläpitäjään',
'E-mail updated'		=>	'Sähköpostiosoitteesi on päivitetty.',
'Activate e-mail sent'		=>	'Antamaasi sähköpostiosoitteeseen on lähetetty ohjeet kyseisen asetuksen aktivoimiseksi. Jos et saa mitään ilmoitusta, ota yhteyttä ylläpitäjään',
'E-mail legend'			=>	'Kirjoita uusi sähköpostiosoitteesi',
'E-mail instructions'		=>	'Uuteen sähköpostiosoitteeseesi lähetetään aktivointilinkki. Uudet tiedot tulevat voimaan heti sen jälken kun olet käynyt linkin osoittamalla sivulla.',
'Change e-mail'			=>	'Vaihda sähköpostiosoitetta',
'New e-mail'			=>	'Uusi sähköpostiosoite',

// Avatar upload stuff
'Avatars disabled'		=>	'Järjestelmän ylläpitäjä on estänyt kuvan käytön.',
'Too large ini'			=>	'Valittu tiedosto oli liian suuri ladattavaksi palvelimelle. Palvelin ei sallinut latausta.',
'Partial upload'		=>	'Valittu tiedosto ladattiin palvelimelle vain osittain. Kokeile uudestaan.',
'No file'			=>	'Et antanut tiedoston nimeä.',
'Bad type'			=>	'Ladattava tiedosto ei ole oikeaa tyyppiä. Hyväksyttäviä tyyppejä ovat gif, jpeg ja png.',
'Too wide or high'		=>	'Tiedosto, jota yritit tarjota palvelimelle, on joko korkeampi tai leveämpi kuin on sallittu.',
'Too large'			=>	'Tiedosto, jota yritut ujuttaa palvelimelle, on sallittua suurempi.',
'pixels'			=>	'pixeliä',
'bytes'				=>	'tavua',
'Move failed'			=>	'Palvelin ei pystynyt tallentamaan lähettämääsi tiedostoa. Ota yhteyttä järjestelmän valvojaan',
'Unknown failure'		=>	'Tuntematon virhe. Kokeile uudestaan.',
'Avatar upload redirect'	=>	'Kuva ladattu. Uudelleenohjaus &hellip;',
'Avatar deleted redirect'	=>	'Kuva poistettu. Uudelleenohjaus &hellip;',
'Avatar desc'			=>	'Kuva näytetään käyttäjätunnuksesi alla. Se ei saa olla suurempi kuin',
'Upload avatar'			=>	'Lataa kuva palvelimelle',
'Upload avatar legend'		=>	'Valitse kuvatiedosto, jonka haluat ladata palvelimelle',
'Delete avatar'			=>	'Poista kuva',	// only for admins
'File'				=>	'Tiedosto',
'Upload'			=>	'Lataa',	// submit button

// Form validation stuff
'Dupe username'			=>	'Joku toinen on jo ehtinyt rekisteröityä valitsemallasi käyttäjätunnuksella. Valitse uusi käyttäjätunnus.',
'Forbidden title'		=>	'Antamasi titteli sisältää kielletyn sanan. Valitse uusi titteli',
'Profile redirect'		=>	'Profiili on päivitetty. uudelleenohjaus &hellip;',

// Profile display stuff
'Not activated'			=>	'Tämä käyttäjä ei ole vielä aktivoinut tiliään. Tili aktivoidaan, kun hän kirjautuu järjestelmään ensimmäisen kerran.',
'Unknown'			=>	'(Tuntematon)',	// This is displayed when a user hasn't filled out profile field (e.g. Location)
'Private'			=>	'(Salainen)',	// This is displayed when a user does not want to receive e-mails
'No avatar'			=>	'(Ei kuvaa)',
'Show posts'			=>	'Näytä kaikki viestit',
'Realname'			=>	'Oikea nimi',
'Location'			=>	'Sijainti',
'Website'			=>	'Website',
'Jabber'			=>	'Jabber',
'ICQ'				=>	'ICQ',
'MSN'				=>	'MSN Messenger',
'AOL IM'			=>	'AOL IM',
'Yahoo'				=>	'Yahoo! Messenger',
'Avatar'			=>	'Kuva',
'Signature'			=>	'Allekirjoitus',
'Sig max length'		=>	'Enimmäispituus',
'Sig max lines'			=>	'Rivejä enintään',
'Avatar legend'			=>	'Kuvan asetukset',
'Avatar info'			=>	'Kuva näytetään kaikkien lähettämiesi viestien yhteydessä. Kuva voi olla itsestäsi, lemmikistäsi tai mistä vain, mikä liittyy itseesi (säädyllisyyden rajoissa kuitenkin - ylläpitäjä ei todennäköisesti salli mitä tahansa). Voit ladata kuvan tälle palvelimelle alla olevan linkin avulla. Valitse \'Käytä kuvaa\', jotta kuva näytetään viestiesi yhteydessä.',
'Change avatar'			=>	'Vaihda kuvaa',
'Use avatar'			=>	'Käytä kuvaa.',
'Signature legend'		=>	'Allekirjoitus',
'Signature info'		=>	'Allekirjoitus on lyhyt viesti, joka liitetään lähettämiisi posteihin. Voit vaikka lainata jotain suurta ajattelijaa esimerkiksi: "Muuten olen sitä mieltä, että Karthago on hävitettävä"',
'Sig preview'			=>	'Voimassaolevan allekirjoituksen katselu:',
'No sig'			=>	'Profiiliin ei ole tallennettu allekirjoitusta.',
'Topics per page'		=>	'Otsikoita sivulla',
'Topics per page info'		=>	'Tämän asetuksen avulla voit säätää kuinka monta viestiketjua yhdellä sivulla näytetään. Jos et ole varma, mitä tähän laittaisit, jätä se tyhjäksi, jolloin järjestelmä käyttää oletusarvoja.',
'Posts per page'		=>	'Viestejä sivulla',
'Posts per page info'		=>	'Tällä asetuksella säädät yhdellä sivulla näkyvien viestien lukumäärää. Jos jätät tämän tyhjäksi, järjestelmä käyttää oletusarvoa.',
'Leave blank'			=>	'Jätä tyhjäksi, jolloin käytetään järjestelmän oletusarvoa.',
'Notify full'			=>	'Sisällytä viesti tilatun kanavan "uusi viesti" ilmoitukseen (sähköpostitse).',
'Notify full info'		=>	'Tämän vaihtoehdon valittuasi uudet viestit sisällytetään sähköpostiviestiin, jolla ilmoitetaan, että tilaamallesi kanavalle on lähetetty uusia viestejä.',
'Show smilies'			=>	'Näytä hymiöt pieninä kuvina',
'Show smilies info'		=>	'Jos otat käyttöön tämän asetuksen, hymiöt näkyvät kuvina sen sijaan että näkyisivät tekstinä.',
'Show images'			=>	'Näytä kuvat viesteissä.',
'Show images info'		=>	'Valitse, jos haluat nähdä viesteihin liitetyt kuvat.',
'Show images sigs'		=>	'Näytä kuvat käyttäjien allekirjoituksissa.',
'Show images sigs info'		=>	'Valitse, jos haluat nähdä allekirjoituksiin liitetyt kuvat.',
'Show avatars'			=>	'Näytä käyttäjä-kuvake viesteissä.',
'Show avatars info'		=>	'Valitse, jos haluat nähdä viestin lähettäjien kuvakkeet viesteissä.',
'Show sigs'			=>	'Näytä viestien allekirjoitukset.',
'Show sigs info'		=>	'Valitse, jos haluat nähdä lähettäjine allekirjoitukset',
'Style legend'			=>	'Valitse haluamasi tyyli',
'Style info'			=>	'Jos haluat, voit valita haluamasi visuaalisen tyylin tälle foorumille.',
'Admin note'			=>	'Admin note',
'Pagination legend'		=>	'Syötä sivutuksen asetukset',
'Post display legend'		=>	'Asetukset postien katseluun',
'Post display info'		=>	'Jos olet hitaan yhteyden takana, näiden asetusten ottaminen pois päältä saa sivuston toimimaan nopeammin.',
'Instructions'			=>	'Kun olet päivittänyt profiilisi, sinut ohjataan takaisin tälle sivulle.',

// Administration stuff
'Group membership legend'	=>	'Valitse käyttäjäryhmä',
'Save'				=>	'Tallenna',
'Set mods legend'		=>	'Aseta moderaattorin oikeudet',
'Moderator in'			=>	'Moderaattori kanavalla',
'Moderator in info'		=>	'Valitse, mitä kanavia tämän käyttäjän sallitaan hallita. Huom! Järjestelmän ylläpitäjällä on automaattisesti kaikki oikeudet koko järjestelmään.',
'Update forums'			=>	'Päivitä foorumi',
'Delete ban legend'		=>	'Poista (vain ylläpitäjälle) tai julista pannaan käyttäjä',
'Delete user'			=>	'Poista käyttäjä',
'Ban user'			=>	'Julista käyttäjä pannaan',
'Confirm delete legend'		=>	'Tärkeää: lue ennenkuin poistat käyttäjän',
'Confirm delete user'		=>	'Vahvista käyttäjän poisto',
'Confirmation info'		=>	'Vahvista, että todella haluat poistaa tämän käyttäjän.',	// the username will be appended to this string
'Delete warning'		=>	'VAROITUS! Poistettua käyttäjää/viestiä ei voida palauttaa myöhemmin. Jos poistat käyttäjän poistamatta hänen viestejään, voit myöhemmin erikseen poistaa myös viestit',
'Delete posts'			=>	'Poista tämän käyttäjän lähettämät viestit ja aloittamat viestiketjut.',
'Delete'			=>	'Poista',		// submit button (confirm user delete)
'User delete redirect'		=>	'Käyttäjätunnus poistettu. Uudelleenohjaus &hellip;',
'Group membership redirect'	=>	'Ryhmän jäsenyys tallennettu. Uudelleenohjaus &hellip;',
'Update forums redirect'	=>	'Foorumin ylläpitäjän oikeudet on päivitetty. Uudelleenohjaus &hellip;',
'Ban redirect'			=>	'Uudelleenohjaus &hellip;'

);
