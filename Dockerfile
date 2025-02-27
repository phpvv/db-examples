FROM ubuntu:20.04

# OS
ENV DEBIAN_FRONTEND=noninteractive

RUN sed -i 's/^deb http:\/\/archive\./deb http:\/\/ua.archive./g' /etc/apt/sources.list \
    && apt-get update \
    #
    # add repositoies
    && apt-get install software-properties-common -y \
    && add-apt-repository -y ppa:ondrej/php \
    #
    # common soft
    && apt-get update \
    && apt-get install -y sudo mc wget curl git \
    #
    # php
    && apt-get -y install \
        php${PHP_VER}-cli \
        php${PHP_VER}-pgsql \
    && mkdir -p /run/php \
    #
    # postgres
    && sh -c 'echo "deb http://apt.postgresql.org/pub/repos/apt $(lsb_release -cs)-pgdg main" > /etc/apt/sources.list.d/pgdg.list' \
    && wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - \
    && apt-get -y install postgresql \
    && echo "listen_addresses='*'" >> /etc/postgresql/12/main/postgresql.conf \
    #
    # clean
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app/src
COPY ./docker/dump ./dump
COPY ./docker/pg_hba.conf /etc/postgresql/12/main/pg_hba.conf

RUN service postgresql start \
    && sudo -u postgres psql < ./dump/00.user-schema-etc.sql \
    && PGPASSWORD=vv_example psql -U vv_example vv_example < ./dump/01.struct.sql \
    && PGPASSWORD=vv_example psql -U vv_example vv_example < ./dump/02.data.sql

EXPOSE 5432

CMD service postgresql start && bash
