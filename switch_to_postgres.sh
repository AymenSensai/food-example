#!/bin/bash

# Default values
DEFAULT_DB_HOST="127.0.0.1"
DEFAULT_DB_PORT="5432"
DEFAULT_DB_DATABASE="food"
DEFAULT_DB_USERNAME="postgres"

echo "------------------------------------------------"
echo "Switching Application to PostgreSQL"
echo "------------------------------------------------"

# Ask for credentials
read -p "Database Name [$DEFAULT_DB_DATABASE]: " DB_DATABASE
DB_DATABASE=${DB_DATABASE:-$DEFAULT_DB_DATABASE}

read -p "Database User [$DEFAULT_DB_USERNAME]: " DB_USERNAME
DB_USERNAME=${DB_USERNAME:-$DEFAULT_DB_USERNAME}

read -s -p "Database Password: " DB_PASSWORD
echo ""

read -p "Database Host [$DEFAULT_DB_HOST]: " DB_HOST
DB_HOST=${DB_HOST:-$DEFAULT_DB_HOST}

read -p "Database Port [$DEFAULT_DB_PORT]: " DB_PORT
DB_PORT=${DB_PORT:-$DEFAULT_DB_PORT}

echo "------------------------------------------------"
echo "Updating .env file..."

# Function to update or add env var
update_env() {
    local key=$1
    local value=$2
    if grep -q "^${key}=" .env; then
        # Use sed to replace the line. 
        # Note: escaping special chars in value might be needed for robust scripts, 
        # but for simple passwords this usually works.
        sed -i '' "s|^${key}=.*|${key}=${value}|" .env
    else
        echo "${key}=${value}" >> .env
    fi
}

update_env "DB_CONNECTION" "pgsql"
update_env "DB_HOST" "$DB_HOST"
update_env "DB_PORT" "$DB_PORT"
update_env "DB_DATABASE" "$DB_DATABASE"
update_env "DB_USERNAME" "$DB_USERNAME"
update_env "DB_PASSWORD" "$DB_PASSWORD"

echo ".env updated."
echo "------------------------------------------------"

# Confirm before migration
read -p "Do you want to run 'php artisan migrate:fresh --seed' now? (This will ERASE existing data) [y/N]: " RUN_MIGRATE
if [[ "$RUN_MIGRATE" =~ ^[Yy]$ ]]; then
    echo "Running migrations..."
    php artisan migrate:fresh --seed
    echo "Done!"
else
    echo "Skipping migration. Please run 'php artisan migrate' manually."
fi

echo "------------------------------------------------"
echo "Switch to PostgreSQL complete!"
