#!/usr/bin/env bash
set -e

echo "=== Caching config/routes/views ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Running database migrations ==="
php artisan migrate --force

echo "=== Creating storage symlink ==="
php artisan storage:link --force

echo "=== Starting server on port $PORT ==="
php artisan serve --host=0.0.0.0 --port=$PORT
