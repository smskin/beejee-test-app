FROM nginx:latest

ARG TZ=Europe/Moscow
RUN echo "Define variable TZ. New value: ${TZ}";
ARG APP_CODE_PATH_CONTAINER=/var/www/html
RUN echo "Define variable APP_CODE_PATH_CONTAINER. New value: ${APP_CODE_PATH_CONTAINER}";

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo ${TZ} > /etc/timezone

COPY ./conf/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./conf/nginx/conf.d /etc/nginx/conf.d

WORKDIR ${APP_CODE_PATH_CONTAINER}

#####################################
#  Clean up APT:
#####################################
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
