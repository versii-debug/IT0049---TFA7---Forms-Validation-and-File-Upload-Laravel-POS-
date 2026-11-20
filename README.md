Extension of the TFA6 Laravel POS application, adding Create, Edit, and profile picture upload features for customer and user management.

Requires PHP 8.2 or newer with PDO SQLite, GD, mbstring, and XML/DOM enabled.

Run

Open a terminal in the extracted TFA7 folder. Then run the commands below:
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve

Open http://127.0.0.1:8000/