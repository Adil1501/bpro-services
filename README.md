# B-Pro Services - Laravel Project

Een professionele website voor B-Pro Services, een schoonmaakbedrijf, gebouwd met Laravel.


## 📋 Projectbeschrijving

Dit project is een dynamische, data-driven website voor een schoonmaakbedrijf met een uitgebreid admin panel en klantportaal. Het systeem biedt functionaliteiten voor het beheren van diensten, portfolio items, offertes, nieuws, FAQ's en contactberichten.


## ✨ Belangrijkste Features

### Verplichte Features
- **Login Systeem**: Volledige authenticatie met admin/user rollen
- **Profielpagina's**: Publieke profielen met username, verjaardag, foto en bio
- **Nieuws Beheer**: Admin kan nieuws CRUD, bezoekers kunnen lezen
- **FAQ Systeem**: Georganiseerd per categorie met accordion functionaliteit
- **Contact Formulier**: Met email notificaties naar admin

### Extra Features
- **Admin Dashboard**: Overzichtelijk dashboard met statistieken
- **Services Management**: CRUD voor schoonmaakdiensten
- **Portfolio Systeem**: Voor/na foto's met like functionaliteit
- **Offerte Systeem**: Klanten kunnen offertes aanvragen
- **Settings Pagina**: Beheer website instellingen
- **Google Maps Integratie**: Locatie weergave op contact pagina


## 🛠️ Technische Requirements

### Gebruikte Technologieën
- **Framework**: Laravel
- **Frontend**: Tailwind CSS + Alpine.js
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage (local disk)


## 🚀 Installatie

### Vereisten
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL Database

### Stappen

1. **Clone de repository**
```bash
git clone https://github.com/Adil1501/bpro-services
cd bpro-services
```

2. **Installeer dependencies**
```bash
composer install
npm install
```

3. **Environment configuratie**
```bash
copy .env.example .env
php artisan key:generate
```

4. **Database configuratie**
Pas `.env` aan met je database gegevens:
```env
DB_DATABASE=bpro_services
DB_USERNAME=root
DB_PASSWORD=
```

5. **Database setup**
```bash
php artisan migrate:fresh --seed
```

6. **Storage link**
```bash
php artisan storage:link
```

7. **Build assets**
```bash
npm run build
```

8. **Start server**
```bash
php artisan serve
```

Website: `http://127.0.0.1:8000`


## 👤 Default Login Credentials

### Admin Account
- **Email**: admin@ehb.be
- **Password**: Password!321

### Test Klant Account
- **Email**: klant@test.be
- **Password**: password


## 📧 Email Configuratie

Voor email notificaties bij contactformulier:

### Ontwikkeling (Mailtrap)
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
```


## 📚 Bronvermelding

### Externe Libraries
- [Laravel Framework](https://laravel.com) - MIT License
- [Tailwind CSS](https://tailwindcss.com) - MIT License
- [Alpine.js](https://alpinejs.dev) - MIT License
- [Font Awesome](https://fontawesome.com) - Free License
- [UI Avatars](https://ui-avatars.com) - Free Service

### Code Inspiratie
- Laravel Documentatie voor basis structuur
- Tailwind UI voor design patterns
- Stack Overflow voor specifieke problemen

### AI Ondersteuning
Delen van deze applicatie zijn ontwikkeld met behulp van Claude voor:
- Brainstormen over oplossingsrichtingen voor specifieke programmeeruitdagingen.
- Hulp bij het debuggen en het identificeren van logische fouten.
- Opstellen en structureren van code en documentatie (zoals deze README)
- Advies over best practices in webontwikkeling, code-optimalisaties en toegankelijkheid.

---

Gemaakt door **Adil BENALI**
Vak: Backend Web - Academiejaar 2025-2026
