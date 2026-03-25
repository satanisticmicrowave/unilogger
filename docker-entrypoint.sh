#!/bin/sh
set -e

echo "=== Applying Doctrine Migrations ==="
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration || true

if [ "$APP_ENV" = "prod" ]; then
    echo "=== Warming up cache ==="
    php bin/console cache:clear --env=prod
    php bin/console cache:warmup --env=prod
fi

echo "=== Starting services ==="
exec "$@"
