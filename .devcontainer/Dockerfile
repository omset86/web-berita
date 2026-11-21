FROM mcr.microsoft.com/devcontainers/php:8.4

# Install dependensi sistem untuk kompilasi ekstensi
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -y libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev \
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# Konfigurasi dan install ekstensi PHP wajib Laravel & Filament 5
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) intl zip gd bcmath pdo_mysql