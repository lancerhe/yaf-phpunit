CREATE TABLE `article` (
  `id` Integer PRIMARY KEY AUTOINCREMENT,
  `category_id` Integer,
  `subject` VARCHAR(50),
  `content` VARCHAR(2000),
  `ctime` Integer,
  `mtime` Integer
);

CREATE TABLE `category` (
  `id` Integer PRIMARY KEY AUTOINCREMENT,
  `name` VARCHAR(50) UNIQUE
);

CREATE TABLE `comment` (
  `id` Integer PRIMARY KEY AUTOINCREMENT,
  `article_id` Integer,
  `content` VARCHAR(20),
  `ctime` Integer
);