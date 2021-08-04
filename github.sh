#!/bin/sh

git fetch --all
git reset --hard origin/master
git checkout master
git pull origin master

chmod -R 777 storage/
chmod -R 777 bootstrap/cache/
chmod -R 777 github.sh

php artisan optimize
