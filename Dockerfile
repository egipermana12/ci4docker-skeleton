FROM dunglas/frankenphp

# Install PHP extensions
RUN install-php-extensions \
    pdo_mysql \
    mysqlnd \
	mysqli  \
    gd \
    intl \
    zip \
    opcache \
    mbstring \
    json \
    curl \
    simplexml


# Set working dir ke root CI4
WORKDIR /app

# Set env development agar listen port 80
ENV SERVER_NAME=":80"

# Expose port jika perlu (opsional, FrankenPHP sudah handle)
EXPOSE 80

