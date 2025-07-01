# Simple PHP MVC Framework

This repository provides a minimal MVC structure suitable for single-user applications.

## Folder Structure

- `app/` - Application code
  - `controllers/` - Controller classes
  - `models/` - Models for database interactions
  - `views/` - View templates
- `core/` - Framework classes (`App`, `Controller`, `Model`)
- `config/` - Configuration files
- `public/` - Web root

## Configuration

The `config/config.php` file contains database credentials and site configuration. Update these values to match your environment.

## Deployment

The application expects the web server's document root to point at the `public/` directory. If you cannot change the document root, you can place all files in this repository at your web root; the included `index.php` at the project root will forward requests to `public/index.php`. Ensure Apache's mod_rewrite is enabled for `.htaccess` support.

## Example Usage

Navigate to your domain to see the welcome page.
