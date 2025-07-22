# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 application for managing useful links, organized into sections. It's a links management system ("controle-links") that uses Cloudinary for image storage.

## Architecture

The application follows standard Laravel MVC architecture with these key components:

### Models
- **Section** (app/Models/Section.php): Represents categories for links, has auto-generated slugs
- **UsefulLink** (app/Models/UsefulLink.php): Individual links belonging to sections, includes image support via Cloudinary

### Controllers
- **SectionController**: CRUD operations for sections
- **UsefulLinkController**: CRUD operations for useful links
- Standard resource controllers without show routes

### Frontend
- Uses Laravel Blade templates with TailwindCSS v4
- Main views in resources/views/ (sections/, useful-links/, welcome.blade.php)
- Built with Vite for asset compilation

## Development Commands

### PHP/Laravel Commands
```bash
# Start development environment (includes server, queue, and vite)
composer dev

# Run tests
composer test
# or directly:
php artisan test

# Serve application only
php artisan serve

# Run queue worker
php artisan queue:listen --tries=1

# Run migrations
php artisan migrate

# Generate application key
php artisan key:generate
```

### Frontend Commands  
```bash
# Development server (Vite)
npm run dev

# Build for production
npm run build
```

## Key Integrations

### Image Storage
- Images are stored as Base64 encoded strings directly in the database
- No external storage dependencies required
- Images are automatically converted to Base64 format during upload

### Testing
- Uses Pest PHP testing framework
- Test files in tests/Feature/ and tests/Unit/

### Database
- SQLite database (database/database.sqlite)
- Migrations for users, cache, jobs, sections, and useful_links tables
- Section has one-to-many relationship with UsefulLink

## Routes Structure
- Home route (/) displays all sections with their links
- Resource routes for sections and useful-links (excluding show actions)
- All routes defined in routes/web.php

## UI/Design
- Modern dark theme with blue (#3b82f6) and pink (#ec4899) accents
- Uses Inter font family for clean typography
- Glass-morphism effects with backdrop blur and transparency
- Responsive grid layouts for cards and sections
- Hover animations and transitions for better UX
- Custom CSS variables for consistent theming