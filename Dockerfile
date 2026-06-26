FROM php:8.2-cli

WORKDIR /app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

COPY composer.json ./
RUN composer dump-autoload -o --no-interaction

COPY package.json package-lock.json ./
RUN npm ci

COPY . .

RUN npm run build \
    && chmod +x start.sh docker-entrypoint.sh

EXPOSE 8000

CMD ["bash", "docker-entrypoint.sh"]
