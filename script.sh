#bin/bash
docker-machine create --driver virtualbox aazeroua
docker-machine start aazeroua
eval $(docker-machine env aazeroua)