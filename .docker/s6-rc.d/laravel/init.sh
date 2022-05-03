#!/command/with-contenv sh

echo "Laravel init started"

cd /var/www

php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

echo "Laravel init done"
