#!/bin/bash
path=`dirname $(readlink -f ${0})`;
cd $path
echo "Delete typo3temp/Cache/*"
rm ../../../../../../typo3temp/Cache/* -rf
echo "Truncate all TYPO3 caching tables:"

if [ "${1}" == "--flush-redis" ]; then
        echo "Leere Redis";
        ./TruncateDBCache.phpsh -f;
else
        ./TruncateDBCache.phpsh
fi
