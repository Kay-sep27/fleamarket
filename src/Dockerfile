# src/Dockerfile

FROM php:8.1-fpm

# 必要ライブラリのインストール
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer をコピー
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# ── 修正ポイント ─────────────────────────────
# まず全ファイルをコピー（artisan も含む）
COPY . .

# その上で Composer install
RUN composer install --no-dev --optimize-autoloader
# ─────────────────────────────────────────────

# パーミッション調整
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 9000
CMD ["php-fpm"]