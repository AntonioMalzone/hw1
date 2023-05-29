create database hw1;
use hw1;

CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(16) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE movies (
    id integer primary key auto_increment,
    user integer not null,
    content json
);