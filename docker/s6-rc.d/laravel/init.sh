#!/command/with-contenv sh

cd /var/www

echo "Laravel init started"
php artisan down

php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
php artisan storage:link
php artisan migrate --force
php artisan wf:setup
php artisan wf:sequences

echo "Laravel init done"
php artisan about
php artisan up
