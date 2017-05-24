#! /bin/bash

#assume only one container is running
CONTAINER_ID=`docker ps -q`

docker exec -ti $CONTAINER_ID bash -c "rm -rf /tmp/*"

docker cp ../sql $CONTAINER_ID:/tmp/
docker cp ../php $CONTAINER_ID:/tmp/
docker cp ../ssl $CONTAINER_ID:/tmp/
docker cp ../conf $CONTAINER_ID:/tmp/
docker cp _run_server.sh $CONTAINER_ID:/tmp/
docker cp _setup_docker.sh $CONTAINER_ID:/tmp/