## How to run this project
#### Fadega Afa | u1114252

#### <span style="color:#f77f00">Directory Structure:</span>
<pre>
- project
  - app         <= [all scripts in this directory]
    - libcommon.php
  - css
  - js
  - templates   <= [index.php and other templates are here]
    - index.php
- project.txt
- README.md
</pre>
For a successful execution, follow these steps sequentially. Assuming that you've opened the parent directory `Project` in cmd, do:
````
$ cd app
$ php install.php

````
This will create bookstore.sqlite3 database, 8 tables and populate the tables with sample data. Please run this file before trying to access the index.php file in a browser.

Success messages after executing the above command.
*1. Database creation: Success!
 2. Table(s) creation: Success, Eight tables created!
 3. Sample data insertion: Success!*

You may also see **PHP Warning:  Module 'mysqli'...** depending on your system configuration. Ignore this, I use Sqlite3/PDO for this project.
___

### <span style="color:#f77f00">Accessing the website(the web application through browser URL)</span>
1. If you are accessing it from a localhost, the url would look like so:
````
      localhost/Project/templates/index.php
````
2. If you have pushed this project online into a subdomain

````
    [subdomain].[your domain]/Project/templates/index.php
````
### <span style="color:#f77f00">First thing to do after accessing index.php on a browser</span>

This application has fully functionl login/logout system and ability to register as a new user.
- signup  and create a new user.
- signin with the details.

You can now see the pre-populated data by navigating to relevant tabs/buttons.

**Search functionality with auto-complete feature**
A fully functional search feature has been added. This search pulls data from three tables (book, author, publisher) and displays relevant details from all the tables when a matching record is found. I have implemented an autocomplete feature where in which suggestions are pulled from a table if search pattern matches existing record.

**Advanced search feature is implemented**
This search pulls data from multiple tables and displays info
in grid layout.

**Inserting data**
From the front end, you can add(insert) data to user table by signing up. You can also add/insert data to all tables once you're logged in.

**Deleting data**
From the front end, deleting data from all tables is possible. You've to be authorized to do so - thus this feature is only for  those who are logged in.

**Editing data**
All signed in users can edit data. Like the delete and insert features.

**Dashboard**
For loggedin users, a dashboard menu items is displayed on top. The dashboard features are not fully implemented. However, basic tasks of editing and deleting users, authors and books is integrated as part of it..


### <span style="color:#f77f00">Responsive Design</span>
The website site fully responsive except the search area (I am thinking of changing the layout - not done yet). Menu bar and other parts of the website respond to the typical breaking point for the appropriate view port. Dashboard is responsive up until 768px only(so not friendly with extra small devices - old phones).

#### <span style="color:#f77f00">Special files</span>
1. dbh.php
  - This is a database handler file. It creates the database.
2. dbsql.sql
  - This file is a pure sql command file which creates all tables.
3. libcommon.php
  - This script consists of functions that are accessed by many other scripts. For example, it consists a single function that inserts to all tables.
  It also has validation function and others.
4. install.php
  - This is the file that populated all the tables created by file mentioned in #2. This file should be executed before accessing index.php.
  - Run this file by typing: php install.php  from a CMD/terminal.

## <span style="color:#f77f00">Update (for final submission)</span>

•	A cover image for a book can be uploaded during insertion. If a cover isn’t added, an alternate text will be displayed along other details relevant of the book.
•	Cart feature has been implemented. This feature allows users to add and remove books to cart and tells them the total amount due. Note – the feature isn’t integrated with payment method(for mock purposes) thus there is no checkout option.
•	Simple search: a simple search was implemented on the second submission. This feature only performed a simple search based on a book title. It also comes with an autocomplete feature. Dr. Matthew indicated that the autocomplete feature was not working in the feedback, I tested it and it still works.
•	 Advanced Search:  I added a new feature for advanced search. This search is based on either one or all of the following fields – title, author name, and ISBN. Note that the fields aren’t from the same table – thus the search algorithm fetches data from multiple tables and displays the result in a separate page.
•	Book display: for public users, books are displayed in a grid format with details including cover photo. However, for registered users, an option to delete/edit is available, and the books are displayed in a table format too.
•	Delete and Edit buttons: The delete and edit buttons displayed in the frontend are not retrieved from the database. They are only included in a table display to correspond with each record so that when a user deletes or updates a record, then they know which records are being affected.
•	AJAX: I used AJAX for the autocomplete feature of the simple search.  The AJAX code is in the main.js file.
•	Dashboard: For loggedin users, a dashboard menu items is displayed on top. The dashboard features are not fully implemented. However, basic tasks of editing and deleting users, authors and books is integrated as part of it.
•	Recommendation: sample data gets inserted once you run the install.php script. However, it’s better to insert your own data and work with.
•	.htaccess: I have implemented a very basic configuration with htaccess. I used it to route everything through index.php and also throw a custom 404 page.
•	Images : cover images uploaded are stored in table column as blob data type.
•	Cover images: if install.php isn’t executed again, the images I have used for testing purposes all come from google.com. The images will be replaced with empty string once install.php is executed and you may want to update the cover photos or insert your own books with sample cover photo.
•	404 file: A custom - file not found (404) is included and configuration in the .htaccess has been set.
