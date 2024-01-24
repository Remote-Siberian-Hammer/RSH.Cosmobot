FROM node:lts-alpine

WORKDIR /var/www/application

EXPOSE 5173

ENTRYPOINT [ "npm",  "--ignore-platform-reqs"]
