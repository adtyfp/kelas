FROM php:8.2-cli

# Copy semua file ke image
COPY . /var/www/html

WORKDIR /var/www/html

# Jalankan server bawaan PHP
CMD ["php", "-S", "0.0.0.0:10000"]
