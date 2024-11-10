CREATE DATABASE IF NOT EXISTS `portfolio`;


CREATE TABLE IF NOT EXISTS `portfolio`.`users` 
(`id` INT NOT NULL AUTO_INCREMENT , 
`username` VARCHAR(200) NOT NULL , 
`email` VARCHAR(200) NOT NULL ,
`password` TEXT NOT NULL , 
`phone` VARCHAR(200) NOT NULL , 
`role` ENUM('staff','manager','admin','') NOT NULL DEFAULT 'staff' ,
`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
`updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`), UNIQUE (`username`), UNIQUE (`email`)) 
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS user_logins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    login_time DATETIME NOT NULL,
    logout_time DATETIME DEFAULT NULL,
    session_duration TIME DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS user_transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action_type ENUM('create', 'update', 'delete', 'view') NOT NULL,
    transaction_details TEXT NOT NULL,
    transaction_time DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE = InnoDB;


-- Table for personal information
CREATE TABLE IF NOT EXISTS personal_info (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100),
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `phone` VARCHAR(50) NOT NULL,
    `address` VARCHAR(100),
    `linkedin_url` VARCHAR(100),
    `github_url` VARCHAR(100),
    `portfolio_url` VARCHAR(150),
    `summary` TEXT,  -- Short bio or professional summary
    `photo` BLOB,  -- Optional: Store a profile picture as a BLOB
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP,  
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author   INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    image_url VARCHAR(255) NULL,
    FOREIGN KEY (author) REFERENCES users(id)

)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    author   INT NOT NULL,
    article   INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author) REFERENCES users(id),
    FOREIGN KEY (article) REFERENCES articles(id)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    image_url VARCHAR(255) NULL, 
    FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id   INT NOT NULL,
    full_name VARCHAR(150) NOT NULL,
    company VARCHAR(100),
    position VARCHAR(100),
    testimonial TEXT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    image_url VARCHAR(255) NULL,   
    FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS team (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id   INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    role VARCHAR(100) NOT NULL,
    bio TEXT,
    linkedin_url VARCHAR(255),
    twitter_url VARCHAR(255),
    image_url VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS services  (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id   INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    icon VARCHAR(50),  -- FontAwesome or other icon library
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    media_url VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)

)ENGINE = InnoDB;




