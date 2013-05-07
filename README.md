Rest API For Wordpress
======================

The REST API plugin for Wordpress.

How To Use It
=============
1. Clone or download into your Wordpress project folder
2. Extract it, into "api" folder
	- api/
	- wp-admin/
	- wp-content/
	- wp-includes/
3. Then you are finish :)

API Endpoint
============
Getting the recent post.
------------------------

url: http://yourdomain.com/api/index.php/recent/:paged

example: http://yourdomain.com/api/index.php/recent/1

method: GET

param: :paged for showing the content in "x" page.

Getting the category.
---------------------
url: http://yourdomain.com/api/index.php/category

method: GET

param: none

Getting the post detail.
------------------------
url: http://yourdomain.com/api/index.php/post/:id

example: http://yourdomain.com/api/index.php/post/403

method: GET

param: :id is a post id

Getting the post by category.
-----------------------------
url: http://yourdomain.com/api/index.php/category/:id

example: http://yourdomain.com/api/index.php/category/2

method: GET

param: :id is a category id

License
=======
This project is licensed under the MIT license.