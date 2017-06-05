FROM debian:8
MAINTAINER Łukasz Koper <hwt365@gmail.com>

RUN apt-get update
RUN apt-get install -y apache2 \
		libapache2-mod-php5 \
		php5 \
		php5-pgsql \
		postgresql-9.4 \
		postgresql-contrib-9.4

COPY sql /tmp/sql
COPY php /tmp/php
COPY conf /tmp/conf
COPY docker/_generate_key.sh /tmp/_generate_key.sh
COPY docker/_setup_docker.sh /tmp/_setup_docker.sh
COPY docker/_run_server.sh /tmp/_run_server.sh

ARG IP
RUN bash -c "/tmp/_generate_key.sh $IP"
RUN bash -c "source /tmp/_setup_docker.sh"
