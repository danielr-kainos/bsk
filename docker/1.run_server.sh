#! /bin/bash

IMAGE_NAME="bsk_image"

docker image load -i ${IMAGE_NAME}.tar
docker run -it -p 80:80 -p 443:443 \
	${IMAGE_NAME} /bin/bash -c "/tmp/_run_server.sh && bash"
