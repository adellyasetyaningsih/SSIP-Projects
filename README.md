
---

## P3K: Online Learning Platform for Offline Courses

```markdown
# 📘 P3K Web Course Platform

P3K (Pembelajaran Pendukung Kursus) is a Laravel-based web application built to support offline course programs by providing an online platform for learning materials, student registration, and scheduling. It serves two types of users: **Admin** and **Student**.

---

## 🚀 Features

### 👨‍🎓 Student
- Register and create an account under a specific course category (UTBK, SEKDIN, or SMA).
- View learning materials based on selected category.
- See offline class schedule and teacher info.
- Edit profile and upload profile photo.
- Login is only allowed after admin verification.

### 🧑‍💼 Admin
- Login using admin credentials.
- Manage (CRUD) the following:
  - Students (including password reset)
  - Payment verification
  - Course categories
  - Subjects/materials
  - Teachers
  - Time slots (offline schedule)
  - Admin account settings

---

## 🧱 System Structure

### 📂 Main Models
- `Admin`
- `Student`
- `Teacher`
- `Category`
- `Subject`
- `Payment`
- `TimeSlot`
- Pivot Models:
  - `CategorySubject`
  - `TeacherSubject`
  - `TeacherCategory`

### 🧩 Key Relationships
- Category ↔ Students, Subjects
- Subject ↔ Teachers (via TeacherSubject)
- Teacher ↔ Categories (via TeacherCategory)
- Subject ↔ Categories (via CategorySubject)
- Student ↔ Payments
- TimeSlot ↔ Subject, Teacher, Category

---

## 🛠 Installation & Setup

```bash
# 1. Clone the project
git clone https://github.com/adellyasetyaningsih/SSIP-Projects.git
cd SSIP-Projects

# 2. Install dependencies
composer install
npm install && npm run dev

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Setup database
# Update your database credentials in the .env file:
# DB_DATABASE=your_database
# DB_USERNAME=your_db_user
# DB_PASSWORD=your_db_password
php artisan migrate
php artisan db:seed

# 5. Serve the application
php artisan serve
