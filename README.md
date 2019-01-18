# REST API in PHP

## How to:

1. Run .sql script into mysql database to create and fill tables.
2. Edit database.php with your database credencials.
3. run php server
  $ sudo php -S localhost:9000

4. Using Postman:


GET method:
http://localhost:9000/PHP_REST_API/api/post/read_single.php?id=3
http://localhost:9000/PHP_REST_API/api/post/read.php


### On Headers tab use: 'Content-Type' as key and value  'application/json' (without quotes)


POST method:
http://localhost:9000/PHP_REST_API/api/post/create.php

e.g:
{
 "title":"some title",
 "body":"lore ipsum...",
 ...
}


PUT method:
http://localhost:9000/PHP_REST_API/api/post/update.php

e.g:
{
 "title":"some other title ",
 "body":"lore ipsum xxx...",
 "id":3
 ...
}

DELETE method:
http://localhost:9000/PHP_REST_API/api/post/delete.php

e.g:
{
 "id":3
}

### Based on bradtraversy/php_rest_myblog
Thank you for sharing.
