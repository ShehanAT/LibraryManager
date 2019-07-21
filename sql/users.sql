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




CREATE TABLE loans (
    book_id INT NOT NULL,
    user_id INT NOT NULL,
    loaned_on DATETIME ,
    return_by DATETIME ,
    returned_on DATETIME ,
    FOREIGN KEY (book_id) REFERENCES books.book_id
);

INSERT INTO loans (book_id, user_id, loaned_on, return_by)
VALUES (1, 1, '2019-07-21 00:00:00', '2019-08-08 00:00:00');


INSERT INTO loans (book_id, user_id, loaned_on, return_by, returned_on)
VALUES (1, 1, '2019-01-21 00:00:00', '2019-03-08 00:00:00', '2019-04-18 00:00:00');


INSERT INTO loans (book_id, user_id, loaned_on, return_by)
VALUES (1, 1, '2019-08-21 00:00:00', '2019-10-08 00:00:00');