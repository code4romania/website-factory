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
                    În această secțiune poți seta elementele de generale ale website-ului tău: titlu, descriere, prima pagină.

                    Pentru setarea **titlului general al website-ului**, este necesar să parcurgi următorii pași:
                    1. Accesează panoul de administrare
                    2. Selectează meniul secundar de setări din colțul din dreapta sus
                    3. Selectează **Setări**
                    4. Completează câmpul **Titlu site**
                    5. Apasă **Salvează**

                    Pentru setarea **descrierii generale a website-ului**, este necesar să parcurgi următorii pași:
                    1. Accesează panoul de administrare
                    2. Selectează meniul secundar de setări din colțul din dreapta sus
                    3. Selectează **Setări**
                    4. Completează câmpul **Descriere site**
                    5. Apasă **Salvează**

                    Pentru setarea **primei pagini**, este necesar să parcurgi următorii pași:
                    1. Accesează panoul de administrare
                    2. Selectează meniul secundar de setări din colțul din dreapta sus
                    3. Selectează **Setări**
                    4. Apasă pe câmpul **Prima Pagină**
                    5. Selectează din paginile create pagina pe care vrei ca utilizatorul să o vadă atunci când accesează website-ul tău. Dacă pagina nu există, o poți crea. Găsești informații despre crearea paginilor în secțiunea **Ajutor, Ghid conținut**.
                    6. Apasă **Salvează**

                    Îți recomandăm ca titlul și descrierea website-ului să fie cât mai clare pentru că acestea vor fi indexate în motoarele de căutare, iar vizitele pe website-ul tău sunt determinate și de calitatea termenilor folosiți în titlul și descrierea acestuia. De asemenea, prima pagină este primul contact pe care vizitatorul îl are cu website-ul tău, de aceea îți sugerăm să acorzi atenție în construcția acestei pagini.
                    markdown,
                'media' => [
                    'type' => 'image',
                    'image' => 'sample-file.png',
                    'caption' => 'Great as a TV Screensaver for the office,  lounge, waiting room, Spa, Restaurant, etc. Play it in your Roky, Apple tv, Chromecast, Xbox, Playstation, Wii, etc.',
                ],
            ],
            'branding' => [
                'title' => 'Setări de branding',
                'intro' => 'În această secțiune setezi elementele de branding ale website-ului tău: culoarea principală și logo-ul.',
                'content' => <<<'markdown'
                    În această secțiune setezi elementele de branding ale website-ului tău: culoarea principală și logo-ul.

                    Pentru setarea **culorii principale**, este necesar să parcurgi următorii pași:
                    1. Accesează panoul de administrare
                    2. Selectează meniul secundar de setări din colțul din dreapta sus
                    3. Selectează **Setări**
                    4. Apasă pe dreptunghiul colorat din câmpul **Culoare principală**
                    5. Apasă **Salvează**

                    **Îți recomandăm să folosești o culoare care se regăsește în logo-ul tău pentru că ea va fi folosită pentru butoanele din site, headere și alte elemente.**

                    Pentru adăugarea **logo-ului**, este necesar să parcurgi următorii pași:
                    1. Accesează panoul de administrare
                    2. Selectează meniul secundar de setări din colțul din dreapta sus
                    3. Selectează **Setări**
                    4. Completează câmpul **Descriere site**
                    5. Apasă **Salvează**

                    Pentru setarea **primei pagini**, este necesar să parcurgi următorii pași:
                    1. Accesează panoul de administrare
                    2. Selectează meniul secundar de setări din colțul din dreapta sus
                    3. Selectează **Setări**
                    4. Apasă pe butonul **Choose File** din câmpul **Logo**
                    5. Selectează fișierul salvat local ce conține logo-ul și apasă Upload. Îți recomandăm să fie un fișier cu o calitate cât mai bună, în format **.png**.
                    6. Apasă **Salvează**

                    Logo-ul va fi încărcat în website și se va afișa deasupra meniului din header, pe toate paginile website-ului.
                    markdown,
                'media' => [
                    'type' => 'video',
                    'video' => 'dQw4w9WgXcQ',
                    'caption' => 'Great as a TV Screensaver for the office,  lounge, waiting room, Spa, Restaurant, etc. Play it in your Roky, Apple tv, Chromecast, Xbox, Playstation, Wii, etc.',
                ],
            ],
            'integrations' => [
                'title' => 'Integrare alte servicii (Google Analytics, Facebook Pixel…)',
                'intro' => 'În activitatea organizației tale, este recomandat să integrezi și alte servicii software care te ajută pe diferite planuri.',
                'content' => <<<'markdown'
                    În activitatea organizației tale, este recomandat să integrezi și alte servicii software care te ajută pe diferite planuri: Google Analytics pentru urmărirea activității de pe website-ul organizației, Mailchimp sau alt serviciu de newsletter pentru a ține legătura cu oamenii care urmăresc activitatea ONG-ului, Facebook Pixel atunci când ai în desfășurarea campanii plătite pe Facebook care trimit către website sau alte softuri. Pentru această integrare, fiecare dintre serviciile folosite îți pun la dispoziție un cod HTML care este necesar să fie integrat în website-ul tău.

                    Pentru integrarea **codului HTML** al unui serviciu, este necesar să parcurgi următorii pași:
                    1. Intră în interfața de administrare a serviciului folosit și copiază codul HTML
                    2. Accesează panoul de administrare
                    3. Selectează meniul secundar de setări din colțul din dreapta sus
                    4. Selectează **Setări**
                    5. Mergi până la ultima secțiune din pagină **Custom HTML**
                    6. Lipește codul HTML copiat din platforma serviciului în unul dintre cele 2 câmpuri Cod HTML introdus înainte de `</head>` / Cod HTML introdus înainte de `</body>`, conform instrucțiunilor serviciului folosit.
                    7. Apasă **Salvează**
                    markdown,
            ],
        ],
    ],

];
