FROM nginx:1.10

ADD ./settings/nginx/vhost.conf /etc/nginx/conf.d/default.conf
