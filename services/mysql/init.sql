CREATE DATABASE IF NOT EXISTS dfwitb_db;

CREATE USER 'symfony'@'%' IDENTIFIED BY 'dfwitb2021symfony';
GRANT ALL PRIVILEGES ON dfwitb_db.* TO 'symfony'@'%';

FLUSH PRIVILEGES;