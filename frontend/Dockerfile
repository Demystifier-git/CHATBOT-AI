# Stage 1: Builder
FROM php:8.2-apache-bookworm AS builder

RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg62-turbo-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
 && docker-php-ext-configure gd --with-jpeg \
 && docker-php-ext-install gd mysqli pdo pdo_mysql \
 && a2enmod rewrite status \
 && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY . .

# Stage 2: Runtime
FROM php:8.2-apache-bookworm AS runtime

RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng16-16 \
    libjpeg62-turbo \
    libonig5 \
    libxml2 \
 && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/
COPY --from=builder /var/www/html /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]

