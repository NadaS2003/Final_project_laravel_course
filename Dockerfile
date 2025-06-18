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

# تثبيت تبعيات Laravel
RUN composer install --optimize-autoloader --no-dev

# صلاحيات Laravel
RUN chmod -R 755 storage

# فتح البورت
EXPOSE 8000

# أمر التشغيل
CMD php artisan serve --host=0.0.0.0 --port=8000
