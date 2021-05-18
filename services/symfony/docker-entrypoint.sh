#!/bin/bash

/wait

echo -e "\n- Start doctrine migration"

cd /var/www/symfony
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
php bin/console cache:clear
chmod 777 -R ./var

echo -e "\n- Symfony is ready !"

exec "$@"