-- Checking if database exists.

CREATE DATABASE IF NOT EXISTS movie_db;
USE movie_db;

-- Table to store users
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Username VARCHAR(50),
    Password VARCHAR(100) NOT NULL,
    ProfilePicture VARCHAR(255),
    JoinDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table to store movies
CREATE TABLE Movies (
    MovieID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255) NOT NULL,
    ReleaseYear INT,
    Director VARCHAR(100),
    Genre VARCHAR(100),
    Description TEXT,
    PosterURL VARCHAR(255),
    TrailerURL VARCHAR(255)
);

-- Table to store discussions
CREATE TABLE Discussions (
    DiscussionID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    MovieID INT,
    Title VARCHAR(255) NOT NULL,
    Content TEXT,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (MovieID) REFERENCES Movies(MovieID)
);

-- Table to store comments
CREATE TABLE Comments (
    CommentID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    DiscussionID INT,
    Content TEXT,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (DiscussionID) REFERENCES Discussions(DiscussionID)
);

CREATE TABLE movie_reflections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_title VARCHAR(255) NOT NULL,
    reflection TEXT NOT NULL,
    improvement_areas TEXT,
    areas_to_desist TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UserID INT, 

    FOREIGN KEY (UserID) REFERENCES users(UserID) 
);

-- Table to store bookmarks
CREATE TABLE Bookmarks (
    BookmarkID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    MovieID INT,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (MovieID) REFERENCES Movies(MovieID)
);

ALTER TABLE users
ADD COLUMN current_password VARCHAR(255) NOT NULL AFTER Email,
ADD COLUMN new_password VARCHAR(255) NOT NULL AFTER current_password;

