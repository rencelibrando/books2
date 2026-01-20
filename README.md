# Knowledge Junction Online Bookstore

This project is a simple PHP-based online bookstore application that allows users to register, log in, browse books, add them to a cart, and place orders. It also features an admin panel for managing orders.

## Features

*   **User Authentication**: Secure user registration with password hashing and login functionality.
*   **Admin Login**: Separate login for administrators to manage the store.
*   **Product Catalog**: Display of available books with images, names, and prices.
*   **Shopping Cart**: Users can add multiple books to their cart, adjust quantities, and remove items.
*   **Order Management**: Users can place orders, select shipping and payment methods.
*   **Admin Panel**: (Based on file names like `admin-orders.php`, `admin-edit-orders.php`) likely for managing user orders.
*   **Responsive Design**: Utilizes W3.CSS and Font Awesome for a modern, responsive user interface.

## Technologies Used

*   **Backend**: PHP
*   **Database**: MySQL
*   **Frontend**: HTML, CSS (W3.CSS), JavaScript
*   **Web Server**: Apache (via XAMPP)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

You will need to have XAMPP installed on your system. XAMPP provides the Apache web server, MySQL database, and PHP environment necessary to run this application.

*   [Download XAMPP](https://www.apachefriends.org/download.html)

### Installation

1.  **Download the Codebase**:
    Clone this repository to your local machine or download the ZIP file and extract it.

2.  **Place Project in XAMPP htdocs**:
    Copy the entire `books2` folder (the root of this project) into the `htdocs` directory of your XAMPP installation (e.g., `C:\xampp\htdocs\books2`).

3.  **Start Apache and MySQL**:
    Open the XAMPP Control Panel and start the Apache and MySQL modules.

4.  **Database Setup**:
    *   Open your web browser and navigate to `http://localhost/phpmyadmin`.
    *   Create a new database named `bookstore`.
    *   Go to the `Import` tab, click `Choose File`, and select the `earist6-6s.sql` (or `bookstore(1).sql` if available) file from the `books2` project folder. Click `Import`. This will create the necessary tables and populate initial data. There are also `status.sql`, `table.sql`, and `verify.sql` files that might contain additional database schema or data; review them if needed.

5.  **Run the Application**:
    Open your web browser and navigate to `http://localhost/books2`.

## Usage

*   **Registration**: New users can register for an account via the "Register" link.
*   **Login**: Registered users can log in using their credentials. There's also a hardcoded admin login:
    *   **Email**: `admin@admin`
    *   **Password**: `admin123`
*   **Browsing Products**: After logging in, users can browse the available books.
*   **Shopping Cart**: Add books to the cart and proceed to checkout.
*   **Admin Functionality**: Log in as admin to access administrative features (e.g., `admin.php`, `admin-orders.php`).

## Project Structure

```
.
├── admin-edit-orders.php
├── admin-orders.php
├── admin-orders1.php
├── admin.php
├── cancel_order.php
├── cart.php
├── cart1.php
├── connect.php
├── delete_item.php
├── delete.php
├── earist6-6s.sql             # Main database schema and data
├── edit.php
├── foot.html
├── gfhfg.php                 # (Potentially temporary/unused file)
├── header.css
├── header.html
├── index.php                 # Main landing page
├── login.php                 # User login logic
├── login2.css
├── login2.php
├── login3.php
├── logout.php
├── order1.php
├── orders.php
├── print_data.php
├── print_database.php
├── print_receipt.php
├── print_receipt2.php
├── process_payment.php
├── products.php              # Displays all products
├── registration.css
├── registration.php          # User registration logic
├── status.sql                # Additional SQL schema/data
├── table.sql                 # Additional SQL schema/data
├── update-order.php
├── update.php
├── v1.php - v25.php          # Individual product detail pages
├── verify_otp.php
├── verify.sql                # Additional SQL schema/data
└── (various .png images)     # Product images and other assets
```

## Contributing

Contributions are welcome! Please feel free to fork the repository, make your changes, and submit a pull request.

## License

[Specify your project's license here, e.g., MIT, Apache 2.0, etc.]
