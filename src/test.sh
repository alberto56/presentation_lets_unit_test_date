#!/bin/bash
set -e

# See https://hub.docker.com/r/phpunit/phpunit/
docker run -ti -v $(pwd)/src:/app phpunit/phpunit --group custom
