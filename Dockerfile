FROM php:8.2-cli

# تثبيت الأدوات المطلوبة
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# مجلد العمل
WORKDIR /var/www

# نسخ الملفات
COPY . .

# نسخ ملف البيئة
RUN cp .env.example .env

# توليد مفتاح التطبيق (مطلوب قبل passport)
RUN composer install --no-dev --optimize-autoloader
RUN php artisan key:generate

# صلاحيات التخزين
RUN chmod -R 755 storage

# فتح المنفذ
EXPOSE 8000

# تشغيل Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000

# نسخ ملف entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# أمر التشغيل الجديد
CMD ["/entrypoint.sh"]
