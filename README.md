--------------- Game Swap Tally README ---------------


How to complile:
    Currently none of the source code is written in a language that
    requires compiling.

How to run:
    Since all components of the project are currently web-based, the code
    needs to be run on a web server such as Apache (including proper modeules 
    for PHP), as well as a mySQL server for the database.  To run this 
    application on your machine locally, XAMPP is recommended.  Using 
    phpMyAdmin you can import the included .sql file into a new database 
    called 'gameswaptally'.  Howvever, we highly recommend running everything
    off of our server, which can be accessed by typing gameswaptally.github.io 
    into your favorite browser's address bar.

How to run the unit test cases:
    -HTML test cases:
        HTML test cases are included in HTMLUNIT.rar.  These are written
        in Java and can be run using Eclipse or any other Java compatible
        IDE
    -PHP test cases:
        PHP test cases are included in signUp_runtest.php and signUp_test.php.
        These tests are meant to be run either locally or on a server using 
        Apache and a mySQL database.

Acceptance Tests for an External Person to Try:
-upon visiting the site navigate to the sign up page and fill out the form
-after submitting the form, you should recieve an email notification with a
 link to activate your account
-navigate to the log in page and try to log into your account.
  NOTE: if you do not wish to create an account, you can use the following log
        in information: email: demo@gameswaptally.com password: gstdemo
-navigate to the edit profile page and edit your profile
-navigate to the create post page and create a post
-navigate to the browse post page and browse all posts or search for a
 specific post
-delete one of your posts from your profile page
-log out of the site from your profile page

