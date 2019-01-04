

--
-- Create a database user for the test database
--
-- GRANT ALL ON anaxdb.* TO anax@localhost IDENTIFIED BY 'anax';



-- Ensure UTF8 on the database connection
SET NAMES utf8;



--
-- Table Questions
--
DROP TABLE IF EXISTS Questions;
CREATE TABLE Questions (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `title` VARCHAR(50) NOT NULL,
    `userID` INTEGER NOT NULL,
    `tags` VARCHAR(256) NOT NULL,
    `question` TEXT NOT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
