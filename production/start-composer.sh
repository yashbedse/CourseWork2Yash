#!/bin/bash

# ----------------------------------------------------------------------
# Create the .env file if it does not exist.
# ----------------------------------------------------------------------

if [[ ! -f "../.env" ]] && [[ -f "../.env.example" ]];
then
cp ./app/.env.example /app/.env
fi

# ----------------------------------------------------------------------
# Run Composer
# ----------------------------------------------------------------------

if [[ ! -d "../vendor" ]];
then
cd ./app
composer install
composer dump-autoload -o
fi
