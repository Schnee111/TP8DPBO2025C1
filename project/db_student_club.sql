-- Create database
CREATE DATABASE IF NOT EXISTS db_student_club;
USE db_student_club;

-- Create students table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nim VARCHAR(20) NOT NULL UNIQUE,
    phone VARCHAR(15),
    join_date DATE
);

-- Create clubs table
CREATE TABLE IF NOT EXISTS clubs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    founded_date DATE
);

-- Create club_members table (relationship between students and clubs)
CREATE TABLE IF NOT EXISTS club_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    club_id INT NOT NULL,
    join_date DATE NOT NULL,
    role VARCHAR(50) DEFAULT 'Member',
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (club_id) REFERENCES clubs(id) ON DELETE CASCADE,
    UNIQUE KEY (student_id, club_id)
);

-- Clear existing data (if any)
DELETE FROM club_members;
DELETE FROM students;
DELETE FROM clubs;

-- Reset auto-increment counters
ALTER TABLE students AUTO_INCREMENT = 1;
ALTER TABLE clubs AUTO_INCREMENT = 1;
ALTER TABLE club_members AUTO_INCREMENT = 1;

-- Insert dummy data for students (5 students only, without email field)
INSERT INTO students (name, nim, phone, join_date) VALUES
('John Doe', '2023001', '081234567890', '2023-08-15'),
('Jane Smith', '2023002', '082345678901', '2023-08-10'),
('Michael Johnson', '2023003', '083456789012', '2023-07-20'),
('Emily Davis', '2023004', '084567890123', '2023-09-05'),
('Robert Wilson', '2023005', '085678901234', '2023-08-25');

-- Insert dummy data for clubs (3 clubs only)
INSERT INTO clubs (name, description, founded_date) VALUES
('Programming Club', 'A club for students interested in programming and software development.', '2022-01-15'),
('Photography Club', 'A club for photography enthusiasts.', '2022-02-20'),
('Debate Club', 'A club for students interested in debating and public speaking.', '2022-03-10');

-- Insert dummy data for club_members (8 memberships only)
INSERT INTO club_members (student_id, club_id, join_date, role) VALUES
-- Programming Club members
(1, 1, '2023-08-20', 'President'),
(3, 1, '2023-08-22', 'Secretary'),
(5, 1, '2023-08-25', 'Member'),

-- Photography Club members
(2, 2, '2023-08-15', 'President'),
(4, 2, '2023-08-18', 'Vice President'),

-- Debate Club members
(1, 3, '2023-08-10', 'Member'),
(3, 3, '2023-08-13', 'Member'),
(5, 3, '2023-08-16', 'President');