#! /bin/bash

rm bsk_2017.tar
docker rm -f `docker ps -aq`
docker rmi bsk_2017