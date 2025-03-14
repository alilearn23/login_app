FROM php:8.0-apache

# تثبيت MySQLi
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# نسخ المشروع إلى المسار الصحيح
COPY . /var/www/html/

# ضبط صلاحيات الملفات
RUN chown -R www-data:www-data /var/www/html/

# فتح المنفذ 80
EXPOSE 80

# تشغيل Apache في المقدمة
CMD ["apache2-foreground"]
