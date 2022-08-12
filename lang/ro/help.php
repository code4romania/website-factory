<?php

declare(strict_types=1);

return [

    'users' => [
        'title' => 'Managementul utilizatorilor',
        'intro' => 'Qui sunt ratione voluptas distinctio maiores ea. Soluta voluptatem at et illum error. Ipsa repellendus dolorem velit corporis quam ipsam.',
        'sections' => [
            'add' => [
                'title' => 'Adăugarea de utilizatori',
                'intro' => 'Odată ce am finalizat instalarea vei primi informații cu privire la contul de administrator din site. Acesta este contul principal al organizației tale și vei putea mai apoi să adaugi oricâți alți utilizatori ai nevoie din interfața de administrare.',
                'content' => <<<'markdown'
                    Odată ce am finalizat instalarea vei primi informații cu privire la contul de administrator din site. Acesta este contul principal al organizației tale și vei putea mai apoi să adaugi oricâți alți utilizatori ai nevoie din interfața de administrare.

                    Pentru a adăuga un utilizator:
                    1. Accesează panoul de administrare
                    2. Selectează meniul secundar de setări din colțul din dreapta sus
                    3. Selectează ”Utilizatori”
                    4. Apasă pe butonul ”Adaugă”
                    5. Introdu numele noului utilizator, adresa de e-mail, asignează un rol și setează limba de bază a acestui utilizator.
                    6. Apasă ”Salvează”

                    Utilizatorul creat va primi un e-mail cu un link pentru a-și seta propria parola și instrucțiuni de accesare a panoului de administrare.
                    markdown,
            ],
            'roles' => [
                'title' => 'Ce înseamnă fiecare rol de utilizator',
                'content' => <<<'markdown'
                    Rolurile pe care le poți asigna unui utilizator nou sunt:
                    - Administrator - un administrator nou va avea toate permisiunile pe care le ai și tu în panoul de administrare, ceea ce înseamnă că va putea controla întregul site precum și conturile altor utilizatori
                    - Editor - un editor are dreptul de a interveni asupra paginilor de conținut curente și va putea adăuga pagini, adăuga articole și crea formulare.
                    - Utilizator - un utilizator simplu…
                    markdown,
            ],
            'edit' => [
                'title' => 'Editarea și stergerea utilizatorilor',
                'intro' => '',
                'content' => <<<'markdown'
                    Ca administrator ai dreptul de a edita starea unui utilizator. Pentru a schimba rolul, adresa de email sau numele unui utilizator trebuie să parcurgi următorii pași:
                    1. Accesează panoul de administrare
                    2. Selectează meniul secundar de setări din colțul din dreapta sus
                    3. Selectează ”Utilizatori”
                    4. Dă click pe numele utilizatorului pe care vrei să îl editezi
                    5. Modifică informațiile
                    6. Apasă ”Salvează”

                    Dacă ai ales să schimbi adresa de e-mail a utilizatorului, acesta nu va putea să se mai logheze cu adresa anterioară în panou. Un email de setare a parolei va fi trimis pe emailul nou introdus în profilul acelui utilizator.

                    Pentru a șterge un utilizator trebuie să parcurgi următorii pași:
                    1. Accesează panoul de administrare
                    2. Selectează meniul secundar de setări din colțul din dreapta sus
                    3. Selectează ”Utilizatori”
                    4. Dă click pe săgeata din dreptul numelui utilizatorului pe care vrei să îl elimini (din partea dreaptă în tabel)
                    5. Selectează ”Șterge”
                    6. Confirmă acțiunea
                    7. Apasă ”Salvează”

                    Dacă ai ales să ștergi un utilizator acest lucru înseamnă că acesta nu va mai avea acces în panoul de administrare și nu va mai putea edita nimic pe website. Conținutul încărcat sau editat de acest utilizator va rămâne intact.
                    markdown,
            ],
        ],
    ],

    'settings' => [
        'title' => 'Setările website-ului',
        'intro' => <<<'markdown'
            După adăugarea utilizatorilor, poți trece la setarea elementelor generale ale website-ului, care se aplică tuturor paginilor. Pentru a ajunge în această secțiune, este necesar să parcurgi următorii pași:
            1. Accesează panoul de administrare
            2. Selectează meniul secundar de setări din colțul din dreapta sus
            3. Selectează Setări
            markdown,
        'sections' => [
            'general' => [
                'title' => 'Setări generale',
                'intro' => 'În această secțiune poți seta elementele de generale ale website-ului tău: titlu, descriere, prima pagină.',
                'content' => <<<'markdown'
                    Odată ce am finalizat instalarea vei primi informații cu privire la contul de administrator din site. Acesta este contul principal al organizației tale și vei putea mai apoi să adaugi oricâți alți utilizatori ai nevoie din interfața de administrare.

                    Pentru a adăuga un utilizator:
                    1. Accesează panoul de administrare
                    2. Selectează meniul secundar de setări din colțul din dreapta sus
                    3. Selectează ”Utilizatori”
                    4. Apasă pe butonul ”Adaugă”
                    5. Introdu numele noului utilizator, adresa de e-mail, asignează un rol și setează limba de bază a acestui utilizator.
                    6. Apasă ”Salvează”

                    Utilizatorul creat va primi un e-mail cu un link pentru a-și seta propria parola și instrucțiuni de accesare a panoului de administrare.
                    markdown,
                'video' => [
                    'id' => 'dQw4w9WgXcQ',
                    'caption' => 'Great as a TV Screensaver for the office,  lounge, waiting room, Spa, Restaurant, etc. Play it in your Roky, Apple tv, Chromecast, Xbox, Playstation, Wii, etc.',
                ],
            ],
            'roles' => [
                'title' => 'Ce înseamnă fiecare rol de utilizator',
                'content' => <<<'markdown'
                    Rolurile pe care le poți asigna unui utilizator nou sunt:
                    - Administrator - un administrator nou va avea toate permisiunile pe care le ai și tu în panoul de administrare, ceea ce înseamnă că va putea controla întregul site precum și conturile altor utilizatori
                    - Editor - un editor are dreptul de a interveni asupra paginilor de conținut curente și va putea adăuga pagini, adăuga articole și crea formulare.
                    - Utilizator - un utilizator simplu…
                    markdown,
            ],
        ],
    ],

];
