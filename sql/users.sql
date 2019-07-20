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