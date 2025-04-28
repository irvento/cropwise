# Farm Management System

Welcome to the Farm Management System! This application is designed to streamline and enhance the management of agricultural operations. Built with Laravel, utilizing Blade for templating, and styled with Tailwind CSS, this system provides a comprehensive solution for managing various aspects of a farm. This is a final project requirement in IT38A Enterprise Systems by Irven L. Abarquez.

## Features

The Farm Management System includes the following key functionalities:

### 1. Inventory Management

- Track and manage farm supplies, equipment, and produce.
- Real-time inventory updates and alerts for low stock.
- Categorization of items for easy access and management.

### 2. Financial Management

- Monitor income and expenses related to farm operations.
- Generate financial reports and analytics.
- Budgeting tools to help plan for future expenses.

### 3. Human Resources Management

- Manage employee records, roles, and responsibilities.
- Track work hours, payroll, and performance evaluations.
- Employee self-service portal for leave requests and personal information updates.

### 4. Farm Management

- Plan and schedule planting, harvesting, and other farm activities.
- Monitor crop health and growth stages.
- Integration with weather data for better decision-making.

## Technologies Used

- **Laravel**: A powerful PHP framework for building web applications.
- **Blade**: Laravel's templating engine for creating dynamic views.
- **Tailwind CSS**: A utility-first CSS framework for designing responsive and modern user interfaces.
- **MySQL**: Database management system for storing application data.

## Installation

To set up the Farm Management System locally, follow these steps:

1. **Clone the repository**:

   ```
   git clone https://github.com/yourusername/farm-management-system.git
   cd farm-management-system
   
   ```
2. **Install dependencies**:
   Make sure you have Composer installed, then run:

   ```
   composer install
   
   ```
3. **Set up the environment**:
   Copy the ```
   .env.example
   ```

    file to ```
   .env
   ```

    and configure your database and other settings:

   ```
   cp .env.example .env
   
   ```
4. **Generate application key**:

   ```
   php artisan key:generate
   
   ```
5. **Run migrations**:

   ```
   php artisan migrate
   
   ```
6. **Start the development server**:

   ```
   php artisan serve
   
   ```
7. **Access the application**:
   Open your browser and navigate to ```
   http://localhost:8000
   ```

   .

## Usage

Once the application is up and running, you can log in using the default admin credentials (you can change these in the database). Explore the various modules for inventory, finance, HR, and farm management. 

### User Roles

- **Admin**: Full access to all features and settings.
- **Employee**: Limited access to personal information and tasks.

## Contributing

We welcome contributions to the Farm Management System! If you have suggestions or improvements, please fork the repository and submit a pull request. 

1. Fork the repository.
2. Create a new branch (```
   git checkout -b feature/YourFeature
   ```

   ).
3. Make your changes and commit them (```
   git commit -m 'Add some feature'
   ```

   ).
4. Push to the branch (```
   git push origin feature/YourFeature
   ```

   ).
5. Open a pull
