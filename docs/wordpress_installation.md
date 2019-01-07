# Wordpress Installation on Bluehost

1. Go to [Bluehost.com](http://bluehost.com).
1. Click on _Control Panel Login_.
1. Enter your domain and password then click _Login_.
1. Under _Databases_ click _MySQL Databases_.

## Create the Database

1. Next, under _Create New Database_ enter in the name you would like to call your database.
1. Click _Create Database_.
1. Once the page reloads take note of your database name, as you will need it later.
1. Click _Go Back_.

## Create a MySQL User

1. Once back on the MySQL Databases page, scroll down To _MySQL Users_.
1. Create a Database Username and Password.
1. Click _Create User_.
1. Once the page reloads take note of your user and password, as you will need it later.
1. Next you will need to Define the privileges the user you just created will have. This will enable you to interact with the database and set up WordPress.
1. Click _Go Back_.

## Define User Privileges

1. Once back on the MySQL Databases page, scroll back down To _MySQL Users_.
1. Under _Add User to Database_, select the user you just created from the _User_ drop-down menu then select the Database you created earlier from the _Database_ drop-down menu.
1. Click _Add_
1. After the page reloads check the _All PRIVILEGES_ check box and click _Make Changes_.
1. That’s it, you may now log out of Bluehost.

## Installing WordPress

1. If you haven’t yet, goto [http://wordpress.org/](http://wordpress.org/) and click the _Download WordPress_ button.
1. Once the wordpress.zip file downloads, double-click it to expand the wordress folder.
1. Open the wordpress folder and change `wp-config-sample.php` to `wp-config.php`
1. Next open `wp-config.php` in your favorite text editor and find the following field and fill them in accordingly.
    ```sql
    -- REPLACE database_name_here WITH THE DATABASE NAME YOU CREATED WITH BLUEHOST
    define(‘DB_NAME’, ‘database_name_here’);
    -- REPLACE username_here WITH THE USER YOU CREATED WITH BLUEHOST
    define(‘DB_USER’, ‘username_here’);
    -- REPLACE password_here WITH THE PASSWORD YOU CREATED WITH BLUEHOST
    define(‘DB_PASSWORD’, ‘password_here’);
    ```

Add Additional Security

1. To add additional Security to your WordPress install you will want to change your Authentication Unique Keys and Salts.
1. To change these keys visit [https://api.wordpress.org/secret-key/1.1/salt/](https://api.wordpress.org/secret-key/1.1/salt/)
1. Once the page loads you will see 8 unique keys/salts. Find the appropriate fields in your `wp-config.php` and replace them with the keys/salts generated on this page.
1. Save the `wp-config.php`

## Upload WordPress to your Server

1. If you haven’t set up FTP on your Bluehost account yet read this. [http://www.ejhansel.com/setup-ftp-on-bluehost-com/](http://www.ejhansel.com/setup-ftp-on-bluehost-com/)
1. Open up your favorite FTP client and connect to your site/server.
1. If you want WordPress in a directory on your site (Ex: www.mycoolsite.com/wordpress) change the wordpress folder to whatever you want the directory called and upload it to your server.
1. If you don’t want WordPress installed in the root directory (Ex: www.mycoolsite.com) then select all the files in the wordpress folder and upload them to your server.
1. After your WordPress files are uploaded you need to install it. If you have uploaded the files to your root folder goto `http://www.yoursitename.com/wp-admin/install.php`
1. If you uploaded it to a directory on your site goto `http://www.yoursitename.com/yourDirectoryName/wp-admin/install.php`
1. If all goes well, you will come to the WordPress welcome screen. Fill in your Site Title, the Username you want to use (DON’T USE ADMIN FOR SECURITY REASONS), your Password, your Email and click _Install WordPress_.
1. Once the screen reloads you should come to the **WordPress Success!** page. Click _Log In_ then fill in your Username and Password and click _Log In_ again.
1. Congratulations, you just set up WordPress.

## In Class Notes

1. Use the Bluehost FTP admin panel instead of FTP desktop software for simplicity and consistency. **Labeled _File Manager_** in the dashboard.
1. It's recommended to upload the Wordpress files as a zip file, and then perform the extraction on the server. Otherwise the upload process will be painfully slow due to the number of small files and the number of students all uploading at the same time. Therefore:
    1. Download wordpress.zip file
    1. Upload the zip file to individual Bluehost accounts
    1. Extract contents of the zip file
    1. Rename config file
    1. Edit config file on the server

#### References

- [http://www.ejhansel.com/installing-wordpress-on-bluehost-com/](http://www.ejhansel.com/installing-wordpress-on-bluehost-com/)
