FROM mysql:8.0

COPY ./data/ /docker-entrypoint-initdb.d/
RUN chmod +x /docker-entrypoint-initdb.d/1_init_scheme.sh
