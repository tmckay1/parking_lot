# parking_lot_app
The project utilizes PHP, MySQL, JavaScript, HTML, and CSS to complete the requirements. No frameworks were used outside of jQuery and BootStrap, so all of the code is written by myself. I did utilize some common boilerplate code from another project of mine that is not yet complete. A lot of the framework structure I had to add ad hoc during the 4 hour challenge. 

## Future Changes
Most of the code is written well, but for the JS, I would have liked to change a few things given a larger amount of time. This code still needs to be improved upon for obvious reasons. The JS could be taken out into separate classes. Also, upon updating the database in the backend, the page does not reflect the available space changes in the front of the page. I would have also liked to implement ReactJS, but I am not too familiar with the framework to use it in a 4 hour challenge.

## How to Setup on Your Local
You can set this up on your local by running MAMP, or WAMP. I use MAMP. Once that is setup, you'll want to make sure it is hosting the server through port 80. You can probably just run the services manually if you have that setup already, MAMP just makes it easier. The versions of the services that I used are MySQL Server 5.5.42, PHP 5.6.10, and Apache 2.2.29. It may be helpful to change the base directory Apache points to to http://localhost/

Once the services are setup, you can download/clone the project. The project NEEDS to be cloned to a folder pl/ inside of the base directory. So to visit the site, you will go to http://localhost/pl/index.php. Once this is done, you need to dump the database file I provided in the base directory parking_lot_app.sql. After doing this, you'll need to change /pl/inc/config.php and provide the correct login information to your MySQL server. The plain text passwords would actually be in an encrypted file for security reasons if this were a real application. Once that is setup, you should be good to go running the application.

## How the Code is Setup 
The basic file structure has files that are more or less resources (.js, .css, .jpg, etc.), which are stored in the /inc folder in the base directory. I did take someone else's Autoload.php file from a Wordpress theme, which I put in /inc/vendor/, so that is not my code. This folder has include files that setup constants I use throughout the application, and it includes a Debugger I made. The debugger is very simple but can be expanded in the future. The debugger outputs the contents of a variable when in debug mode (GET[dbg] is set, you can see this in include.php).

The /fw directory is a directory I'm using as an interface bewteen the JavaScript front end and the PHP backend. All JS asynchronous requests will go through this page. 

The /parking folder is the meat of the application. This is where the logic and different models go. I basically setup an MVC from scratch, but it is not fully an MVC yet. Some other things need to be done before it can be considered that. Each page should be made with a class that subclasses Page.php. This class will indicate the css and js to include in the HTML header. It has a base function which outputs all the HTML to the screen. It does this by calling an action on the controller for that page.

The controllers are supposed to be used as that. They are to retrieve data, fill a view with that data and output it to the screen. The controller will use the models to get information about a specific record from the MySQL database. The logic for some of the data retrieval could be outsourced to other classes for HomeController, but for the sake of time, I did not do this. I have also made a Service folder which acts as a service for database retrieval. 
