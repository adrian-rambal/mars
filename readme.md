Set up environment provided as Docker container

$ bash docker-build.sh # builds the Docker image

$ bash docker-run.sh # interactive bash inside the container

Inside the docker interactive bash session:

$ bash scripts/run-tests.sh

TIP: To make development easier, once inside the container's bash session we can refresh the application files by running: 

$ docker cp . CONTAINER:/usr/src/myapp # from our laptop session





