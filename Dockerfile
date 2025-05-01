FROM alpine:latest AS alpine-source
RUN apk add --no-cache unzip

FROM php:8.3.16-zts
# Install PCOV
RUN pecl install pcov && docker-php-ext-enable pcov
# Enable PCOV
ENV PCOV_ENABLED=1
COPY . /usr/src/workspace
WORKDIR /usr/src/workspace
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

COPY --from=alpine-source /lib/ /lib/
COPY --from=alpine-source /usr/lib/ /usr/lib/

COPY --from=alpine-source /usr/bin/unzip /usr/bin/unzip

# install the composer dependencies once
RUN composer update