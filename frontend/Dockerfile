# Stage 1: Builder
FROM php:8.2-apache-bullseye AS builder

# Install build deps
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
 && docker-php-ext-configure gd --with-jpeg \
 && docker-php-ext-install gd mysqli pdo pdo_mysql \
 && a2enmod rewrite status \
 && rm -rf /var/lib/apt/lists/*

# Copy app source
WORKDIR /var/www/html
COPY . .

# Stage 2: Runtime (slim, no build tools)
FROM php:8.2-apache-bullseye AS runtime

# Install only runtime deps (not build tools)
RUN apt-get update && apt-get install -y \
    libpng16-16 \
    libjpeg62-turbo \
    libonig5 \
    libxml2 \
 && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy compiled PHP extensions & app
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/
COPY --from=builder /var/www/html /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
