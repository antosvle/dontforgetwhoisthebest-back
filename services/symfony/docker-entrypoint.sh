#!/bin/bash

/wait

echo -e "\n- Start doctrine migration"

cd /var/www/symfony
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

echo -e "\n- Symfony is ready !"

exec "$@"