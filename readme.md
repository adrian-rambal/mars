## Overview

### Entities

- **MarsMission** : the whole of the mission. It provides a Commander to interface with the rover. This is the class meant to be used to interact with the rover.


- **Commander**: module that lies in the rover, used to execute commands.

- **Rover**: Composed by Mover (calculates where to go) and obstacle detector.



## Requirements

Linux: (at least tested on Linux Mint 21)

Docker:  v26.1.x (it may work on previous versions)


## Test Execution

The project can be executed inside a Docker container. The provided Dockerfile contains all the required execution dependencies needed.

```
bash docker-build.sh # builds the Docker image
```

> Heads UP: Check the output of the console to see the php dependencies are downloaded successfully(composer)

```
bash docker-run.sh # interactive bash session inside the container
```

Once you are on the containers session, execute the project test suite. Note that there is no need to install php dependencies, they are already downloaded at "Docker build" time.

```
bash scripts/run-unit.sh

bash scripts/run-integration.sh
```

## Development

### Set up development environment

> TIP: To make development easier, we can use the docker container as our development environment.

This process is like the Execution one. Be sure to follow the Execution section before continuing here. 

Once your session to the container is opened, open another terminal session in **your** machine. From **your** machine we can send new source code to the already running development.

From the session in **your** machine, `cd`into the project root foolder and execute:

```
# replace CONTAINER_ID with the appropiate id that you may find when running the docker container.

docker cp . CONTAINER_ID:/usr/src/workspace # from our laptop session
```

This will copy the modified project source from **your** machine into the container.

Now in the container session you may want to update or install again the dependencies. Even check code coverage.

```
composer update

composer install

bash scripts/run-coverage.sh
```
### Tests conventions

We distinguish between unit testing and integration testing.

`MoverTest.php`: unit tests for `Mover.php` class.

`MoverITTest.php`: integration test for `Mover.php` class.





