# Menggunakan image PHP resmi dengan Apache berbasis Debian (sangat stabil untuk CI4)
FROM php:8.2-apache

# Install ekstensi sistem yang dibutuhkan CodeIgniter 4 (ICU untuk intl, libpng untuk GD, dll)
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install dan aktifkan ekstensi PHP yang diwajibkan CI4 & TiDB Cloud (mysqli)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install intl mysqli gd opcache

# Aktifkan modul mod_rewrite Apache agar routing URL CodeIgniter berjalan mulus (tanpa index.php)
RUN a2enmod rewrite

# Ubah Document Root Apache agar mengarah secara ketat ke folder public milik CI4
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Salin seluruh source code aplikasi ke dalam container server
COPY . /var/www/html

# Pasang Composer untuk mengelola package manager jika dibutuhkan
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Berikan hak akses penuh (permission) ke folder writable agar CI4 bisa menulis log/cache
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 775 /var/www/html/writable

# Buka port standar HTTP
EXPOSE 80

# Jalankan Apache di foreground
CMD ["apache2-foreground"]