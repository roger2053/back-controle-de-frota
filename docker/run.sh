#!/bin/bash
set -e

composer install

/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
