
# Library Management System built with HTML, PHP and MySQL
#### Final Project for COMP-3340


### Next Step:
* Search for book functionality using AJAX calls javascript to php



### Project Logs:
* Added loanBook.php template, implement read all books from database then display all book in select tag.
* Added boostrap navbar, book uniqueness verification when about to issue book, and display all loans per user section.
* Added user profile info section, user issued books section, user overdue books section, user overdue book fees section.
* Added admin overview, admin add user sections, admin delete user section, admin user update section, admin user delete and update sections.
* 2019-07-22:made UI improvements to user overduebooks, and user overduefees sections.
* 2019-07-24: project put on hold.
* 2019-07-24: working on waitlist feature implementation.
* 2019-07-26: added waitlist feature for issued books, added alert popup on adding user to waitlist, fixed navbar dropdown bug in user/issueBook and user/returnBook, added custom loan periods based on userType, fixed formating on /user/userProfile/userIssued.php, added high priority books feature.
* 2019-07-30: refractored admin update user, admin update book sections with more readable + simpler form validations, refractored + fixed bugs on admin delete book section, fixed bugs on admin delete user section, made user section more resposive for mobile viewports, added charts from google charts api to admin overview section
* 2019-08-03: added mysqli_real_escape_string for all $_POST variables, removed search bar with AJAX functionality(reason: too complex)
