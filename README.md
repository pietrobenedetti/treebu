# Treebu


**Installare vue:**

`npm install -g @vue/cli`

**Scaricare il progetto**

Entrare nella cartella /client

Eseguire nel terminale:

`npm install`

Entrare nella cartella /server

Eseguire nel terminale:

`composer update`

**Collegamento DB**

Nella cartella /server cercare il file `.env.example`
Creare file `.env` uguale al file `.env.example`, e modificare il nome del database **DB_DATABASE = treebu

**Effettuare le migrazioni**

Per creare la struttura del database, entrare nella cartella /server ed eseguire nel terminale:

`php artisan migrate`

**Serve**

Nella cartella /server eseguire nel terminale:

`php artisan serve`

Nella cartella /client eseguire nel terminale:

`npm run serve`

Naviga in https://localhost:8080/. L'applicazione automaticamente si ricarica ad ogni modifica dei file
