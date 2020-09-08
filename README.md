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

You can now see the pre-populated data by navigating to relevant tabs/buttons. Note that you can see user data only after you login.

**Search functionality with auto-complete feature**
A fully functional search feature has been added. This search pulls data from three tables (book, author, publisher) and displays relevant details from all the tables when a matching record is found. I have implemented an autocomplete feature where in which suggestions are pulled from a table if search pattern matches existing record.

**Inserting data**
From the front end, you can add(insert) data to user table by signing up. You can also add/insert data to all tables once you're logged in. Data insertion will only be done by admins. For now, everyone who is registered is able to add data.

**Deleting data**
From the front end, deleting data from all tables is possible. You've to be authorized to do so - thus this feature is only for  those who are logged in. As insertion, only admins will be able to perform this task later on.

**Editing data**
All signed in users can edit data. Like the delete and insert features, this feature will be available only for admins, but for now a member can do so.

**Dashboard**
A dashboard layout is ready to be plugged but not functional yet. I have a little more work to do with that.

**Comment and Cart feature**
Tese features aren't fully functional yet.
### <span style="color:#f77f00">Responsive Design</span>
The website site fully responsive except the search area (I am thinking of changing the layout - not done yet). Menu bar and other parts of the website respond to the typical breaking point for the appropriate view port. Dashboard is responsive up until 768px only(so not friendly with extra small devices - old phones).

#### <span style="color:#f77f00">Special files</span>
These
