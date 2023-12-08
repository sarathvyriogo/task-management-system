
**Project: PHP/MySQLi-Based Task Management System**

**Overview:**

The Task Management System is a robust solution designed to streamline project organization within a company. Tailored for three distinct user roles - Admin, Project Manager, and Regular Employee - the system offers versatile functionalities to meet the varied needs of each user type. Admins wield comprehensive control over the database, primarily focusing on the creation and management of system users. Project Managers play a pivotal role in overseeing project intricacies and monitoring progress, while Regular Employees actively participate by updating the status of their assigned tasks.

**System Functionality:**

1. **User Management:**
   - Exclusive to Admins and Project Managers.
   - Admins create and manage system users, defining their roles and access levels.
   - Project Managers initiate user creation during project setup, assigning roles and permissions.

2. **Project Initiation:**
   - Admins and Project Managers initiate new projects.
   - Essential project details, such as project name, description, and start/end dates, are provided.
   - During project creation, users (Admins/Project Managers) list and assign employees to handle project tasks.

3. **Task Assignment and Updates:**
   - Regular Employees have the ability to add and edit the status of tasks assigned to them.
   - Project Managers review these updates to assess task completion.

4. **Project Status Update:**
   - Project Managers are responsible for updating the overall project status based on the collective progress of tasks.
   - The system provides an overview of project status, making it easy to track project health.

### Admin Features:

#### Dashboard:

- **Project Status:**
  - Overview of the current status of all projects.
- **Project Progress:**
  - Summary of the progress made in ongoing projects.
- **Project Count:**
  - Total number of projects in the system.
- **Tasks Count:**
  - Total number of tasks across all projects.

#### Project Section:

- **Project Creation:**
  - Ability to create new projects.
  - Can add employees and project managers to the project during creation/updation.
- **Inside Project Task Creation:**
  - Creating tasks within a project.
- **Edit Task:**
  - Modify details of a task within a project.
- **Delete Task:**
  - Remove a task from a project.
- **Change Project Progress:**
  - Update the overall progress status of a project.
- **Change Task Progress:**
  - Update the progress status of individual tasks.
- **Delete Project:**
  - Remove an entire project from the system.

#### Task Section:

- **View Tasks:**
  - Access to a list of all tasks.
- **Edit Tasks:**
  - Ability to modify task details.
- **Delete Tasks:**
  - Remove tasks from the system.

#### User Section:

- **Create User:**
  - Create new users with different roles (Employee, Project Manager, Admin).
- **Edit User:**
  - Modify details of existing users.
- **Delete User:**
  - Remove users from the system.

### Project Manager Features:

#### Dashboard:

- **Project Status:**
- **Project Progress:**
- **Project Count:**
- **Tasks Count:**

#### Project Section:

- **Project Creation:**
  - Can only add employees to the project during creation.
- **Inside Project Task Creation:**
- **Edit Task:**
- **Delete Task:**
- **Change Project Progress:**
- **Change Task Progress:**
- **Delete Project:**

#### Task Section:
- **View Tasks:**
- **Edit Tasks:**
- **Delete Tasks:**

### Employee Features:

#### Dashboard:
- **Project Status:**
- **Project Progress:**
- **Project Count:**
- **Tasks Count:**

#### Task Section:
- **View Tasks:**
  - Access to a list of tasks assigned to the employee.
- **Edit Tasks:**
  - Ability to modify task details.
- **Delete Tasks:**
  - Remove tasks assigned to the employee.


**Technology Stack:**

The Task Management System has been created utilizing a technology stack that includes HTML, PHP/MySQL, CSS, JavaScript (leveraging jQuery/Ajax), and Bootstrap, along with the Admin LTE plugin for design enhancements.

**Instructions to Run:**

1. Clone the project.
2. Set up a local web server that supports PHP scripts.
3. Open the web-server database and create a new database named "tms_db."
4. Import the provided SQL file located in the database folder of the source code.
5. Copy and paste the source code to the directory where your local web server accesses your projects (e.g., 'C:\xampp\htdocs' for XAMPP).
6. Open a web browser and navigate to the project (e.g., [http://localhost/true]).

Admin Access:

- Email: admin@admin.com
- Password: Admin@123

Project Manager Access:

- Email: manager@manager.com
- Password: Manager@123

User Access:

- Email: user@user.com
- Password: User@123

Notes:

1. **Ensure Proper Permissions:**
   - Grant appropriate permissions to the `assets/uploads` directory to ensure the correct functioning of image uploads.
   - Proper permissions include allowing the web server (e.g., Apache, Nginx) to read and write to this directory.
   - This step is crucial for the system to handle image uploads seamlessly.

2. **Development Stage Caution:**
   - The project is currently in the development stage, and as such, it may encounter a few issues.
   - Continuous modifications and improvements are anticipated over time.

