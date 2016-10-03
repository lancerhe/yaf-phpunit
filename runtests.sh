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
        echo -e "\033[41;37mfailed!\033[0m"
        echo -e "\033[41;37m$error_output\033[0m"
        exit 1
    else
        echo "OK!"
    fi
done

echo -e "\r\n\033[43;37mRun unit tests.\033[0m"
${PHP_BIN} ./vendor/bin/phpunit -c tests/site/phpunit.xml --testsuite unit
echo -e "\r\n\033[43;37mRun acceptance tests.\033[0m"
${PHP_BIN} ./vendor/bin/phpunit -c tests/site/phpunit.xml --testsuite acceptance