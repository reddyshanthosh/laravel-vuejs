#Follow the Laravel Documentation setup:
macOS: https://laravel.com/docs/10.x#sail-on-macos
Windows: https://laravel.com/docs/10.x#sail-on-windows

#Install Docker
curl -s "https://laravel.build/example-app" | bash
cd example-app
./vendor/bin/sail up

#Code
git clone git@uisgithub1.uis.edu:tllos1/foods.git

php artisan db:seed --class=Foodseeder

http://10.89.38.36/api/foods
