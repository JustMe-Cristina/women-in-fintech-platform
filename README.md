# Women in FinTech Platform

A Laravel web application designed to manage members, success stories, and events within a Women in FinTech community.

This project was developed as an academic assignment to demonstrate the use of Laravel for building a full-stack web application with CRUD operations, relational databases, data validation, filtering, and responsive UI design.

---

## Features

### Members Management
- Create, read, update, and delete members
- Required fields validation (name, email, profession)
- Email format and uniqueness validation
- Optional LinkedIn profile URL validation
- Member status management (active / inactive)
- Search members by name or email
- Filter members by profession, company, and status
- Pagination (10 members per page)

### Success Stories
- One-to-Many relationship between members and success stories
- Add multiple success stories for each member
- View success stories on a dedicated page
- Cascade delete (stories are removed when a member is deleted)

### Events
- Add and view upcoming events
- Event date and description support
- Delete events with confirmation
- Events displayed in chronological order

### Extra Features
- Export members list to CSV
- Responsive UI using Bootstrap
- Clean and structured MVC architecture

---

## Technologies Used
- PHP 8+
- Laravel 11
- MySQL
- Bootstrap
- Blade Templates
- Git & GitHub

---

## Project Setup

### Requirements
- PHP 8.1 or higher
- Composer
- MySQL
- Node.js & npm (optional, for frontend assets)

---

### Installation Steps

1. Clone the repository:
   bash
   git clone https://github.com/JustMe-Cristina/women-in-fintech-platform.git
   cd women-in-fintech-platform

2. Install PHP dependencies:
   composer install

3.	Create environment file:
   cp .env.example .env

4.	Generate application key:
   php artisan key:generate

5. Configure the database in .env:
   DB_DATABASE=women_fintech
   DB_USERNAME=root
   DB_PASSWORD=your_password

6.	Run database migrations:
   php artisan migrate

7.	Start the development server:
   php artisan serve

The application will be available at: http://127.0.0.1:8000


Database Structure
	•	members
	•	success_stories (One-to-Many with members)
	•	events


Notes
	•	The .env file is intentionally excluded from the repository.
	•	The vendor and node_modules directories are not included.
	•	This project runs locally using the Laravel development server.


Author: Cristina Pop
License: This project is developed for educational purposes.
