
-- Use the newly created database
USE iiuc_library;

-- Create the 'users' table for storing user information
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('student', 'librarian') NOT NULL, -- 'student' or 'librarian'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the 'books' table for storing book information
CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    book_name VARCHAR(255) NOT NULL,
    author_name VARCHAR(255) NOT NULL,
    genre VARCHAR(100),
    total_quantity INT NOT NULL,   -- Total number of books in inventory
    available_quantity INT NOT NULL,  -- Books available for borrowing
    borrowed_quantity INT NOT NULL DEFAULT 0,  -- Books that are borrowed
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create table for book requests
CREATE TABLE book_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE
);

-- Create table for borrowed books
CREATE TABLE borrowed_books (
    borrow_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    borrow_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE
);
