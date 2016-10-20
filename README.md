--------------- Game Swap Tally README ---------------


How to complile:
    Currently none of the source code is written in a language that
    requires compiling.

How to run:
    Since all components of the project are currently web-based, the code
    needs to be run on a web server such as Apache, as well as a mySQL server
    for the database.  To run this application on your machine locally, XAMPP
    is recommended.  Using phpMyAdmin you can import the included .sql file
    into a new database called 'gameswaptally_test'.  Additionally, everything
    is also hosted on our server and can be run by typing 54.209.151.46 into
    your favorite browser's address bar.

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
    -navigate to the signup page, and try to create an account on the site
    -navigate to the login page and try to enter the information of the
     account you just made
    -navigate to the browse page and see if you see your email as the user
     logged in.

