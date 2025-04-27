# VisiTrack

other note: need natin palatin yung back ground ng llogin form kasi may nakita akong kaparehas natin

pag gusto nyong paganahin yung code open nyo yung xammp tapos lagay nyo to
create kayo ng new data inside nun gawa kayo ng table name visitors and users
para makaaccess yung php sa database.

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
    nalimutan ko palitan
    ALTER TABLE visitors DROP INDEX Email;

---------------------------------------------------
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
-----------------------------------------------------------------


things that need to remember 
you need to reconfigure the xamp in order to make mailer work

i already did the configuration you just need to copy it and place it in the proper directory

watch the first part
https://www.youtube.com/watch?v=UpHzA_buInY

[mail function]
For Win32 only.
https://php.net/smtp
SMTP=smtp.gmail.com
https://php.net/smtp-port
smtp_port=587

For Win32 only.
https://php.net/sendmail-from
sendmail_from = "imtheonlyoneknows61@gmail.com"

; For Unix only.  You may supply arguments as well (default: "sendmail -t -i").
https://php.net/sendmail-path
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"

------------------------------------------------------------------
/this is for sendmail (note: very important!)

[sendmail]

smtp_server=smtp.gmail.com
smtp_port=587
error_logfile=error.log
debug_logfile=debug.log
auth_username=imtheonlyoneknows61@gmail.com
auth_password=curdwywwbistkodi
forcer_sender=imtheonlyoneknows61@gmail.com
