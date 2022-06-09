#!/command/with-contenv sh

echo "Laravel init started"

cd /var/www

php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
php artisan migrate --force
php artisan wf:update-translations

echo "Laravel init done"
