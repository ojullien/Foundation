#!/bin/sh

#************************************************#
#                    run.sh                      #
#               by Olivier Jullien               #
#                   07.05.2013                   #
#                                                #
# Runs phpunit tests.                            #
#************************************************#

#------------------------------------#
# Defines working directory          #
#------------------------------------#
m_DIRAS=$(/usr/bin/dirname $(/bin/readlink -f $0))

#------------------------------------#
# Mandatory arguments                #
#------------------------------------#
if [ $# -lt 1 -o -z "$1" ]; then
    echo "Usage: `/usr/bin/basename $0` <module>"
    exit 1
fi
m_MODULE=$1
${m_DIRAS}/../../vendor/bin/phpunit --verbose --configuration  ${m_DIRAS}/../Foundation/${m_MODULE}/config.xml
