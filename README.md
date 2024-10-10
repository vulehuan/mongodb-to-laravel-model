# MongoDB Collections to Laravel Models

## Overview
This is a PHP artisan command that helps generate models from MongoDB Collections. It automates the process of creating Laravel models based on your MongoDB collections.

## Features
- Generates Laravel models from MongoDB collections.
- Auto-creates model classes based on MongoDB schemas.

## Requirements
- Laravel 11
- MongoDB PHP Driver
- Composer
- [jenssegers/laravel-mongodb](https://github.com/jenssegers/laravel-mongodb)

## Installation
If you need to generate models, simply copy `app/Console/Commands/GenerateMongoModels.php` into your Laravel 11 project.

### Steps:
1. Run the artisan command to generate models:
   ```bash
   php artisan app:generate-mongo-models

2. Ensure your MongoDB connection settings in `config/database.php` and environment variables (`DB_HOST`, `DB_PORT`, `DB_DATABASE`) are correct.

If you're running locally, this setup should be enough.
If your database is hosted on services like MongoDB Atlas, make sure to adjust the database configuration accordingly.
