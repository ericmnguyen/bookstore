DROP DATABASE IF EXISTS db_22074118;

-- Since DROP DATABASE has been disabled by phpMyAdmin,
-- one has to remove a database manually via the "Databases" tab there.
--
-- Or modify (with caution) phpMyAdmin\libraries\config.default.php by
-- replacing $cfg['AllowUserDropDatabase'] = false; with
-- $cfg['AllowUserDropDatabase'] = true;


-- you may have to replace "bookreview" below by "db_zhuhan"
-- if this database is to be placed on the School's database server,
-- where "zhuhan" should be replaced by your own username on the server
CREATE DATABASE db_22074118;
USE db_22074118;


-- DROP TABLE Authorship, Report, Book, Author, Reviewer;

CREATE TABLE Category (
	cateId int PRIMARY KEY AUTO_INCREMENT,
  categoryName VARCHAR(100) NOT NULL
);

CREATE TABLE Book (
  bookId VARCHAR(10) PRIMARY KEY,
  title VARCHAR(100) NOT NULL
);

CREATE TABLE BookCategory (
	cateId int(11) NOT NULL,
  bookId VARCHAR(10) NOT NULL,
  PRIMARY KEY (cateId, bookId),
  FOREIGN KEY(cateId) REFERENCES Category(cateId),
  FOREIGN KEY(bookId) REFERENCES Book(bookId)
);

CREATE TABLE Author (
  authorId VARCHAR(10) PRIMARY KEY,
  authorName VARCHAR(50) NOT NULL
);

CREATE TABLE Reviewer (
  reviewerId INT PRIMARY KEY AUTO_INCREMENT,
  reviewerName VARCHAR(50) NOT NULL
);


CREATE TABLE Authorship (
  bookId VARCHAR(10), 
  FOREIGN KEY(bookId) REFERENCES Book(bookId),
  authorId VARCHAR(10),
  FOREIGN KEY(authorId) REFERENCES Author(authorId),
  PRIMARY KEY (bookId, authorId)
);

CREATE TABLE Report (
  bookId VARCHAR(10),
  FOREIGN KEY(bookId) REFERENCES Book(bookId),
  reviewerId INT,
  FOREIGN KEY(reviewerId) REFERENCES Reviewer(reviewerId),
  rating INT DEFAULT 1,
  reviewDate DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (bookId, reviewerId)
);


-- insert some authors
INSERT INTO Author VALUES ('A001', 'Kishori Sharan');
INSERT INTO Author VALUES ('A002', 'Douglas Adams');
INSERT INTO Author VALUES ('A003', 'Mark J Price');
INSERT INTO Author VALUES ('A004', 'Jon Duckett');
INSERT INTO Author VALUES ('A005', 'Eric Matthes');
INSERT INTO Author VALUES ('A006', 'Alex Xu');
INSERT INTO Author VALUES ('A007', 'Matthew Portnoy');
INSERT INTO Author VALUES ('A008', 'Stan Gibilisco');
INSERT INTO Author VALUES ('A009', 'Library Mindset');

-- insert some reviewers
INSERT INTO Reviewer(reviewerName) VALUES ('Donald');
INSERT INTO Reviewer(reviewerName) VALUES ('Vladimir');
INSERT INTO Reviewer(reviewerName) VALUES ('Theresa');

-- insert some categories
INSERT INTO Category(categoryName) VALUES ('Other');
INSERT INTO Category(categoryName) VALUES ('Popular');
INSERT INTO Category(categoryName) VALUES ('New release');
INSERT INTO Category(categoryName) VALUES ('Network and Cloud computing');
INSERT INTO Category(categoryName) VALUES ('Software development');
INSERT INTO Category(categoryName) VALUES ('Mathematics');

-- insert some books
INSERT INTO Book (bookId, title) VALUES ('B001', 'Beginning Java 17 Fundamentals: Object-Oriented Programming in Java 17');
INSERT INTO Book (bookId, title) VALUES ('B002', 'Java 13 Revealed: For Early Adoption and Migration');
INSERT INTO Book (bookId, title) VALUES ('B003', 'C# 12 and .NET 8 - Modern Cross-Platform Development Fundamentals - Eighth Edition');
INSERT INTO Book (bookId, title) VALUES ('B004', 'PHP & MySQL: Server-side Web Development');
INSERT INTO Book (bookId, title) VALUES ('B005', 'HTML and CSS: Design and Build Websites');
INSERT INTO Book (bookId, title) VALUES ('B006', 'JavaScript and jQuery: Interactive Front-End Web Development');
INSERT INTO Book (bookId, title) VALUES ('B007', 'Web Design with HTML, CSS, JavaScript and jQuery Set');
INSERT INTO Book (bookId, title) VALUES ('B008', 'Front-End Back-End Development with HTML, CSS, JavaScript, jQuery, PHP, and MySQL');
INSERT INTO Book (bookId, title) VALUES ('B009', 'Python Crash Course, 3rd Edition: A Hands-On, Project-Based Introduction to Programming');
INSERT INTO Book (bookId, title) VALUES ('B010', 'System Design Interview');
INSERT INTO Book (bookId, title) VALUES ('B011', 'Virtualization Essentials');
INSERT INTO Book (bookId, title) VALUES ('B012', 'Mastering Technical Mathematics, Third Edition');
INSERT INTO Book (bookId, title) VALUES ('B013', "Beginner's Guide to Reading Schematics, Fourth Edition");
INSERT INTO Book (bookId, title) VALUES ('B014', 'The Art of Laziness: Overcome Procrastination & Improve Your Productivity');

-- insert book categories
INSERT INTO BookCategory VALUES (5, 'B001');
INSERT INTO BookCategory VALUES (5, 'B002');
INSERT INTO BookCategory VALUES (5, 'B003');
INSERT INTO BookCategory VALUES (5, 'B004');
INSERT INTO BookCategory VALUES (5, 'B005');
INSERT INTO BookCategory VALUES (5, 'B006');
INSERT INTO BookCategory VALUES (5, 'B007');
INSERT INTO BookCategory VALUES (5, 'B008');
INSERT INTO BookCategory VALUES (5, 'B009');
INSERT INTO BookCategory VALUES (3, 'B009');
INSERT INTO BookCategory VALUES (2, 'B008');
INSERT INTO BookCategory VALUES (3, 'B007');
INSERT INTO BookCategory VALUES (2, 'B006');
INSERT INTO BookCategory VALUES (3, 'B005');
INSERT INTO BookCategory VALUES (2, 'B004');
INSERT INTO BookCategory VALUES (3, 'B003');
INSERT INTO BookCategory VALUES (2, 'B002');
INSERT INTO BookCategory VALUES (3, 'B001');
INSERT INTO BookCategory VALUES (4, 'B010');
INSERT INTO BookCategory VALUES (4, 'B011');
INSERT INTO BookCategory VALUES (1, 'B010');
INSERT INTO BookCategory VALUES (2, 'B011');
INSERT INTO BookCategory VALUES (2, 'B010');
INSERT INTO BookCategory VALUES (6, 'B012');
INSERT INTO BookCategory VALUES (6, 'B013');
INSERT INTO BookCategory VALUES (1, 'B014');
INSERT INTO BookCategory VALUES (2, 'B012');
INSERT INTO BookCategory VALUES (3, 'B013');
INSERT INTO BookCategory VALUES (2, 'B014');



-- who wrote which books
INSERT INTO Authorship VALUES 
('B001','A001'), ('B002','A001'),
('B003','A003'), 
('B004','A004'), ('B005','A004'), ('B006','A004'), ('B007','A004'), ('B008','A004'),
('B009','A005'),
('B010','A006'),
('B011','A007'),
('B012','A008'), ('B013','A008'),
('B014','A009');

-- insert book report/reviews
INSERT INTO Report VALUES 
('B001',1, 5, '2024-06-21 11:11:59'), 
('B001',3, 4, '2024-09-24 11:11:59'), 
('B002',2, 4, '2024-07-22 12:11:59'), 
('B002',3, 5, '2024-10-25 12:11:59'),
('B003',3, 3, '2024-08-23 13:11:59');


-- ***************************************
-- Sample SQL to display report/review;
-- just uncomment the SQL code below
-- ***************************************

-- SELECT * FROM Report r, Reviewer w, Book b
-- WHERE r.reviewerId=w.reviewerid
-- AND b.bookId=r.bookId
-- AND b.title='Java Software Solutions';
