

--
-- Create a database user for the test database
--
-- GRANT ALL ON anaxdb.* TO anax@localhost IDENTIFIED BY 'anax';



-- Ensure UTF8 on the database connection
SET NAMES utf8;



--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `acronym` VARCHAR(10) UNIQUE NOT NULL,
    `password` VARCHAR(128) NOT NULL,
    `firstname`VARCHAR(50),
    `lastname` VARCHAR(50),
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `counter` INTEGER,
    `updated` DATETIME,
    `deleted` DATETIME,
    `active` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO User (email, acronym, password, firstname, lastname)
   VALUES
   ('christofer.wikman@gmail.com', 'chai17', '$2y$10$LIcFyosOoNyBnqvpnK2tt.rhIySx6B/JwBhkl4WkjRJjjr4ic8l1a', 'Christofer', 'Wikman'),
   ('robin.wikman@gmail.com', 'frisbee', '$2y$10$LIcFyosOoNyBnqvpnK2tt.rhIySx6B/JwBhkl4WkjRJjjr4ic8l1a', 'Robin', 'Wikman'),
   ('michael.wikman@gmail.com', 'warhammern', '$2y$10$LIcFyosOoNyBnqvpnK2tt.rhIySx6B/JwBhkl4WkjRJjjr4ic8l1a', 'Michael', 'Wikman'),
   ('jolene.wikman@gmail.com', 'jollan', '$2y$10$LIcFyosOoNyBnqvpnK2tt.rhIySx6B/JwBhkl4WkjRJjjr4ic8l1a', 'Jolene', 'Wikman');
