#!/bin/bash

# ----------------------------------------------------------------------
# Create the .env file if it does not exist.
# ----------------------------------------------------------------------

if [[ ! -f "/application/.env" ]] && [[ -f "/application/.env.example" ]];
then
cp /application/.env.example /app/.env
fi

# ----------------------------------------------------------------------
# Run Composer
# ----------------------------------------------------------------------

if [[ ! -d "/application/vendor" ]];
then
cd /app
composer install
composer dump-autoload -o
fi
