#! /bin/bash

#assume only one container is running
CONTAINER_ID=`docker ps -q`

docker commit $CONTAINER_ID bsk_2017
docker rm --force $CONTAINER_ID
docker image save bsk_2017 -o bsk_2017.tar
docker rmi bsk_2017