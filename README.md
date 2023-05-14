# Registration Portal System

The Registration Portal System is a web-based application that provides users with a convenient way to manage their course registration and enrollment. This system allows users to view available courses, add courses to their enrollment, and remove courses from their enrollment. It also provides features for listing courses by semester and displaying the courses in which the user is currently enrolled.

## Features

- List of Courses by Semester: Users can view a list of courses offered during different semesters. They can select a semester from a dropdown menu, and the system dynamically displays the corresponding courses.

- Enrolled Courses: Users can see the courses in which they are currently enrolled. The system retrieves and displays this information from the database.

- Add Courses: Users can add courses to their enrollment using a user-friendly form. The form includes fields for student ID, course selection, and a course description. The course description is dynamically updated based on the selected course.

- Delete Courses: Users can remove courses from their enrollment. The system provides a dropdown menu of registered courses, allowing users to select the course they want to delete.

## Technologies Used

- PHP: The server-side scripting language used for the backend implementation.

- MySQL: The database management system used for storing and retrieving course and user information.

- HTML/CSS: The markup and styling languages used for creating the user interface.

- Bootstrap: The front-end framework used for responsive and visually appealing design.

- JavaScript: Used for dynamic content updates and form interactivity.

## Prerequisites

To run the Registration Portal System locally, ensure you have the following prerequisites installed:

- Web server software (e.g., Apache, Nginx)
- PHP (version 7 or higher)
- MySQL database
- Compatible web browser

## Installation

1. Clone the repository to your local machine:

```bash
git clone https://github.com/k32ng/registrationPortal.git
```

2. Configure the database connection by updating the `config.php` file with your database credentials.

3. Import the database schema by running the SQL script provided (`database.sql`) into your MySQL database.

4. Start your web server and navigate to the project directory in your web browser.

5. You should now be able to access and use the Registration Portal System.

## Contributing

Contributions are welcome! If you find any bugs or have suggestions for improvements, please open an issue or submit a pull request. Make sure to follow the project's code style and guidelines.

## License

N/A

## Acknowledgments

- [Bootstrap](https://getbootstrap.com) - Front-end framework for responsive design.
- [W3Schools](https://www.w3schools.com) - Web development tutorials and resources.

## Contact

For any inquiries or support, please contact the project maintainer at kendricgarmon.dev@gmail.com
