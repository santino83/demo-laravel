# Progetto EDITT - versione Laravel

### Installazione del progetto

- composer install
- php artisan migrate (rispondere yes)
- php artisan db:seed
- php artisan storage:link

Il progetto è configuratio per girare su database sqlite che verrà creato nella cartella var

### Lanciare il progetto

- php artisan serve

il progetto sarà quindi visibile aprendo il browser all'indirizzo http://localhost:8000/

### Pannello di backend

Per accedere al pannello di backend basta cliccare su "area riservata" nella homepage del sito.

Utente di default:

- Username: demo@email.com
- Password: pass1234

### API Travio

Le credenziali impostate per autenticarsi su Travio sono nel file .env

### Note

- Aumentare il php.ini per supportare file di dimensioni >= 5MB
