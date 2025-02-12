CREATE TABLE status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(50)
);

INSERT INTO status (status) VALUES 
('Not Found'),
('Info Received'),
('In Transit'),
('Pick Up'),
('Out for Delivery'),
('Undelivered'),
('Delivered'),
('Alert'),
('Expired');
