#!/command/with-contenv sh

cd /var/www

echo "Laravel init started"
php artisan down --render="errors::503"

php artisan migrate --force
php artisan wf:install
php artisan wf:translations
php artisan wf:sequences
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
php artisan storage:link

echo "Laravel init done"
php artisan about
php artisan up
