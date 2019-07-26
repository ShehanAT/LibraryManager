//creating users table 
CREATE TABLE users (
    user_id int NOT NULL AUTO_INCREMENT,
    username varchar(100),
    email varchar(100),
    password varchar(100),
    userType varchar(15),
    PRIMARY KEY (user_id)
);

INSERT INTO users (username, email, password, userType)
VALUES ('atukoran', 'shehanatuk@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'undergrad');

INSERT INTO users (username, email, password, userType)
VALUES ('admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin');

INSERT INTO users (username, email, password, userType)
VALUES ('freshman', 'yohan@admin.com', '34232f297a57a5a743894a0e4a801fc3', 'grad');


CREATE TABLE books (
	book_id INT NOT NULL AUTO_INCREMENT,
    author VARCHAR(100),
    title VARCHAR(100),
	category VARCHAR(100),
	year INT,
    isbn BIGINT,
    PRIMARY KEY (book_id)
)

INSERT INTO books (author, title, category, year, isbn)
VALUES ('Charles Darwin', 'The Origin of Species', 'Non-Fiction', 1856, 12345678901);

INSERT INTO books (author, title, category, year, isbn)
VALUES ('Shehan Atuk', 'Deep Water', 'Non-Fiction', 2021, 09876543219);

INSERT INTO books (author, title, category, year, isbn)
VALUES ('Jane Austen', 'Pride and Prejudice', 'Fiction', 1876, 54321982345);

INSERT INTO books (author, title, category, year, isbn)
VALUES ('F. Scott Fitzgerald', 'The Great Gatsby', 'Fiction', 1924, 513221982342);

INSERT INTO books (author, title, category, year, isbn)
VALUES ('Harper Lee', 'To Kill a Mockingbird', 'Fiction', 1956, 543219802349);

INSERT INTO books (author, title, category, year, isbn)
VALUES ('J.K Rowling', "Harry Potter and the Sorcerers's Stone", 'Fiction', 1999, 5432182249);

INSERT INTO books (author, title, category, year, isbn)
VALUES ('George Orwell', '1984', 'Fiction', 1984, 54311982349);

INSERT INTO books (author, title, category, year, isbn)
VALUES ('Fahrenheit 451', 'Ray Bradbury', 'Fiction', 1984, 543119812349);

INSERT INTO books (author, title, category, year, isbn)
VALUES ('In Cold Blood', 'Truman Capote', 'Non-Fiction', 1966, 5431198123149);

INSERT INTO books (author, title, category, year, isbn)
VALUES ('Silent Spring', 'Rachel Carson', 'Non-Fiction', 1962, 543119812149);

CREATE TABLE loans (
    book_id INT NOT NULL,
    user_id INT NOT NULL,
    loaned_on DATETIME ,
    return_by DATETIME ,
    returned_on DATETIME ,
    loan_id INT AUTO_INCREMENT,
    PRIMARY KEY(loan_id),
    FOREIGN KEY (book_id) REFERENCES books(book_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO loans (book_id, user_id, loaned_on, return_by, returned_on)
VALUES (1, 2, '2019-07-21 00:00:00', '2019-08-10 00:00:00', NULL);


INSERT INTO loans (book_id, user_id, loaned_on, return_by, returned_on)
VALUES (2, 2, '2019-07-18 00:00:00', '2019-08-08 00:00:00', NULL);


INSERT INTO loans (book_id, user_id, loaned_on, return_by, returned_on)
VALUES (3, 1, '2019-02-22 00:00:00', '2019-04-12 00:00:00', '2019-07-21 00:00:00');

INSERT INTO loans (book_id, user_id, loaned_on, return_by, returned_on)
VALUES (4, 1, '2019-07-18 00:00:00', '2019-08-08 00:00:00', NULL);

INSERT INTO loans (book_id, user_id, loaned_on, return_by, returned_on)
VALUES (3, 1, '2019-07-21 00:00:00', '2019-08-11 00:00:00', NULL);

-- Waitlist table query 

CREATE TABLE waitlist (
    `book_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `waitlist_id` INT NULL AUTO_INCREMENT,
    `isValid` DATETIME NULL,
    PRIMARY KEY(`book_id`, `user_id`),
    KEY `waitlist_id` (`waitlist_id`)
)ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- left join query for loans and waitlist
SELECT * FROM loans LEFT JOIN waitlist ON loans.book_id != waitlist.book_id WHERE loans.returned_on IS NULL LIMIT 10