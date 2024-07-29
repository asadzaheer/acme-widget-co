# docker/Dockerfile

FROM php:8.2-cli

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHPStan
RUN composer global require phpstan/phpstan

# Set working directory
WORKDIR /app

# Copy application code and entrypoint script
COPY . /app
COPY docker/entrypoint.sh /docker/entrypoint.sh

# Make the entrypoint script executable
RUN chmod +x /docker/entrypoint.sh

# Install PHP dependencies
RUN composer install

# Make Composer and PHPStan available globally
ENV PATH="/root/.composer/vendor/bin:${PATH}"

# Entry point for the container
ENTRYPOINT ["/docker/entrypoint.sh"]
