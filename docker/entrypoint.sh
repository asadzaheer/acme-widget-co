#!/bin/sh

# Run PHPStan
phpstan analyse src --level max

# Run PHPUnit tests
if [ -f vendor/bin/phpunit ]; then
    vendor/bin/phpunit
else
    echo "PHPUnit not found. Please install it using Composer."
fi

# By default, start a PHP interactive shell
exec php -a
