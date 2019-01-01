

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
    `created` DATETIME,
    `updated` DATETIME,
    `deleted` DATETIME,
    `active` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
