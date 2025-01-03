# InfoSphere News Application

InfoSphere is a news application built with Laravel, allowing users to browse, create, and manage articles, subscriptions, and users.

## Features

### General
- Responsive user interface supporting light and dark modes.
- Multi-role user system: Admin, Author, Reader.
- Login, registration, and password reset system.

### Articles
- Authors can add, edit, and delete articles.
- Articles are viewable by all users.
- Premium content is available exclusively for subscribers.

### Subscriptions
- Users can choose subscription periods with automatic price calculation.
- Subscription management is available in the user panel.
- Admin can approve or reject subscription statuses.

### Admin Panel
- Manage users (add, edit, delete).
- Manage articles (add, edit, delete).
- Manage subscriptions (approve, reject).

## Requirements

Before installation, ensure you have:
- PHP 8.1 or later
- Composer
- Node.js 16+ with npm
- MySQL or another compatible database server

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/Mateusz-Koczorowski/laravel-project-blog-news.git
cd infosphere-blog
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
npm run dev
```

### 4.  Create the .env File

```bash
cp .env.example .env
```

### 5. Generate the Application Key

```bash
php artisan key:generate
```

### 6. Configure the .env File

Fill in all required fields in the .env file, such as:
- Database configuration
- Mailtrap settings
- Default user credentials
You can find detailed information on these settings in a separate file (attached to assignment).

### 7. Run Database Migrations and Seeders

To set up the database and seed initial data:
```bash
php artisan migrate --seed
```

### 8. Run Database Migrations and Seeders

Create links to store article images
```bash
php artisan storage:link
```

### 9. Start the Application
Run the development server:
```bash
php artisan serve
```
The application will be accessible at http://127.0.0.1:8000.