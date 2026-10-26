# Disna Bakery – Online Bakery Sales and Custom Cake Ordering System

## 📌 Project Overview

**Disna Bakery** is a web-based bakery management and online ordering system developed to support the online presentation of bakery products and custom cake ordering. The system provides a user-friendly interface for customers and administrative functionality for managing product categories and bakery products.

The project was developed as an individual academic project for the Bachelor of Science (Hons) in Software Engineering programme at Lanka Nippon BizTech Institute.

## 🎯 Project Objectives

- Provide an online platform to browse bakery products.
- Allow customers to register, log in, and manage their profiles.
- Enable customers to customise cake orders using available options.
- Allow administrators to manage product categories and products.
- Apply role-based access control to the system.
- Improve the accessibility and organisation of bakery ordering and product management.

## ✨ Features

### Customer Features
- Customer registration and login.
- Customer dashboard.
- View bakery products and categories.
- View product information and prices.
- Custom cake ordering interface.
- Customer profile management.
- Form validation.

### Administrator Features
- Administrator dashboard.
- Manage product categories.
- Add, edit, and manage bakery products.
- Manage product information, including names, prices, images, categories, and stock details where supported.
- Access administrative functions according to assigned permissions.

### Additional System Features
- Role-based access control.
- Database-driven product catalogue.
- Responsive user interface.
- Authentication and request validation.

*Note: The feature list should reflect the functionality currently implemented in the project. Advanced delivery management, online payment integration, and live order tracking are not claimed as completed features.*

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| Laravel 12 | Backend web application framework |
| PHP 8.2 | Server-side programming |
| SQLite | Database management |
| HTML5 | Web page structure |
| CSS3 | Styling and layout |
| JavaScript | Client-side interactions |
| Bootstrap 5 | User interface styling |
| Laravel Breeze | Authentication scaffolding |
| Blade | Laravel templating engine |
| Font Awesome | Icons |
| Git | Version control |
| GitHub | Source code hosting |
| Composer | PHP dependency management |
| Node.js and npm | Frontend asset management |

## 🏗️ System Architecture

The application follows the **Model–View–Controller (MVC)** architectural pattern provided by Laravel.

- **Model:** Handles database entities and data operations.
- **View:** Displays the user interface using Blade templates, HTML, CSS, and JavaScript.
- **Controller:** Processes requests, validates input, and coordinates application logic.
- **Database:** SQLite stores application data.
- **Middleware:** Restricts access to protected routes according to authentication and user roles.

## 📂 Project Structure

```text
bakery_system/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── database.sqlite
├── public/
│   └── images/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── admin/
│       ├── customer/
│       └── delivery/
├── routes/
│   └── web.php
├── tests/
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

*This is a representative structure. The actual files and directories may differ depending on the current project version.*

## ⚙️ Installation and Setup

Follow these steps to run the project locally.

### Prerequisites

Install the following software:

- PHP 8.2 or a compatible version required by the project.
- Composer.
- Node.js and npm.
- Git.
- A web browser.

XAMPP can be used to provide a local PHP development environment.

### Step 1: Clone the Repository

Open a terminal and run:

```bash
git clone https://github.com/Aneema23/bakery_system.git
```

Navigate to the project directory:

```bash
cd bakery_system
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Configure the Environment

Create your local environment file.

On Windows Command Prompt:

```cmd
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Check the `.env` file and configure the application environment as required.

Do not commit your `.env` file or other files containing passwords, API keys, or secret credentials.

### Step 4: Configure SQLite

Create the SQLite database file if it does not already exist.

On Windows Command Prompt:

```cmd
if not exist database\database.sqlite type nul > database\database.sqlite
```

In the `.env` file, configure the database connection:

```dotenv
DB_CONNECTION=sqlite
```

Ensure that the SQLite database path is correct for your local setup. If your `.env` file contains an existing `DB_DATABASE` setting, verify that it points to the correct database file.

### Step 5: Run Database Migrations

```bash
php artisan migrate
```

If the project requires initial data and contains the appropriate seeders, run:

```bash
php artisan db:seed
```

Only run the seeding command if the project has been configured for it. Avoid running destructive database commands on a database containing data you need to preserve.

### Step 6: Install Frontend Dependencies

If the repository includes `package.json`, install the frontend dependencies:

```bash
npm install
```

Build the frontend assets:

```bash
npm run build
```

For frontend development, you can use:

```bash
npm run dev
```

### Step 7: Start the Laravel Development Server

```bash
php artisan serve
```

Open the following address in your browser:

**http://127.0.0.1:8000**

The application should now be accessible locally.

## 🔐 Authentication and User Roles

The application uses Laravel authentication functionality and role-based access control.

The intended roles include:

- **Customer:** Access customer pages and available ordering functionality.
- **Administrator:** Access administrative dashboards and product management features.
- **Delivery Person:** Access the delivery dashboard and any delivery functions implemented in the current version.

Access permissions depend on the configured routes, middleware, and user-role assignments.

## 🧪 Testing

The project can be tested using Laravel's testing tools and manual browser testing.

Suggested testing areas include:

- User registration and login.
- Form validation.
- Product catalogue display.
- Category management.
- Product management.
- Customer profile functionality.
- Custom cake ordering form.
- Role-based route access.
- Database operations.

To run the automated tests included in the project, use:

```bash
php artisan test
```

The test results depend on the tests currently implemented and the local environment configuration.

## 🚀 Future Enhancements

Potential future improvements include:

- Online payment gateway integration.
- Order history and order status tracking.
- Complete delivery management.
- Email or SMS notifications.
- Improved reporting and analytics.
- Automated testing coverage.
- Production deployment with enhanced security and monitoring.

These enhancements are planned possibilities and should not be interpreted as currently implemented features.

## 🔒 Security Notes

- Keep environment variables and credentials private.
- Do not upload the `.env` file to GitHub.
- Use server-side validation for user-submitted data.
- Apply authentication and authorization checks to protected routes.
- Use secure settings and HTTPS when deploying to production.
- Back up important database data before making schema changes.

## 👩‍💻 Developer

**Aneema Rajapaksha**  
BSc (Hons) Software Engineering  
Lanka Nippon BizTech Institute

