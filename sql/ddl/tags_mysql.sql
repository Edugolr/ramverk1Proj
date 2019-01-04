
--
-- Create a database user for the test database
--
-- GRANT ALL ON anaxdb.* TO anax@localhost IDENTIFIED BY 'anax';



-- Ensure UTF8 on the database connection
SET NAMES utf8;



--
-- Table Tag
--
DROP TABLE IF EXISTS Tags;
CREATE TABLE Tags (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `tag` VARCHAR(50) UNIQUE NOT NULL,
    `counter` INTEGER,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
