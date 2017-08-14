Installation instruction
1.	Copy script folder in your application
2.	Open script/config/config.php file
3.	Enter url till script folder e.g. http://yourdomain.com/path-till-script-folder/
4.	Enter database settings (hostname, dbname, username and pwd etc) 
5.	In your application, include the following file 
        require_once �script/ pdocrud.php�;
6.	Now you can create object of pdocrud class and run various function to generate crud table.



Please check documentation and demo folder for more details about how to use various function.

Demo folder contains demo database sql file and also some forms.

Each function reference is given in function file.


Description about folders

Script - It contains main script code. 
Demo - It contains some example forms
Documentation - It contains all dcoumentation related codes


Version 1.1- released
Initial release

Version 1.2- released
Fixed small bug for join statement
Added extra skins
Added french language
Added some more js plugins

Version 1.3- released
Added option of url in column formatting
PDOModel class support is added
Fixed bug related to pagination
Added more examples


Version 1.4- released
Added column switch operation
Added option to show left join data in view also
Many demo forms added
More plugins added
fixed bug related to join operation


Version 1.5- released
Recaptcha support
Option to add hidden fields to save against specific columns
Added option to add custom action buttons
fixed bug of select action hook data

Version 1.6 - released
Added more plugins
Image upload path will be added in the saved image url
Send form data on email - various template customization options

version 1.7 - released
Redirect to another url after form submission
Show/hide fields with conditional logic (this works with database fields only)
Added more options to format table columns (Sum, divide, merge etc)
bug fix - columns removed function is now working with the print function

version 1.8 - released
Advanced filter option is added
Added Option to specify col data from another table's column or array
Added option to Open insert,edit form directly in popup on button click (direct popup form was already there)
Added new column action url function to redirect to another page with primary key
Added more options to format table columns (date, string, number formatting)
Added more parameter options for jQuery date picker
Bug fix - Fixed a sqlite related bug in PDOModel part


Version 1.9 - released
Added crud table bulk data update operation to change values directly in crud table
Added option to import bulk data from csv, xml and excel file
Added function csvToArray(), excelToArray() and xmlToArray() to get these files data in array format
Added sumPerPage & sumTotal functions
Added new form elements e.g. slider, range picker etc. currently, it works one element per page
Added search operator to search using 'like', '>', '>=', '<','=<' etc, with default '=' operation.
Added one page template to show Form and Crud Table on single page.
Added various image functions (crop, resize, thumbnail, watermark, flip)

Version 2.0 
Add nested table and nested table in tabs feature
Added plugin ckeditor

Version 2.1 
Add more options to format table columns
fixed small bug related to responsive design
fixed bug related to sqlite

Version 2.2
Added sql server support ( >= 2012)
Added graphs/charts using direct code and plugin both 
Added function to set file upload/download folder instead of config
Added more plugins
Fixed small bug of inline edit position when checkbox column and id column is hidden
Fixed small bug related to sqlite
Fixed small bug related to php validation

version 2.3
Added Tags type field (fieldtype = tags)
Improved login management further by adding redirection
only after successfull login etc.
Added Event calendar mangement javascript plugin
Added button for delete and edit in view, also option 
to hide/show all these buttons
Added extra option to specify the columns for the view
form also.
Added a new portfolio section to autogenerate portfolio 
like format directly from database
Extra Option for whether to delete the join table data or not

bugs
fixed small bug related to table column formatting.
fixed small bug related to search.


Version 2.4
Added direct function for forgot password
Added Trigger insert/update/delete operation in other table based on the main table operation
Added Left side action buttons display
Added jQuery data table plugin to display sql render data more efficiently
Added date range/time range/ datetime range search by setting search column type i.e. now you can pass from and to dates.
Changes in sql render function - removed pagination/records per page/totalrecords display in default display
Added more callback events in insert and update (after_insert and after_update)

bug fixed
Removed double slashes from the url addition
fixed bug of sql render function for print/export