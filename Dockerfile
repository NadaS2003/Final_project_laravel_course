FROM php:8.2-cli

# تثبيت الأدوات المطلوبة وامتدادات PHP
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl bcmath

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تعيين مجلد العمل
WORKDIR /var/www

# نسخ ملفات المشروع
COPY . .

# تثبيت الحزم
RUN composer install --no-dev --optimize-autoloader

# نسخ ملف البيئة
RUN cp .env.example .env

# إعداد صلاحيات التخزين
RUN mkdir -p storage/oauth && chmod -R 755 storage bootstrap/cache

# نسخ ملف entrypoint وتشغيله بصلاحية تنفيذ
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# فتح المنفذ 8000
EXPOSE 8000

# تشغيل Laravel من خلال entrypoint
ENTRYPOINT ["/entrypoint.sh"]
