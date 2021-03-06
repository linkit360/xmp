FROM nginx:1.13.0-alpine

# Deps
RUN apk add --progress --no-cache bash openssl certbot

# Env
EXPOSE 8080 8443
ENV TERM xterm

# Add Group and User
RUN addgroup -g 1000 docker
RUN adduser -S -D -s /bin/bash -u 1000 -G docker docker

# Configs
COPY config/ /config
RUN cp /config/.bashrc /home/docker
RUN mv /config/.bashrc /root
RUN mv /config/nginx.nginx /etc/nginx/nginx.conf
RUN mv /config/nginx.vh.default.nginx /etc/nginx/conf.d/default.conf

# Permissions
RUN touch /var/run/nginx.pid
RUN mkdir -p /var/cache/nginx
RUN chown -R 1000:1000 /var/cache/nginx
RUN chown -R 1000:1000 /etc/nginx
RUN chown -R 1000:1000 /var/log/nginx
RUN chown -R 1000:1000 /var/run/nginx.pid
RUN chmod +x /config/start.sh

# User switch
WORKDIR /config
USER 1000
ENTRYPOINT ["bash", "/config/start.sh"]
