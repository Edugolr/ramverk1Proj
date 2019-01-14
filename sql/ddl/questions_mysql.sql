

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

INSERT INTO Questions (title, userID, tags, question)
   VALUES
   ('Dog Nelson Mandela i fängelse?', '1', 'nelson mandela', 'Jag är helt hundra på att Nelson Mandela avled under sin tid i fängelset är det någon mer som upplever det så ?'),
   ('Mirror mirror on the wall', '2', 'snowwhite mirror', 'Spegel spegel på väggen där eller säger de inte Magic mirror on the wall ?'),
   ('Monopol gubbens monocle', '3', 'monopol monocle', 'Jag är helt hundra på att han hade en monocle över högerögat, när tog dem bort den ?');
