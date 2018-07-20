## Live web chat application


![Screenshot](https://raw.githubusercontent.com/diamond95/LiveChat/master/2.png)

## Installing

Upload **chat.sql** to your server / localhost (check **database_connection.php** for details).

If you are going to have limited users with some passwords use http://www.passwordtool.hu/php5-password-hash-generator to hash passwords and store into table login.

Otherwise if you are going to make **register** page as you wish use php5 function: 
```php
                     password_hash();
```
### Todos

Open database_connection.php 
 - Line 2: (connection to database)
Change it using your database name, username and password. 
 - Line 3:
 ```php
         date_default_timezone_set('Your location goes here');
```
Change your location using (http://php.net/manual/en/timezones.php) this link. 


## Authors
      Ivan Miljanić


License
----

      MIT


**Free Software, Hell Yeah!**

      Run login.php and have fun. :) 


## Donations
---
      If this project help you reduce time to develop, you can give me a cup of coffee :)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](ivanvk95@gmail.com)

