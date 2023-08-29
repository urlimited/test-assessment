FROM nginx:1.23.2

COPY ./deployment/configs/ga_webserver.conf /etc/nginx/conf.d/
RUN rm /etc/nginx/conf.d/default.conf