## How to run this project
#### Fadega Afa | u1114252

#### <span style="color:#f77f00">Directory Structure:</span>
<pre>
- project
  - app         <= [all scripts in this directory]
  - css
  - js
  - templates   <= [index.php and other templates are here]
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
1. If you are accessing it from a localhost the url would look like so:
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

**Search functionality**
This feature is being built. The most complex search query fetches data from four tables.

**Inserting data**
From the front end, you can add data to user table by signing up. You can also insert data to all tables.

**Deleting data**
From the front end, deleting a user from user table is possible. Deleting data from other tables in being built right now.

**Editing data**
From front end, you can edit data for user table. This will be built for all tables in few days.

**Dashboard**
A dashboard layout is ready to be plugged with the functional part of the website. I have a little more work to do with that.

**Cart feature**
This feature isn't ready yet.
## Responsive Design
The website site fully responsive. Menu bar and other parts of the website respond to the typical breaking point for the appropriate view port. Dashboard is responsive up until 768px only(so not friendly with extra small devices - old phones).
