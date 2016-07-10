#!/bin/bash

cat << HELP

------------------------------------------------------------
        Checking PHP Syntax errors.
        Include the path:
                            application/config
                            application/controllers
                            application/libraries
                            application/hooks
                            application/helpers
                            application/models

        Author :  Steven Wang
        Version:  V2.0.2
------------------------------------------------------------

HELP
# system/libraries system/core system/database
dir_list="application/config application/controllers application/libraries application/hooks application/helpers \
application/models"
for item in $dir_list; do
    printf "%-70s ...\n" "Parsing dir $item"

    file_list=`find $item | grep -E "*.php"`
    for file in $file_list; do
        php -l $file >/dev/null 2>&1
        [ "$?" != "0" ] && {
            printf "%-70s ... Error\n" $file
            php -l $file 2>&1
            exit -1
        }
        printf "%-70s ... Ok\n" $file
    done

    echo
done

echo
echo 'Checking finished, No Error.'
echo
exit 0
