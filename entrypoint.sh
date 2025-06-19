#!/bin/sh

php artisan config:clear
php artisan cache:clear
php artisan migrate --force

# توليد مفاتيح Passport إن لم تكن موجودة
if [ ! -f storage/oauth-private.key ]; then
  mkdir -p storage/oauth
  php artisan passport:keys
fi

# تشغيل السيرفر
php artisan serve --host=0.0.0.0 --port=8000
