CREATE TABLE temp_users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    contact_number VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    student_number VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    verification_code VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
