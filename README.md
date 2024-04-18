# Laravel Project Setup Guide

This guide will help you set up a new Laravel project, run migrations, and seed the database with sample data.

## Prerequisites

Before getting started, ensure you have the following installed on your machine:

- PHP (recommended version)
- Composer
- MySQL or any other supported database system
- Node.js (optional, for frontend assets compilation)

## Installation

1. Clone this repository to your local machine:

    ```bash
    git clone <repository_url>
    ```

2. Navigate to the project directory:

    ```bash
    cd <project_directory>
    ```

3. Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

4. Copy the `.env.example` file to `.env` and update the database credentials:

    ```bash
    cp .env.example .env
    ```

5. Generate a new application key:

    ```bash
    php artisan key:generate
    ```

6. Run database migrations:

    ```bash
    php artisan migrate
    ```

7. (Optional) Seed the database with sample data:

    ```bash
    php artisan db:seed
    ```

8. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

    You can now access your Laravel application at `http://localhost:8000`.

## Method and API Endpoints

Here are the routes and corresponding controller methods:

### Users

| Method | Endpoint                     | Description                  |
|--------|------------------------------|------------------------------|
| GET    | /users                       | Get all users                |
| GET    | /users/details/{id}          | Get user details by ID       |
| POST   | /users/create                | Create a new user            |
| PUT    | /users/update/{id}           | Update an existing user      |
| DELETE | /users/delete/{id}           | Delete a user                |

### Departments

| Method | Endpoint                     | Description                  |
|--------|------------------------------|------------------------------|
| GET    | /departments                 | Get all departments          |
