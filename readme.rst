#####################
What is NISL CI Demo?
#####################

The NISL CI Demo is kind of a starter kit to help the developers 
to build web sites using CodeIngiter MVC Framework. Its goal is to enable developers to develop any CodeIgniter project from scratch by using this demo as a base so that they don't need to develop some of the basic functionalities every time. It uses the CodeIgniter best practices to be followed, so that the developers can refer & follow the same throughout the project to make the project more flexible for future. It has some basic moduled pre-developed which can be inherited for all similar kind of modules. 

*******************
System Requirements
*******************
PHP version 5.6 or newer is recommended.
Codeigniter version 3.x.x is recommended.

************
Installation
************
- Clone or download this demo to your server.
- Rename it to your project name. 
- Database SQL (nisl_ci_demo.sql) is included at the code root folder. Create a database with this sql file.
- Change the config.php & databases.php accordingly. 


*********************************
What is included in NISL CI Demo?
*********************************
- **Authentication in Admin Area:** Login, Forgot Password, Remember Me, Edit Profile, Change Password. 
  SignUp, Login, Forgot Password, Remember Me features for normal users. 
- **CRUD Modules in Admin Area:** Two CRUD modules (Categories, Projects) with basic features like search & pagination. These can be used as reference. Any new CRUD Modules can be created quickly by using these modules as base.
- **Users Module in Admin Area:** User Management module with possible information. It can be used as a base & can be extended as per the project requirement.
- **Roles Module in Admin Area:** A basic role module to manage roles & user permissions based on the roles. This module can be extended as per the project requirement or can be removed completely if there is no need of it. 
- **Email Templates Module in Admin Area:** A Email Template module to manage "Sign Up" & "Forgot Password" Email content from the admin area. This module can be extended as per the project requirement or can be removed completely if there is no need of it. 
- **Settings Module in Admin Area:** A basic settings module to manage website level settings from the admin area. This module can be extended as per the project requirement or can be removed completely if there is no need of it .
- **Authentication in users Area:** Sign Up, Login, Forgot Password, Remember Me.
- **Multiple Theme concept in users Area:** Default theme & a sample(Jupiter) theme as reference.

***************************************************************************
Additional Files or Directories added on the top of Fresh CodeIgniter code.
***************************************************************************
- **/limitless.zip:** (must be removed from the actual project)
- **/nisl_ci_demo.sql:** (to be restored in the database)
- **application/config/email.php:** (for email configuration) 
- **application/controllers/admin/<9-controllers>:** (contains all controllers of admin area)
- **application/controllers/Authentication.php:** (for users side authentication)
- **application/controllers/Home.php:** (Basic controller for front-side)
- **application/core/MY_Controller.php:** (base controller to be used globally by entire system)
- **application/core/Admin_Controller.php:** (another base controller derived from MY_Controller which will contain all common methods to be used from admin side controllers)
- **application/core/Frontend_Controller.php:** (another base controller derived from MY_Controller which will contain all common methods to be used from users side controllers)
- **application/core/MY_Model.php:** (base model to be used by all the models)
- **application/helpers/admin_helper.php:** (for admin related common functions to be used from anywhere in the code)
- **application/helpers/general_helper.php:** (for common general  functions to be used from anywhere in the code)
- **application/helpers/mail_helper.php:** (for common mail related functions to be used from anywhere in the code)
- **application/helpers/theme_helper.php:** (for common theme related functions to be used from anywhere in the code)
- **application/helpers/time_helper.php:** (for common time related functions to be used from anywhere in the code)
- **application/helpers/general_helper.php:** (for common users related functions to be used from anywhere in the code)
- **application/language/english/english_lang.php:** (contains the words/sentences for English language)
- **application/libraries/Template.php:** (used in the front-end user side for templating & theme feature)
- **application/models/<10 Models Files>:** (for different entities)
- **application/views/admin/<multiple folders & files for admin views>:**
- **application/views/themes/default/:** (all front-end side views are managed in this as default theme)
- **application/views/themes/jupiter/:** (one sample theme created which is different from default just to have the theme concept. If there is no theme in actual project, this folder can be removed completely)
- **assets/admin/:** (all admin related assets are added here)
- **assets/themes/default:** (all default theme front-end side assets are added here)
- **assets/themes/jupiter:** (all jupiter theme front-end side assets are added here)
	  
	  
