# Gestione Palestra — Battle

Web application for managing a gym: member accounts, booking of slots, and an administrative
back-office. Written in plain PHP and MySQL, without a framework.

Final project for the **ITS CADMO** "Programmatore 4.0" diploma (Soverato, Italy) — graded 100/100.

## Features

- Member registration, login and session handling
- Create, edit and cancel bookings, with server-side validation
- Member dashboard and profile
- Back-office for user administration

## Tech stack

PHP · MySQL · HTML/CSS/JavaScript · Apache

> GitHub reports this repository as mostly JavaScript because `dist/` and `plugins/` hold the
> third-party template assets. The application code is the PHP files at the root.

## Getting started

Requires PHP 7.4+, MySQL 5.7+ and Apache.

```bash
git clone https://github.com/JackF007/Gestione_Palestra_Battle_CADMO.git
mysql -u root -p -e "CREATE DATABASE palestra;"
mysql -u root -p palestra < palestra.sql
```

Set your database credentials in `config.php`, start Apache and open `login.php`.

## License

Apache License 2.0 — see [LICENSE](LICENSE).
