## Project Overview
This project is a web-based system designed to manage clients and their enrollment into various health programs (such as TB, Malaria, and HIV programs).
It allows registration of new clients, enrollment into one or more health programs, client search, profile viewing, and exposure of client profiles via a secure API.

## Key Features
Create health programs (e.g., TB, HIV, Malaria).

Register new clients into the system.

Enroll clients into multiple programs.

Search for registered clients.

View detailed client profiles (including enrolled programs).

Expose client profiles via a RESTful API for external systems.

## Technologies Used
laravel, tailiwind, vite and mysql
## Installation & Setup
### clone the repo
git clone https://github.com/Frenol021/Health-App

cd Health-app

run both backend(laravel) ie **php artisan serve** and frontend ie **npm run dev**

## Database Migration
Create MySQL Table and migrate 

# Future Improvements
1. Expand reporting features (PowerBI dashboards).
2. Implement Redis caching to improve database retrieval speed.
3. Add support for bulk client uploads via CSV.


