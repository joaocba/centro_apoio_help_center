# Centro Apoio Web App

The Centro Apoio Web App is a comprehensive help center with a ticket system, built using HTML, CSS, Bootstrap 5, PHP, and MySQL. It provides a solution for managing customer support tickets, knowledge base articles, and user administration.

This was developed as a final project for course "Tecnologias e Programação de Sistemas de Informação (TeSP)" of ISLA Santarém 

## Features

- **Home Page**: An informative page that provides an overview of the help center's services and features with a language selector.

- **About Page**: Detailed information about the help center, its mission, and goals.

- **Contact Page**: A contact form for users to submit queries or requests.

- **Login Portal**: A secure login portal for users to access their accounts. Also provide a new account registration feature.

![Alt text]([/screenshots/main_page_header](https://github.com/joaocba/centro_apoio_help_center/blob/main/screenshots/main_page_header.png)?raw=true "Main Page Header")

### User Functionality (Backoffice)

- **Ticket Management**: Registered users can open support tickets, view their status, and receive assistance.

- **Knowledge Base Integration**: The ticket system features a knowledge base that automatically matches user-entered keywords with relevant articles.

### Agent Functionality (Backoffice)

- **Ticket Management**: Support agents can open and close tickets, respond to user inquiries, and provide assistance.

- **Ticket Statistics**: Agents have access to statistics and performance metrics to track their progress.

### Administrator Functionality (Backoffice)

- **User and Agent Management**: Administrators can manage users and agents within the system.

- **Knowledge Base Management**: Administrators can add, edit, and delete knowledge base articles.

- **Internal Contacts**: Administrators can maintain internal contacts for agents.

## Installation and Setup

To run the Centro Apoio Web App locally, follow these steps:

1. Clone the repository to your local machine.

2. Set up a web server environment such as XAMPP or WAMP.

3. Import the provided database file, `centro_apoio_lite.sql`, into your MySQL database server.

4. Configure the necessary database credentials in the app's configuration files.

5. On file "page-head.php" from directory "components" change the root path to correct one '<base href="http://localhost/centro_apoio/centro_apoio/root/" />'

6. Access the web app through your preferred web browser.


## Default logins

This are the default logins for the application:

##### User: user@user.com / Useruser1
##### Agent: agent@agent.com / agent
##### Admin: admin@admin.com / admin

## License

This project is licensed under the [MIT License](LICENSE).


## Acknowledgements

- [Bootstrap](https://getbootstrap.com): An open-source CSS framework that provides responsive design and UI components.

- [PHP](https://www.php.net): A popular server-side scripting language used for web development.

- [MySQL](https://www.mysql.com): An open-source relational database management system used for storing data.
