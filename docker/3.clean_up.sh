#! /bin/bash

IMAGE_NAME="bsk_image"

# remove all current containers
docker rm -f `docker ps -aq`

# remove image
docker rmi $IMAGE_NAME

# remove image.tar
# rm ${IMAGE_NAME}.tar