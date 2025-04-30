FROM alpine:latest AS alpine-source
RUN apk add --no-cache unzip
#RUN apk add --no-cache git unzip


FROM php:8.3.16-zts
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

#COPY --from=alpine-source /usr/bin/git /usr/bin/git
#COPY --from=alpine-source /usr/libexec/git-core /usr/libexec/git-core
COPY --from=alpine-source /lib/ /lib/
COPY --from=alpine-source /usr/lib/ /usr/lib/

COPY --from=alpine-source /usr/bin/unzip /usr/bin/unzip