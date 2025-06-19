#!/bin/sh

# تأكد من وجود APP_KEY
if [ ! -f .env ]; then
  cp .env.example .env
fi

# توليد مفتاح التطبيق إذا غير موجود
php artisan key:generate

# تنفيذ الترحيلات
php artisan migrate --force

# توليد مفاتيح Passport إذا غير موجودة
if [ ! -f storage/oauth-private.key ]; then
  echo "Generating Passport keys..."
  php artisan passport:keys
fi

# تشغيل السيرفر
php artisan serve --host=0.0.0.0 --port=8000
