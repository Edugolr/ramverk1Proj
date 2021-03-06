

--
-- Create a database user for the test database
--
-- GRANT ALL ON anaxdb.* TO anax@localhost IDENTIFIED BY 'anax';



-- Ensure UTF8 on the database connection
SET NAMES utf8mb4;



--
-- Table Answer
--
DROP TABLE IF EXISTS Answer;
CREATE TABLE Answer (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `questionID` INTEGER NOT NULL,
    `userID` VARCHAR(50) NOT NULL,
    `username`  VARCHAR(10) NOT NULL,
    `upvote` INTEGER,
    `downvote` INTEGER,
    `answer` TEXT NOT NULL,
    `solution` BOOLEAN DEFAULT 0,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci;
