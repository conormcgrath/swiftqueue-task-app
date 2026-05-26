# Swiftqueue Technical Assessment

A lightweight PHP task management application developed as part of a technical assessment.

The application allows authenticated users to:
- Register and log in
- Create tasks
- Edit tasks
- Delete tasks
- Filter tasks by status

---

# Technology Stack

- PHP 8+
- SQLite
- PDO
- Bootstrap 5
- Alpine.js

---

# Features

- User authentication
- User registration
- Session management
- Task CRUD operations
- CSRF protection
- Prepared SQL statements
- Bootstrap UI
- Task filtering with Alpine.js 

---

# Requirements

- PHP 8+
- SQLite enabled in PHP

---

# Setup Instructions

# 1. Clone Repository

git clone https://github.com/conormcgrath/swiftqueue-task-app.git

cd swiftqueue-task-app

---

## 2. Enable SQLite Extensions

Ensure the following extensions are enabled in `php.ini`:

extension=pdo_sqlite
extension=sqlite3

---

## 3. Start PHP Development Server

From the project root directory:

php -S localhost:8000 -t public


Application will be available at:

http://localhost:8000

---

# Demo User Credentials

The following demo account is included for reviewers:

Email: test@test.com
Password: Password123!

---

# Security Considerations

The application includes the following security measures:

- Password hashing using `password_hash()`
- Password verification using `password_verify()`
- CSRF protection on POST requests
- Prepared statements using PDO
- Session-based authentication
- User ownership validation for task operations

---

# Implementation Notes

## Architecture

The application follows a lightweight MVC-style structure:
- Controllers handle request processing
- Views handle presentation
- PDO is used directly for database access

---

## Database Choice

SQLite was selected to simplify project setup and allow reviewers to run the application without requiring a separate database server installation.

---

## Frontend Approach

Bootstrap 5 was used for responsive UI.

Alpine.js was used for the frontend task filtering.

---

# Future Improvements

Potential future enhancements could include:

- Upgrade route handling
- Improved frontend validation and widgets
- Pagination
- Unit and feature testing
- Password reset functionality
- Email verification
- Docker support

---

# Author

Conor McGrath