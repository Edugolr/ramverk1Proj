

--
-- Create a database user for the test database
--
-- GRANT ALL ON anaxdb.* TO anax@localhost IDENTIFIED BY 'anax';



-- Ensure UTF8 on the database connection
SET NAMES utf8;



--
-- Table Comment
--
DROP TABLE IF EXISTS Comment;
CREATE TABLE Comment (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `username`  VARCHAR(10) NOT NULL,
    `userID`  VARCHAR(10) NOT NULL,
    `questionID` INTEGER,
    `answerID` INTEGER,
    `comment` TEXT NOT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
