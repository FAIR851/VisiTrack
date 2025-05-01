VISITOR REGISTRATION SYSTEM SETUP (XAMPP + PHP + MySQL + VS CODE + EMAIL CONFIG)

---------------------------------------------------------
✅ STEP 0: ADD PHP TO ENVIRONMENT VARIABLES (IMPORTANT)
---------------------------------------------------------
To run PHP in CMD or VS Code terminal:

1. Press Windows Key + S and search: Environment Variables
2. Click "Edit the system environment variables"
3. In the System Properties window, click "Environment Variables..."
4. Under "System Variables", select "Path" and click "Edit"
5. Click "New" and add:
   C:\xampp\php
6. Click OK to save everything.

👉 To check: Open CMD and type:
   php -v
You should see the PHP version.

---------------------------------------------------------
✅ STEP 1: INSTALL VISUAL STUDIO CODE (VS Code)
---------------------------------------------------------
- Download: https://code.visualstudio.com/
- Install for your OS.

---------------------------------------------------------
✅ STEP 2: INSTALL EXTENSIONS IN VS CODE
---------------------------------------------------------
In VS Code, install these extensions:

1. PHP Extension Pack
2. Live Server (by Ritwick Dey)
3. HTML CSS Support
4. Prettier - Code Formatter (optional)

Click the Extensions icon (left sidebar) to install them.

---------------------------------------------------------
✅ STEP 3: INSTALL AND START XAMPP
---------------------------------------------------------
- Download from: https://www.apachefriends.org/index.html
- Install it.
- Open XAMPP Control Panel.
- Start Apache and MySQL.

---------------------------------------------------------
✅ STEP 4: CREATE DATABASE AND TABLES
---------------------------------------------------------
1. Go to http://localhost/phpmyadmin
2. Create a new database: visitor_db
3. Run the SQL below in the SQL tab:

-- VISITORS TABLE
CREATE TABLE visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Lastname VARCHAR(50) NOT NULL,
    Firstname VARCHAR(50) NOT NULL,
    Middle_Initial VARCHAR(5) NULL,
    Suffix VARCHAR(10) NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    purpose TEXT NOT NULL,
    visitor_type ENUM('Regular', 'VIP') NOT NULL,
    ZIP_Code VARCHAR(10) NOT NULL,
    Municipality VARCHAR(100) NOT NULL,
    Barangay_Village VARCHAR(50) NOT NULL,
    visit_date DATE NOT NULL DEFAULT (CURRENT_DATE),
    visit_time TIME NOT NULL DEFAULT (CURRENT_TIME)
);

-- If you forgot to remove the unique index on Email:
ALTER TABLE visitors DROP INDEX Email;

-- USERS TABLE
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

---------------------------------------------------------
✅ STEP 5: SETUP PHP PROJECT IN VS CODE
---------------------------------------------------------
1. Go to: C:\xampp\htdocs
2. Create a folder named: visitor_system
3. Open it in VS Code
4. Create the files:
   - index.php
   - register.php
   - style.css

Use Live Server for frontend preview, and `http://localhost/visitor_system/index.php` to test PHP backend.

---------------------------------------------------------
✅ STEP 6: CONFIGURE PHP MAIL FUNCTION
---------------------------------------------------------

Edit php.ini (located at: C:\xampp\php\php.ini)

Find and edit:

[mail function]
SMTP=smtp.gmail.com
smtp_port=587
sendmail_from = "imtheonlyoneknows61@gmail.com"
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"

---------------------------------------------------------

Edit sendmail.ini (located at: C:\xampp\sendmail\sendmail.ini)

Replace contents:

[sendmail]
smtp_server=smtp.gmail.com
smtp_port=587
error_logfile=error.log
debug_logfile=debug.log
auth_username=imtheonlyoneknows61@gmail.com
auth_password=curdwywwbistkodi
force_sender=imtheonlyoneknows61@gmail.com

---------------------------------------------------------
✅ STEP 7: RESTART XAMPP
---------------------------------------------------------
- After editing configurations, restart Apache from XAMPP Control Panel.

---------------------------------------------------------
✅ STEP 8: WATCH TUTORIAL VIDEO
---------------------------------------------------------
📺 https://www.youtube.com/watch?v=UpHzA_buInY

---------------------------------------------------------
💡 DESIGN TIP: Make your login background unique
---------------------------------------------------------
Palitan yung background ng login page mo para hindi magmukhang kaparehas ng ibang system. Use your own images, color theme, or use Google Fonts + CSS to personalize.

