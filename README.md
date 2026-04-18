# 🏆 School Tournament Website

##  Overview

A web-based tournament management system for schools built using **PHP, MySQL, and Bootstrap**.
This project is designed as an educational full-stack application to demonstrate database design, backend logic, and responsive UI.

---

##  Features

*  View match schedules
*  Display teams, matches, and standings
*  Automatic standings calculation based on match results
*  Responsive UI using Bootstrap
*  Fast and simple database structure

---

## 🗂️ Project Structure

```
project/
│── config/
│   └── db.php
│
│── pages/
│   ├── teams.php
│   ├── matches.php
│   ├── standings.php
│   └── schedule.php
│
│── includes/
│   ├── header.php
│   └── footer.php
│
│── assets/
│   ├── css/
│   └── js/
│
│── database/
│   └── schema.sql
│
└── index.php
```

---

##  Database Design

### Tables

#### 1. teams

* id (Primary Key)
* class_name (Unique)
* points
* goals_scored
* goals_conceded

#### 2. matches

* id (Primary Key)
* team1_id (Foreign Key)
* team2_id (Foreign Key)
* team1_goals
* team2_goals
* match_date

---

##  Technologies Used

* PHP
* MySQL
* Bootstrap
* HTML / CSS / JavaScript

---

##  Setup Instructions

1. Clone the repository:

```bash
git clone https://github.com/your-username/school-tournament.git
```

2. Move project to `htdocs` (XAMPP)

3. Import database:

* Open phpMyAdmin
* Create database (e.g. `tournament`)
* Import `database/schema.sql`

4. Update database connection in:

```
config/db.php
```

5. Run project:

```
http://localhost/school-tournament
```

---

## Security

* Uses prepared statements to prevent SQL Injection
* No authentication required (educational project)

---

## Educational Value

This project demonstrates:

* Database relationships (One-to-Many)
* Backend logic with PHP
* Dynamic data rendering
* Responsive UI with Bootstrap

---

## Future Improvements

* Admin panel for match management
* Player statistics
* Tournament brackets
* Team logos
