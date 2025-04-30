Set up environment provided as Docker container

$ docker-build.sh # builds the Docker image

$ docker-run.sh # interactive bash inside the container

Inside the docker interactive bash session:

composer update # installs dependencies

./vendor/bin/phpunit --testdox tests # executes tests





