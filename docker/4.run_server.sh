#! /bin/bash

docker image load -i bsk_2017.tar
# "tail -f /dev/null" - endless command to keep server alive
docker run -it -p 8080:80 bsk_2017 /bin/bash -c "/tmp/_run_server.sh && tail -f /dev/null"