#!/bin/sh

# توليد المفتاح إذا مش موجود
if [ ! -f storage/oauth-private.key ]; then
  echo "Generating passport keys..."
  php artisan migrate --force
  php artisan passport:keys
fi

# تشغيل Laravel
php artisan serve --host=0.0.0.0 --port=8000
