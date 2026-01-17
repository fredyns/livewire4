# laravel deploy scripts

# reset files to  latest git commit
git reset --hard HEAD
git pull

# update dependencies
composer install
npm install

# first time setup
php artisan storage:link  # used for livewire temp
php artisan key:generate

# laravel setup
php artisan livewire:publish --assets

# database
php artisan migrate:status
php artisan migrate
# php artisan migrate:fresh --seed # --force

# tune up
composer dump-autoload -o
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan event:cache
#php artisan icons:cache
npm run build

# supervisor
#supervisorctl status
#supervisorctl reread
#supervisorctl update
#supervisorctl restart all
#supervisorctl status
