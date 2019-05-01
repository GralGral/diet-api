#!/bin/bash

usermod -u `stat -c %u $APPLICATION_PATH` $APPLICATION_USER
groupmod -g `stat -c %g $APPLICATION_PATH` $APPLICATION_GROUP

exec "$@"
