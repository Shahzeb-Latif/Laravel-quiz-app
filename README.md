Quiz Application

A step-by-step guide to set up and run the Laravel-based quiz application.

 Table of Contents
- [Requirements](#requirements)
- [Installation Steps](#installation-steps)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Available Routes](#available-routes)
- [Features](#features)

---

 Requirements

Ensure your development environment meets the following requirements:
- PHP 8.1 or higher
- Composer
- MySQL or any supported database
- Laravel 11

---

 Installation Steps

1. Clone the repository:
   bash
   git clone <repository-url>
   cd <repository-folder>
   

2. Install dependencies:
   bash
   composer install
   

3. Copy `.env` file:
   bash
   cp .env.example .env
   

4. Generate application key:
   bash
   php artisan key:generate
   

5. Install frontend dependencies (optional for assets):
   bash
   npm install
   npm run dev
   

---

 Database Setup

1. Update `.env` with your database credentials:
   env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=quiz_app
   DB_USERNAME=root
   DB_PASSWORD=
   

2. Run migrations:
   bash
   php artisan migrate
   

3. Seed the database with questions and answers:
   bash
   php artisan db:seed
   

---

 Running the Application

Start the Laravel development server:
bash
php artisan serve


Visit the application at: `http://127.0.0.1:8000`

---

 Available Routes

1. Save User
- Route: `POST /save-user`
- Description: Stores the user's name and saves their ID in the session.
- Payload:
  json
  {
    "name": "John Doe"
  }
  
- Response:
  json
  {
    "success": true
  }
  

---

2. Save Answer
- Route: `POST /save-answer`
- Description: Saves the user's answer or marks the question as skipped.
- Payload:
  json
  {
    "question_id": 1,
    "answer_id": 2  // Send null if skipped
  }
  
- Response:
  json
  {
    "success": true
  }
  

---

3. Fetch Results
- Route: `GET /quiz-results`
- Description: Fetches the user's quiz results.
- Response:
  json
  {
    "success": true,
    "total_questions": 10,
    "answered_questions": 8,
    "correct_answers": 5,
    "skipped_questions": 2
  }
  

---

 Features

1. User Session Handling:
   - Stores the user's ID in the session after entering their name.

2. Step-by-Step Quiz Navigation:
   - Displays questions one at a time.
   - Allows users to answer or skip questions.

3. Real-Time Answer Saving:
   - Answers and skipped questions are saved via AJAX calls.

4. Result Summary:
   - Displays the total number of questions, answered questions, correct answers, and skipped questions at the end of the quiz.

---

Let me know if you have any issues or need further assistance!