Climate Change Awareness Hub
This was a basic web application designed to educate and inform users about climate change. The platform included functionality for user registration and login, posting articles, engaging in forum discussions, and viewing multimedia content.

Features
User Authentication
Users could register and log in using their credentials.
Secure password storage was implemented using PHP's password_hash and password_verify.
Article Management
Users could create and view articles.
Articles were stored in a MySQL database and displayed dynamically.
Forum Discussions
Users could post comments in the forum discussion section.
Forum posts were stored in the database and displayed dynamically.
Multimedia Content
The site featured embedded videos to enhance learning.
Videos could be filtered and searched dynamically using JavaScript.
Responsive Design
The application was designed to be user-friendly and responsive across different devices.
Installation and Setup
Prerequisites
XAMPP (Apache and MySQL).
PHP version 7.4 or higher (included in XAMPP).
A browser to test the application locally.
Steps
Clone the Repository

bash
Copy code
git clone https://github.com/your-repo/climate-change-hub.git
Move the cloned files to the htdocs folder of your XAMPP installation:

text
Copy code
C:\xampp\htdocs\climate-change-hub
Start XAMPP Services
Open the XAMPP Control Panel.
Start Apache and MySQL.

Database Setup

Open phpMyAdmin at http://localhost/phpmyadmin.
Create a database named climate_change_hub.
Use the SQL section in phpMyAdmin to execute the SQL script:
Navigate to the SQL tab.
Paste the SQL code for creating tables and initial data.
Click "Go" to execute.
Configure Database Connection
Open the db.php file in the project directory.
Set your database credentials (default for XAMPP):

php
Copy code
$servername = "localhost";
$username = "root";
$password = ""; // No password by default
$dbname = "climate_change_hub";
Run the Application
Open your browser and navigate to:

text
Copy code
http://localhost/climate-change-hub/index.php
File Structure
text
Copy code
climate-hub/
├── index.php          # Main file for login and registration
├── dashboard.php      # Dashboard for articles, videos, and forum
├── db.php             # Database connection file
├── style.css          # Stylesheet for index page
├── dashboard.css      # Stylesheet for dashboard
├── script.js          # JavaScript for filtering and interactions
├── schema.sql         # SQL file for database schema
├── video/             # Directory for video files
└── README.md          # Documentation
Usage
Registration
Users could navigate to the registration page.
They filled in the username, email, and password fields.
After submitting the form, their account was created.
Login
Users logged in using their registered credentials.
They accessed the dashboard with articles, forum discussions, and videos.
Posting Content
Articles: Users could fill in the title and content fields in the "Post New Article" section.
Forum: Users could add comments in the "Forum Discussions" section.
Searching Content
The search bar in the "Articles" and "Videos" sections allowed users to filter content dynamically.
Security Features
Passwords were hashed using PHP's PASSWORD_DEFAULT.
Prepared statements were used to prevent SQL injection.
Sessions securely managed user authentication.
Future Enhancements
Add user profile management.
Enable multimedia upload functionality.
Implement pagination for large datasets.
Enhance UI/UX with modern frameworks like Bootstrap or Tailwind CSS.

