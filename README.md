# City Pair Slot Allocation System

A Laravel-based system for managing flight slot allocations between city pairs with rationalized block times.

## Features

- Multiple city pair slot allocation
- Airline slot management
- Block time rationalization
- Slot allocation rules and constraints
- Modern UI with Tailwind CSS

## Slot Allocation Rules

1. **Maximum Slots per Airline**
   - Maximum 4 slots per airline per city pair
   - Prevents any single airline from dominating a route

2. **Minimum Time Gap**
   - 30 minutes gap required between slots on the same route
   - Prevents scheduling conflicts

3. **Maximum Slots per Hour**
   - Maximum 6 slots per hour at any airport
   - Prevents airport congestion

## Requirements

- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM (for frontend assets)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/city-pair-slot-system.git
cd city-pair-slot-system
```

2. Install PHP dependencies:
```bash
composer install
```

3. Copy environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Configure your database in `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations and seeders:
```bash
php artisan migrate --seed
```

7. Install frontend dependencies:
```bash
npm install
```

8. Build frontend assets:
```bash
npm run build
```

9. Start the development server:
```bash
php artisan serve
```

## Database Structure

1. **Cities Table**
   - Stores airport information
   - Contains airport codes and city names

2. **Airlines Table**
   - Stores airline information
   - Contains airline codes and names

3. **City Pairs Table**
   - Stores routes between cities
   - Links to cities table

4. **Block Times Table**
   - Stores flight durations between city pairs
   - Links to city pairs table

5. **Slots Table**
   - Stores actual flight slots
   - Links to city pairs and airlines

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.
