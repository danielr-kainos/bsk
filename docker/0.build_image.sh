#! /bin/bash

CONT_NAME="bsk_container"
IMAGE_NAME="bsk_image"

if [ -z "$1" ]
then
    echo "Argument not present."
    echo "Useage $0 [common name]"
 
    exit 99
fi

if [ -f ${IMAGE_NAME}.tar ]
then
    docker image load -i ${IMAGE_NAME}.tar
    rm ${IMAGE_NAME}.tar
fi

docker build -t $IMAGE_NAME --build-arg IP=$1 ..
docker image save $IMAGE_NAME -o ${IMAGE_NAME}.tar
docker rmi --force $IMAGE_NAME
