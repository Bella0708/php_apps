create database if not exists crossapp;
use crossapp;

CREATE TABLE workouts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    exercise VARCHAR(255) NOT NULL,
    sets INT NOT NULL,
    reps INT NOT NULL,
    weight DECIMAL(5,2) NOT NULL
);

