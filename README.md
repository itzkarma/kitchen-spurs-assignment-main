# Task Management App API

This is a simple Task Management App API built using PHP (Laravel) and MySQL. The API allows users to manage tasks, including creating, updating, deleting, and viewing tasks. Each task has a title, description, due date, and status (e.g., pending, in progress, completed).

## Requirements

1. **User Authentication:**
   - Implement a login mechanism.
   - Signup API is not required. Use a seeder to insert dummy users into the database.

2. **Task Listing:**
   - Retrieve a list of tasks, with options for filtering by status, date, and assigned user.
   - Implement functionalities for creating, updating, and deleting tasks.

3. **Task Assignment:**
   - Allow the assignment of multiple users to a task.
   - Provide the ability to unassign a user from a task.
   - Allow users to change the status of a task.

4. **User-Specific Task Lists:**
   - Provide a list of tasks assigned to a particular user.
   - Display a list of tasks assigned to the currently logged-in user.

## Setup and Usage

### Prerequisites:
- PHP installed on your system.
- Composer installed for managing PHP dependencies.
- MySQL database server installed and running.

### Steps to Set Up and Run the Project:

1. **Clone the Repository:**
```git clone <repository_url>```

2. **Install Dependencies:**

``` 
cd task-management-api
composer install
```

3. **Database Configuration:**
- Create a MySQL database for the application.
- Configure the database connection settings in the `.env` file.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

4. **Generate Application Key:**
```php artisan key:generate```

5. **Run Migrations and Seeders:**

```
php artisan migrate
php artisan db:seed --class=UserSeeder
```

6. **Serve the Application:**
```php artisan serve```

7. **API Endpoints:**
- **User Authentication:**
  - `POST /api/auth/login`: Endpoint for user login.
- **Tasks:**
  - `GET /api/tasks`: Retrieve a list of tasks.
  - `POST /api/tasks`: Create a new task.
  - `PUT /api/tasks/{task_id}`: Update an existing task.
  - `DELETE /api/tasks/{task_id}`: Delete a task.
  - `POST /api/tasks/{task_id}/assign-users`: Assign users to a task.
  - `POST /api/tasks/{task_id}/unassign-user`: Unassign a user from a task.
  - `POST /api/tasks/{task_id}/change-status`: Change the status of a task.
- **User-Specific Task Lists:**
  - `GET /api/tasks/assigned-to-me`: Retrieve tasks assigned to the currently logged-in user.
  - `GET /api/tasks/user/{user_id}`: Retrieve tasks assigned to a specific user.

8. **Testing:**
Test the API endpoints using tools like Postman or cURL.

### Additional Notes:
- Check the `APP_URL` in `.env` before running API endpoints.
- Ensure your MySQL server is running before running migrations.
- Update `.env` with appropriate configurations, especially the database connection details.
- Customize routes, controllers, and models as per your requirements.

By following these steps, you should be able to set up and run the Task Management App API successfully. If you encounter any issues, feel free to ask for assistance to my mail address: aashishpoojari777@gmail.com
