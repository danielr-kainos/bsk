#! /bin/bash

# Assumed only one container is runnuing
docker cp `docker ps -q`:/etc/ssl/certs/some.crt .