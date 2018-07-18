Database name: chat
Username: root
Password: 
Host: localhost

Upload chat.sql to your server / localhost 
If you are going to have limited users with some passwords use http://www.passwordtool.hu/php5-password-hash-generator to hash passwords and store into table login.
Otherwise if you are going to make register page as you wish use php5 function 'password_hash()'.


First open database_connection.php 

At line 2 is connection to database. Change it using your database name, username and password. 

At line 3: date_default_timezone_set('Your location goes here');  - Change your location using (http://php.net/manual/en/timezones.php) this link. 



login.php details(currently) 
username: admin
password: admin


username: test
password: admin


username: user
password: admin



Run login.php and have fun. :) 

