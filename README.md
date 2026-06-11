# 📝 Blog Application

A modern blog application built with Laravel 12, Tailwind CSS, and Alpine JS. This application comes with authentication system, article management, and role-based access control using Spatie Laravel Permission.

<p align="center">
<a href="#-technology"><strong>Technology</strong></a> •
<a href="#-features"><strong>Features</strong></a> •
<a href="#-requirements"><strong>Requirements</strong></a> •
<a href="#-installation"><strong>Installation</strong></a> •
<a href="#-running-the-application"><strong>Running</strong></a> •
<a href="#-project-structure"><strong>Structure</strong></a>
</p>

---

## 🎯 About Project

Blog Application is a comprehensive blogging platform with complete features for creating, editing, and managing articles. Designed with a focus on ease of use and high performance, this application uses the latest Laravel framework with a responsive and modern interface.

## ✨ Features

- ✅ **User Authentication** - Register, Login, and Logout with guaranteed security
- ✅ **Article Management** - Create, Read, Update, Delete (CRUD) with user-friendly editor
- ✅ **Role-Based Access Control** - Role and permission system using Spatie Laravel Permission
- ✅ **Admin Dashboard** - Interactive dashboard for managing content
- ✅ **Responsive Design** - Beautiful and responsive UI on all devices
- ✅ **Search & Filtering** - Search and filter articles easily
- ✅ **User Profile Management** - Manage user profiles
- ✅ **Database Migrations** - Well-structured database schema

## 🛠️ Technology

**Backend:**
- **Laravel** v12.0 - Powerful PHP Framework
- **PHP** ^8.2 - Server-side programming language
- **Spatie Laravel Permission** v6.25 - Role and Permission management

**Frontend:**
- **Tailwind CSS** v3.1 - Utility-first CSS framework
- **Alpine JS** v3.4 - Lightweight JavaScript framework
- **Vite** v7.0 - Next generation frontend tooling
- **Axios** v1.11 - HTTP client for API requests

**Database & Tools:**
- **Laravel Breeze** - Authentication scaffolding
- **Pest PHP** - Modern testing framework
- **Laravel Tinker** - Interactive shell

## 📋 Requirements

Before getting started, make sure you have installed:

- **PHP** >= 8.2
- **Composer** >= 2.2
- **Node.js** >= 16.0
- **npm** or **yarn**
- **MySQL** or other database (SQLite for development)
- **Git**

## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/blog.git
cd blog
```

### 2. Automated Setup (Recommended)

```bash
composer run-script setup
```

This script will automatically:
- Install PHP dependencies
- Copy `.env` file
- Generate APP_KEY
- Run database migrations
- Install Node dependencies
- Build frontend assets

### 3. Manual Setup

If you prefer to do the setup manually:

```bash
# 1. Install PHP dependencies
composer install

# 2. Copy environment file
cp .env.example .env

# 3. Generate application key
php artisan key:generate

# 4. Setup database and migrate
php artisan migrate

# 5. (Optional) Seed database with sample data
php artisan db:seed

# 6. Install Node dependencies
npm install

# 7. Build frontend assets
npm run build
```

## 🎮 Running the Application

### Development Mode

Run the application in development mode with hot reload:

```bash
composer run-script dev
```

This command will run concurrently:
- Laravel development server (port 8000)
- Queue listener
- Vite dev server
- Application logs (pail)

The application will be available at: `http://localhost:8000`

### Production Mode

For production, build frontend assets first:

```bash
npm run build
```

Then run the server:

```bash
php artisan serve
```

## 📁 Project Structure

```
blog/
├── app/
│   ├── Http/
│   │   ├── Controllers/         # Application controllers
│   │   └── Requests/            # Form request validations
│   ├── Models/
│   │   ├── Article.php          # Article model
│   │   └── User.php             # User model
│   └── Providers/               # Service providers
├── config/                      # Configuration files
├── database/
│   ├── factories/               # Model factories for testing
│   ├── migrations/              # Database migrations
│   └── seeders/                 # Database seeders
├── public/                      # Public assets (compiled)
├── resources/
│   ├── css/                     # CSS files (Tailwind)
│   ├── js/                      # JavaScript files (Alpine)
│   └── views/                   # Blade templates
├── routes/
│   ├── web.php                  # Web routes
│   ├── auth.php                 # Authentication routes
│   └── console.php              # Console commands
├── storage/                     # Storage files
├── tests/                       # Unit & Feature tests (Pest)
└── vendor/                      # Composer dependencies
```

## 🧪 Testing

Run the test suite using Pest:

```bash
# Run all tests
./vendor/bin/pest

# Run tests with coverage
./vendor/bin/pest --coverage

# Run specific tests
./vendor/bin/pest tests/Feature/ExampleTest.php
```

## 📝 Environment Configuration

Configure the application through the `.env` file:

```env
APP_NAME=Blog
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_db
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
```

## 🔐 Security

- Sensitive data stored in `.env` file (don't commit to repository)
- SQL injection prevention through Eloquent ORM
- CSRF protection on all forms
- Bcrypt password hashing
- User authentication & authorization

## 📦 Dependency Management

### PHP Dependencies
```bash
# Add new package
composer require package/name

# Update dependencies
composer update
```

### JavaScript Dependencies
```bash
# Add new package
npm install package-name

# Update dependencies
npm update
```

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork this repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Create a Pull Request

## 📞 Support & Contact

If you have any questions or issues, please create an issue in this GitHub repository.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for more details.

---

<div align="center">

**Built with ❤️ using Laravel**

[⬆ Back to top](#-blog-application)

</div>
