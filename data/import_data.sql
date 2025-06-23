-- SQL script to import CSV data into MySQL database
-- Run this script in your MySQL database

-- Disable foreign key checks temporarily
SET foreign_key_checks = 0;

-- Clear existing data (optional - remove if you want to keep existing data)
TRUNCATE TABLE article_comments;
TRUNCATE TABLE article_likes;
TRUNCATE TABLE article_categories;
TRUNCATE TABLE articles;
TRUNCATE TABLE categories;
TRUNCATE TABLE users;

-- Import Users
LOAD DATA LOCAL INFILE '/var/lib/mysql-files/users.csv'
INTO TABLE users
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

-- Import Categories
LOAD DATA LOCAL INFILE '/var/lib/mysql-files/categories.csv'
INTO TABLE categories
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

-- Import Articles
LOAD DATA LOCAL INFILE '/var/lib/mysql-files/articles.csv'
INTO TABLE articles
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

-- Import Article Categories
LOAD DATA LOCAL INFILE '/var/lib/mysql-files/article_categories.csv'
INTO TABLE article_categories
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

-- Import Article Likes
LOAD DATA LOCAL INFILE '/var/lib/mysql-files/article_likes.csv'
INTO TABLE article_likes
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

-- Import Article Comments
LOAD DATA LOCAL INFILE '/var/lib/mysql-files/article_comments.csv'
INTO TABLE article_comments
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

-- Re-enable foreign key checks
SET foreign_key_checks = 1;

-- Show import results
SELECT 'Users' as Table_Name, COUNT(*) as Record_Count FROM users
UNION ALL
SELECT 'Categories', COUNT(*) FROM categories
UNION ALL
SELECT 'Articles', COUNT(*) FROM articles
UNION ALL
SELECT 'Article Categories', COUNT(*) FROM article_categories
UNION ALL
SELECT 'Article Likes', COUNT(*) FROM article_likes
UNION ALL
SELECT 'Article Comments', COUNT(*) FROM article_comments;
