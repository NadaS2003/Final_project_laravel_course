#!/bin/sh

php artisan config:clear
php artisan cache:clear
php artisan migrate --force

# تأكد من وجود مفاتيح Passport في /etc/secrets
if [ ! -f /etc/secrets/oauth-private.key ] || [ ! -f /etc/secrets/oauth-public.key ]; then
  echo "Passport keys not found in /etc/secrets. Please upload them as Secret Files."
  exit 1
fi

# تشغيل السيرفر
php artisan serve --host=0.0.0.0 --port=8000
