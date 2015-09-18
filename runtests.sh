#!/bin/bash

PHP_BIN="/usr/local/bin/php"

#####################################
# no need to change
#####################################

#checking php syntax
for folder in "public" "application" "tests"; do
    echo -n "Checking syntax for *.php in ./${folder}, "
    error_output=`find "./${folder}" -type f -iname "*.php" -exec ${PHP_BIN} -l {} \; | grep -i "Errors.parsing"`
    if [ "$error_output" != "" ]; then
        echo "failed!"
        echo $error_output
        exit 1
    else
        echo "OK!"
    fi
done

${PHP_BIN} ./vendor/bin/phpunit -c tests/phpunit.xml