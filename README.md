# 🌊 Alexandria Guide - Travel Website

🔴 **Live Demo:** [http://alexandria-guide.infinityfree.me](http://alexandria-guide.infinityfree.me)

---

## 📋 Table of Contents
- [About The Project](#about-the-project)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Contact](#contact)

---

## About The Project

**Alexandria Guide** is a fully functional tourism website that allows visitors to:
- Explore top attractions in Alexandria, Egypt
- Create personalized tour itineraries
- Calculate trip costs in real-time
- Save and manage their tour plans

---

## Features

### User System
- **Sign Up / Sign In** - Secure user registration and login
- **Password Hashing** - Passwords are encrypted for security

### Tour Planner
- **Date Selection** - Choose your travel date
- **Traveler Counter** - Adjust number of travelers
- **Attractions Selection** - Checkbox selection with real-time pricing
- **Hotel Selection** - Multiple accommodation options
- **Transportation Choice** - Bus, Taxi, or Private Driver
- **Live Cost Calculation** - Automatic total cost updates
- **Save Tours** - Save itineraries to database

### Gallery
- Responsive image grid with hover effects

### Reviews Section
- User testimonials with rating summary

### Contact Form
- User message submission to database

---

## Technologies Used

- **HTML5** - Structure
- **CSS3** - Styling and animations
- **JavaScript** - Interactivity and API calls
- **PHP 8.2** - Server-side logic
- **MySQL** - Database management
- **PDO** - Secure database connections

---

## Installation

### Prerequisites
- XAMPP (or any PHP/MySQL server)

### Steps

1. **Download the project** from GitHub

2. **Move to XAMPP directory**
   - Copy the folder to: `C:\xampp\htdocs\alexandria-guide`

3. **Start XAMPP**
   - Start Apache
   - Start MySQL

4. **Import Database**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Create database: `alexandria_db`
   - Import `alex-database.sql`

5. **Configure Database**
   - Edit `config.php` with your credentials

6. **Run the website**
   - Open browser and go to: `http://localhost/alexandria-guide`

---

## Database Setup

Run this SQL in phpMyAdmin:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tour_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(100) NOT NULL,
    tour_date DATE NOT NULL,
    travelers INT DEFAULT 1,
    attractions TEXT NOT NULL,
    accommodation VARCHAR(100),
    transport VARCHAR(100),
    total_cost INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
