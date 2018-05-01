FROM mariadb:10.0.34

MAINTAINER Bruno Correia <brunogomescorreia@gmail.com>

COPY my.cnf /etc/mysql/my.cnf

ADD dump/* /docker-entrypoint-initdb.d/
