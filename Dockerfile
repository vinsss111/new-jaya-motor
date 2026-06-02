# Menggunakan image PHP 8.2 versi CLI (Tanpa Apache bawaan agar tidak konflik)
FROM php:8.2-cli

# Install dependensi sistem dasar yang diwajibkan oleh CodeIgniter 4
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP yang dibutuhkan untuk koneksi TiDB/MySQL dan fungsi web
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install intl mysqli gd opcache

# Salin seluruh source code proyek ke dalam container
COPY . /var/www/html

# Masuk ke direktori kerja utama
WORKDIR /var/www/html

# Pasang Composer dan unduh library vendor secara optimal
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Setel hak akses folder writable agar CI4 bisa menulis log dan cache
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 775 /var/www/html/writable

# Daftarkan Port 80 untuk lalu lintas jaringan global Railway
EXPOSE 80

# Jalankan PHP server internal yang mengarah langsung ke folder public CodeIgniter 4
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]