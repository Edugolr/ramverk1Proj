
--
-- Create a database user for the test database
--
-- GRANT ALL ON anaxdb.* TO anax@localhost IDENTIFIED BY 'anax';



-- Ensure UTF8 on the database connection
SET NAMES utf8mb4;



--
-- Table Tag
--
DROP TABLE IF EXISTS Tags;
CREATE TABLE Tags (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `tag` VARCHAR(50) UNIQUE NOT NULL,
    `counter` INTEGER,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci;


INSERT INTO Tags (tag, counter)
   VALUES
   ('nelson', 1),
   ('mandela', 1),
   ('snowwhite', 1),
   ('mirror', 1),
   ('monopol', 1),
   ('monocle', 1);
